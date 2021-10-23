<?php

/**
 * Class Dashboard
 */
class Dashboard {

    /**
     * @param $params
     */
    public function index($params) {

        $view = new View("dashboard/dashboard");

        if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
            $view->redirect('home');
        }

        $view->render([], 'dashboard');
    }

    /**
     * @param $params
     */
    public function listUser($params) {
        $view = new View("dashboard/list-users");

        if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
            $view->redirect('home');
        }

        $view->render([], 'dashboard');
    }

    /**
     * @param $params
     */
    public function listEvt($params) {
        $view = new View("dashboard/list-evenements");

        if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
            $view->redirect('home');
        }

        $view->render([], 'dashboard');
    }

    /**
     * @param $params
     */
    public function editEvt($params) {
        $view = new View("dashboard/edit-evenements");

        if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
            $view->redirect('home');
        }

        $view->render([], 'dashboard');
    }

}