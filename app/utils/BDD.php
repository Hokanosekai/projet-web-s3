<?php

class BDD {
    private $hostname = "localhost";
    private $username = "";
    private $password = "";
    private $database = "";

    protected function connect() {
        $dsn = 'mysql:host='.$this->hostname.';port=3308;dbname='.$this->database;
        $pdo = new PDO(
            $dsn,
            $this->username,
            $this->password,
            array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
            )
        );
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}