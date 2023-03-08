<?php
    
    class Search extends Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        function index()
        {
            if(isset($_GET['s']) AND ($_GET['type'] == "blog" OR $_GET['type'] == "service")) {
                $page = $this->model->getPage("search");
                $this->model->calViewer($page['p_id'], $_SERVER['REMOTE_ADDR'], "search");

                $findMag = $this->model->findMag($this->checkLogin, $_GET);
                $findService = $this->model->findService($this->checkLogin, $_GET);

                $this->model->addWordSearch(
                    htmlspecialchars($_GET['s']),
                    sizeof($findMag)+sizeof($findService)
                );

                $data = array(
                    'getNews' => $findMag,
                    'getServices' => $findService,
                    'page' => $page
                );
                $this->view('search/index', $data);
            } else {
                $this->view('notfound/index');
            }
        }
    }

?>