<?php

ini_set('max_execution_time', 300); //300 seconds

if (isset($_POST)) {
    $host = $_POST["host"];
    $dbuser = $_POST["dbuser"];
    $dbpassword = $_POST["dbpassword"];
    $dbname = $_POST["dbname"];

    $admin_name = $_POST["admin_name"];
    $admin_username = $_POST["admin_username"];
    $email = $_POST["email"];
    $login_password = $_POST["password"] ? $_POST["password"] : "";
    $root_path = $_POST["root_path"];
    $web_title = $_POST["web_title"];

    //check required fields
    if (!($host && $dbuser && $dbname && $admin_name && $admin_username && $email && $login_password && $root_path && $web_title)) {
        echo json_encode(array("success" => false, "message" => "لطفا تمام فیلدها را پر کنید"));
        exit();
    }

    //check for valid root_path
    if (filter_var($root_path, FILTER_VALIDATE_URL) === false) {
        echo json_encode(array("success" => false, "message" => "لطفا آدرس معتبری وارد کنید"));
        exit();
    }

    //check for valid email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo json_encode(array("success" => false, "message" => "لطفا ایمیل معتبری وارد کنید"));
        exit();
    }

    //check for valid database connection
    $mysqli = @new mysqli($host, $dbuser, $dbpassword, $dbname);

    if (mysqli_connect_errno()) {
        echo json_encode(array("success" => false, "message" => $mysqli->connect_error));
        exit();
    }

    //all input seems to be ok. check required fiels
    if (!is_file('database.sql')) {
        echo json_encode(array("success" => false, "message" => "The database.sql file could not found in install folder!"));
        exit();
    }

    /*
     * check the db config file
     * if db already configured, we'll assume that the installation has completed
     */

    $db_file_path = "../core/config.php";
    $db_file = file_get_contents($db_file_path);
    $is_installed = strpos($db_file, "enter_hostname");

    if (!$is_installed) {
        echo json_encode(array("success" => false, "message" => "Seems this app is already installed! You can't reinstall it again."));
        exit();
    }

    //start installation
    $sql = file_get_contents("database.sql");

    //set admin information to database
    $sql = str_replace('admin_name', $admin_name, $sql);
    $sql = str_replace('admin_username', $admin_username, $sql);
    $sql = str_replace('admin_email', $email, $sql);

    $sql = str_replace('admin_password', password_hash($login_password, PASSWORD_DEFAULT), $sql);

    require_once '../public/library/jdf/jdf.php';
    $sql = str_replace('admin_created_at',  jdate('Y/m/d', '', '', 'Asia/Tehran', 'en'), $sql);

    require_once '../public/library/GoogleAuthenticator/GoogleAuthenticator.php';
    $pga = new PHPGangsta_GoogleAuthenticator();
    $secret = $pga->createSecret();
    $sql = str_replace('google_secret_code_gen', $secret, $sql);

    $sql = str_replace('root_path', $root_path, $sql);
    $sql = str_replace('web_title', $web_title, $sql);

    //set time for use test script foa all parts
    $duration = time() + (24 * 60 * 60 * 3);
    $data = array(
        "license_username" => "demo",
        "license_order_id" => "demo",
        "license_domain" => $_SERVER['SERVER_NAME'],
        "license_check_expire" => $duration,
        "license_type" => "demo"
    );

    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = substr(md5(rand()), 0, 50);
    $encryption_key_for_license = $encryption_key . "#Un!xTeam#" . $_SERVER['SERVER_NAME'];

    $data_for_license_test =  openssl_encrypt(
        serialize($data),
        $ciphering,
        $encryption_key_for_license,
        $options,
        $encryption_iv
    );

    $sql = str_replace(
        'license_info_set_demo_time',
        $data_for_license_test,
        $sql
    );
    ///////////////////////////////////////////////

    //create tables in datbase

    $mysqli->multi_query($sql);
    do {} while (mysqli_more_results($mysqli) && mysqli_next_result($mysqli));

    $mysqli->close();
    // database created
    // set the database config file

    $db_file = str_replace('enter_hostname', $host, $db_file);
    $db_file = str_replace('enter_db_username', $dbuser, $db_file);
    $db_file = str_replace('enter_db_password', $dbpassword, $db_file);
    $db_file = str_replace('enter_database_name', $dbname, $db_file);
    file_put_contents($db_file_path, $db_file);

    // set random enter_encryption_key
    $config_file_path = "../core/config.php";
    $config_file = file_get_contents($config_file_path);
    $config_file = str_replace('enter_encryption_key', $encryption_key, $config_file);
    file_put_contents($config_file_path, $config_file);

    // set the app state = installed
    $index_file_path = "../index.php";
    $index_file = file_get_contents($index_file_path);
    $index_file = preg_replace('/pre_installation/', 'installed', $index_file, 1); //replace the first occurence of 'pre_installation'
    file_put_contents($index_file_path, $index_file);


    echo json_encode(array("success" => true, "message" => "نصب اسکریپت با موفقیت انجام شد."));
    exit();
}
