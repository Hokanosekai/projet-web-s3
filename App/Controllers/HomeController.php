<?php

namespace App\Controllers;

use \App\Models\EvenementModel;
use App\Models\ReservationModel;
use \App\Models\UserModel;
use \App\Utils\EvtTypes;
use \App\Utils\View;

class HomeController {

    /**
     * Methode pour la page /
     *
     * TODO :
     *  - A refaire
     *
     * @param $params
     */
    public function index($params) {
        $evenementManager = new EvenementModel();

        $theatres = $evenementManager->findAll(1, 0, EvtTypes::THEATRE);
        $concerts = $evenementManager->findAll(1, 0, EvtTypes::CONCERT);
        $humours = $evenementManager->findAll(1, 0, EvtTypes::HUMOUR);
        $expositions = $evenementManager->findAll(1, 0, EvtTypes::EXPOSITION);

        $view = new View('home/home');
        $view->render([
            'piece' => $theatres[0],
            'concert' => $concerts[0],
            'humour' => $humours[0],
            'exposition' => $expositions[0],
        ]);
    }

    /**
     * Methode pour la page error 404
     *
     * @param $params
     */
    public function error($params) {
        $view = new View('home/error');

        $view->render();
    }

    /**
     * Methode pour la page /login
     *  - permet la connexion de l'Utilisateur
     *
     * @param $params
     */
    public function login($params) {

        $view = new View('home/login');

        $userManager = new UserModel();
        $errors = [];

        if (!empty($_POST)) {

            if (
                !empty($_POST['mail']) &&
                !empty($_POST['password'])
            ) {

                $mail = htmlspecialchars(trim($_POST['mail']));
                $password = htmlspecialchars(trim($_POST['password']));

                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                    if ($userManager->exists($mail)) {

                        $user = $userManager->findOne($mail);

                        if (password_verify($password, $user->getPassword())) {

                            unset($_SESSION['mail']);

                            $_SESSION['user'] = [
                                "nom" => $user->getNom(),
                                "prenom" => $user->getPrenom(),
                                "mail" => $user->getMail(),
                                "type" => $user->getType(),
                                "id" => $user->getId(),
                            ];

                            $view->redirect('home');

                        } else {
                            $errors['password'] = "Mot de passe incorrect";
                        }

                    } else {
                        $errors['user'] = "E-mail invalide";
                    }

                } else {
                    $errors['mail'] = "Merci de renseigner un mail valide";
                }

            } else {
                $errors['empty'] = "Merci de compléter tous les champs";
            }
        }


        $view->render([
            'errors' => $errors
        ]);
    }

    public function listReservations($params) {
        $view = new View('home/reservations');

        if (empty($_SESSION['user'])) {
            $view->redirect('home');
        }

        $reservationManager = new ReservationModel();

        $reservations = $reservationManager->findAllByUsers($_SESSION['user']['id']);

        $view->render([
            "reservations" => $reservations
        ]);

    }

    /**
     * Methode pour la page /logout
     *  - permet la deconnexion de l'Utilisateur
     *
     * @param $params
     */
    public function logout($params) {
        unset($_SESSION['user']);
        $view = new View();
        $view->redirect('home');
    }


    /**
     * Methode pour la page /register
     *  - permet l'enregistrement d'un nouvel Utilisateur
     *
     * @param $params
     */
    public function register($params) {

        $view = new View('home/register');

        $userManager = new UserModel();
        $errors = [];

        if (!empty($_POST)) {

            if (
                !empty($_POST['nom']) &&
                !empty($_POST['prenom']) &&
                !empty($_POST['mail']) &&
                !empty($_POST['password']) &&
                !empty($_POST['confirm_password'])
            ) {

                $nom = htmlspecialchars(trim($_POST['nom']));
                $prenom = htmlspecialchars(trim($_POST['prenom']));
                $mail = htmlspecialchars(trim($_POST['mail']));
                $password = htmlspecialchars(trim($_POST['password']));
                $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));

                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                    $user = $userManager->findOne($mail);

                    if ($user->getMail() == null) {

                        if ($password == $confirm_password) {

                            $hash = password_hash($password, PASSWORD_BCRYPT);

                            $result = $userManager->create($nom, $prenom, $mail, $hash);

                            if ($result) {
                                $_SESSION['mail'] = $mail;

                                $view->redirect('login');
                            } else {
                                $errors['sql'] = "Une erreur s'est produite";
                            }

                        } else {
                            $errors['password'] = "Les mots de passe ne correspondent pas";
                        }

                    } else {
                        $errors['user'] = "Il y a déja un compte associé à cette e-mail";
                    }

                } else {
                    $errors['mail'] = "Merci de renseigner un mail valide";
                }

            } else {
                $errors['empty'] = "Merci de compléter tous les champs";
            }
        }


        $view->render([
            'errors' => $errors
        ]);
    }
}