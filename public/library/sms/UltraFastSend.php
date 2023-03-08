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
	
	include_once("Classes/UltraFastSend.php");

	// your sms.ir panel configuration
	$APIKey = "enter your api key ...";
	$SecretKey = "enter your secret key ...";
	
	// message data
	$data = array(
		"ParameterArray" => array(
			array(
				"Parameter" => "FirstVariable",
				"ParameterValue" => "xxxx"
			),
			array(
				"Parameter" => "SecondVariable",
				"ParameterValue" => "xxxx"
			),
			array(
				"Parameter" => "ThirdVariable",
				"ParameterValue" => "xxxx"
			)
		),
		"Mobile" => "091xxxxxxxx",
		"TemplateId" => "26"
	);

	$SmsIR_UltraFastSend = new SmsIR_UltraFastSend($APIKey,$SecretKey);
	$UltraFastSend = $SmsIR_UltraFastSend->UltraFastSend($data);
	var_dump($UltraFastSend);
	
} catch (Exeption $e) {
	echo 'Error UltraFastSend : '.$e->getMessage();
}

?>