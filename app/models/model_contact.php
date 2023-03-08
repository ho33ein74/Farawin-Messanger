<?php

class model_contact extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function sendMessageSave($post)
    {
        try {
            $sql = "INSERT INTO tbl_contact (co_title,co_user_name,co_user_email,co_user_phone,co_text,co_date) VALUES (?,?,?,?,?,?)";
            $value = array($post['title'], $post['name'], $post['email'], $post['phone'], $post['message'], time());
            $this->doQuery($sql, $value);

            $this->response_success("پیام شما با موفقیت دریافت شد و در صورت نیاز، به‌زودی با شما تماس گرفته می‌شود.");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }
}

?>