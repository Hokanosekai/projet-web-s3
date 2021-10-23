<?php

/**
 * Class Home
 */
class Home {

    /**
     * @param $params
     */
    public function index($params) {
        $theaterManager = new EvenementManager(EvtTypes::THEATRE);
        $theatres = $theaterManager->findAll(5);

        $concertManager = new EvenementManager(EvtTypes::CONCERT);
        $concerts = $concertManager->findAll(5);

        $humourManager = new EvenementManager(EvtTypes::HUMOUR);
        $humours = $humourManager->findAll(5);

        $expositionManager = new EvenementManager(EvtTypes::EXPOSITION);
        $expositions = $expositionManager->findAll(5);

        $view = new View('home');
        $view->render([
            'theatres' => $theatres,
            'concerts' => $concerts,
            'humours' => $humours,
            'expositions' => $expositions,
        ]);
    }

    /**
     * @param $params
     */
    public function error($params) {
        var_dump($params);
    }

    /**
     * @param $params
     */
    public function login($params) {

        $view = new View('login');

        $userManager = new UserManager();
        $errors = [];

        if (!empty($_POST)) {

            if (
                !empty($_POST['mail']) &&
                !empty($_POST['password'])
            ) {

                $mail = htmlspecialchars(trim($_POST['mail']));
                $password = htmlspecialchars(trim($_POST['password']));

                if (preg_match('/(.)+@.+\.com/',$mail)) {

                    if ($userManager->exists($mail)) {

                        $user = $userManager->find($mail);

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

    /**
     * @param $params
     */
    public function logout($params) {
        unset($_SESSION['user']);
        $view = new View();
        $view->redirect('home');
    }


    /**
     * @param $params
     */
    public function register($params) {

        $view = new View('register');

        $userManager = new UserManager();
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

                if (preg_match('/(.)+@.+\.com/',$mail)) {

                    $user = $userManager->find($mail);

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