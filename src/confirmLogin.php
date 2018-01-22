<?php
require "vendor/autoload.php";
use Model\Model;
use Router\Router;
use ClientSource\matibabu\ClientSource;
use Security\matibabu\Security;
if(!Router::isAjax()){ Router::unAuthorized();die();} 


class ConfirmStageLogin extends Model
{
	
	private $dataPost;

	function __construct()
	{

		$this->Secure 		=new Security;
		$this->dataPost 	=$this->Secure->InternalSourceValidator();//this method retrn data if everything is ok otherwise it return false from Security class
           
		if($this->dataPost){

    		$this->ValidateConfirmationCode();
    		
    	}

    }


	public function ValidateConfirmationCode()
	{

		if($this->dataPost->confirmationCode 
			&& !empty($this->dataPost->confirmationCode)):

			$confirmationCode =$this->dataPost->confirmationCode;

			$query =$this->queryList("SELECT phone_number FROM m_login_confirmation_code WHERE code =:code AND validity >= CURDATE()",["code"=>$confirmationCode]);
			$queryRes =$this->AsCurrent($query);

			if($queryRes):

				if(!$queryRes->phone_number):

					Router::ErrorMessage(401,"Wrong crendentials");

				endif;

				$phoneNumber =$queryRes->phone_number;

				$stageId =$this->queryList("SELECT id,profil_code FROM m_stages WHERE respo_phone =:respoPhone AND active =:active",
					[
						"respoPhone"=>$phoneNumber,
						"active" 	=>1
					]);

				$stageIdRes =$this->AsCurrent($stageId);	

				if(!$stageIdRes):

					Router::ErrorMessage(401,"Wrong crendentials");

				endif;
				if(!$stageIdRes->profil_code):

					Router::ErrorMessage(401,"Wrong crendentials");
					
				endif;

				$profilCode =$this->queryList("SELECT true_profil_code FROM m_profil_code 
					WHERE id =:id",["id"=>$stageIdRes->profil_code]);

				$trueProfilCode =$this->AsCurrent($profilCode);

				if($trueProfilCode):

					if(isset($trueProfilCode->true_profil_code) && !empty($trueProfilCode->true_profil_code)):

						$logPrint 		= (new Stringer)->NowDateToHash();
		    			$validityDate 	= strtotime("+6 Months");//logprint validity date

		    			$validity     	=str_ireplace("pm", "", date("Y-m-d h:i:sa", $validityDate));

		    			//GET NUMBER OF CONNECTED DEVICES ON THIS ACCOUNT

		    			$countDevices =$this->queryList("SELECT init_log FROM m_logs_activity WHERE stage_id =:stageId AND validity >= CURDATE()",["stageId"=>$stageIdRes->id]);
		    			$countDevicesRes =$this->AsCount($countDevices);

						//SAVING THE LOG PRINT
						$makeLog =$this->queryList("INSERT INTO m_logs_activity 
							(stage_id,log,init_log,validity) 
							VALUES(:stage_id,:log,:init_log,:validity)",
							[
								"stage_id"	=>$stageIdRes->id,
								"log"		=>$logPrint,
								"init_log"	=>0,
								"validity"	=>$validity
							]);

						//DELETING THE CONFIRMATION CODE USED TO ALLOW NEXT USAGE
						$deleteCodeForNextUse =$this->queryList("DELETE FROM m_login_confirmation_code 
							WHERE  phone_number =:phoneNumber AND code =:code",
							[
								"phoneNumber"	=>$phoneNumber,
								"code" 			=>$confirmationCode
							]);
						
						//SEND THE RESPONSE
						Router::Status200("message",[
							"profilCode"		=>$trueProfilCode->true_profil_code,
							"stageId"			=>$stageIdRes->id,
							"logPrint"			=>$logPrint,
							"connectedDevices" 	=>$countDevicesRes
							]);

					else:
							
						Router::ErrorMessage(401,"Something wrong hapenned");

					endif;
				else:
						
					Router::ErrorMessage(401,"Something wrong hapenned");

				endif;		

			else:

				Router::ErrorMessage(401,"Wrong crendentials");

			endif;	

		else:

			Router::ErrorMessage(401,"Wrong crendentials");

		endif;	
		
	}
}	
new ConfirmStageLogin;	