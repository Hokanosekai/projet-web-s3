<?php

/**
 * Class Evenement
 */
class Evenement {

    /**
     * @param $params
     */
    public function theatre($params) {
        $theaterManager = new EvenementManager(EvtTypes::THEATRE);

        if (!empty($params)) {
            $piece = $theaterManager->findOne($params['id']);

            $view = new View('evenements/evenement');
            $view->render(['evenement' => $piece]);
        } else {

            $theatres = $theaterManager->findAll();

            $view = new View('evenements/theatres');
            $view->render(['evenements' => $theatres]);

        }
    }

    /**
     * @param $params
     */
    public function concert($params) {
        $concertManager = new EvenementManager(EvtTypes::CONCERT);

        if (!empty($params)) {
            $concert = $concertManager->findOne($params['id']);

            $view = new View('evenements/evenement');
            $view->render(['evenement' => $concert]);
        } else {

            $concerts = $concertManager->findAll();

            $view = new View('evenements/concerts');
            $view->render(['evenements' => $concerts]);

        }
    }

    /**
     * @param $params
     */
    public function humour($params) {
        $humourManager = new EvenementManager(EvtTypes::HUMOUR);

        if (!empty($params)) {
            $humour = $humourManager->findOne($params['id']);

            $view = new View('evenements/evenement');
            $view->render(['evenement' => $humour]);
        } else {

            $humours = $humourManager->findAll();

            $view = new View('evenements/humours');
            $view->render(['evenements' => $humours]);

        }
    }

    /**
     * @param $params
     */
    public function exposition($params) {
        $expositionManager = new EvenementManager(EvtTypes::EXPOSITION);

        if (!empty($params)) {
            $exposition = $expositionManager->findOne($params['id']);

            $view = new View('evenements/evenement');
            $view->render(['evenement' => $exposition]);
        } else {

            $expositions = $expositionManager->findAll();

            $view = new View('evenements/expositions');
            $view->render(['evenements' => $expositions]);

        }
    }
}
