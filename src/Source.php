<?php
namespace ClientSource\matibabu;
require "vendor/autoload.php";
header("Content-Security-Policy: default-src 'self'");

use AppKernel\matibabu\AppKernel as Kernel;

class ClientSource extends \Src
{

	public 	$EnvVars;
	
	function __construct()
	{
		$this->EnvVars 		=(new \LoadEnv);

	}
	public function DetermineSourceFromStr($str1,$str2,$str3)
	{
		if(strtolower($str1) === strtolower($this->EnvVars->PUBLIC_KEY) && strtolower($str2) === strtolower($this->EnvVars->PUBLIC_KEY) && strtolower($str3) === strtolower($this->EnvVars->PUBLIC_KEY)){
			return true;

		}else{

			return false;
		}
	}
	public function Decide($source,$action)
	{
		if ($action ==$this->CreateStage && $source =="internal") {
			(new Kernel)->CreateStageFromInternal();
		}
	}
}