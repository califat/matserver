<?php
require "vendor/autoload.php";
use Model\Model;
use Router\Router;

/**
* 
*/
class ValidateProfilCodeAndStageId extends Model
{
	
	function __construct()
	{
		
	}

	public function ValidateProfilCodeAndStageId($profilCode,$stageId)
	{
		
		$query =$this->queryList("SELECT id FROM m_profil_code 
			WHERE true_profil_code =:trueProfilCode",["trueProfilCode"=>$profilCode]);
		$queryRes =$this->AsCurrent($query);

		if($queryRes):

			if(!isset($queryRes->id) || empty($queryRes->id)):

				return false;

			else:	

				$query =$this->queryList("SELECT id FROM m_stages 
					WHERE id =:id AND profil_code =:trueProfilCode",
					["id"=>$stageId,"trueProfilCode"=>$queryRes->id]);

				$queryRes =$this->AsCurrent($query);

				if($queryRes):


					if(isset($queryRes->id) && !empty($queryRes->id)):

						return true;

					else:
					
						return false;
						
					endif;		


				else:	
					
					return false;
					
				endif;	

			endif;	
			
		else:
			
			return false;
			
		endif;		

	}
}