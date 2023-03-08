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
	
	include_once("Classes/CustomerClubSendToCategories.php");

	// your sms.ir panel configuration
	$APIKey = "enter your api key ...";
	$SecretKey = "enter your secret key ...";
	
	// your text message
	$Messages = 'text';
	
	// your Customer Club contacts Category Ids. if it does`nt have any value then sends to all customer club contacts.
	$contactsCustomerClubCategoryIds = array(1,2); //for send to all -> array();

	// sending date
	@$SendDateTime = date("Y-m-d")."T".date("H:i:s");

	$SmsIR_CustomerClubSendToCategories = new SmsIR_CustomerClubSendToCategories($APIKey,$SecretKey);
	$CustomerClubSendToCategories = $SmsIR_CustomerClubSendToCategories->CustomerClubSendToCategories($Messages, $contactsCustomerClubCategoryIds, $SendDateTime);
	var_dump($CustomerClubSendToCategories);
	
} catch (Exeption $e) {
	echo 'Error CustomerClubSendToCategories : '.$e->getMessage();
}

?>