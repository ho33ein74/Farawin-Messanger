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

    use publicTrait;
    use privateTrait;
}

?>
