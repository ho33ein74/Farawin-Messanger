<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

@ob_start();
@session_start();

@ini_set('max_execution_time', 240);
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb');
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('PHPASS_HASH_STRENGTH', 8);
define('PHPASS_HASH_PORTABLE', false);

class Install
{
    protected $error = '';

    public $current_step = 1;

    public $config_path = '../core/config.php';

    public static $last_step = 4;

    public function go()
    {
        $debug = '';

        if (isset($_POST) && !empty($_POST)) {
            if (isset($_POST['step']) && $_POST['step'] == 2) {
                $this->current_step = 2;
            } elseif (isset($_POST['step']) && $_POST['step'] == 3) {
                if ($_POST['hostname'] == '') {
                    $this->error = 'نام هاست ضروری است';
                } elseif ($_POST['database'] == '') {
                    $this->error = 'نام دیتابیس ضروری است';
                } elseif ($_POST['password'] == '' && !$this->is_localhost()) {
                    $this->error = 'رمز عبور دیتابیس ضروری است';
                } elseif ($_POST['username'] == '') {
                    $this->error = 'نام کاربری دیتابیس ضروری است';
                }
                $this->current_step = 3;
                if ($this->error === '') {
                    $h = trim($_POST['hostname']);
                    $u = trim($_POST['username']);
                    $p = trim($_POST['password']);
                    $d = trim($_POST['database']);

                    $link = @new mysqli($h, $u, $p, $d);
                    $link->set_charset("utf8");

                    if ($link->connect_errno) {
                        $this->error .= 'خطا: اتصال با دیتابیس ناموفق بود.<br />';
                        $this->error .= 'شماره خطا: ' . $link->connect_errno . '<br />';
                        $this->error .= 'پیام خطا: ' . $link->connect_error;
                    } else {
                        $debug .= 'تبریک: ارتباط با دیتابیس موفقیت آمیز بود! دیتابیس ' . $d . ' عالیست.<br />';
                        $debug .= 'اطلاعات هاست: ' . $link->host_info . '<br />';
                        $this->current_step = 4;
                        $link->close();
                    }
                }
            } elseif (isset($_POST['requirements_success'])) {
                $this->current_step = 2;
            } elseif (isset($_POST['permissions_success'])) {
                $this->current_step = 3;
            } elseif (isset($_POST['step']) && $_POST['step'] == 4) {
                if ($_POST['admin_mobile'] == '') {
                    $this->error = 'شماره موبایل ضروری است';
                } elseif (filter_var($_POST['admin_email'], FILTER_VALIDATE_EMAIL) === false) {
                    $this->error = 'ایمیل معتبری وارد کنید';
                } elseif ($_POST['admin_password'] == '') {
                    $this->error = 'رمز عبور ضروری است';
                } elseif ($_POST['admin_password'] != $_POST['admin_passwordr']) {
                    $this->error = 'رمز عبور مطابقت ندارد';
                } elseif ($_POST['base_url'] == '') {
                    $this->error = 'آدرس پایه ضروری است';
                } elseif ($_POST['web_title'] == '') {
                    $this->error = 'عنوان وبسایت ضروری است';
                }
                $this->current_step = 4;
            }
            if ($this->error === '' && isset($_POST['step']) && $_POST['step'] == 4) {
                include_once('sqlparser.php');
                $parser = new SqlScriptParser();

                $sqlStatements = $parser->parse('database.sql');

                $h = trim($_POST['hostname']);
                $u = trim($_POST['username']);
                $p = trim($_POST['password']);
                $d = trim($_POST['database']);

                $link = new mysqli($h, $u, $p, $d);

                foreach ($sqlStatements as $statement) {
                    $distilled = $parser->removeComments($statement);
                    if (!empty($distilled)) {
                        $link->query($distilled);
                    }
                }

                if (!$this->copy_app_config()) {
                    $config_copy_failed = true;
                }

//                $encryption_key = bin2hex($this->create_key(50));
                $ciphering = "AES-128-CTR";
                $iv_length = openssl_cipher_iv_length($ciphering);
                $options = 0;
                $encryption_iv = '1234567891011121';
                $encryption_key = substr(md5(rand()), 0, 50);
                $this->write_app_config($encryption_key);

                // https://stackoverflow.com/questions/20867182/insert-query-executes-successfully-but-data-is-not-inserted-to-the-database
                // There is a commit in the database.sql
                $link->autocommit(true);

                //set admin information to database
                $firstname = $link->escape_string($_POST['firstname']);
                $lastname = $link->escape_string($_POST['lastname']);
                $username = $link->escape_string($_POST['admin_mobile']);
                $password = password_hash($_POST['admin_password'], PASSWORD_DEFAULT);
                $email = $link->escape_string($_POST['admin_email']);

                require_once '../public/library/GoogleAuthenticator/GoogleAuthenticator.php';
                $pga = new PHPGangsta_GoogleAuthenticator();
                $secret = $pga->createSecret();
                $url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($username))) . "?d=identicon&s=50&r=x";

                require_once '../public/library/jdf/jdf.php';
                $registery_date = jdate('Y/m/d', '', '', 'Asia/Tehran', 'en');

                $sql = "INSERT INTO tbl_admin (
                       a_name, 
                       a_username, 
                       a_password,
                       a_email,
                       admin_role_id, 
                       a_image,
                       a_desc, 
                       google_secret_code, 
                       registery_date,
                       a_status
                ) VALUES (
                      '$firstname $lastname', 
                      '$username',
                      '$password',
                      '$email',
                      1,
                      '$url', 
                      '', 
                      '$secret', 
                       '$registery_date', 
                      1
                )";
                $link->query($sql);

                $base_url = trim($_POST['base_url']);
                $base_url = rtrim($base_url, '/') . '/';
                $sql = "UPDATE tbl_settings SET `value`='$base_url' WHERE `key`='root'";
                $link->query($sql);

                $sql = "UPDATE tbl_link SET l_link='$base_url' WHERE l_id=1";
                $link->query($sql);

                $web_title  = $link->escape_string($_POST['web_title']);
                $sql = "UPDATE tbl_settings SET `value`='$web_title' WHERE `key` in ('site', 'site_short_name', 'legal_name')";
                $link->query($sql);

                ///////////////////////////////////////////////
                // set the app state = installed
                $index_file_path = "../index.php";
                $index_file = file_get_contents($index_file_path);
                $index_file = preg_replace('/pre_installation/', 'installed', $index_file, 1); //replace the first occurence of 'pre_installation'
                file_put_contents($index_file_path, $index_file);

                unset($_COOKIE['adminId']);
                setcookie('adminId', null, -1, '/');

                $this->current_step = 5;
            } else {
                $error = $this->error;
            }
        }

        $current_step = $this->current_step;
        $steps        = $this->steps();

        require_once('html.php');
    }

    public function is_localhost()
    {
        $whitelist = [
            '127.0.0.1',
            '::1',
        ];

        if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            return true;
        }

        return false;
    }

    private function write_app_config($encryption_key)
    {
        $hostname = trim($_POST['hostname']);
        $database = trim($_POST['database']);
        $username = trim($_POST['username']);
        $password = addslashes(trim($_POST['password']));

        $config_path    = $this->config_path;

        @chmod($config_path, FILE_WRITE_MODE);

        $config_file = file_get_contents($config_path);
        $config_file = trim($config_file);

        $config_file = str_replace('enter_hostname', $hostname, $config_file);
        $config_file = str_replace('enter_db_username', $username, $config_file);
        $config_file = str_replace('enter_db_password', $password, $config_file);
        $config_file = str_replace('enter_database_name', $database, $config_file);
        $config_file = str_replace('enter_encryption_key', $encryption_key, $config_file);

        if (!$fp = fopen($config_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
            return false;
        }

        flock($fp, LOCK_EX);
        fwrite($fp, $config_file, strlen($config_file));
        flock($fp, LOCK_UN);
        fclose($fp);
        @chmod($config_path, FILE_READ_MODE);

        return true;
    }

    private function copy_app_config()
    {
        if (@copy('../core/config-example.php', '../core/config.php') == true) {
            return true;
        }

        return false;
    }

    public function create_key($length)
    {
        if (function_exists('random_bytes')) {
            try {
                return random_bytes((int) $length);
            } catch (Exception $e) {
                echo $e->getMessage();

                return false;
            }
        } elseif (defined('MCRYPT_DEV_URANDOM')) {
            return mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);
        }

        $is_secure = null;
        $key       = openssl_random_pseudo_bytes($length, $is_secure);

        return ($is_secure === true) ? $key : false;
    }

    public function guess_base_url()
    {
        $base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on' ? 'https' : 'http';
        $base_url .= '://' . $_SERVER['HTTP_HOST'];
        $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        $base_url = preg_replace('/install.*/', '', $base_url);

        return $base_url;
    }

    public function steps()
    {
        $step = $this->current_step;

        return [
            [
                'id'     => 1,
                'name'   => 'نیازمندی ها',
                'status' => $step > 1 ? 'complete' : 'current',
            ],
            [
                'id'     => 2,
                'name'   => 'دسترسی ها',
                'status' => $step < 2 ? 'upcoming' : ($step > 2 ? 'complete' : 'current'),
            ],
            [
                'id'     => 3,
                'name'   => 'دیتابیس',
                'status' => $step < 3 ? 'upcoming' : ($step > 3 ? 'complete' : 'current'),
            ],
            [
                'id'     => 4,
                'name'   => 'نصب',
                'status' => $step < 4 ? 'upcoming' : ($step > 4 ? 'complete' : 'current'),
            ],
            [
                'id'     => 5,
                'name'   => 'اتمام',
                'status' => $step === 5 ? 'complete' : 'upcoming',
            ],
        ];
    }
}