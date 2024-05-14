<?php

class register extends  Controller
{
    public $checkLogin = '';

    function __construct()
    {
        parent::__construct();
        $this->checkLogin = Model::session_get("username");
        if ($this->checkLogin != FALSE) {
            header("Location:" . URL);
        }
    }

    function index()
    {
        $this->view('register/index');
    }
    function insert_data()
    {
        $this->model->insert_data($_POST);
    }

}