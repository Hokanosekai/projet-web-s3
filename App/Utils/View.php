<?php

namespace App\Utils;

class View {

    private $template;

    /**
     * @param null $template
     */
    public function __construct($template = null) {
        $this->template = $template;
    }

    /**
     * Methode pour faire le rendu du code html avec les data
     *
     * @param array $data
     * @param string $gabarit
     */
    public function render($data = [], $gabarit = "home") {
        $template = $this->template;

        if ($gabarit != false) {
            ob_start();
            include(VIEWS.$template.'.php');
            $contentPage = ob_get_clean();
            include(VIEWS.'_gabarit.'.$gabarit.'.php');
        } else {
            include(VIEWS.$template.'.php');
        }
    }

    /**
     * Methode pour faire une redirection
     *
     * @param $route
     */
    public function redirect($route) {
        header('Location: '.HOST.$route);
        exit();
    }
}