<?php

class Contact extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $page = $this->model->getPage("contact");
        $this->model->calViewer($page['p_id'], $_SERVER['REMOTE_ADDR'], "page");
        $contactSubject = $this->model->getContactSubject();

        $data = array(
            'page' => $page,
            'contactSubject' => $contactSubject
        );
        $this->view('contact/index', $data);
    }

    function sendMessage()
    {
        $this->model->sendMessageSave($_POST);
    }

}

?>