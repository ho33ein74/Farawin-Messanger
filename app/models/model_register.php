<?php

class model_register extends model
{
    function __construct()
    {
        parent::__construct();
    }
    function insert_data($post)
    {
        $sql = "SELECT * FROM tbl_users WHERE username=?";
        $params = array($post['username']);
        $result = $this->doSelect($sql, $params);

        if (sizeof($result) == 0) {
            $sql = "INSERT INTO tbl_users (username,password,register_date) VALUES (?,?,?)";
            $params = array($post['username'], md5($post['password']), self::jalali_date("Y/m/d"));
            $this->doQuery($sql, $params);

            echo "ok";
        } else {
            echo "error";
        }
    }

}