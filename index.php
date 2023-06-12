<?php
ignore_user_abort(1); // run script in background
set_time_limit(0); // run script forever
date_default_timezone_set("Asia/Tehran");

$domain = $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
$domain = preg_replace('/index.php.*/', '', $domain); //remove everything after index.php

//set the variable to 'installed' after installation
$app_state = "installed"; //installed or installed

// Valid PHP Version?
$minPHPVersion = '7.4';
if (version_compare(PHP_VERSION, $minPHPVersion, '<')) {
    die("Your PHP version must be {$minPHPVersion} or higher to run script. Current version: " . PHP_VERSION);
}
unset($minPHPVersion);

if ($app_state === 'pre_installation') {
    if (!empty($_SERVER['HTTPS'])) {
        $domain = 'https://' . $domain;
    } else {
        $domain = 'http://' . $domain;
    }

    header("Location: $domain./install/index.php");
    exit;
} else {
    require_once 'core/config.php';
}

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