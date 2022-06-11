<?php 

require_once __DIR__ . "/../Common/Environmento.php";
require_once __DIR__ . "/../Traits/HttpTrait.php";
require_once __DIR__ . "/../Controllers/LoginController.php";
require_once __DIR__ . "/../Models/Totalizer.php";

Environment::load(__DIR__ . "/../../");


class GetTotalizerController 
{
    use HttpTrait;

    public function get()
    {
        $loginController = new LoginController();
        $totalizer = new Totalizer();
        
        # Recupera o token de acesso a API da King Voice realizando a chamada Login.
        $token = $loginController->auth()->token;

        # Recupera a data do dia anterior.
        $lastDay = gmdate("Y-m-d", time()-(3600*27));

        $response = $this->getTotalizerApi($data=array(
            "dataInicial" => "$lastDay 00:00:00",
            "dataFinal" => "$lastDay 23:59:59",
            "agruparPor" => "dia",
            "totalPorPagina" => 200000
        ), $token);

        for ($idx = 0; $idx < intval($response->totalRegistros); $idx++)
        {
            $totalizer->save($response->resultados[$idx]);
        }
        return true;
    }
}