<?php


require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../Connection/Sql.php";
require_once __DIR__ . "/../Helpers/FormatHours.php";



class QueuesConfig extends Connection {

    private $table;

    public function __construct()
    {
        $this->table = "ctl_queues_config";    
    }

    public function getQueues()
    {
        $query = "SELECT queues_config_fila FROM " . $this->table;

        $stmt = $this->db()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}