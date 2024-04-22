<?php
ignore_user_abort(1); // run script in background
set_time_limit(0); // run script forever
date_default_timezone_set("Asia/Tehran");

require_once 'core/config.php';
require_once 'core/messenger.php';
require_once 'core/controller.php';
require_once 'core/model.php';

//ini_set("log_errors", 0);
//error_reporting(E_ERROR | E_PARSE);
//unlink("error_log");
ini_set('display_errors', '1');


new messenger;