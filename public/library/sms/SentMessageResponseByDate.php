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
	
	include_once("Classes/SentMessageResponseByDate.php");

	// your sms.ir panel configuration
	$APIKey = "enter your api key ...";
	$SecretKey = "enter your secret key ...";
	
	$Shamsi_FromDate = '1397/02/1';
	$Shamsi_ToDate = '1397/02/31';
	$RowsPerPage = 10;
	$RequestedPageNumber = 1;
	
	$SmsIR_SentMessageResponseByDate = new SmsIR_SentMessageResponseByDate($APIKey,$SecretKey);
	$SentMessageResponseByDate = $SmsIR_SentMessageResponseByDate->SentMessageResponseByDate($Shamsi_FromDate, $Shamsi_ToDate, $RowsPerPage, $RequestedPageNumber);
	var_dump($SentMessageResponseByDate);
	
} catch (Exeption $e) {
	echo 'Error SentMessageResponseByDate : '.$e->getMessage();
}

?>