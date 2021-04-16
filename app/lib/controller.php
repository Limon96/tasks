<?php

class Controller {

    public $request;
    public $view;
    public $user;

    public function __construct()
    {
        $this->request = new Request();
        $this->view = new View();
        $this->user = new User();
    }

}