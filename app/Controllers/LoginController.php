<?php

require_once __DIR__ . "/../Common/Environmento.php";
require_once __DIR__ . "/../Traits/HttpTrait.php";

Environment::load(__DIR__ . "/../../");

class LoginController {

    use HttpTrait;

    /**
     * Recupera ou realiza a criação de um novo token.
     * 
     */
    public function auth()
    {
        return $this->login(["login" => getenv("CTL_USER"), "senha" => getenv("CTL_PASSWORD")]);
    }
    
}