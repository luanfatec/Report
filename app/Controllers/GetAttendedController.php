<?php

use function PHPSTORM_META\type;

require_once __DIR__ . "/../Common/Environmento.php";
require_once __DIR__ . "/../Traits/HttpTrait.php";
require_once __DIR__ . "/../Controllers/LoginController.php";
require_once __DIR__ . "/../Controllers/QueuesConfigController.php";

Environment::load(__DIR__ . "/../../");


class GetAttendedController {

    use HttpTrait;

    public function get()
    {
        $loginController = new LoginController();
        $queuesConfigController = new QueuesConfigController();

        $token = $loginController->auth()->token;

        # Recupera as filas cadastradas.
        $queues = $queuesConfigController->get();
        
        $resp = $this->getHistoriesAttended($data=array(
            "dataInicial" => "2022-06-01 00:00:00",
            "dataFinal" => "2022-06-30 23:40:00",
            "filas" => $queues, 
            "totalPorPagina" => 200000
        ), $token);

        foreach($resp as $item)
        {
            print_r($item);
        }

    }
}