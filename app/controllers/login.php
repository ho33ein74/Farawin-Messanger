<?php

class Login extends Controller
{
    public $checkLogin = '';

    function __construct()
    {
        parent::__construct();
        if ($this->checkLogin != FALSE) {
            header("Location:" . URL);
        }
    }

    function index()
    {
        $this->view('login/index');
    }

}

?>