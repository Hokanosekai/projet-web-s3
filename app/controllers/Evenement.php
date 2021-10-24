<?php

/**
 * Class Evenement
 */
class Evenement {

    public function evt($params) {
        $theaterManager = new EvenementManager(EvtTypes::THEATRE);
        $concert = $theaterManager->findOne($params['id']);

        $view = new View('evenements/evenement');
        $view->render(['evenement' => $concert]);
    }

    /**
     * @param $params
     */
    public function theatre($params) {
        $theaterManager = new EvenementManager(EvtTypes::THEATRE);

        $theatres = $theaterManager->findAll();

        $view = new View('evenements/theatres');
        $view->render(['evenements' => $theatres]);
    }

    /**
     * @param $params
     */
    public function concert($params) {
        $concertManager = new EvenementManager(EvtTypes::CONCERT);

        $concerts = $concertManager->findAll();

        $view = new View('evenements/concerts');
        $view->render(['evenements' => $concerts]);
    }

    /**
     * @param $params
     */
    public function humour($params) {
        $humourManager = new EvenementManager(EvtTypes::HUMOUR);

        $humours = $humourManager->findAll();

        $view = new View('evenements/humours');
        $view->render(['evenements' => $humours]);
    }

    /**
     * @param $params
     */
    public function exposition($params) {
        $expositionManager = new EvenementManager(EvtTypes::EXPOSITION);

        $expositions = $expositionManager->findAll();

        $view = new View('evenements/expositions');
        $view->render(['evenements' => $expositions]);
    }
}
