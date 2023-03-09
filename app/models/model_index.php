<?php

class model_index extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getWidget($userId='')
    {
        $sql = "SELECT pw.*,t.t_href FROM tbl_page_widget pw 
                    LEFT JOIN tbl_template t ON pw.template_id=t.t_id 
                    WHERE pw.ip_status=1 AND t.t_theme=? AND pw.page_id=2
                    ORDER BY pw.ip_order ASC";
        $result = $this->doSelect($sql, array($this->getPublicInfo("theme")));

        $data = array();
        $i=0;
        foreach ($result as $item){
            $content = unserialize($item['ip_content']);
            if($item['template_id']==1){
                $data[$i]['slider']['content'] = $this->getSliders($content['ordering'], $content['number']);
            } else if($item['template_id']==3){
                $data[$i]['blog']['title'] = $content['title'];
                $data[$i]['blog']['link'] = $content['link'];
                $data[$i]['blog']['link_title'] = $content['link_title'];
                $data[$i]['blog']['type'] = $content['sort_type'];
                $data[$i]['blog']['view_type'] = $content['view_type'];
                $data[$i]['blog']['content'] = $this->getBlog($userId, $content['categories'], $content['sort_type'], $content['number'], $content['sub_category']);
            } else if($item['template_id']==4){
                $data[$i]['service']['title'] = $content['title'];
                $data[$i]['service']['description'] = $content['description'];
                $data[$i]['service']['link'] = $content['link'];
                $data[$i]['service']['link_title'] = $content['link_title'];
                $data[$i]['service']['view_type'] = $content['view_type'];
                $data[$i]['service']['type'] = $content['sort_type'];
                $data[$i]['service']['content'] = $this->getService($content['sort_type'], $content['number']);
            } else if($item['template_id']==5){
                $data[$i]['banner']['content'] = $this->getBanners($content['ordering'], $content['number']);
            } else if($item['template_id']==6){
                $data[$i]['comment']['title'] = $content['title'];
                $data[$i]['comment']['description'] = $content['description'];
                $data[$i]['comment']['content'] = $this->getComment($content['ordering'], $content['number']);
            } else if($item['template_id']==7){
                $data[$i]['socialmedia']['link'] = $content['link'];
                $data[$i]['socialmedia']['link_title'] = $content['link_title'];
                $data[$i]['socialmedia']['description'] = $content['description'];
            } else if($item['template_id']==8){
                $data[$i]['textarea']['title'] = $content['title'];
                $data[$i]['textarea']['view_type'] = $content['view_type'];
                $data[$i]['textarea']['description'] = $content['description'];
            }
            $i++;
        }

        return $data;
    }

    function getSliders($ordering='ASC', $number=0)
    {
        $sql = "SELECT si.*,s.s_title,s.s_type FROM tbl_slider_image si 
                    LEFT JOIN tbl_slider s ON si.slider_id=s.s_id
                    WHERE s.s_id=? AND s.s_status=1 AND si.si_status=1 ORDER BY si.si_id $ordering";
        return $this->doSelect($sql, array($number));
    }

    function getService($sort_type='latest', $number=10)
    {
        if($sort_type=='latest') { // جدیدترین
            $order = "s_id DESC";
        } else if($sort_type=='oldest') { // قدیمی ترین
            $order = "s_id ASC";
        } else if($sort_type=='view') { // پربازدیدترین
            $order = "s_view DESC";
        } else { // تصادفی
            $order = "rand() DESC";
        }

        $_where = "WHERE s_status=1";
        $_input = array();
        $_order = "ORDER BY $order";
        $_limit = "LIMIT $number";
        $_join = "";
        return $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);
    }

    function getBlog($userId, $categories='', $sort_type='latest', $number=10, $sub_category=0)
    {
        $where='';
        if($sort_type=='latest') { // جدیدترین
            $order = "a.n_id DESC";
        } else if($sort_type=='oldest') { // قدیمی ترین
            $order = "a.n_id ASC";
        } else if($sort_type=='view') { // پربازدیدترین
            $order = "a.view DESC";
        } else if($sort_type=='suggestion') { // پیشنهاد سردبیر
            $order = "a.suggestion DESC";
            $where .= " AND a.suggestion=1";
        } else if($sort_type=='mostComment') { // پربحث ترین
            $order = "commentCount DESC";
        } else { // تصادفی
            $order = "rand() DESC";
        }

        if($categories!=""){
            $categoriesId='';
            foreach ($categories as $category){
                $categoriesId .= $category.",";
                if($sub_category==1){
                    $datas = $this->doSelect("SELECT id FROM tbl_category WHERE id != 1 and status=1 and c_type=? and parent_id=?", array("blog", $category));

                    foreach($datas as $item){
                        $categoriesId .= $item['id'].",";
                    }
                }
            }
            $categoriesId=rtrim($categoriesId, ",");
            $where .= " AND a.cat_id in ($categoriesId)";
        }

        $_where = "WHERE a.b_status=1 AND b.c_type='blog' $where";
        $_input = array();

        $_order = "ORDER BY $order";
        $_limit = "LIMIT $number";
        $_join = "";
        return $this->getBlogData(False, $userId, $_where, $_order, $_limit, $_input, $_join, False);
    }

    function getBanners($ordering='ASC', $number=0)
    {
        $sql = "SELECT bi.*,b.b_title,b.b_type FROM tbl_banner_image bi 
                    LEFT JOIN tbl_banner b ON bi.banner_id=b.b_id
                    WHERE b.b_id=? AND b.b_status=1 AND bi.bi_status=1 ORDER BY bi.bi_id $ordering";
        return $this->doSelect($sql, array($number));
    }

    function getComment($ordering='ASC', $number=0)
    {
        $sql = "SELECT a.cm_id,a.cm_date,a.cm_text,c.c_display_name,c.c_image
                    FROM tbl_comments a
                    LEFT JOIN tbl_customer c
                    ON a.cm_user_id=c.customer_vids_id
                    WHERE a.cm_status=1 AND a.selected=1 ORDER BY a.cm_id $ordering LIMIT $number";
        return $this->doSelect($sql);
    }
}

?>