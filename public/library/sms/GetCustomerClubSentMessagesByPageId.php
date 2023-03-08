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
	
	include_once("Classes/GetCustomerClubSentMessagesByPageId.php");

	// your sms.ir panel configuration
	$APIKey = "enter your api key ...";
	$SecretKey = "enter your secret key ...";

	$pageId = 1;
	$rowCount = 10;
	
	$SmsIR_GetCustomerClubSentMessagesByPageId = new SmsIR_GetCustomerClubSentMessagesByPageId($APIKey,$SecretKey);
	$GetCustomerClubSentMessagesByPageId = $SmsIR_GetCustomerClubSentMessagesByPageId->GetCustomerClubSentMessagesByPageId($pageId,$rowCount);
	var_dump($GetCustomerClubSentMessagesByPageId);
	
} catch (Exeption $e) {
	echo 'Error GetCustomerClubSentMessagesByPageId : '.$e->getMessage();
}

?>