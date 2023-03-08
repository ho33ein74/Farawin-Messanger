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
	
	include_once("Classes/ReceiveMessageByBatchKeyAndPageId.php");

	// your sms.ir panel configuration
	$APIKey = "enter your api key ...";
	$SecretKey = "enter your secret key ...";
	
	$batchKey = 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx';
	$pageId = 1;
	
	$SmsIR_ReceiveMessageByBatchKeyAndPageId = new SmsIR_ReceiveMessageByBatchKeyAndPageId($APIKey,$SecretKey);
	$ReceiveMessageByBatchKeyAndPageId = $SmsIR_ReceiveMessageByBatchKeyAndPageId->ReceiveMessageByBatchKeyAndPageId($pageId, $batchKey);
	var_dump($ReceiveMessageByBatchKeyAndPageId);
	
} catch (Exeption $e) {
	echo 'Error ReceiveMessageByBatchKeyAndPageId : '.$e->getMessage();
}

?>