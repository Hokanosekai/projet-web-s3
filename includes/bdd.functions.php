<?php
$dbname = 'annuaire';
$dbhost = 'localhost';
$dbuser = 'root';
$dbpswd = '';

try {
    $bdd = new PDO('mysql:host='.$dbhost.';port=3308;dbname='.$dbname,$dbuser,$dbpswd,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch(PDOException $e) {
    die("Une erreur est survenue lors de la connexion à la base de données");
}
?>