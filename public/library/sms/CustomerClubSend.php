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
	
	include_once("Classes/CustomerClubSend.php");
	
	// your sms.ir panel configuration
	$APIKey = "enter your api key ...";
	$SecretKey = "enter your secret key ...";
	
	// your mobile numbers
	$MobileNumbers = array('091xxxxxxxx','092xxxxxxxx','093xxxxxxxx');
	
	// your text messages
	$Messages = array('text1','text2','text3');
	
	// sending date
	@$SendDateTime = date("Y-m-d")."T".date("H:i:s");

	$SmsIR_CustomerClubSend = new SmsIR_CustomerClubSend($APIKey,$SecretKey);
	$CustomerClubSend = $SmsIR_CustomerClubSend->CustomerClubSend($MobileNumbers,$Messages,$SendDateTime);
	var_dump($CustomerClubSend);
	
} catch (Exeption $e) {
	echo 'Error CustomerClubSend : '.$e->getMessage();
}

?>