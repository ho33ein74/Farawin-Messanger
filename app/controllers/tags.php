<?php

class Tags extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $slug = explode("/", $this->model->Check_Param($_GET['url']));
        $slug_tag = str_replace("-", " ", $slug[2]);
        $tag_types = array("blog", "service");

        if ($slug_tag != '' and in_array($slug[1], $tag_types)) {
            $tag_isset = $this->model->getIssetTag($slug_tag);
            if (sizeof($tag_isset) > 0) {
                $blogs = $this->model->getBlogTag($this->checkLogin, $tag_isset[0]['t_id']);
                $services = $this->model->getServiceTag($this->checkLogin, $tag_isset[0]['t_id']);

                $data = array(
                    'tag_info' => $tag_isset,
                    'tag_type' => $slug[1],
                    'slug' => $_GET['url'],
                    'blogs' => $blogs,
                    'services' => $services,
                );
                $this->view('tags/index', $data);
            } else {
                $this->view('notfound/index');
            }
        } else {
            $this->view('notfound/index');
        }
    }
}

?>