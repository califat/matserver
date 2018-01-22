<?php
namespace ClientSource\matibabu;
require "vendor/autoload.php";
header("Content-Security-Policy: default-src 'self'");

use AppKernel\matibabu\AppKernel as Kernel;

class ClientSource extends \Src
{

	public 	$EnvVars;
	private $Kernel;
	private $Model;
	
	function __construct()
	{
		$this->EnvVars 		=(new \LoadEnv);
		$this->Kernel 		=new Kernel;

	}
	public function DetermineSourceFromStr($str1,$str2,$str3)
	{
		if(strtolower($str1) === strtolower($this->EnvVars->PUBLIC_KEY) && strtolower($str2) === strtolower($this->EnvVars->PUBLIC_KEY) && strtolower($str3) === strtolower($this->EnvVars->PUBLIC_KEY)){
			return true;

		}else{

			return false;
		}
	}
	public function Decide($source,$action,$dataPostRequire,$credentials)
	{
		if ($action == $this->CreateStage && $source =="internal") {

			$this->Kernel->CreateStageFromInternal($dataPostRequire);

		}elseif($action ==$this->CreateClient && $source =="internal"){

			$this->Kernel->CreateClientFromInternal($dataPostRequire,$credentials);

		}elseif($action == $this->logStage && $source =="internal"){

			$this->Kernel->LogStage($dataPostRequire,$credentials);

		}elseif($action == $this->disconnectDevice && $source =="internal"){

			(new \DisconnectDevice($dataPostRequire,$credentials));

		}elseif($action == $this->searchClient && $source =="internal"){

			$this->Kernel->SearchClient($dataPostRequire,$credentials);

		}
	}

}