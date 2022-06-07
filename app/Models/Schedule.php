<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../Connection/Sql.php";


class Schedule extends Connection {

    public $table;

    public function __construct()
    {
        $this->table = "ctl_schedule" ;       
    }

    public function save($params)
    {
        try {
        
            $query = "INSERT INTO $this->table (
                name, telefone1, tipo
            ) VALUES (
                :name, :telefone1, :tipo
            );";

            $stmt = $this->db()->prepare($query);

            foreach ($params as $key => $item)
            {
                if ($key == "nome") $stmt->bindValue(":name", $item);
                if ($key == "telefone1") $stmt->bindValue(":telefone1", $item);
                if ($key == "tipo") $stmt->bindValue(":tipo", $item);
            }

            $stmt->execute();

            return $stmt;
            
        } catch (\PDOException $err) {
        }
    }
}