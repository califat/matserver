<?php
namespace AppKernel\matibabu;
require "vendor/autoload.php";
use Model\Model;
use Router\Router;
use PhoneNumberValidator;
use AppDefender\AppDefender;
use Security\matibabu\Security;
/*use ClientSource\matibabu\ClientSource;*/
use ClientResponse\matibabu\ClientResponse;
use ValidateProfilCodeAndStageId as AccountValidator;

class AppKernel extends Model
{
	private $date;
	private $Defender;
	private $Security;
	private $Response;
	private $phoneNumberValidator;

	function __construct(){

		$this->date 					=new \Dater;
		$this->Security 				=new Security;
		$this->Defender 				=new \AppDefender;
		$this->Response 				=new ClientResponse;
		$this->phoneNumberValidator 	=new PhoneNumberValidator;

	}//END CONSTRUCT

	private function ErrorMessage($status=401,$errorMessage)
	{

	 	echo json_encode($errorMessage);
	 	http_response_code($status);
	 	die();
	}//END METHOD
	private function GenerateProfilCode($province,$zone)
	{
		$dash 	="-";
		return 	$province.
				$zone.$dash.
				$this->date->year.$dash.
				mb_strtoupper($this->Defender->getRandomInteger(50,10000));
	}//END METHOD
	private function GenerateClientTrueProfilCode($stageIdProfilcode)
	{
		$dash 	="-";
		return 	$stageIdProfilcode.$dash.
				mb_strtoupper($this->Defender->getRandomInteger(50,10000));
	}//END METHOD
	private function GenerateClientProfilCode($provinceId,$zoneId,$stageId)
	{
		return $stageId.
				mb_strtoupper($this->Defender->getRandomInteger(50,100000));
	}//END METHOD
	private function GenerateAccountNumber($provinceId,$zoneId)
	{
		return 	$provinceId.
				$zoneId.
				$this->date->year.
				mb_strtoupper($this->Defender->getRandomInteger(50,100000));
	}//END METHOD

	public function CreateStageFromInternal($dataPostRequire)
	{
	    /**
	     * @param tables[m_provinces,m_zones,m_profil_code,m_arrete_min,m_stages,m_balance,m_trans_in_tokens,m_trans_in_amount,m_trans_in]
	     * @param queries[query,insertArreteMin,createStage,initializeBalance,insertTransactionToken,initializeTransIn,initializeTransIn]
	     */

		$data =$dataPostRequire;

        $require =["name","address","arrete_min","province","zone","resName","resPhone"];			

    	if (	!isset($data->name) 		|| empty($data->name) 		|| 
    			!isset($data->address) 		|| empty($data->address) 	||
    			!isset($data->arrete_min)	|| empty($data->arrete_min)	||
    			!isset($data->province) 	|| empty($data->province)	||
    			!isset($data->zone) 		|| empty($data->zone)		||
    			!isset($data->resName)		|| empty($data->resName)	||
    			!isset($data->resPhone) 	|| empty($data->resPhone)) {

    		$this->ErrorMessage(401,"some values are missing");//NOT ACCEPTABLE

    	}else{

    		/*VALIDER LA PROVINCE AVEC CELLE DE LA BASE DES DONNES*/
    		$dataProvinceAlphabet =$data->province;

    		$getProvince =$this->queryList("SELECT id FROM  m_provinces WHERE alphabet =:alphabet",["alphabet"=>$dataProvinceAlphabet]);

			$getProvinceExistsRes 	=$this->AsCurrent($getProvince);

			if(!$getProvinceExistsRes || empty($getProvinceExistsRes)){
				/*AUCUNE PROVINCE 
				AVEC CET ALPHABET 
				NA ETAIT TROUVER*/
				$this->ErrorMessage(401,"Province not found");//NOT ACCEPTABLE

			}else{

				$provinceId =$getProvinceExistsRes->id;

				/*VALIDER LA ZONE AVEC CELLE DE LA BASE DES DONNES*/
				$dataZoneAlphabetComposed =$data->zone;
	    		$getZone =$this->queryList("SELECT id FROM  m_zones WHERE alphabet_composed =:alphabet_composed AND province =:province",
	    			[
	    				"alphabet_composed"=>$dataZoneAlphabetComposed,
	    				"province"=>$provinceId
	    			]);

				$getZoneExistsRes 	=$this->AsCurrent($getZone);

				if(!$getZoneExistsRes || empty($getZoneExistsRes)){

					/*AUCUNE PROVINCE 
					AVEC CET ALPHABET 
					NA ETAIT TROUVER*/
					$this->ErrorMessage(401,"Zone not found");//NOT ACCEPTABLE
					

				}else{

					$zoneId 			=$getZoneExistsRes->id;
					$province   		=$data->province;
					$zone 				=$data->zone;

					$stageName  		=$data->name;
    				$stageAddress 		=$data->address;
    				$stageArreteMin 	=$data->arrete_min;
    				$stageRespoName 	=$data->resName;
    				$stageRespoPhone 	=$this->phoneNumberValidator
    									->PhoneNumberFormater($data->resPhone);

    				if($stageRespoPhone == "Invalid phone number"){

    					$this->ErrorMessage(401,"Telephone Invalid en RDC");//NOT ACCEPTABLE

    				}

					//GENERATE UNIQUE PROFIL CODE BY CHECKING IN DATABASE
					do {

						$trueProfilCode =$this->GenerateProfilCode($province,$zone);

					} while ($this->cell_count("m_profil_code","true_profil_code",
						$trueProfilCode) > 0);

					//INSERTING THE PROFIL CODE OF THE STAGE IN DATA BASE
					$query 	=parent::queryList("INSERT  INTO m_profil_code (province,zone,annee,true_profil_code) 
						VALUES (:province,:zoneNumber,:Annee,:trueProfilCode) ",
						[
							"province"			=>$provinceId,
							"zoneNumber"		=>$zoneId,
							"Annee"				=>$this->date->year,
							"trueProfilCode"	=>$trueProfilCode
					]);

					$profilCodeNumber =$this->lastId();

					/*****************************
					******************************
					*****************************/
					//INSERTING THE ARRETE MINISTERIEL IN DATABASE

					$insertArreteMin =$this->queryList("INSERT IGNORE INTO m_arrete_min (arrete) VALUES (:arrete_min)",
						["arrete_min"	=>$stageArreteMin]);

					$insertArreteMinNumber =$this->lastId();
					/*****************************
					******************************
					*****************************/
					//CREATING A NEW STAGE
					$createStage 	=$this->queryList("INSERT IGNORE INTO m_stages 

						(stage_name,province,zone,base64_stage_name,address,respo_name,
						respo_phone,profil_code,annee,arrete_min,creation_source) 
						VALUES (:stage_name,:province,:zone,:base64_stage_name,:address,
						:respo_name,:respo_phone,:profil_code,:annee,:arrete_min,
						:creation_source) ",
						[
							"stage_name"		=>$stageName,
							"province"			=>$provinceId,
							"zone"				=>$zoneId,
							"base64_stage_name"	=>base64_encode($stageName),
							"address" 			=>$stageAddress,
							"respo_name" 		=>$stageRespoName,
							"respo_phone" 		=>$stageRespoPhone,
							"profil_code" 		=>$profilCodeNumber,
							"annee" 			=>$this->date->year,
							"arrete_min" 		=>$insertArreteMinNumber,
							"creation_source" 	=>1//ITERNAL SOURCE
					]);

					$insertedStageId =$this->lastId();
					/*****************************
					******************************
					*****************************/
					//GENERATE UNIQUE ACCOUNT NUMBER BY CHECKING IN DATABASE
					do {

						$accountNumber =$this->GenerateAccountNumber($provinceId,$zoneId);

					} while ($this->cell_count("m_balance","account_num",
						$accountNumber) > 0);

					// echo $this->cell_count("m_balance","account_num",
					// 	$accountNumber);
					
					//CREATING AN ACCOUNT NUMBER OF THE CREATED STAGE AND INITIALIZING THE BALLANCE TO 0
					$initializeBalance 	=$this->queryList("INSERT IGNORE INTO m_balance (account_num,stage_id,devise,last_tran_in,last_tran_out) 
						VALUES (:account_num,:stage_id,:devise,:last_tran_in,
						:last_tran_out) ",
						[
							"account_num"	=>$accountNumber,
							"stage_id"		=>$insertedStageId,
							"devise"		=>1,//DOLLARS AMERICAINS
							"last_tran_in"	=>0,
							"last_tran_out" =>0
					]);

					$initializedBalanceId =$this->lastId();
					/*****************************
					******************************
					*****************************/
					// CREATTING THE FIRST TOKEN FOR THE FIRST TRANSACTION IN WICHT WILL BE INITIALIZE TO 0

					//generating a unique token for a transaction
					do {

						$transactionInToken =hash('sha256', $this->Defender->getToken(200));

					} while ($this->cell_count("m_trans_in_tokens","token",
						$transactionInToken) > 0);

					//keeping the transaction token in database
					$insertTransactionToken =$this->queryList("INSERT IGNORE INTO m_trans_in_tokens (token) VALUES (:token) ",
						["token"	=>$transactionInToken]);	

					$insertedTokenId =$this->lastId();

					//INITIALIZING THE FIRST TRANSACTION IN AMOUNT TO ZEREO
					$initializeTransIn =$this->queryList("INSERT IGNORE INTO m_trans_in_amount (amount,token_id) VALUES (:amount,:token_id) ",
						["amount"=>0,"token_id"=>$insertedTokenId]);
					
					$initializedTransInAmount =$this->lastId();

					//INITIALIZING THE FIRST TRANSACTION IN TO ZERO FOR THE CREATED STAGE

					$initializeTransIn 	=$this->queryList("INSERT IGNORE INTO m_trans_in (balance_id,trans_amount,trans_token,devise) 
						VALUES (:balance_id,:trans_amount,:trans_token,:devise) ",
						[
							"balance_id"		=>$initializedBalanceId,
							"trans_amount"		=>$initializedTransInAmount,
							"trans_token"		=>$insertedTokenId,
							"devise"			=>1,//DOLLARS AMERICAINS
					]);				
					/*****************************
					******************************
					*****************************/
					
					//CREATE AN ACTIVATION CODE AND INSERT IT IN DATABASE

					$insertActivationCode 	=$this->queryList("INSERT IGNORE INTO m_activation_code (code,phone_number,stage_id) 
						VALUES (:code,:phone_number,:stage_id) ",
						[
							"code"			=>$this->Defender->getRandomInteger(1000,10000),
							"phone_number"	=>$stageRespoPhone,
							"stage_id" 		=>$insertedStageId
					]);					
					/*****************************
					******************************
					*****************************/
					if ($query && $insertArreteMin && $createStage && $initializeBalance&& $insertTransactionToken && $initializeTransIn && $initializeTransIn && $insertActivationCode) {
						
						Router::Status200("message",["ProfilCode"=>$trueProfilCode,"stageId"=>$insertedStageId]);

					}else{

						$this->ErrorMessage(401,"Resquest failled try again");//NOT ACCEPTABLE

					}
				}

			}

    	}
       	
	}//END METHOD


	public function CreateClientFromInternal($dataPostRequire,$credentials)
	{	 
		/**
	     * @param stageId,stageProfilcode,stageProvinceId,stageZoneId, AND MORE
	    */

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

			endif;	
			/***********************************
			************************************
			***********************************/			
			if(!isset($dataPostRequire) || empty($dataPostRequire)):

				Router::ErrorMessage(401,"Some values were missing or were not defined");
			endif;
			/***********************************
			************************************
			***********************************/
			if(
				!isset($dataPostRequire->name) || empty($dataPostRequire->name)
				|| !isset($dataPostRequire->civilStatus) || empty($dataPostRequire->civilStatus)
				|| !isset($dataPostRequire->age) || empty($dataPostRequire->age)
				|| !isset($dataPostRequire->bloodGroup) || empty($dataPostRequire->bloodGroup)):

					Router::ErrorMessage(401,"Some values are empty");

			endif;
			/***********************************
			************************************
			***********************************/
			/*CHECKING IF ALL THE VALUES PASSED TO queryList FOR BEING STORED IN DATABASE WERE DEFINE TO AVOID SOME PHP PROBLEMES BY PASSING TO THE SECURITY STATIC METHOD THE DATAPOSTREQUIRE OBJECT TO BE CHECKED*/
			Security::CheckdataPostRequireToCreateNewClient($dataPostRequire);
			/***          ***             *** 
			***           ***             ***/
			//if the age is less than 1 years avoiding to have an age like 0	
			if(intval($dataPostRequire->age) <1):
				Router::ErrorMessage(401,"The age con not be a string or equal to 0");
			endif;
			/***********************************
			************************************
			***********************************/
			if(!(new AccountValidator)->ValidateProfilCodeAndStageId($PROFIL_CODE,$STAGE_ID)){

				Router::ErrorMessage(401,"Wrong credentials");

			}else{


				$getProvinceId 		=Model::queryList("SELECT province,zone,profil_code FROM m_stages WHERE id =:id",["id"=>$STAGE_ID]);
				$getProvinceIdRes 	=Model::AsCurrent($getProvinceId);

				if($getProvinceIdRes):

					if(isset($getProvinceIdRes->province) && !empty($getProvinceIdRes->province) && isset($getProvinceIdRes->zone) && !empty($getProvinceIdRes->zone) && isset($getProvinceIdRes->profil_code) && !empty($getProvinceIdRes->profil_code)):

						$stageProvinceId 	=$getProvinceIdRes->province;
						$stageZoneId 		=$getProvinceIdRes->zone;
						$stageProfilcodeId  =$getProvinceIdRes->profil_code;

					else:
						Router::ErrorMessage(401,"Wrong credentials");
					endif;

				else:
					Router::ErrorMessage(401,"Wrong credentials");
				endif;

				//creating a unique client_profil_code
				do {

					$clientProfilCode =$this->GenerateClientProfilCode($stageProvinceId,$stageZoneId,$STAGE_ID);

				} while ($this->cell_count("m_clients_profil_code","client_profil_code",
					$clientProfilCode) > 0);

				//creating a unique true_client_profil_code
				do {

					$clientTrueProfilCode =$this->GenerateClientTrueProfilCode($PROFIL_CODE);

				} while ($this->cell_count("m_clients_profil_code","client_true_profil_code",
					$clientTrueProfilCode) > 0);
				/********************************************************************
				*********************************************************************
				*********************************************************************/
				//CREATTING A PROFIL CODE AND TRUE PROFIL CODE FOR THE CURRENT CLIENT
				$insertIntoCleintProfilcode =$this->queryList("INSERT INTO m_clients_profil_code (stage_id,stage_profil_code,client_profil_code,client_true_profil_code) 
					VALUES(:stage_id,:stage_profil_code,:client_profil_code,:client_true_profil_code)",
					[
					"stage_id"					=>intval($STAGE_ID),
					"stage_profil_code"			=>$stageProfilcodeId,
					"client_profil_code"		=>$clientProfilCode,
					"client_true_profil_code"	=>$clientTrueProfilCode
				]);


				//if the profil code was inserted then continue else trow an error
				if($insertIntoCleintProfilcode){

					//geting the phone number sufix;
					$phoneNumberSufix 		=$this->phoneNumberValidator->GetPhoneNumberSufix($dataPostRequire->emergencyPhone);

					//client phone number sufix
					$clientPhoneNumberSufix=$this->phoneNumberValidator->GetPhoneNumberSufix($dataPostRequire->clientPhone);

					//geting the client phone number sufix to determine the network
					$isclientPhoneNumberValid =false;
					if ($this->phoneNumberValidator->GetPhoneNumberNetwork($clientPhoneNumberSufix) !=="Undefined network" 
						&& 
						$this->phoneNumberValidator->PhoneNumberFormater($dataPostRequire->clientPhone) !=="Invalid phone number") {

						$isclientPhoneNumberValid =true;

					}
					/******************************************************
					*******************************************************
					*******************************************************/
					$savePartenerPhone;
					if($this->phoneNumberValidator->GetPhoneNumberNetwork($phoneNumberSufix) !=="Undefined network" 
						&& 
						$this->phoneNumberValidator->PhoneNumberFormater($dataPostRequire->emergencyPhone) !=="Invalid phone number"){

						$savePartenerPhone =$this->queryList("INSERT INTO m_clients_emergency_phones 
							(client_profil_code,phone_number,network) 
							VALUES(:client_profil_code,:phone_number,:network)",
							[
								"client_profil_code"=>$clientProfilCode,
								"phone_number"		=>$this->phoneNumberValidator->PhoneNumberFormater($dataPostRequire->emergencyPhone),
								"network"			=>$this->phoneNumberValidator->GetPhoneNumberNetwork($phoneNumberSufix)
							]);

					}
					/***********************************
					************************************
					***********************************/					
					if(!$savePartenerPhone):
						Router::ErrorMessage(401,"An error happened");
					endif;	
					/***********************************
					************************************
					***********************************/					
					//saving identity data for the current client
					$insertNewClient =$this->queryList("INSERT INTO m_clients 
						(client_profil_code,client_true_profil_code,full_name,age,
						client_address,client_size,emergency_name,emergency_phone,
						partener_name,partener_occupation,client_occupation,client_phone,client_blood_group,client_Rh,electrophorese_HB,
						client_civil_status,stage_id,stage_profil_code)

						VALUES(:client_profil_code,:client_true_profil_code,:full_name,
						:age,:client_address,:client_size,:emergency_name,
						:emergency_phone,:partener_name,:partener_occupation,
						:client_occupation,:client_phone,:client_blood_group,:client_Rh,
						:electrophorese_HB,:client_civil_status,:stage_id,
						:stage_profil_code)",
						[
							"client_profil_code" 		=>$clientProfilCode,
							"client_true_profil_code" 	=>$clientTrueProfilCode,
							"full_name" 				=>$dataPostRequire->name,
							"age" 						=>intval($dataPostRequire->age),
							"client_address" 			=>$dataPostRequire->clientAddress,
							"client_size" 				=>$dataPostRequire->size,
							"emergency_name" 			=>$dataPostRequire->emergencyName,
							"emergency_phone" 			=>$clientProfilCode,
							"partener_name" 			=>$dataPostRequire->partenerName,
							"partener_occupation" 		=>$dataPostRequire->partenerOccupation,
							"client_occupation" 		=>$dataPostRequire->clientOccupation,
							"client_phone" 				=>$isclientPhoneNumberValid ==true ? $dataPostRequire->clientPhone : "",
							"client_blood_group" 		=>$dataPostRequire->bloodGroup,
							"client_Rh" 				=>$dataPostRequire->RH,
							"electrophorese_HB" 		=>$dataPostRequire->electrophaseHB,
							"client_civil_status" 		=>$dataPostRequire->civilStatus,
							"stage_id" 					=>intval($STAGE_ID),
							"stage_profil_code" 		=>$stageProfilcodeId
					]);
					/***********************************
					************************************
					***********************************/
					if(!$insertNewClient):
						Router::ErrorMessage(401,"An error happened");
					endif;	
					/***********************************
					************************************
					***********************************/
					//SAVING CLIENT ANTECEDENTS
					//formating the next apointment date

					$nextApointment =$this->date->FormatNextApointement($dataPostRequire->DDR);

					$insertAntecedents =$this->queryList("INSERT INTO m_clients_antecedents (client_profil_code,
						client_true_profil_code,DDR,DPA,M_TBC,M_HTA,M_CSA_SS,M_DBT,M_CAR,M_MFG,M_RAA,M_SYPHYLIS,M_VIH_SIDA,M_VVS,M_PEP,m_primipare,
						GC_CESARIENNE,GC_CERCLAGE,GC_FUBROME_UTERIEN,GC_FRACTURE_BASSIN,GC_GEU,GC_FISTULE,GC_UTERUS_CICATRICIEL,
						GC_TRAITEMENT_POUR_STERILITE,O_PARITE,O_GESTILITE,
						O_ENFANT_EN_VIE,O_AVORTEMENT,O_DYSTOCIE,O_EUTOCIE,
						O_PLUS_GROS_POIDS_NAISSANCE,O_PLUS_DE_4_KGS,O_PREMATURE,
						O_POST_MATURE,O_MORT_NE,O_MORT_AVANT_7_JOURS,
						O_DERNIER_ACCOUCHEMENT_DATE,O_INTERVAL_MOIN_2_ANS,
						O_COMPLICATION_POST_PARUM,O_POST_PARUM_DETAILS) 

						VALUES(:client_profil_code,
						:client_true_profil_code,:DDR,:DPA,:M_TBC,:M_HTA,:M_CSA_SS,
						:M_DBT,:M_CAR,:M_MFG,:M_RAA,:M_SYPHYLIS,:M_VIH_SIDA,:M_VVS,
						:M_PEP,:m_primipare,:GC_CESARIENNE,:GC_CERCLAGE,
						:GC_FUBROME_UTERIEN,:GC_FRACTURE_BASSIN,:GC_GEU,:GC_FISTULE,
						:GC_UTERUS_CICATRICIEL,
						:GC_TRAITEMENT_POUR_STERILITE,:O_PARITE,:O_GESTILITE,
						:O_ENFANT_EN_VIE,:O_AVORTEMENT,:O_DYSTOCIE,:O_EUTOCIE,
						:O_PLUS_GROS_POIDS_NAISSANCE,:O_PLUS_DE_4_KGS,:O_PREMATURE,
						:O_POST_MATURE,:O_MORT_NE,:O_MORT_AVANT_7_JOURS,
						:O_DERNIER_ACCOUCHEMENT_DATE,:O_INTERVAL_MOIN_2_ANS,
						:O_COMPLICATION_POST_PARUM,:O_POST_PARUM_DETAILS)",
						[

							"client_profil_code"			=>$clientProfilCode,
							"client_true_profil_code"		=>$clientTrueProfilCode,
							"DDR"							=>$nextApointment,
							"DPA"							=>$dataPostRequire->DPA,
							"M_TBC"							=>$dataPostRequire->TBC,
							"M_HTA"							=>$dataPostRequire->HTA,
							"M_CSA_SS"						=>$dataPostRequire->SCA_SS,
							"M_DBT"							=>$dataPostRequire->DBT,
							"M_CAR" 						=>$dataPostRequire->CAR,
							"M_MFG"							=>$dataPostRequire->MFG,
							"M_RAA"							=>$dataPostRequire->RAA,
							"M_SYPHYLIS"					=>$dataPostRequire->Syphylis,
							"M_VIH_SIDA"					=>$dataPostRequire->VIH_SIDA,
							"M_VVS"							=>$dataPostRequire->VVS,
							"M_PEP"							=>$dataPostRequire->PEP,
							"m_primipare"					=>$dataPostRequire->primipare,
							"GC_CESARIENNE"					=>$dataPostRequire->Cesarienne,
							"GC_CERCLAGE"					=>$dataPostRequire->Cerclage,
							"GC_FUBROME_UTERIEN"			=>$dataPostRequire->FubromeUterien,
							"GC_FRACTURE_BASSIN"			=>$dataPostRequire->FractureBassin,
							"GC_GEU"						=>$dataPostRequire->GEU,
							"GC_FISTULE"					=>$dataPostRequire->Fistule,
							"GC_UTERUS_CICATRICIEL"			=>$dataPostRequire->UterusCicatriciel,
							"GC_TRAITEMENT_POUR_STERILITE"	=>$dataPostRequire->TraitementSterilite,
							"O_PARITE"						=>$dataPostRequire->Paritee,
							"O_GESTILITE"					=>$dataPostRequire->Gestile,
							"O_ENFANT_EN_VIE"				=>$dataPostRequire->EnfantEnvie,
							"O_AVORTEMENT"					=>$dataPostRequire->Avortement,
							"O_DYSTOCIE"					=>$dataPostRequire->Distocie,
							"O_EUTOCIE"						=>$dataPostRequire->Eutocie,
							"O_PLUS_GROS_POIDS_NAISSANCE"	=>$dataPostRequire->GrosPoidNaissance,
							"O_PLUS_DE_4_KGS"				=>$dataPostRequire->PlusDe4kg,
							"O_PREMATURE"					=>$dataPostRequire->Premature,
							"O_POST_MATURE"					=>$dataPostRequire->Premature,
							"O_MORT_NE"						=>$dataPostRequire->MortNe,
							"O_MORT_AVANT_7_JOURS"			=>$dataPostRequire->MortAvant7Jrs,
							"O_DERNIER_ACCOUCHEMENT_DATE"	=>$dataPostRequire->DernierAcouchementDate,
							"O_INTERVAL_MOIN_2_ANS"			=>$dataPostRequire->IntervalMoin2ans,
							"O_COMPLICATION_POST_PARUM"		=>$dataPostRequire->complicationPostParumOui,
							"O_POST_PARUM_DETAILS"			=>$dataPostRequire->ComplicationPostParumDesc 
						]);
					/***********************************
					************************************
					***********************************/
					if(!$insertAntecedents):
						Router::ErrorMessage(401,"An error happened");
					endif;	
					/***********************************
					************************************
					***********************************/
					//saving the client phone number also in a different table
					if($this->phoneNumberValidator->GetPhoneNumberNetwork($clientPhoneNumberSufix) !=="Undefined network" 
						&& 
						$this->phoneNumberValidator->PhoneNumberFormater(
							$dataPostRequire->clientPhone) !=="Invalid phone number"){

						$saveclientPhoneNumberForFeature =$this->queryList("INSERT INTO m_clients_phones
						 (stage_id,client_profil_code,phone_number,network) 
						 VALUES (:stage_id,:client_profil_code,:phone_number,:network)",
						 [
						 	"stage_id"			=>intval($STAGE_ID),
						 	"client_profil_code"=>$clientProfilCode,
						 	"phone_number"		=>$dataPostRequire->clientPhone,
						 	"network"			=>$this->phoneNumberValidator->GetPhoneNumberNetwork($clientPhoneNumberSufix)
						 ]);

					}

					//RETURN THE RESPONSE WITH THE client_true_profil_code LAST PART NUMBER

					//SCHEDULING THE SMS 
					$this->Response->ScheduleSmSFromStageToClient(
						$dataPostRequire->clientPhone,intval($STAGE_ID),
						$clientProfilCode,$nextApointment);
					//SENDING AN SMS TO CONFIRM THAT THE CLIENT NUMBER IS ALIVE
					/***		***		***		***
					***			***		***		***
					***			***		***		***
					***			***		***		***
					***			***		***		***/
					$clientProfilCodeExploded =explode("-", $clientTrueProfilCode)[3];
					Router::Status200(
						"message",["clientProfilCode"=>$clientProfilCodeExploded,"nextApointment"=>$nextApointment]);
				}else{

					//THE QUERY DID NOT PASS
					Router::ErrorMessage(401,"error");
				}

			}

		}else{

			Router::ErrorMessage(401,"error");

		}

	}//END METHOD

	public function LogStage($dataPostRequire,$credentials)
	{

		$data =$dataPostRequire;

		if(!isset($data->phoneNumber) || empty($data->phoneNumber)):

			$this->ErrorMessage(401,"some values are missing");//NOT ACCEPTABLE

		else:

			$phoneNumber =$dataPostRequire->phoneNumber;
			///geting the phone number sufix;
			$phoneNumberSufix 		=$this->phoneNumberValidator->GetPhoneNumberSufix(
				$phoneNumber);

			//geting the phone number sufix to determine the network
			$isclientPhoneNumberValid =false;
			if ($this->phoneNumberValidator->GetPhoneNumberNetwork($phoneNumberSufix) 
				!=="Undefined network" 
				&& 
				$this->phoneNumberValidator->PhoneNumberFormater(
					$phoneNumber) !=="Invalid phone number") {

				$isclientPhoneNumberValid =true;

			}
 
			if($isclientPhoneNumberValid !==true):

				$this->ErrorMessage(401,"Invalid phone number");//NOT ACCEPTABLE

			endif;

			$query =$this->queryList("SELECT id FROM m_stages 
				WHERE respo_phone =:respoPhone AND active=:active",
				[
					"respoPhone"=>$phoneNumber,
					"active" 	=>1
				]);

			$queryRes =$this->AsCurrent($query);

			if($queryRes){

				if($queryRes->id){

					//GENRATING THE CONFIRMATION CODE TO BE SENT TO THE STAGE PHONE NUMBER
					//creating a unique code
					do {

						$confirmationCode =$this->Defender->getRandomInteger(1000,10000);

					} while ($this->cell_count("m_login_confirmation_code","code",
						$confirmationCode) > 0);
					/********************************************
					*********************************************
					*********************************************/
					
					$insertCode =$this->queryList("INSERT INTO m_login_confirmation_code (phone_number,code,validity) 
						VALUES (:phoneNumber,:code,DATE_ADD(NOW(), INTERVAL 1 DAY))",
						[
							"phoneNumber"=>$phoneNumber,
							"code" 		=>$confirmationCode,
						]);

					$prefixMessage ="Votre code de confirmation est : ";
					if($insertCode){

						$this->Response->SimpleSms($phoneNumber,
							$prefixMessage.$confirmationCode);

						//Router::Status200();

					}

				}else{

					$this->ErrorMessage(401,"Phone number not found");//NOT ACCEPTABLE

				}

			}else{

				$this->ErrorMessage(401,"Phone number not found");//NOT ACCEPTABLE

			}

		endif;		
	}//END METHOD

	public function SearchClient($dataPostRequire,$credentials)
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

			endif;	
			/***********************************
			************************************
			***********************************/			
			if(!isset($dataPostRequire) || empty($dataPostRequire)):

				Router::ErrorMessage(401,"Some values were missing or were not defined");
			endif;
			//since the client is composed by the stage_true_profil_code with a dash and a small part of int 
			//that is why to get the client_true_profil_code we combine the stage_true_profil_code with a dash and the typed number which is in dapastRequire->profilCode
			/*
			*
			*
			*/
			$ProfilCode =$PROFIL_CODE."-".$dataPostRequire->profilCode; 
			/*
			*
			*
			*/
			$query =$this->queryList("SELECT client_profil_code,stage_profil_code 
				FROM m_clients_profil_code 
				WHERE client_true_profil_code =:ProfilCode AND stage_id =:stageId",
				[
					"ProfilCode"=>$ProfilCode,
					"stageId" 	=>intval($STAGE_ID)
				]);

			$queryRes =$this->AsCurrent($query);

			if($queryRes){

				if(isset($queryRes->client_profil_code) 
					&& !empty($queryRes->client_profil_code) 
					&& isset($queryRes->stage_profil_code) 
					&& !empty($queryRes->stage_profil_code)){

					$clientProfilCode =$queryRes->client_profil_code;
					//FETCH CLIENT FROM m_clients TABLE
					$findClient =$this->queryList("SELECT 
						full_name,age,client_address,client_size,emergency_name,
						emergency_phone,partener_name,
						partener_occupation,client_occupation,client_phone,
						client_blood_group,client_RH,electrophorese_HB,
						client_civil_status,created_at AS creation_date 
						FROM m_clients
						WHERE client_profil_code =:client_profil_code 
						AND client_true_profil_code =:client_true_profil_code",
						[
							"client_profil_code"		=>$clientProfilCode,
							"client_true_profil_code" 	=>$ProfilCode

						]);

					$findClientRes =$this->AsCurrent($findClient);


					if(!$findClientRes):
						
						Router::Status200("message",["clientFound"=>0]);
						die();

					endif;
					/*********			***********					*******
					**********			***********					*******
					**********			***********					*******/
					//check if the client has an emergency phone number if yes we fetch
					$getClientEmergencyPhone =$this->queryList("SELECT phone_number
						FROM m_clients_emergency_phones 
						WHERE client_profil_code =:client_profil_code",
						["client_profil_code"=>$clientProfilCode]);

					$getClientEmergencyPhoneRes =$this->AsCurrent($getClientEmergencyPhone);

					/*
					*
					*/

					$clientEmergencyPhone ="";
					$clientNextApointment ="";

					/*
					*
					*/

					//asign the client_emergency_phone number to a variable
					if($getClientEmergencyPhoneRes){
						if(isset($getClientEmergencyPhoneRes) && !empty($getClientEmergencyPhoneRes)){

							$clientEmergencyPhone =$getClientEmergencyPhoneRes->phone_number;

						}
					}
					/*********			***********					*******
					**********			***********					*******
					**********			***********					*******/
					//getting the client next apointment
					$getClientNextApointment =$this->queryList("SELECT schedule_time FROM m_stage_sms_schedule 
						WHERE stage_id =:stageId 
						AND client_profil_code =:client_profil_code",
						[
							"stageId"				=>intval($STAGE_ID),
							"client_profil_code" 	=>$clientProfilCode
						]);
					$getClientNextApointmentRes =$this->AsCurrent($getClientNextApointment);

					//if the client next apointment was found we asign it to a variable
					if($getClientNextApointmentRes){
						if($getClientNextApointmentRes->schedule_time){

							$clientNextApointment =$getClientNextApointmentRes->schedule_time;

						}
					}
					/*********			***********					*******
					**********			***********					*******
					**********			***********					*******/
					/*
					*
					*
					*
					*/
					$responseAntecedent =[];
					/*
					*
					*
					*
					*/
					//fetch the client antecedts
					$getClientAntecedents =$this->queryList("SELECT * FROM m_clients_antecedents 
						WHERE client_profil_code =:clientProfilCode AND client_true_profil_code =:clientTrueProfilCode",
						[
							"clientProfilCode"		=>$clientProfilCode,
							"clientTrueProfilCode"	=>$ProfilCode
						]);

					$getClientAntecedentsRes =$this->AsCurrent($getClientAntecedents);

					if(!empty($getClientAntecedentsRes)){

						foreach ($getClientAntecedentsRes as $key => $value) {

							if($key !=="client_profil_code" && $key !=="client_true_profil_code"):

								$responseAntecedent[$key] =$value;

							endif;	

						}
						
					}

					$responseData 					=[];//this array will contain data
					/*
					*
					*
					*/
					$responseData ["clientFound"] 	=1;//telling the api that there is a client found

					/*
					*
					*
					*/


					//dinamicaly appending results data to the array

					if(!empty($findClientRes)){

						foreach ($findClientRes as $key => $value) {

							//if the key is equal to emergency_phone we assing the clientEmergencyPhone as value
							if($key =="emergency_phone"):
								
								$value =$clientEmergencyPhone;

							endif;
							//then we append data to the array
							$responseData[$key] =$value;

						}

					}
					//we append the fetched next apointment date to the array
					$responseData["nextApointment"] =$clientNextApointment;
					$responseData["antecedents"] 	=$responseAntecedent;

					//return the rusults
					Router::Status200("message",$responseData);


				}else{

					Router::Status200("message",["clientFound"=>0]);

				}

			}else{

				Router::Status200("message",["clientFound"=>0]);


			}

		}else{

			Router::ErrorMessage(401,"error");

		}

	}//END METHOD

}//END CLASS