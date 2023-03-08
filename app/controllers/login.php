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
        $getIcons = $this->model->getIcons();

        $data = array('icons' => $getIcons);
        $this->view('login/index', $data);
    }

    public function mobile()
    {
        $this->model->mobileLogin($_POST);
    }

    public function verifyMobile()
    {
        $this->model->verifyMobileLogin($_POST);
    }

    public function resendCode()
    {
        $this->model->resendCode($_POST);
    }
}

?>