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
	
	include_once("Classes/VerificationCode.php");

	// your sms.ir panel configuration
	$APIKey = "enter your api key ...";
	$SecretKey = "enter your secret key ...";
	
	// your code
	$Code = "12345";
	
	// your mobile number
	$MobileNumber = "091xxxxxxxx"; 

	$SmsIR_VerificationCode = new SmsIR_VerificationCode($APIKey,$SecretKey);
	$VerificationCode = $SmsIR_VerificationCode->VerificationCode($Code, $MobileNumber);
	var_dump($VerificationCode);
	
} catch (Exeption $e) {
	echo 'Error VerificationCode : '.$e->getMessage();
}

?>