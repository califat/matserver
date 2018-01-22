<?php
require "vendor/autoload.php";
use Model\Model;
use Router\Router;
use ClientSource\matibabu\ClientSource;
use Security\matibabu\Security;
if(!Router::isAjax()){ Router::unAuthorized();die();}

class DisconnectDevice extends Model
{
	
	private $dataPost;
	private $credentials;

	function __construct($dataPostRequire,$credentials)
	{

		$this->Security 	=new Security;
		$this->dataPost 	=$dataPostRequire;
		$this->credentials 	=$credentials;

		if(!$this->dataPost || !$this->credentials):
			
			Router::ErrorMessage(401,"Something wrong happened");
			
		else:
		
			$this->DisconnectDevice($this->dataPost,$this->credentials);

		endif;	
		
    }//END CONSTRUCT

	public function DisconnectDevice($dataPostRequire,$credentials)
	{

		if (isset($dataPostRequire) && !empty($dataPostRequire) && isset($credentials) && !empty($credentials)) {

			if(!is_array($credentials)):
				Router::ErrorMessage(401,"error");
			endif;	

			if(count($credentials) > 4):
				Router::ErrorMessage(401,"error");
			endif;	

			if(!isset($credentials["SID"]) || !isset($credentials["TOKEN"]) ||  
				!isset($credentials["BILL"]) || !isset($credentials["ELAPSE"]) ):

				Router::ErrorMessage(401,"error");

			elseif(empty($credentials["SID"]) || empty($credentials["TOKEN"]) 
				||  empty($credentials["BILL"]) || empty($credentials["ELAPSE"])):

				Router::ErrorMessage(401,"error");

			endif;

			$SID 		=$credentials["SID"];
			$TOKEN 		=$credentials["TOKEN"];
			$BILL  		=$credentials["BILL"];
			$ELAPSE 	=$credentials["ELAPSE"];

			$TARGETS_ID =explode(":", base64_decode($credentials["BILL"]));
			/***********************************
			************************************
			***********************************/
			if(count($TARGETS_ID) !==3):

				Router::ErrorMessage(401,"error");

			endif;
			/***********************************
			************************************
			***********************************/

			$PROFIL_CODE 	=$TARGETS_ID[0];
			$STAGE_ID 		=$TARGETS_ID[1];
			$STAGE_LOG_PRINT=$TARGETS_ID[2];

			//CHECKING IF THE LOG PRINT IS VALID 
			/***********************************
			************************************
			***********************************/
			if(!$this->Security->ValidateLogPrint($STAGE_ID,$STAGE_LOG_PRINT)):

				Router::ErrorMessage(401,"This session is expired");

			else:

				//disconnect all devices excep this one 
				$disconnectDevice =$this->queryList("DELETE FROM m_logs_activity 
					WHERE log !=:logPrint AND stage_id =:stageId",
					["logPrint"=>$STAGE_LOG_PRINT,"stageId"=>intval($STAGE_ID)]);

				if($disconnectDevice){

					//update the current connection from the device tointi log
					$makeTheInitLog =$this->queryList("UPDATE m_logs_activity 
						SET init_log =1 WHERE log =:log AND stage_id =:stageId",
						[
							"log"		=>$STAGE_LOG_PRINT,
							"stageId" 	=>intval($STAGE_ID)
						]);

				}

				Router::Status200();

			endif;	
			
		}

	}//END METHOD

}//END CLASS
