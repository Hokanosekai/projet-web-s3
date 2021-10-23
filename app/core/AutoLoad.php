<?php


class AutoLoad {

    public static function start() {
        spl_autoload_register(array(__CLASS__, 'load'));

        $root = $_SERVER['DOCUMENT_ROOT'];
        $host = $_SERVER['HTTP_HOST'];

        define('HOST', 'http://'.$host.'/');
        define('ROOT', $root.'/');

        define('CONTROLLERS', ROOT.'app/controllers/');
        define('MODELS', ROOT.'app/models/');
        define('VIEWS', ROOT.'app/views/');
        define('CLASSES', ROOT.'app/classes/');

        define('ASSETS', HOST.'assets/');
    }

    public static function load($class) {
        if (file_exists(MODELS.$class.'.php')) {
            include_once(MODELS.$class.'.php');
        } elseif (file_exists(CLASSES.$class.'.php')) {
            include_once(CLASSES.$class.'.php');
        } elseif (file_exists(CONTROLLERS.$class.'.php')) {
            include_once(CONTROLLERS.$class.'.php');
        }
    }

}
