<?php
if(!file_exists("vendor/autoload.php"))die();
require "vendor/autoload.php";

use Find_session\Find_session;
use Router\Router;
use Model\Model;

class PhoneNumberValidator extends Model
{

	private $countryCode 			="+243";
	private $aritel      			=["099","097"];
	private $vodacom 				=["082"];
	private $orange 				=["085","084"];
	private $tigo 					=["089"];
	private $processedPhoneLength 	=12;
	private $plus 					="+";

	function __construc(){}

	public function PhoneNumberFormater($phoneNumber)
	{
		$processedPhone 		="";
		$countryCode 			=$this->countryCode;
		$aritel      			=$this->aritel;
		$vodacom 				=$this->vodacom;
		$orange 				=$this->orange;
		$tigo 					=$this->tigo;

		$zero 					="0";
		$newPhone 				="";
		$phoneSufix 			="";
		$phoneNoCode 			=substr($phoneNumber, 0,3);
		$phoneWithCode 			=substr($phoneNumber, 0,4);
		$processedPhoneError 	="Invalid phone number";

		if ($phoneWithCode =="+243") {

			$newPhone 		=str_ireplace($countryCode, $zero, $phoneNumber);
			$phoneSufix 	=substr($newPhone, 0,3);
			$processedPhone =$phoneNumber;

		}elseif(in_array($phoneNoCode, $aritel)){

			$newPhone 		=str_ireplace($countryCode, $zero, $phoneNumber);
			$phoneSufix 	=substr($newPhone, 0,3);
			$processedPhone =$countryCode.substr($phoneNumber, 1);

		}elseif(in_array($phoneNoCode, $vodacom)){

			$newPhone 		=str_ireplace($countryCode, $zero, $phoneNumber);
			$phoneSufix 	=substr($newPhone, 0,3);
			$processedPhone =$countryCode.substr($phoneNumber, 1);

		}elseif(in_array($phoneNoCode, $orange)){

			$newPhone 		=str_ireplace($countryCode, $zero, $phoneNumber);
			$phoneSufix 	=substr($newPhone, 0,3);
			$processedPhone =$countryCode.substr($phoneNumber, 1);

		}elseif(in_array($phoneNoCode, $tigo)){

			$newPhone 		=str_ireplace($countryCode, $zero, $phoneNumber);
			$phoneSufix 	=substr($newPhone, 0,3);
			$processedPhone =$countryCode.substr($phoneNumber, 1);

		}

		if(mb_strlen(str_ireplace($this->plus, "", $processedPhone)) ==$this->processedPhoneLength)
		{
			return $processedPhone;

		}else{

			return $processedPhoneError;

		}

	}

	public function GetPhoneNumberSufix($phoneNumber)
	{
		$countryCode 	=$this->countryCode;
		$aritel      	=$this->aritel;
		$vodacom 		=$this->vodacom;
		$orange 		=$this->orange;
		$tigo 			=$this->tigo;

		$zero 			="0";
		$newPhone 		="";
		$phoneSufix 	="";
		$phoneNoCode 	=substr($phoneNumber, 0,3);
		$phoneWithCode 	=substr($phoneNumber, 0,4);
		$processedPhone ="";

		if ($phoneWithCode =="+243") {

			$newPhone 		=str_ireplace($countryCode, $zero, $phoneNumber);
			$phoneSufix 	=substr($newPhone, 0,3);
			$processedPhone =$phoneNumber;

		}elseif(in_array($phoneNoCode, $aritel)){

			$newPhone 		=str_ireplace($countryCode, $zero, $phoneNumber);
			$phoneSufix 	=substr($newPhone, 0,3);
			$processedPhone =$countryCode.substr($phoneNumber, 1);

		}elseif(in_array($phoneNoCode, $vodacom)){

			$newPhone 		=str_ireplace($countryCode, $zero, $phoneNumber);
			$phoneSufix 	=substr($newPhone, 0,3);
			$processedPhone =$countryCode.substr($phoneNumber, 1);

		}elseif(in_array($phoneNoCode, $orange)){

			$newPhone 		=str_ireplace($countryCode, $zero, $phoneNumber);
			$phoneSufix 	=substr($newPhone, 0,3);
			$processedPhone =$countryCode.substr($phoneNumber, 1);

		}elseif(in_array($phoneNoCode, $tigo)){

			$newPhone 		=str_ireplace($countryCode, $zero, $phoneNumber);
			$phoneSufix 	=substr($newPhone, 0,3);
			$processedPhone =$countryCode.substr($phoneNumber, 1);

		}
		return $phoneSufix ;
	}
	private function FetchNetworkId($network){

		$networkId =$this->queryList("SELECT id FROM m_networks 
									WHERE network =:network
								",["network"=>ucfirst($network)]);

		$networkIdRes =$this->AsCurrent($networkId);

		if($networkIdRes){

			return $networkIdRes->id;

		}else{

			return false;
		}

	}
	public function GetPhoneNumberNetwork($phoneSufix)
	{

		$network;
		$networkId 	="Undefined network";

		if(in_array($phoneSufix, $this->aritel)){

			$network 	="Airtel";
			$networkId 	=$this->FetchNetworkId($network);

		}elseif(in_array($phoneSufix, $this->orange)){

			$network ="Orange";
			$networkId 	=$this->FetchNetworkId($network);

		}elseif(in_array($phoneSufix, $this->tigo)){

			$network 	="Tigo";
			$networkId 	=$this->FetchNetworkId($network);

		}elseif(in_array($phoneSufix, $this->vodacom)){

			$network ="Vodacom";
			$networkId 	=$this->FetchNetworkId($network);

		}

		return $networkId;
	}	
}