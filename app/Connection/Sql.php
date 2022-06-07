<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once "./app/Common/Environmento.php";
Environment::load(__DIR__ . "/../../");

// 

class Connection {

    public function db()
    {
        try {
            $conn = new \PDO("mysql:host=" . getenv("MYSQL_HOST") . ";dbname=". getenv("MYSQL_DATABASE"), getenv("MYSQL_USER"), getenv("MYSQL_PASSWORD"));
            return $conn;
        } catch (\PDOException $err) {
            $err->getMessage();
        }
    }
}