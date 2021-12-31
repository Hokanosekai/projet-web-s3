<?php

namespace App\Utils;

use \PDO;

class BDD {

    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "webticket";

    /**
     * Methode pour se connecter à la base de donnée
     *
     * @return PDO
     */
    protected function connect() {
        $dsn = 'mysql:host='.$this->hostname.';port=3306;dbname='.$this->database;
        $pdo = new PDO(
            $dsn,
            $this->username,
            $this->password
        );
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}