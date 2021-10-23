<?php

/**
 * Class App
 */
class App {

    private $routes = [
        "home" => ["controller" => "Home", "method" => "index"],
        "error" => ["controller" => "Home", "method" => "error"],

        "login" => ["controller" => "Home", "method" => "login"],
        "logout" => ["controller" => "Home", "method" => "logout"],
        "register" => ["controller" => "Home", "method" => "register"],

        "humours" => ["controller" => "Evenement", "method" => "humour"],
        "theatres" => ["controller" => "Evenement", "method" => "theatre"],
        "concerts" => ["controller" => "Evenement", "method" => "concert"],
        "expositions" => ["controller" => "Evenement", "method" => "exposition"],

        "dashboard" => ["controller" => "Dashboard", "method" => "index"],
        "list-users" => ["controller" => "Dashboard", "method" => "listUser"],
        "list-evenements" => ["controller" => "Dashboard", "method" => "listEvt"],
        "edit-evenement" => ["controller" => "Dashboard", "method" => "editEvt"],

        "api-count" => ["controller" => "Api", "method" => "count"],
        "api-reservations" => ["controller" => "Api", "method" => "reservations"],
    ];

    /**
     * App constructor.
     */
    public function __construct() {
        $route = $this->getRoute();
        $params = $this->getParams();

        if (key_exists($route, $this->routes)) {
            $controller = $this->routes[$route]['controller'];
            $method = $this->routes[$route]['method'];

            $controller = new $controller();
            $controller->$method($params);
        } else {
            $controller = $this->routes['error']['controller'];
            $method = $this->routes['error']['method'];

            $controller = new $controller();
            $controller->$method($params);
        }
    }

    /**
     * @return mixed|string
     */
    public function getRoute() {
        return !empty($_GET)?
            explode('/', $_GET['url'])[0] :
            'home';
    }

    /**
     * @return array|null
     */
    public function getParams() {
        $url = !empty($_GET)? explode('/', $_GET['url']) : [];
        unset($url[0]);

        for ($i = 1; $i < count($url); $i++) {
            $params[$url[$i]] = $url[$i+1];
            $i++;
        }

        return isset($params)? $params : null;
    }
}