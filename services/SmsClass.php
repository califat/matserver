<?php
namespace SmsClass\matibabu; 
require "vendor/autoload.php";

interface SmsClass{

	public function SimpleSms($phoneNumber,$SmsContent);

}