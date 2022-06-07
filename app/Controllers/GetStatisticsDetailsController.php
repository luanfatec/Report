<?php


require_once __DIR__ . "/../Common/Environmento.php";
require_once __DIR__ . "/../Traits/HttpTrait.php";
require_once __DIR__ . "/../Controllers/LoginController.php";

Environment::load(__DIR__ . "/../../");


class GetStatisticsDetailsController {

    use HttpTrait;

    public function get()
    {
        $loginController = new LoginController();

        $token = $loginController->auth()->token;
        
        return $this->getStatisticsDetails($data=array(
            "dataInicial" => "2022-01-01 00:00:00",
            "dataFinal" => "2022-05-30 23:40:00",
            "filas" => "901", 
            "agruparPor" => "dia",
            "totalPorPagina" => 200
        ), $token);
    }
}