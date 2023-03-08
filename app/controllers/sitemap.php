<?php

class Sitemap extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $getPage = $this->model->getPage();
        $getBlog = $this->model->getBlog();
        $getCategory = $this->model->getCategory();
        $getServices = $this->model->getServices();
        $getFaq = $this->model->getFaq();

        $data = array(
            'getPage' => $getPage,
            'getBlog' => $getBlog,
            'getServices' => $getServices,
            'getCategory' => $getCategory,
            'getFaq' => $getFaq,
        );

        $this->view('sitemap/index', $data);
    }
}

?>