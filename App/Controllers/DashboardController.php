<?php

namespace App\Controllers;

use App\Entities\Price;
use \App\Models\PriceModel;
use \App\Models\ReservationModel;
use \App\Models\UserModel;
use \App\Models\EvenementModel;
use \App\Entities\Evenement;
use \App\Utils\Utils;
use \App\Utils\View;
use \Exception;

class DashboardController {

    /**
     * Methode de la page /dashboard
     *  - liste les dernières réservations par type (all | theatres | concerts | humours | expositions)
     *  - affiche la somme total gagné
     *  - affiche le nombres d'utilisateurs
     *  - affiche le nombre total de réservations
     *  - (Un graphique permet de voir le nombres de réservation au cours des 10 derniers jours géré en JS avec le controller APIController)
     *
     * @param $params
     */
    public function index($params) {

        $view = new View("dashboard/dashboard");

        if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
            $view->redirect('home');
        }

        $offset = !empty($_POST['offset'])? $_POST['offset'] : 0;
        $type = !empty($_POST['type'])? $_POST['type'] : 0;

        $userManager = new UserModel();
        $reservationManager = new ReservationModel();

        $reservations = $type === 0? $reservationManager->findAll(10, $offset) : $reservationManager->findAll(10, $offset, $type);

        $tot_price = 0;
        foreach ($reservationManager->findAll() as $reservation) {
            $tot_price += $reservation->getPrix();
        }

        $view->render([
            'total_reservation' => number_format($reservationManager->count(), 0, '', ","),
            "total_price" => number_format($tot_price, 2, '.', ""),
            "total_users" => number_format($userManager->count(), 0, '', ","),
            "reservations" => $reservations,
            "offset" => $offset,
            "type" => $type,
            "nb_resa" => $type == 0? $reservationManager->count() : $reservationManager->count($type),
        ], 'dashboard');

        if (isset($_SESSION['notif'])) unset($_SESSION['notif']);
    }

    /**
     * Méthode pour la page /statistiques
     *  - Affiche des graphiques avec du JS avec le controller APIController
     *
     * @param $params
     */
    public function statistic($params) {
        $view = new View("dashboard/statistic");

        if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
            $view->redirect('home');
        }
        $resManager = new ReservationModel();

        $evts = $resManager->findMostReservedEvt();
        $types = $resManager->findMostReservedType();

        $view->render([
            "types" => $types,
            "evenements" => $evts
        ], 'dashboard');
    }

    /**
     * Methode pour la page /list-users
     *  - liste les Utilisateurs par type (all | ayant une réservation | admin | user)
     *
     * @param $params
     */
    public function listUser($params) {
        $view = new View("dashboard/list-users");

        $offset = !empty($_POST['offset'])? $_POST['offset'] : 0;
        $type = !empty($_POST['type'])? $_POST['type'] : 'all';

        $userManager = new UserModel();
        $users = $type === 'all'? $userManager->find(15, $offset) : $userManager->find(15, $offset, $type);

        if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
            $view->redirect('home');
        }

        $view->render([
            "users" => $users,
            "offset" => $offset,
            "nb_users" => sizeof($users),
            "type" => $type
        ],'dashboard');

        if (isset($_SESSION['notif'])) unset($_SESSION['notif']);
    }

    /**
     * Methode pour la page /list-evenements
     *  - liste les Evenements par type (all | theatres | concerts | humours | expositions)
     *
     * @param $params
     */
    public function listEvt($params) {
        $view = new View("dashboard/list-evenements");

        $offset = !empty($_POST['offset'])? $_POST['offset'] : 0;
        $type = !empty($_POST['type'])? $_POST['type'] : 0;

        $evenementsManager = new EvenementModel();
        $evenements = $type === 0? $evenementsManager->findAll(15, $offset) : $evenementsManager->findAll(15, $offset, $type);

        if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
            $view->redirect('home');
        }

        $view->render([
            "evenements" => $evenements,
            "offset" => $offset,
            "nb_evts" => $type == 0? $evenementsManager->count() : $evenementsManager->count($type),
            "type" => $type,
        ], 'dashboard');

        if (isset($_SESSION['notif'])) unset($_SESSION['notif']);
    }

    /**
     * Methode pour la page /create
     *  - créer un nouvel EvenementModel
     *
     * Methode pour la page /edit
     *  - edit un EvenementModel
     *
     * @param $params
     */
    public function editEvt($params) {
        $view = new View("dashboard/edit-evenements");

        $evenementsManager = new EvenementModel();
        $pricesManager = new PriceModel();
        $errors = [];

        if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
            $view->redirect('home');
        }

        $evenement = isset($params['id'])? $evenementsManager->findOne($params['id']) : null;
        $prices = isset($params['id']) ? $pricesManager->findAll($params['id']) : null;

        if (isset($_POST['send'])) {
            if (
                !empty($_POST['description']) &&
                !empty($_POST['title']) &&
                !empty($_POST['type']) &&
                !empty($_POST['date_start']) &&
                !empty($_POST['date_end']) &&
                !empty($_POST['lieu']) &&
                !empty($_POST['places']) &&
                !empty($_POST['img']) &&
                !empty($_POST['nb_price'])
            ) {

                $nb_price = $_POST['nb_price'];

                if ($nb_price > 0) {
                    $prices_input = [];
                    for ($i = 0; $i <= $nb_price-1; $i++) {
                        $name_price = htmlspecialchars($_POST['price' . $i . '_name']);
                        $price_prix = (float) htmlspecialchars($_POST['price' . $i . '_prix']);
                        $price_id = htmlspecialchars($_POST['price' . $i . '_id']);

                        $removed = isset($_POST['price'.$i.'_suppr']);

                        if (empty($name_price) || empty($price_prix)) {
                            $errors['empty_prices'] = "Merci de remplir les champs des prix";
                            $view->render([
                                "evenement" => $evenement,
                                "prices" => $prices,
                                "errors" => $errors
                            ], 'dashboard');
                            return;
                        }

                        if ($removed) {
                             if ($pricesManager->exists($price_id)) {
                                 $pricesManager->deleteOne($price_id);
                             }
                        } else {
                            $p = new Price();
                            $p->setTitre($name_price);
                            $p->setPrix($price_prix);
                            $p->setId($price_id);
                            $prices_input[] = $p;
                        }
                    }

                    $evt = new Evenement();
                    if (!empty($_POST['id'])) $evt->setId($_POST['id']);
                    $evt->setDescription($_POST['description']);
                    $evt->setTitre($_POST['title']);
                    $evt->setTypeID($_POST['type']);
                    $evt->setDateStart(Utils::parseDate($_POST['date_start']));
                    $evt->setDateEnd(Utils::parseDate($_POST['date_end']));
                    $evt->setLieu($_POST['lieu']);
                    $evt->setPlaces($_POST['places']);
                    $evt->setImgPath($_POST['img']);

                    if ($_POST['date_end'] > $_POST['date_start']) {

                        if (filter_var($evt->getImgPath(), FILTER_VALIDATE_URL)) {
                            if (!empty($_POST['id'])) {
                                try {
                                    $evenementsManager->updateOne($evt);

                                    foreach ($prices_input as $price) {
                                        if ($pricesManager->exists($price->getId())) {
                                            $pricesManager->updateOne($price);
                                        } else {
                                            $price->setEvtId($evt->getId());
                                            $pricesManager->createOne($price);
                                        }
                                    }

                                    $errors['succes'] = "🔥 L'évènement à bien été mis à jour <a class='ml-3 text-blue-4' href='".HOST."evenement/id/".$evt->getId()."'>voir</a>";
                                    /*$view->redirect('evenement/id/' . $evt->getId());*/
                                } catch (exception $ex) {
                                    $errors['saved'] = "Une erreur est survenue lors de l'enregistrement";
                                }

                            } else {

                                $id = $evenementsManager->createOne($evt);

                                foreach ($prices_input as $price) {
                                    $price->setEvtId($id);
                                    $pricesManager->createOne($price);
                                }

                                if ($id) {

                                    $errors['succes'] = "🔥 L'évènement à bien été créé <a class='ml-3 text-blue-4' href='".HOST."evenement/id/".$evt->getId()."'>voir</a>";

                                    //$view->redirect('evenement/id/' . $id);
                                } else {
                                    $errors['save'] = "Une erreur est survenue lors de l'enregistrement";
                                }

                            }
                        } else {
                            $errors['img_url'] = "Merci de renseigner une url pour l'image de fond";
                        }
                    } else {
                        $errors['date'] = "Merci de rentrer une date de fin plus grande que la date de début";
                    }
                } else {
                    $errors['prices'] = "Merci de spécifier au moins 1 prix";
                }
            } else {
                $errors['empty'] = "Merci de compléter tous les champs";
            }
        }

        $view->render([
            "evenement" => $evenement,
            "prices" => $prices,
            "errors" => $errors
        ], 'dashboard');
    }

    /**
     * Methode pour la page /evenement-delete
     *  - supprime un EvenementModel
     *
     * @param $params
     */
    public function deleteEvt($params) {
        $view = new View("dashboard/list-evenements");

        $evenementsManager = new EvenementModel();

        if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
            $view->redirect('home');
        }

        if (!isset($params['id'])) {
            $view->redirect('list-evenements');
        }

        try {
            if ($evenementsManager->deleteOne($params['id'])) {
                $_SESSION['notif'] = [
                    "status" => 200,
                    "message" => "L'Evenement à bien été supprimé"
                ];
            } else {
                $_SESSION['notif'] = [
                    "status" => 500,
                    "message" => "L'Evenement na pas été supprimé car il y a des réservations dessus supprimez les avant"
                ];
            }

        } catch (Exception $e) {
            $_SESSION['notif'] = [
                "status" => 500,
                "message" => $e
            ];
            $view->redirect('list-evenements');
        }
        $view->redirect('list-evenements');
    }

    /**
     * Methode pour la page /user-delete
     *  - supprime un Utilisateur
     *
     * @param $params
     */
    public function deleteUser($params) {
        $view = new View("dashboard/list-users");

        $userManager = new UserModel();

        if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
            $view->redirect('home');
        }

        if (!isset($params['id'])) {
            $view->redirect('list-users');
        }

        try {
            if ($userManager->deleteOne($params['id'])) {
                $_SESSION['notif'] = [
                    "status" => 200,
                    "message" => "L'Utilisateur à bien été supprimé"
                ];
            } else {
                $_SESSION['notif'] = [
                    "status" => 500,
                    "message" => "L'Utilisateur na pas été supprimé car il a des réservations en cours supprimez les avant"
                ];
            }

        } catch (Exception $e) {
            $_SESSION['notif'] = [
                "status" => 500,
                "message" => $e
            ];
            $view->redirect('list-users');
        }
        $view->redirect('list-users');
    }

    /**
     * Methode pour la page /reservation-delete
     *  - supprime une Réservation
     *
     * @param $params
     */
    public function deleteResa($params) {
        $view = new View("dashboard/dashboard");

        $reservationManager = new ReservationModel();

        if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
            $view->redirect('home');
        }

        if (!isset($params['id'])) {
            $view->redirect('dashboard');
        }

        try {
            if ($reservationManager->deleteOne($params['id'])) {
                $_SESSION['notif'] = [
                    "status" => 200,
                    "message" => "La Réservation à bien été supprimé"
                ];
            } else {
                $_SESSION['notif'] = [
                    "status" => 500,
                    "message" => "La Réservation na pas été supprimée"
                ];
            }

        } catch (Exception $e) {
            $_SESSION['notif'] = [
                "status" => 500,
                "message" => $e
            ];
            $view->redirect('dashboard');
        }

        $view->redirect('dashboard');
    }
}