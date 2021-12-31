<?php

namespace App\Controllers;

use App\Entities\Reservation;
use \App\Models\EvenementModel;
use \App\Models\PriceModel;
use App\Models\ReservationModel;
use \App\Utils\EvtTypes;
use \App\Utils\View;
use Exception;

class EvenementController {

    /**
     * Methode pour la page /evenement
     *  - affiche les infos d'un EvenementModel
     *  - affiche les Prix de l'EvenementModel
     *
     * @param $params
     */
    public function evt($params) {

        $reservationManager = new ReservationModel();

        $evenementManager = new EvenementModel();
        $evt = $evenementManager->findOne($params['id']);

        $errors = [];

        $priceManager = new PriceModel();
        $prices = $priceManager->findAll($evt->getId());

        $view = new View('evenements/evenement');

        if (isset($_POST['send'])) {

            if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {

                if (
                    !empty($_POST['evt_id']) &&
                    !empty($_POST['date']) &&
                    !empty($_POST['hour']) &&
                    !empty($_POST['price'])
                ) {

                    $nb_prices = sizeof($prices);

                    $prices_details = [];
                    if ($nb_prices > 0) {
                        for ($i = 0; $i <= $nb_prices - 1; $i++) {
                            $count = (int)htmlspecialchars($_POST['price_' . $i]);
                            if ($count > 0) {
                                $price_id = htmlspecialchars($_POST['price_id_' . $i]);
                                $price = $priceManager->findOne($price_id);
                                $total = $count * (float)$price->getPrix();

                                $prices_details[] = [
                                    "count" => $count,
                                    "total" => $total,
                                    "price_id" => $price_id
                                ];
                            }
                        }
                    }

                    $date = htmlspecialchars($_POST['date']);
                    $evt_id = htmlspecialchars($_POST['evt_id']);
                    $hour = htmlspecialchars($_POST['hour']);
                    $price = htmlspecialchars($_POST['price']);

                    $price = str_replace(' €', '', $price);
                    $price = str_replace(',', '.', $price);

                    $reservation = new Reservation();
                    $reservation->setUser($_SESSION['user']['id']);
                    $reservation->setPrix($price);
                    $reservation->setDate($date);
                    $reservation->setHour($hour);
                    $reservation->setEvenement($evt_id);

                    try {
                        if ($reservationManager->create($reservation, $prices_details)) {
                            $errors['succes'] = "😎 Votre réservation a bien été prise en compte";
                        } else {
                            $errors['error'] = "Une erreur est survenue";
                        }
                    } catch (Exception $e) {
                        $errors['error'] = $e->getMessage();
                        $view->render([
                            "errors" => $errors,
                            'evenement' => $evt,
                            'prices' => $prices
                        ]);
                    }

                } else {
                    $errors['error'] = "Merci de remplir tous les champs";
                }
            } else {
                $errors['error'] = "Merci de vous connecter pour pouvoir réserver";
            }
        }

        $view->render([
            "errors" => $errors,
            'evenement' => $evt,
            'prices' => $prices
        ]);
    }

    /**
     * Methode pour la page /theatres
     *  - affiche tous les Evenements de ce type (theatre)
     *
     * @param $params
     */
    public function theatre($params) {
        $theaterManager = new EvenementModel();

        $theatres = $theaterManager->findAll(1000, 0, EvtTypes::THEATRE);

        $view = new View('evenements/theatres');
        $view->render(['evenements' => $theatres]);
    }

    /**
     * Methode pour la page /concerts
     *  - affiche tous les Evenements de ce type (concert)
     *
     * @param $params
     */
    public function concert($params) {
        $concertManager = new EvenementModel();

        $concerts = $concertManager->findAll(1000, 0, EvtTypes::CONCERT);

        $view = new View('evenements/concerts');
        $view->render(['evenements' => $concerts]);
    }

    /**
     * Methode pour la page /humours
     *  - affiche tous les Evenements de ce type (humour)
     *
     * @param $params
     */
    public function humour($params) {
        $humourManager = new EvenementModel();

        $humours = $humourManager->findAll(1000, 0, EvtTypes::HUMOUR);

        $view = new View('evenements/humours');
        $view->render(['evenements' => $humours]);
    }

    /**
     * Methode pour la page /expositions
     *  - affiche tous les Evenements de ce type (exposition)
     *
     * @param $params
     */
    public function exposition($params) {
        $expositionManager = new EvenementModel();

        $expositions = $expositionManager->findAll(1000, 0, EvtTypes::EXPOSITION);

        $view = new View('evenements/expositions');
        $view->render(['evenements' => $expositions]);
    }
}
