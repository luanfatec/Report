<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../Connection/Sql.php";


class Queues extends Connection {
    
    private $table;

    public function __construct()
    {
        $this->table = "ctl_queues_config";
    }

    public function saveQueues($queues, $user)
    {
        try {
            $query = "INSERT INTO $this->table (
                queues_config_name, queues_config_fila, queues_config_userid
            ) VALUES (
                :name, :queue, (SELECT user_id FROM ctl_users WHERE user_username = :user)
            );";
    
            $stmt = $this->db()->prepare($query);
            $stmt->bindValue(":name", $queues->nome);
            $stmt->bindValue(":queue", strval($queues->fila));
            $stmt->bindValue(":user", $user);
    
            $stmt->execute();
    
            return $stmt; 
        } catch (\PDOException $err) {
        }
               
    }
}