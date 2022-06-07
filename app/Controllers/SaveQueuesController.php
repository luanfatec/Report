<?php 

require_once __DIR__ . "/../Common/Environmento.php";
require_once __DIR__ . "/../Models/Queues.php";
require_once __DIR__ . "/../Traits/HttpTrait.php";
require_once __DIR__ . "/../Controllers/LoginController.php";

Environment::load(__DIR__ . "/../../");

class SaveQueuesController {

    use HttpTrait;
    
    public function save($user)
    {
        $queuesModels = new Queues();
        $queues = $this->getApi();

        foreach ($queues as $queue)
        {
            $queuesModels->saveQueues($queue, $user);
        }
    }

    private function getApi()
    {
        # Inícialização das classes.
        $loginController = new LoginController();

        # Recupera o token de acesso a API da King Voice realizando a chamada Login.
        $token = $loginController->auth()->token;

        $queues = $this->getQueuesApi($token);

        return $queues->resultados;
    }
}