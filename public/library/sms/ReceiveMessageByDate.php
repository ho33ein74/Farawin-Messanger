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
	
	include_once("Classes/ReceiveMessageByDate.php");

	// your sms.ir panel configuration
	$APIKey = "enter your api key ...";
	$SecretKey = "enter your secret key ...";
	
	$Shamsi_FromDate = '1397/02/1';
	$Shamsi_ToDate = '1397/02/31';
	$RowsPerPage = 10;
	$RequestedPageNumber = 1;
	
	$SmsIR_ReceiveMessageResponseByDate = new SmsIR_ReceiveMessageResponseByDate($APIKey,$SecretKey);
	$ReceiveMessageResponseByDate = $SmsIR_ReceiveMessageResponseByDate->ReceiveMessageResponseByDate($Shamsi_FromDate, $Shamsi_ToDate, $RowsPerPage, $RequestedPageNumber);
	var_dump($ReceiveMessageResponseByDate);
	
} catch (Exeption $e) {
	echo 'Error ReceiveMessageResponseByDate : '.$e->getMessage();
}

?>