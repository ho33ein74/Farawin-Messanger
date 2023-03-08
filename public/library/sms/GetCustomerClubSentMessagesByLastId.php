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
	
	include_once("Classes/GetCustomerClubSentMessagesByLastId.php");

	// your sms.ir panel configuration
	$APIKey = "enter your api key ...";
	$SecretKey = "enter your secret key ...";

	$lastId = 1;
	
	$SmsIR_GetCustomerClubSentMessagesByLastId = new SmsIR_GetCustomerClubSentMessagesByLastId($APIKey,$SecretKey);
	$GetCustomerClubSentMessagesByLastId = $SmsIR_GetCustomerClubSentMessagesByLastId->GetCustomerClubSentMessagesByLastId($lastId);
	var_dump($GetCustomerClubSentMessagesByLastId);
	
} catch (Exeption $e) {
	echo 'Error GetCustomerClubSentMessagesByLastId : '.$e->getMessage();
}

?>