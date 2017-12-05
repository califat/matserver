<?php
namespace Security\matibabu;
require "vendor/autoload.php";
header("Content-Security-Policy: default-src 'self'");

class Security
{
	function __construct()
	{
		
	}

	public function base64_to_utf8($string){
		return base64_decode(base64_decode(base64_decode(base64_decode($string))));
	}
	public function matchinStr($str1,$str2)
	{
		return ($str1 == $srt2) ?true : false;
	}

	public function shoten($str)
	{
		return trim($str);
	}
}