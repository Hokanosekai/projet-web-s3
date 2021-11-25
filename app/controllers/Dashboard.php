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

        $view->render([],'dashboard');
    }

    /**
     * @param $params
     */
    public function listEvt($params) {
        $view = new View("dashboard/list-evenements");

        $offset = !empty($_POST['offset'])? $_POST['offset'] : 0;
        $type = !empty($_POST['type'])? $_POST['type'] : 0;

        $evenementsManager = new EvenementManager($type);
        $evenements = $type == 0? $evenementsManager->findAllEvts(3, $offset) : $evenementsManager->findAll(3, $offset);

        if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
            $view->redirect('home');
        }

        $view->render([
            "evenements" => $evenements,
            "offset" => $offset,
            "nb_evts" => $type == 0? $evenementsManager->count() : $evenementsManager->count($type),
            "type" => $type,
        ], 'dashboard');
    }

    /**
     * @param $params
     */
    public function editEvt($params) {
        $view = new View("dashboard/edit-evenements");

        $evenementsManager = new EvenementManager();
        $errors = [];

        if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
            $view->redirect('home');
        }

        $evenement = isset($params['id'])? $evenementsManager->findOne($params['id']) : null;

        if (isset($_POST['send'])) {

            if (
                !empty($_POST['description']) &&
                !empty($_POST['title']) &&
                !empty($_POST['type']) &&
                !empty($_POST['date_start']) &&
                !empty($_POST['date_end']) &&
                !empty($_POST['lieu']) &&
                !empty($_POST['places'])
            ) {

                $evt = new EvenementObject();
                if (!empty($_POST['id'])) $evt->setId($_POST['id']);
                $evt->setDescription($_POST['description']);
                $evt->setTitre($_POST['title']);
                $evt->setTypeID($_POST['type']);
                $evt->setDateStart(Utils::parseDate($_POST['date_start']));
                $evt->setDateEnd(Utils::parseDate($_POST['date_end']));
                $evt->setLieu($_POST['lieu']);
                $evt->setPlaces($_POST['places']);

                if (!empty($_FILES['img']['name'])) {
                    if ($evenement) {
                        $path = explode(HOST, $evenement->getImgPath())[1];
                        if (file_exists(ROOT . $path)) {
                            unlink(ROOT . explode(HOST, $evenement->getImgPath())[1]);
                        }
                    }

                    switch ((int)$evt->getType()) {
                        case EvtTypes::THEATRE:
                            $typeName = 'theater/';
                            break;
                        case EvtTypes::CONCERT:
                            $typeName = 'concert/';
                            break;
                        case EvtTypes::HUMOUR:
                            $typeName = 'humour/';
                            break;
                        case EvtTypes::EXPOSITION:
                            $typeName = 'exposition/';
                            break;
                    }

                    $img_ext = explode('.', $_FILES['img']['name'])[1];
                    $img_path = 'images/uploads/' . $typeName . $evt->getTitre() . '.' . $img_ext;

                    $evt->setImgPath($img_path);

                    if (move_uploaded_file($_FILES['img']['tmp_name'], IMAGES . $img_path)) {
                        if ($evenement) {
                            try {
                                $evenementsManager->updateOne($evt);
                                $view->redirect('evenement/id/'.$evt->getId());
                            } catch (exception $ex) {
                                $errors['saved'] = "Une erreur est survenue lors de l'enregistrement";
                            }
                        } else {
                            $id = $evenementsManager->createOne($evt);
                            if ($id) {
                                $view->redirect('evenement/id/'.$id);
                            } else {
                                $errors['save'] = "Une erreur est survenue lors de l'enregistrement";
                            }
                        }
                    } else {
                        $errors['upload'] = "Une erreur est survenue lors de l'upload";
                    }

                } else {
                    $errors['img'] = "Merci d'ajouter une image";
                }

            } else {
                $errors['empty'] = "Merci de compléter tous les champs";
            }
        }

        $view->render([
            "evenement" => $evenement,
            "errors" => $errors
        ], 'dashboard');
    }

    /**
     * @param $params
     */
    public function deleteEvt($params) {
        $view = new View("dashboard/edit-evenements");

        $evenementsManager = new EvenementManager();

        if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
            $view->redirect('home');
        }

        if (!isset($params['id'])) {
            $view->redirect('list-evenements');
        }

        $evenementsManager->deleteOne($params['id']);
        $view->redirect('list-evenements');
    }
}