<?php

namespace App\Core;

class AutoLoad {

    public static function start() {
        spl_autoload_register(array(__CLASS__, 'load'));

        $root = $_SERVER['DOCUMENT_ROOT'];
        $host = $_SERVER['HTTP_HOST'];

        define('HOST', 'http://'.$host.'/');
        define('ROOT', $root.'/');

        define('CONTROLLERS', ROOT.'App/Controllers/');
        define('MODELS', ROOT.'App/Models/');
        define('VIEWS', ROOT.'App/views/');
        define('CLASSES', ROOT.'App/Utils/');
        define('ENTITIES', ROOT.'App/Entities/');
        define('IMAGES', ROOT.'assets/');

        define('ASSETS', HOST.'assets/');
    }

    public static function load($class) {
        $class = str_replace(__NAMESPACE__, "", $class);
        $class = explode('\\', $class)[sizeof(explode('\\', $class)) - 1];
        if (file_exists(MODELS.$class.'.php')) {
            include_once(MODELS.$class.'.php');
        } elseif (file_exists(CLASSES.$class.'.php')) {
            include_once(CLASSES.$class.'.php');
        } elseif (file_exists(ENTITIES.$class.'.php')) {
            include_once(ENTITIES.$class.'.php');
        } elseif (file_exists(CONTROLLERS.$class.'.php')) {
            include_once(CONTROLLERS.$class.'.php');
        }
    }

}
