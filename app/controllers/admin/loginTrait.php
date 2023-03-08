<?php

trait loginTrait
{
    function login()
    {
        if ($this->checkLoginAdmin != FALSE) {
            header("Location:" . URL . ADMIN_PATH . "/dashboard");
        } else {
            $this->view('admin/login/login');
        }
    }

    function logout()
    {
        $this->model->logout();
        echo "<script>window.location='" . URL . ADMIN_PATH . "/login';</script>";
    }

    function forgetPassword()
    {
        if ($this->checkLoginAdmin != FALSE) {
            header("Location:" . URL . ADMIN_PATH . "/dashboard");
        } else {
            $this->view('admin/login/forget-password');
        }
    }

    function loginCheck()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $this->model->Login($_POST);
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function authCheck()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $this->model->authCheck($_POST);
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function forgetPasswordSendSMS()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $this->model->forgetPasswordSendSMS($_POST);
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function googleAuthentication()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $this->model->googleAuthentication($_POST, $this->checkLoginAdmin);
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function googleAuthenticationDeactive()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $this->model->googleAuthenticationDeactive($this->checkLoginAdmin);
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

}
