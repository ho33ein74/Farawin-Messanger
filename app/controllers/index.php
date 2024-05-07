<?php

class Index extends Controller
{
    public $checkLogin = '';

    function __construct()
    {
        parent::__construct();

        if ($this->checkLogin == FALSE) {
            header("Location: /register" );
        }
    }

    function index()
    {
//        $widget = $this->model->getWidget($this->checkLogin);
//        $data = array('widget' => $widget);

//        $this->view('index/index', $data);
        $this->view('index/index');
    }

}