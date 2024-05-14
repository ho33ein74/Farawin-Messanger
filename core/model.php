<?php
require_once "public-function.php";

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
}

?>
