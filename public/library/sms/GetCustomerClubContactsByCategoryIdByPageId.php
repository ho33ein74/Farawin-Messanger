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
	
	include_once("Classes/GetCustomerClubContactsByCategoryIdByPageId.php");

	// your sms.ir panel configuration
	$APIKey = "enter your api key ...";
	$SecretKey = "enter your secret key ...";

	$categoryId = 0;
	$pageId = 1;
	
	$SmsIR_GetCustomerClubContactsByCategoryIdByPageId = new SmsIR_GetCustomerClubContactsByCategoryIdByPageId($APIKey,$SecretKey);
	$GetCustomerClubContactsByCategoryIdByPageId = $SmsIR_GetCustomerClubContactsByCategoryIdByPageId->GetCustomerClubContactsByCategoryIdByPageId($categoryId,$pageId);
	var_dump($GetCustomerClubContactsByCategoryIdByPageId);
	
} catch (Exeption $e) {
	echo 'Error GetCustomerClubContactsByCategoryIdByPageId : '.$e->getMessage();
}

?>