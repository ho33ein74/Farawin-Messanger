<?php

class model_blog extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getIssetNews($id)
    {
        $sql = "SELECT n_id as id,cat_id FROM tbl_blog WHERE slug= ? AND b_status=1";
        return $this->doSelect($sql, array($id));
    }

    function getIssetCategory($id)
    {
        $sql = "SELECT id FROM tbl_category WHERE link= ? AND status=1";
        return $this->doSelect($sql, array($id));
    }

    function getLastNews($userId)
    {
        $_where = "WHERE a.b_status=1 AND c_type='blog'";
        $_input = array();
        $_order = "ORDER BY a.n_id DESC";
        $_limit = "LIMIT 6";
        $_join = "";
        return $this->getBlogData(False, $userId, $_where, $_order, $_limit, $_input, $_join, False);
    }

    function getItemsPagination($userId, $get, $url, $id='')
    {
        $sort_type = $this->Check_Param($get['orderby']);
        if($sort_type=='oldest') { // قدیمی ترین
            $order = "a.n_id ASC";
        } else if($sort_type=='view') { // پربازدیدترین
            $order = "a.view DESC";
        } else if($sort_type=='controversial') { // پربحث ترین
            $order = "commentCount DESC";
        } else { // جدیدترین
            $order = "a.n_id DESC";
        }

        $where='';
        $author = $this->Check_Param($get['author']);
        if($author!="" and is_numeric($author)) {
            $where = " AND a.writer=".$author;
        }

        $url_check = explode("/", htmlspecialchars($get['url']));
        $pageNo = $url_check[2];

        $_where = "WHERE a.b_status=1".$where;
        $_input = array();
        if ($id != '' && is_numeric($id)) {
            $pageNo = $url_check[4];

            $_where = $_where." AND a.cat_id=?";
            $_input = array($id);
        }

        $_order = "ORDER BY $order";
        $_limit = "";
        $_join = "";
        $result = $this->getBlogData(False, $userId, $_where, $_order, $_limit, $_input, $_join, False);

        return $this->getAllPageLinks(sizeof($result), $pageNo, $url, $this->getPublicInfo('blog_item_per_page'), $get);
    }

    function getNews($userId, $get, $id='')
    {
        $sort_type = $this->Check_Param($get['orderby']);
        if($sort_type=='oldest') { // قدیمی ترین
            $order = "a.n_id ASC";
        } else if($sort_type=='view') { // پربازدیدترین
            $order = "a.view DESC";
        } else if($sort_type=='controversial') { // پربحث ترین
            $order = "commentCount DESC";
        } else { // جدیدترین
            $order = "a.n_id DESC";
        }

        $where='';
        $author = $this->Check_Param($get['author']);
        if($author!="" and is_numeric($author)) {
            $where = " AND a.writer=".$author;
        }

        $page = 1;
        $get = explode("/", $get['url']);
        if(!empty($get[2]) and is_numeric($get[2])) {
            $page = $get[2];
        } else if ($id != '' and is_numeric($id) and !empty($get[4]) and is_numeric($get[4])) {
            $page = $get[4];
        }
        $perPage = $this->getPublicInfo('blog_item_per_page');
        $start = ($page-1)*$perPage;
        if($start < 0) $start = 0;

        $_where = "WHERE a.b_status=1".$where;
        $_input = array();
        if ($id != '' && is_numeric($id)) {
            $_where = $_where." AND a.cat_id=?";
            $_input = array($id);
        }

        $_order = "ORDER BY $order";
        $_limit = "LIMIT $start, $perPage";
        $_join = "";
        return $this->getBlogData(False, $userId, $_where, $_order, $_limit, $_input, $_join, False);
    }

    function getMostViewNews($userId)
    {
        $_where = "WHERE a.b_status=1 AND c_type='blog'";
        $_input = array();
        $_order = "ORDER BY view DESC";
        $_limit = "LIMIT 15";
        $_join = "";
        return $this->getBlogData(False, $userId, $_where, $_order, $_limit, $_input, $_join, False);
    }

    function getSuggestBlog($userId)
    {
        $_where = "WHERE a.b_status=1 AND a.suggestion=1";
        $_input = array();
        $_order = "ORDER BY a.n_id DESC";
        $_limit = "LIMIT 15";
        $_join = "";
        return $this->getBlogData(False, $userId, $_where, $_order, $_limit, $_input, $_join, False);
    }

    function getRandomNews($userId)
    {
        $_where = "WHERE a.b_status=1 AND c_type='blog'";
        $_input = array();
        $_order = "ORDER BY RAND() DESC";
        $_limit = "LIMIT 5";
        $_join = "";
        return $this->getBlogData(False, $userId, $_where, $_order, $_limit, $_input, $_join, False);
    }

    function getNewsInfo($id, $userId, $idDemo = 1)
    {
        $_where = "";
        $_input = array();
        if ($id != '' && is_numeric($id)) {
            $_where = "WHERE a.b_status=" . $idDemo . " AND a.n_id=?";
            $_input = array($id);
        }

        $_order = "";
        $_limit = "";
        $_join = "";
        $result = $this->getBlogData(False, $userId, $_where, $_order, $_limit, $_input, $_join, False);

        $sql = "SELECT b.t_id,b.tag FROM tbl_blog_tag a
                LEFT JOIN tbl_tags b ON a.pt_tag_id=b.t_id
                WHERE a.pt_post_id=?";
        $result['all_tags'] = $this->doSelect($sql, array($id));

        $related_post_id = $this->doSelect("SELECT * FROM tbl_blog_related WHERE blog_id=?", array($id));
        $all_related_post = array();
        foreach ($related_post_id as $related_postID) {
            $related_postInfo = $this->related_postInfo($related_postID['br_related_id'], $userId);
            $all_related_post[] = $related_postInfo[0];
        }
        $result['all_related_post'] = $all_related_post;

        return $result;
    }

    function sameNews($id, $userId)
    {
        $catInfo = $this->doSelect("SELECT cat_id FROM tbl_blog WHERE n_id=?", array($id), 1);

        $_where = "";
        $_input = array();
        if ($id != '' && is_numeric($id)) {
            $_where = "WHERE a.b_status=1 AND a.n_id<> ? AND a.cat_id=?";
            $_input = array($id, $catInfo['cat_id']);
        }

        $_order = "ORDER BY RAND() DESC";
        $_limit = " LIMIT 6";
        $_join = "";
        return $this->getBlogData(False, $userId, $_where, $_order, $_limit, $_input, $_join, False);
    }

    function related_postInfo($id, $userId)
    {
        $_where = "";
        $_input = array();
        if ($id != '' && is_numeric($id)) {
            $_where = "WHERE a.b_status=1 AND a.n_id=?";
            $_input = array($id);
        }

        $_order = "";
        $_limit = "";
        $_join = "";
        return $this->getBlogData(False, $userId, $_where, $_order, $_limit, $_input, $_join, False);
    }
}

?>