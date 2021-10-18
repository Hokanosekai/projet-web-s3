<?php


class Home extends Controller {

    public function index() {
        $theatre = $this->model('Theatre');

        $this->view('home', ['name' => 'arsene']);
    }
}