<?php
namespace Sms\matibabu;
require "vendor/autoload.php";
use SmsClass\matibabu\SmsClass; 


/**
* 
*/
class Sms implements SmsClass
{
	
	function __construct(){}

	public function SimpleSms($phoneNumber,$SmsContent)
	{
		echo $SmsContent;
	}
}
