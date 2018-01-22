<?php
require "vendor/autoload.php";
use Model\Model;
use Router\Router;
use ClientSource\matibabu\ClientSource;
use Security\matibabu\Security;
if(!Router::isAjax()){ Router::unAuthorized();die();} 
/**
* 
*/
class ActivateStage extends Model
{
	
	private $dataPost;

	function __construct()
	{

		$this->Secure 		=new Security;
		$this->dataPost 	=$this->Secure->InternalSourceValidator();
           
		if($this->dataPost){

    		$this->Process();
    		
    	}

    }

    private function Process()
    {

    	if(isset($this->dataPost->stageId) && !empty($this->dataPost->stageId) 
    		&& isset($this->dataPost->activationCode) && !empty($this->dataPost->activationCode)){

	    	$query =$this->queryList("SELECT * FROM m_activation_code 
	    	 	WHERE stage_id =:stageId AND code =:activationCode",[
	    	 		"stageId"			=>$this->dataPost->stageId,
	    	 		"activationCode" 	=>$this->dataPost->activationCode
	    	 	]);

	    	$result =$this->AsCount($query);

	    	if($result){

	    		$queryActivationStatus =$this->queryList("SELECT active,profil_code,created_at FROM m_stages WHERE id =:stageId",["stageId"=>$this->dataPost->stageId]);

	    		$queryActivationStatusRes =$this->AsCurrent($queryActivationStatus );


	    		if($queryActivationStatusRes->active =="1"){

	    			echo "The account is active since ".$queryActivationStatusRes->created_at;

	    		}else{

	    			$this->ActivateStageAccount($this->dataPost->stageId,$queryActivationStatusRes->profil_code);	

	    		}


	    	}else{

	    		Router::ErrorMessage(401,"Wrong crendentials");
	    	}
	    	

    	}else{

    		Router::ErrorMessage(401,"some values were missing or they are empty");

    	}

    }//END METHODE 


    private function ActivateStageAccount($tageId,$profilCode){


    	//CREATING THE LOG PRINT
    	$logPrint 		= (new Stringer)->NowDateToHash();
    	$validityDate 	= strtotime("+6 Months"); //logprint validity date
    	$validity     	=str_ireplace("pm", "", date("Y-m-d h:i:sa", $validityDate));

		$query =parent::queryList("UPDATE m_stages SET active =1 WHERE id =:id",
			["id"=>$tageId]);

		if(!$query):

			Router::ErrorMessage(401,"Something wrong happened");

		endif;	
		/*********************************************************
		**********************************************************
		**********************************************************
		**********************************************************
		**********************************************************/
		$profilCode =$this->queryList("SELECT true_profil_code FROM m_profil_code 
			WHERE id =:id",["id"=>$profilCode]);

		$trueProfilCode =$this->AsCurrent($profilCode);

		if($trueProfilCode){

			if(isset($trueProfilCode->true_profil_code) && !empty($trueProfilCode->true_profil_code)):

				//SAVING THE LOG PRINT
				$makeLog =$this->queryList("INSERT INTO m_logs_activity 
					(stage_id,log,init_log,validity) 
					VALUES(:stage_id,:log,:init_log,:validity)",
					[
						"stage_id"=>$tageId,
						"log"=>$logPrint,
						"init_log"=>1,
						"validity"=>$validity
					]);

				Router::Status200("message",[
					"profilCode"=>$trueProfilCode->true_profil_code,
					"stageId"	=>$tageId,
					"logPrint"	=>$logPrint
					]);

			else:

				Router::ErrorMessage(401,"Something wrong happened");

			endif;
			

		}else{

			Router::ErrorMessage(401,"Something wrong happened");

		}
		

	}//END METHODE 


}//END CLASS

new ActivateStage;