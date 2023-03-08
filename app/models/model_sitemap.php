<?php

class model_sitemap extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getPage()
    {
        $sql = "SELECT * FROM tbl_page WHERE p_status=1";
        return $this->doSelect($sql);
    }

    function getServices()
    {
        $_where = "WHERE s.s_status=1";
        $_input = array();
        $_order = "ORDER BY s.s_id DESC";
        $_limit = "";
        $_join = "";
        return $this->getServiceData(False, $this->checkLogin, $_where, $_order, $_limit, $_input, $_join, False);
    }

    function getCategory()
    {
        $sql = "SELECT * FROM tbl_category WHERE status=1";
        return $this->doSelect($sql);
    }

    function getBlog()
    {
        $sql = "SELECT * FROM tbl_blog WHERE b_status=1";
        return $this->doSelect($sql);
    }

    function getFaq()
    {
        $sql = "SELECT * FROM tbl_faq WHERE status=1";
        return $this->doSelect($sql);
    }
}

?>