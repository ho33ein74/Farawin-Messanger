<?php

class Faq extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $page = $this->model->getPage("faq");

        $attrId = str_replace(["faq", "/", "details"], ["", "", ""], $this->model->check_param($_GET['url']));
        if($attrId!='' && is_numeric($attrId)) {
            $id_isset = $this->model->getIssetFaq($attrId);
            if (sizeof($id_isset) > 0) {
                $faq = $this->model->getFaq($attrId);
                $this->model->calViewer($attrId, $_SERVER['REMOTE_ADDR'], "faq");

                $data = array(
                    'faq' => $faq,
                    'page' => $page
                );
                $this->view('faq/details', $data);
            } else {
                $this->view('notfound/index');
            }
        } else {
            $faq = $this->model->getFaq();
            $this->model->calViewer($page['p_id'], $_SERVER['REMOTE_ADDR'], "page");

            $data = array(
                'faq' => $faq,
                'page' => $page
            );
            $this->view('faq/index', $data);
        }
    }
}

?>