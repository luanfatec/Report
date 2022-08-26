<?php


require_once __DIR__ . "/../Common/Environmento.php";
require_once __DIR__ . "/../Traits/HttpTrait.php";
require_once __DIR__ . "/../Models/StatisticsQueues.php";
require_once __DIR__ . "/../Controllers/LoginController.php";
require_once __DIR__ . "/../Controllers/QueuesConfigController.php";

Environment::load(__DIR__ . "/../../");


class GetStatisticsQueuesController {

    use HttpTrait;

    /**
     * Busca pelos dados das estatisticas.
     * Salva os dados em uma base de dados para análises.
     *
     * @return void
     */
    public function get()
    {
        # Inícialização das classes.
        $loginController = new LoginController();
        $queuesConfigController = new QueuesConfigController();
        $statisticsQueuesModel = new StatisticsQueues();

        # Recupera o token de acesso a API da King Voice realizando a chamada Login.
        $token = $loginController->auth()->token;

        # Recupera as filas cadastradas.
        $queues = explode(",", $queuesConfigController->get());

        # Recupera a data do dia anterior.
        $lastDay = gmdate("Y-m-d", time()-(3600*27));

        

        foreach ($queues as $queue)
        {
            $response = $this->getStatisticsQueues($data=array(
                "dataInicial" => "$lastDay 00:00:00",
                "dataFinal" => "$lastDay 23:59:59",
                "filas" => $queue, 
                "agruparPor" => "dia",
                "totalPorPagina" => 200000
            ), $token);             
            
            // Buscando dados dentro do array recuperado da requisição.
            for ($idx = 0; $idx < intval($response->totalRegistros); $idx++)
            {                
                // Salvando cada objeto.
                $statisticsQueuesModel->save($queue=$queue, $params=$response->resultados[$idx]);
            }

            // Essa espera de 5 segundos é necessária para não exceder o máximo de requisições na API.
            sleep(5);
        }       
        
    }
}
