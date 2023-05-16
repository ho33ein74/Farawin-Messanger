<?php
require_once "public-function.php";
require_once "private-function.php";

class Model
{
    public static $conn = '';

    function __construct()
    {
        Model::cookie_init();
        Model::session_init();

        $attr = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        self::$conn = new PDO('mysql:host=' . SERVER_NAME . ';dbname=' . DATABASE, USERNAME, PASSWORD, $attr);
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (function_exists('jdate') == FALSE) {
            require('public/library/jdf/jdf.php');
        }
    }
    public function rtl_theme_send_request($username, $order_id)
    {
        $sand_box = 0;
        $url = 'https://www.rtl-theme.com/oauth/';
        $product_id = "new Product"; // شناسه محصول
        $domain = $_SERVER['SERVER_NAME']; //دامنه

        if ($sand_box) {
            $api = 'SandBox-API';
            $username = 'SandBox-User';
            $order_id = 'SandBox-Order';
            $return_value = '&return=1'; #1,-1,-2,-3,-4,-5,-6,-7
        } else {
            $api = 'rtl60b70cef16ac6ce487c07ec827c34c'; // API اختصاصی فروشنده
            $return_value = "";
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "api=$api&username=$username&order_id=$order_id&domain=$domain&pid=$product_id$return_value");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);

        switch ($result) {
            case '1':
                $message = 'OK';
                break;
            case '-1':
                $message = 'کلید API اشتباه است';
                break;
            case '-2':
                $message = 'نام کاربری اشتباه است';
                break;
            case '-3':
                $message = 'کد سفارش اشتباه است';
                break;
            case '-4':
                $message = 'کد سفارش قبلاً ثبت شده است';
                break;
            case '-5':
                $message = 'کد سفارش مربوط به این نام کاربری نمیباشد.';
                break;
            case '-6':
                $message = 'اطلاعات وارد شده در فرمت صحیح نمیباشند!';
                break;
            case '-7':
                $message = 'کد سفارش مربوط به این محصول نیست';
                break;
            default:
                $message = 'خطای غیرمنتظره رخ داده است';
                break;
        }

        return $message;
    }

    public function rtl_theme_set_session_check_expire($username, $order_id, $type='product')
    {
        $duration = time() + (24 * 60 * 60 * 7);

        $sql = "UPDATE tbl_settings SET `value`=? WHERE `key`=?";
        $data = array(
            "license_username" => $username,
            "license_order_id" => $order_id,
            "license_domain" => $_SERVER['SERVER_NAME'],
            "license_check_expire" => $duration,
            "license_type" => $type
        );
        $this->doQuery($sql, [$this->serialize_license_info($data), "license_info"]);
    }

    public static function un_serialize_license_info()
    {
        return unserialize(
            self::decrypt(
                self::getPublicInfo("license_info"),
                KEY . "#Un!xTeam#" . $_SERVER['SERVER_NAME']
            )
        );
    }

    public static function get_license_error_msg()
    {
        $license_info = self::un_serialize_license_info();
        $alert = "";
        if(time() >= $license_info['license_check_expire'] AND $license_info['license_type'] == "demo"){
            $alert .= '<div style="direction: rtl" class="alert alert-warning callout callout-warning alert-dismissible">';
            $alert .= 'متاسفانه مدت زمان استفاده رایگان از اسکریپت ونسا به پایان رسیده است؛ برای فعالسازی دائمی و استفاده از اسکریپت لطفا از <a href="'.ADMIN_PATH.'/license">اینجا</a> آن را فعال نمایید.';
            $alert .= '</div>';
        } else if((time() >= $license_info['license_check_expire'] AND $license_info['license_type'] == "product") OR self::getPublicInfo("license_info")=="") {
            $alert .=  '<div style="direction: rtl" class="alert alert-danger callout callout-danger alert-dismissible">';
            $alert .= 'متاسفانه اسکریپت ونسا غیرفعال شده است برای فعالسازی مجدد اسکریپت و دسترسی به تمامی امکانات لطفا از <a href="'.ADMIN_PATH.'/license">اینجا</a> آن را فعال نمایید.';
            $alert .= '</div>';
        }

        return $alert;
    }

    public static function serialize_license_info($data)
    {
        return self::encrypt(
            serialize($data),
            KEY . "#Un!xTeam#" . $_SERVER['SERVER_NAME']
        );
    }

    function set_csrf_token()
    {
        $this->session_set("token", bin2hex(random_bytes(32)));
        $this->session_set("token-expire", time() + (3600 * 12)); // 1 hour = 3600 secs
    }

    function check_csrf_token()
    {
        $status = 1;
        $msg = "access";

        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
        if (strpos($this->getPublicInfo('root'), $actual_link) !== false) {
            if ($_SESSION["token"] == $_SERVER['HTTP_X_CSRF_TOKEN']) {
                if (time() >= $_SESSION["token-expire"]) {
                    $status = 0;
                    $msg = "مدت زمان نشست این صفحه به پایان رسیده است. لطفا صفحه را به روز نمایید.";
                }
            } else {
                $status = 0;
                $msg = "توکن ارسالی صحیح نمی باشد لطفا صفحه را به روز نمایید.";
            }
        } else {
            $status = 0;
            $msg = "شما مجاز به ارسال درخواست به این آدرس نمی باشید.";
        }

        $response = array(
            "status" => $status,
            "msg" => $msg
        );
        return $response;
    }
    public static function encrypt($data, $encryption_key)
    {
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = '1234567891011121';

        return openssl_encrypt($data, $ciphering, $encryption_key, $options, $encryption_iv);
    }

    public static function decrypt($data, $decryption_key)
    {
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $decryption_iv = '1234567891011121';

        return openssl_decrypt($data, $ciphering, $decryption_key, $options, $decryption_iv);
    }

    use publicTrait;
    use privateTrait;
}

?>
