<?php

class Blog extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $getNews = $this->model->getNews($this->checkLogin, $_GET);
        $page = $this->model->getPage("blog");
        $getSuggestBlog = $this->model->getSuggestBlog($this->checkLogin);
        $getItemsPagination = $this->model->getItemsPagination($this->checkLogin, $_GET, "blog");

        $data = array('getNews' => $getNews, 'page' => $page, 'suggestBlog' => $getSuggestBlog,
            'itemsPagination' => $getItemsPagination);
        $this->view('blog/index', $data);
    }

    function article()
    {
        $slug = str_replace(["blog", "/", "article"], ["", "", ""], $this->model->check_param($_GET['url']));

        if ($slug != '') {
            $id_isset = $this->model->getIssetNews($slug);
            if (sizeof($id_isset) > 0) {

                $this->model->calViewer($id_isset[0]['id'], $_SERVER['REMOTE_ADDR'], "blog");

                $getNews = $this->model->getNewsInfo($id_isset[0]['id'], $this->checkLogin);
                $comment = $this->model->getCommentData($id_isset[0]['id'], "blog", $this->checkLogin);
                $sameNews = $this->model->sameNews($id_isset[0]['id'], $this->checkLogin);
                $lastNews = $this->model->getLastNews($this->checkLogin);
                $getScoreItem = $this->model->getScoreItem($id_isset[0]['id'], "blog");
                $getMostViewNews = $this->model->getMostViewNews($this->checkLogin);

                $data = array('getBlog' => $getNews, 'attrId'  => $id_isset[0]['id'],
                    'lastNews' => $lastNews, 'comment' => $comment, 'sameNews' => $sameNews,
                    'mostViewNews'   => $getMostViewNews, 'scoreItem'   => $getScoreItem);

                $this->view('blog/article', $data);
            } else {
                $this->view('notfound/index');
            }
        } else {
            $this->view('notfound/index');
        }
    }

    function demo($id)
    {
        if ($id != '' && is_numeric($id)) {
            $id_isset = $this->model->getIssetNews($id, 0);
            if (sizeof($id_isset) > 0) {
                $getNews = $this->model->getNewsInfo($id, $this->checkLogin, 0);
                $comment = $this->model->getCommentData($id, "blog", $this->checkLogin);
                $sameNews = $this->model->sameNews($id, $this->checkLogin);
                $lastNews = $this->model->getLastNews($this->checkLogin);
                $getMostViewNews = $this->model->getMostViewNews($this->checkLogin);

                $data = array(
                    'getBlog' => $getNews,
                    'attrId'  => $id,
                    'lastNews' => $lastNews,
                    'comment' => $comment,
                    'sameNews' => $sameNews,
                    'getMostViewNews'   => $getMostViewNews
                );
                $this->view('blog/article', $data);
            } else {
                $this->view('notfound/index');
            }
        } else {
            $this->view('notfound/index');
        }
    }

    function category($id = '')
    {
        if ($id != '') {
            $id_isset = $this->model->getIssetCategory($id);
            if (sizeof($id_isset) > 0) {
                $getNews = $this->model->getNews($this->checkLogin, $_GET, $id_isset[0]['id']);
                $getSuggestBlog = $this->model->getSuggestBlog($this->checkLogin);
                $getItemsPagination = $this->model->getItemsPagination($this->checkLogin, $_GET, "blog/category/$id", $id_isset[0]['id']);

                $data = array(
                    'getNews' => $getNews,
                    'suggestBlog' => $getSuggestBlog,
                    'itemsPagination' => $getItemsPagination,
                    'attrId' => $id_isset[0]['id']
                );
                $this->view('blog/category', $data);
            } else {
                $this->view('notfound/index');
            }
        } else {
            $this->view('notfound/index');
        }
    }

}

?>