<?php

class model_tags extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getIssetTag($id)
    {
        $sql = "SELECT * FROM tbl_tags WHERE tag= ? AND status=1";
        return $this->doSelect($sql, array($id));
    }

    function getBlogTag($user_id, $tag_id)
    {
        $_where = "WHERE a.b_status=1 AND c_type='blog' AND pt.pt_tag_id=?";
        $_input = array($tag_id);
        $_order = "ORDER BY a.n_id DESC";
        $_limit = "";
        $_join = "RIGHT JOIN tbl_blog_tag pt ON a.n_id=pt.pt_post_id";
        return $this->getBlogData(False, $user_id, $_where, $_order, $_limit, $_input, $_join, False);
    }

    function getServiceTag($user_id, $tag_id)
    {
        $_where = "WHERE s.s_status=1 AND st.tag_id=?";
        $_input = array($tag_id);
        $_order = "ORDER BY s.s_id DESC";
        $_limit = "";
        $_join = "RIGHT JOIN tbl_services_tag st ON s.s_id=st.service_id";
        return $this->getServiceData(False, $user_id, $_where, $_order, $_limit, $_input, $_join, False);
    }
}

?>