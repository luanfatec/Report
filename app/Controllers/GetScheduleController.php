<?php 

require_once __DIR__ . "/../Common/Environmento.php";
require_once __DIR__ . "/../Traits/HttpTrait.php";
require_once __DIR__ . "/../Controllers/LoginController.php";
require_once __DIR__ . "/../Models/Schedule.php";

Environment::load(__DIR__ . "/../../");


class GetScheduleController 
{
    use HttpTrait;

    public function get()
    {
        $loginController = new LoginController();
        $schedule = new Schedule();
        
        # Recupera o token de acesso a API da King Voice realizando a chamada Login.
        $token = $loginController->auth()->token;

        # Recupera a data do dia anterior.
        $lastDay = gmdate("Y-m-d", time()-(3600*27));

        $response = $this->getSchedule($data=array(
            "tipo" => "IN",
            "totalPorPagina" => 200000
        ), $token);

        for ($idx = 0; $idx < intval($response->totalRegistros); $idx++)
        {
            $schedule->save($response->resultados[$idx]);
        }

    }
}