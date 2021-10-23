<?php


class API {

    public function count($params) {

        $evtManager = new EvenementManager();
        $userManager = new UserManager();
        $resManager = new ReservationManager();

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
                "reserved" => $userManager->countByReservation(true),
                "not_reserved" => $userManager->countByReservation(false)
            ]
        ];

        $view = new View("api/count");
        $view->render([
            "count" => $count
        ], false);

    }

    public function reservations($params) {
        $resManager = new ReservationManager();

        $reservations = $resManager->countByDate();

        $view = new View('api/reservations');
        $view->render([
            "reservations" => $reservations
        ], false);
    }

}