<?php

trait rtlThemeModelTrait
{
    function send($api, $username, $order_id, $domain, $product_id = "new Product")
    {
        $url = 'https://www.rtl-theme.com/oauth/';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "api=$api&username=$username&order_id=$order_id&domain=$domain&pid=$product_id");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    function rtl_theme_send_request($post)
    {
        try {
            $sand_box = TRUE;
            $product_id = "new Product"; // شناسه محصول
            $domain = $_SERVER['SERVER_NAME']; //دامنه
            $url = 'https://www.rtl-theme.com/oauth/';

            if ($sand_box) {
                $api = 'SandBox-API';
                $username = 'SandBox-User';
                $order_id = 'SandBox-Order';
                $return_value = '&return=-5'; #1,-1,-2,-3,-4,-5,-6,-7
            } else {
                $api = 'rtl60b70cef16ac6ce487c07ec827c34c'; // API اختصاصی فروشنده
                $username = $post['username']; //نام کاربری خریدار
                $order_id = $post['order_code']; // شماره سفارش
                $return_value = "";
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "api=$api&username=$username&order_id=$order_id&domain=$domain&pid=$product_id$return_value");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $res = curl_exec($ch);
            curl_close($ch);

            if ($res == "1") {
                $this->session_set("license_username", $username);
                $this->session_set("license_order_id", $order_id);
                $this->session_set("site_domain", $domain);

                $this->ActivityLog("فعالسازی لایسنس اسکریپت");
                $this->response_success("لایسنس شما با موفقیت فعال شد");
            } else {
                switch ($res) {
                    case '-1':
                        $error = 'کلید API اشتباه است';
                        break;
                    case '-2':
                        $error = 'نام کاربری اشتباه است';
                        break;
                    case '-3':
                        $error = 'کد سفارش اشتباه است';
                        break;
                    case '-4':
                        $error = 'کد سفارش قبلاً ثبت شده است';
                        break;
                    case '-5':
                        $error = 'کد سفارش مربوط به این نام کاربری نمیباشد.';
                        break;
                    case '-6':
                        $error = 'اطلاعات وارد شده در فرمت صحیح نمیباشند!';
                        break;
                    case '-7':
                        $error = 'کد سفارش مربوط به این محصول نیست';
                        break;
                    default:
                        $error = 'خطای غیرمنتظره رخ داده است';
                        break;
                }
                $this->ActivityLog($error);
                $this->response_error($error);
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

}