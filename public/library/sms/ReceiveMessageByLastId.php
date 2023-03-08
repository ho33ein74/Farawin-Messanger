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
	
	include_once("Classes/ReceiveMessageByLastId.php");

	// your sms.ir panel configuration
	$APIKey = "enter your api key ...";
	$SecretKey = "enter your secret key ...";
	
	// your received message id
	$id = 1;
	
	$SmsIR_ReceiveMessageByLastId = new SmsIR_ReceiveMessageByLastId($APIKey,$SecretKey);
	$ReceiveMessageByLastId = $SmsIR_ReceiveMessageByLastId->ReceiveMessageByLastId($id);
	var_dump($ReceiveMessageByLastId);
	
} catch (Exeption $e) {
	echo 'Error ReceiveMessageByLastId : '.$e->getMessage();
}

?>