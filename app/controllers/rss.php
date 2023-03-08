<?php
    
    class rss extends Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        function index()
        {
            $getNews = $this->model->getNews();
            $data = array('getNews' => $getNews);
            
            $this->view('rss/index', $data);
        }
    }

?>