<?php


require_once __DIR__ . "/../Common/Environmento.php";
require_once __DIR__ . "/../Models/QueuesConfig.php";

Environment::load(__DIR__ . "/../../");


class QueuesConfigController {

    public function get()
    {
        $queuesConfig = new QueuesConfig();

        $consult = $queuesConfig->getQueues();
        $queues=[];

        for ($ind = 0; $ind < count($consult); $ind++)
        {
            array_push($queues, $consult[$ind]["queues_config_fila"]);
        }

        return $queues;
    }
}