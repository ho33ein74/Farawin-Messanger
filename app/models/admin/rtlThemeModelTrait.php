<?php

trait rtlThemeModelTrait
{
    function checkLicense($post)
    {
        try {
            $username = $post['username']; //نام کاربری خریدار
            $order_id = $post['order_code']; // شماره سفارش

            $result = $this->rtl_theme_send_request($username, $order_id);

            if ($result['message'] == "OK") {
                $this->rtl_theme_set_session_check_expire(
                    $username,
                    $order_id,
                    $result['sandbox']
                );

                $this->ActivityLog("فعالسازی لایسنس اسکریپت");
                $this->response_success("لایسنس شما با موفقیت فعال شد");
            } else {
                $this->ActivityLog($result['message']);
                $this->response_error($result['message']);
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function deactiveLicense($post)
    {
        try {
            $sql = "UPDATE tbl_settings SET `value`=? WHERE `key`=?";
            $this->doQuery($sql, [NULL, "license_info"]);

            $this->ActivityLog("غیرفعالسازی لایسنس اسکریپت");
            $this->response_success("لایسنس شما با غیرموفقیت فعال شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

}