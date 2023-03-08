<?php

class model_faq extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getIssetFaq($id)
    {
        $sql = "SELECT * FROM tbl_faq WHERE id=? AND status=1";
        return $this->doSelect($sql, array($id));
    }

    function getFaq($id="")
    {
        if($id!=""){
            $sql = "SELECT * FROM tbl_faq WHERE id=? AND status=1";

            $result = $this->doSelect($sql, array($id), 1);
        } else {
            $sql = "SELECT * FROM tbl_faq WHERE type=? AND status=1";

            $result['services'] = $this->doSelect($sql, array('service'));
            $result['public'] = $this->doSelect($sql, array('public'));
        }

        return $result;
    }

}

?>