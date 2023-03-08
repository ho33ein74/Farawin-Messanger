<?php
ignore_user_abort(1); // run script in background
set_time_limit(0); // run script forever
date_default_timezone_set("Asia/Tehran");

require_once 'vendor/autoload.php';
require_once 'core/config.php';
require_once 'core/reservation.php';
require_once 'core/controller.php';
require_once 'core/model.php';
require_once 'public/library/MobileDetect/Mobile_Detect.php';
require_once 'public/library/rss/rss_feed.php';
require_once 'public/library/ics/ics.php';
require_once 'public/library/sms/Classes/UltraFastSend.php';
require_once 'public/library/sms/Classes/GetCredit.php';
require_once 'public/library/GoogleAuthenticator/GoogleAuthenticator.php';
require_once 'core/zarinPal.php';

define('URL', (new Model)->getPublicInfo("root"));
define('ADMIN_PATH', (new Model)->getPublicInfo("admin_path"));

if ((new Model)->getPublicInfo("show_error")) {
    ini_set('display_errors', '1');
} else {
    ini_set("log_errors", 0);
    error_reporting(E_ERROR | E_PARSE);
    unlink("error_log");
    ini_set('display_errors', '0');
}

new reservation;