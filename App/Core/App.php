<?php

namespace App\Core;

use App\Controllers\HomeController;
use App\Controllers\DashboardController;
use App\Controllers\EvenementController;
use App\Controllers\APIController;

class App {

    private $routes = [
        // HomeController
        "home" => ["controller" => "App\\Controllers\\HomeController", "method" => "index"],
        "error" => ["controller" => "App\\Controllers\\HomeController", "method" => "error"],

        // HomeController (connexion)
        "login" => ["controller" => "App\\Controllers\\HomeController", "method" => "login"],
        "logout" => ["controller" => "App\\Controllers\\HomeController", "method" => "logout"],
        "register" => ["controller" => "App\\Controllers\\HomeController", "method" => "register"],

        // HomeController (reservations)
        "reservations" => ["controller" => "App\\Controllers\\HomeController", "method" => "listReservations"],

        // HomeController (evenements)
        "humours" => ["controller" => "App\\Controllers\\EvenementController", "method" => "humour"],
        "theatres" => ["controller" => "App\\Controllers\\EvenementController", "method" => "theatre"],
        "concerts" => ["controller" => "App\\Controllers\\EvenementController", "method" => "concert"],
        "expositions" => ["controller" => "App\\Controllers\\EvenementController", "method" => "exposition"],

        // HomeController (evenement)
        "evenement" => ["controller" => "App\\Controllers\\EvenementController", "method" => "evt"],

        // DashboardController
        "dashboard" => ["controller" => "App\\Controllers\\DashboardController", "method" => "index"],
        "statistiques" => ["controller" => "App\\Controllers\\DashboardController", "method" => "statistic"],

        // DashboardController (list)
        "list-users" => ["controller" => "App\\Controllers\\DashboardController", "method" => "listUser"],
        "list-evenements" => ["controller" => "App\\Controllers\\DashboardController", "method" => "listEvt"],

        // DashboardController (edit/create)
        "edit" => ["controller" => "App\\Controllers\\DashboardController", "method" => "editEvt"],
        "create" => ["controller" => "App\\Controllers\\DashboardController", "method" => "editEvt"],

        // DashboardController (delete)
        "evenement-delete" => ["controller" => "App\\Controllers\\DashboardController", "method" => "deleteEvt"],
        "user-delete" => ["controller" => "App\\Controllers\\DashboardController", "method" => "deleteUser"],
        "reservation-delete" => ["controller" => "App\\Controllers\\DashboardController", "method" => "deleteResa"],

        // APIController
        "api-count" => ["controller" => "App\\Controllers\\APIController", "method" => "count"],
        "api-reservations" => ["controller" => "App\\Controllers\\APIController", "method" => "reservations"],
    ];

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
     * Récupère la page via l'URL
     * @return mixed|string
     */
    public function getRoute() {
        return !empty($_GET)?
            explode('/', $_GET['url'])[0] :
            'home';
    }

    /**
     * Récupère les paramètres depuis l'URL sous forme d'une Array
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