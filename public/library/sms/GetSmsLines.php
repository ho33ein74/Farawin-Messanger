<?php

/**
 * @author Pejman Kheyri
 * @author Pejman Kheyri <pejmankheyri@gmail.com>
 * @copyright © 2018 The Ide Pardazan (ipe.ir) PHP Group. All rights reserved.
 * @link http://sms.ir/ Documentation of sms.ir RESTful API PHP sample.
 * @version 1.2
 */

try {
	
	date_default_timezone_set("Asia/Tehran");
	
	include_once("Classes/GetSmsLines.php");

	// your sms.ir panel configuration
	$APIKey = "enter your api key ...";
	$SecretKey = "enter your secret key ...";
	
	$SmsIR_GetSmsLines = new SmsIR_GetSmsLines($APIKey,$SecretKey);
	$GetSmsLines = $SmsIR_GetSmsLines->GetSmsLines();
	var_dump($GetSmsLines);
	
} catch (Exeption $e) {
	echo 'Error GetSmsLines : '.$e->getMessage();
}

?>