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
	
	include_once("Classes/SentMessageResponseById.php");

	// your sms.ir panel configuration
	$APIKey = "enter your api key ...";
	$SecretKey = "enter your secret key ...";
	
	// your sent message id
	$id = "enter your message id ...";
	
	$SmsIR_SentMessageResponseById = new SmsIR_SentMessageResponseById($APIKey,$SecretKey);
	$SentMessageResponseById = $SmsIR_SentMessageResponseById->SentMessageResponseById($id);
	var_dump($SentMessageResponseById);
	
} catch (Exeption $e) {
	echo 'Error SentMessageResponseById : '.$e->getMessage();
}

?>