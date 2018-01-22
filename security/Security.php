<?php
namespace Security\matibabu;
require "vendor/autoload.php";
use Model\Model;
use Router\Router;
use ClientSource\matibabu\ClientSource;
header("Content-Security-Policy: default-src 'self'");

class Security extends Model
{
	function __construct()
	{
		
	}//END CONSTRUCT

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

	public function InternalSourceValidator(){

		$this->EnvVars 		=(new \LoadEnv);
		$this->Source 		=new ClientSource;
		$this->Dater 		=new \Dater;
		$this->Public_key 	=$this->EnvVars->PUBLIC_KEY;
	
        if(isset($_POST)){

        	if(isset($_POST["data"]) && !empty($_POST["data"])){

        		$this->dataPost =json_decode($_POST["data"]);

        		if(isset($this->dataPost->ACC_SID) && !empty($this->dataPost->ACC_SID) 
        			&& isset($this->dataPost->TOKEN) && !empty($this->dataPost->TOKEN) 
        			&& isset($this->dataPost->PUBLIC_KEY) && !empty($this->dataPost->PUBLIC_KEY) 
        			&& isset($this->dataPost->CSRF_TOKEN)&& !empty($this->dataPost->CSRF_TOKEN) 
        			&& isset($this->dataPost->METHOD) && !empty($this->dataPost->METHOD) 
        			&& isset($this->dataPost->ACTION) && !empty($this->dataPost->ACTION)
        			&& isset($this->dataPost->BILL) && !empty($this->dataPost->BILL)
        			&& isset($this->dataPost->ELAPSE) && !empty($this->dataPost->ELAPSE)
                                && isset($this->dataPost->require) && !empty($this->dataPost->require)){

        			$this->Action 			=$this->dataPost->ACTION;
        			$this->Method 			=$this->dataPost->METHOD;
        			$this->Bill 			=$this->dataPost->BILL;
        			$this->Elapse 			=$this->dataPost->ELAPSE;
        			$this->Csrf_token 		=$this->dataPost->CSRF_TOKEN;
        			$replaceArr 			=["@s-","@k-","@t-"];
        			$this->Account_sid		=str_replace($replaceArr, "", $this->dataPost->ACC_SID);
        			$this->Key 				=str_replace($replaceArr, "", $this->dataPost->PUBLIC_KEY);
        			$this->Account_token	=str_replace($replaceArr, "", $this->dataPost->TOKEN);
        			$this->compositeArr 	=[$this->Account_sid, $this->Account_token,$this->Elapse,$this->Bill];
        			$composite 				=$this->compositeArr[0].$this->compositeArr[1].$this->compositeArr[2].$this->compositeArr[3];

        			$shortened 				=$this->shoten(str_replace($replaceArr, "", $this->base64_to_utf8($this->Csrf_token)));

                                $dataPostRequire =$this->dataPost->require;


        			if($shortened !==trim($composite)){

        				Router::forbiden();

        			}else{
                                        
	        			if($this->Source->DetermineSourceFromStr($this->Key,$this->Account_sid,$this->Account_token)){

	        				return $this->dataPost->require;

	        			}else{


	        				// WE SHOULD VALIDATE FOR EXTERNAL SOURCE
	        				//PROCESS FOR EXTERNAL SOURCE TO VALIDATE THE ACCOUNT SID IF IS MATCHING IN DATABASE
	        				Router::forbiden();

	        			}
	        		}
	        	}
	        }
	    }
	}//END METHOD 


	public static function CheckdataPostRequireToCreateNewClient($dataPostRequire)
	{
		if(!isset($dataPostRequire->clientAddress) || !isset($dataPostRequire->size)|| !isset($dataPostRequire->emergencyName) 
			|| !isset($dataPostRequire->partenerName) 
			|| !isset($dataPostRequire->partenerOccupation) 
			|| !isset($dataPostRequire->clientOccupation) 
			|| !isset($dataPostRequire->clientPhone) 
			|| !isset($dataPostRequire->RH) 
			|| !isset($dataPostRequire->electrophaseHB) 
			|| !isset($dataPostRequire->civilStatus) 
			|| !isset($dataPostRequire->DPA) 
			|| !isset($dataPostRequire->TBC) || !isset($dataPostRequire->HTA) 
			|| !isset($dataPostRequire->SCA_SS) || !isset($dataPostRequire->DBT) 
			|| !isset($dataPostRequire->CAR) || !isset($dataPostRequire->MFG) 
			|| !isset($dataPostRequire->RAA) 
			|| !isset($dataPostRequire->Syphylis) 
			|| !isset($dataPostRequire->VIH_SIDA) 
			|| !isset($dataPostRequire->VVS) || !isset($dataPostRequire->PEP) 
			|| !isset($dataPostRequire->primipare) 
			|| !isset($dataPostRequire->Cerclage) 
			|| !isset($dataPostRequire->FubromeUterien) 
			|| !isset($dataPostRequire->FractureBassin) 
			|| !isset($dataPostRequire->GEU) || !isset($dataPostRequire->Fistule) 
			|| !isset($dataPostRequire->UterusCicatriciel) 
			|| !isset($dataPostRequire->TraitementSterilite) 
			|| !isset($dataPostRequire->Paritee) 
			|| !isset($dataPostRequire->Gestile) 
			|| !isset($dataPostRequire->EnfantEnvie) 
			|| !isset($dataPostRequire->Avortement) 
			|| !isset($dataPostRequire->Distocie) 
			|| !isset($dataPostRequire->Eutocie) 
			|| !isset($dataPostRequire->GrosPoidNaissance) 
			|| !isset($dataPostRequire->PlusDe4kg) 
			|| !isset($dataPostRequire->Premature) 
			|| !isset($dataPostRequire->Premature) 
			|| !isset($dataPostRequire->MortNe) 
			|| !isset($dataPostRequire->MortAvant7Jrs) 
			|| !isset($dataPostRequire->DernierAcouchementDate) 
			|| !isset($dataPostRequire->IntervalMoin2ans) 
			|| !isset($dataPostRequire->complicationPostParumOui) 
			||!isset($dataPostRequire->ComplicationPostParumDesc)):
			Router::ErrorMessage(401,"Some values were not defined or mal formed");
		endif;
	}//END METHOD


	//VALIDATING A LOG PRINT TO ENSURE THAT IS ALLOWED TO ACCESS ON THAT ACCOUNT
	public function ValidateLogPrint($stageId,$logPrint)
	{

		$ValidateLogPrint =$this->queryList("SELECT init_log,created_at,validity 
			FROM m_logs_activity 
			WHERE stage_id =:stageId AND log =:log AND validity >= CURDATE()",
			["stageId"=>$stageId,"log"=>$logPrint]);

		$ValidateLogPrintRes =$this->AsCurrent($ValidateLogPrint);

		if($ValidateLogPrintRes):
			
			return true;

		else:
			
			return false;

		endif;		
	}//END METHOD


}//END CLASS