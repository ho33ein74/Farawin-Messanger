<?php

class Page extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $page = $this->model->getPage($_GET['url']);
        if(sizeof($page['title'])>0) {
            $this->model->calViewer($page['p_id'], $_SERVER['REMOTE_ADDR'], "page");

            $data = array('page' => $page);
            $this->view('page/index', $data);
        } else {
            $this->view('notfound/index');
        }
    }
}

?>