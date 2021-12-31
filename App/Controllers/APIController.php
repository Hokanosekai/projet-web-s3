<?php

namespace App\Controllers;

use \App\Models\EvenementModel;
use \App\Models\ReservationModel;
use \App\Models\UserModel;
use \App\Utils\EvtTypes;
use \App\Utils\View;
use \DateInterval;
use \DateTime;
use \Exception;

class APIController {

    /**
     * Methode pour la page (APIController) /api-count
     *  - Nombre d'EvenementModel (all | theatres | concerts | humours | expositions)
     *  - Nombre de Rservation (all | theatres | concerts | humours | expositions)
     *  - Nombre d'Utilisateur (all | avec reservation | sans | reservation | admin | user)
     *
     * @param $params
     */
    public function count($params) {

        $evtManager = new EvenementModel();
        $userManager = new UserModel();
        $resManager = new ReservationModel();

        $count = [
            "evenements" => [
                "total" => $evtManager->count(),
                "theatres" => $evtManager->count(EvtTypes::THEATRE),
                "expositions" => $evtManager->count(EvtTypes::EXPOSITION),
                "concerts" => $evtManager->count(EvtTypes::CONCERT),
                "humours" => $evtManager->count(EvtTypes::HUMOUR),
            ],
            "reservations" => [
                "total" => $resManager->count(),
                "theatres" => $resManager->count(EvtTypes::THEATRE),
                "expositions" => $resManager->count(EvtTypes::EXPOSITION),
                "concerts" => $resManager->count(EvtTypes::CONCERT),
                "humours" => $resManager->count(EvtTypes::HUMOUR),
            ],
            "users" =>  [
                "total" => $userManager->count(),
                "reserved" => $userManager->count('resa'),
                "not_reserved" => $userManager->count('not_resa'),
                "admin" => $userManager->count('admin'),
                "user" => $userManager->count('user')
            ]
        ];

        $view = new View("api/count");
        $view->render([
            "count" => $count
        ], false);

    }

    /**
     * Methode pour la page (APIController) /api-reservations
     *  - Nombre de ReservationModel sur les 10 derniers jours
     *
     * TODO :
     *  - Date Debut
     *  - Date Fin
     *  - Nombres de Jours
     *
     * @param $params
     * @throws Exception
     */
    public function reservations($params) {
        $resManager = new ReservationModel();

        $dates = [];
        for ($i = 10; $i > -1; $i--) {
            $duration = 'P'.$i.'D';
            $currentDate = new DateTime();
            $daysAgo = $currentDate->sub(new DateInterval($duration));
            $dates[] = $daysAgo->format('Y-m-d');
        }

        $reservations = [];
        foreach ($dates as $date) {
            $data = $resManager->countByDate(0, $date);
            $reservations[] = sizeof($data) === 0? [
                "date" => $date,
                "count" => 0
            ] : [
                'date' => $date,
                'count' => $data[0]['count']
            ];
        }

        $view = new View('api/reservations');
        $view->render([
            "reservations" => $reservations
        ], false);
    }
}