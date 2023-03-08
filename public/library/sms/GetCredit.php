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
	
	include_once("Classes/GetCredit.php");

	// your sms.ir panel configuration
	$APIKey = "enter your api key ...";
	$SecretKey = "enter your secret key ...";
	
	$SmsIR_GetCredit = new SmsIR_GetCredit($APIKey,$SecretKey);
	$GetCredit = $SmsIR_GetCredit->GetCredit();
	var_dump($GetCredit);
	
} catch (Exeption $e) {
	echo 'Error GetCredit : '.$e->getMessage();
}

?>