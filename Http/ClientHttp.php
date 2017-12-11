<?php
namespace ClientHttp\matibabu;
require "vendor/autoload.php";
use Router\Router;
use ClientSource\matibabu\ClientSource;
use Security\matibabu\Security;
if(!Router::isAjax()){ Router::unAuthorized();die();}

class ClientHttp extends \Src
{
	

	function __construct()
	{
		$this->EnvVars 		=(new \LoadEnv);
		$this->Secure 		=(new Security);
		$this->Source 		=(new ClientSource);
		$this->Dater 		=new \Dater;
		$this->Public_key 	=$this->EnvVars->PUBLIC_KEY;
		$data 				=file_get_contents('./tasks.json', FILE_USE_INCLUDE_PATH);

		$json = json_decode($data, true);
		
        // foreach ($json as $key => $value) {

        //     if (!is_array($value)) {
        //         echo $key . '=>' . $value . '<br/>';
        //     } 
        //     else {

        //         foreach ($value as $key => $val) {
        //             echo $key. '<br/>';
        //             var_dump( $val);
        //         }
        //     }
        // }
        //echo $this->Dater->getDays(11);//  SHOW HOW MANY DAY NOVEMEMBER HAS

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
        			&& isset($this->dataPost->ELAPSE) && !empty($this->dataPost->ELAPSE)){

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

        			$shortened 				=$this->Secure->shoten(str_replace($replaceArr, "", $this->Secure->base64_to_utf8($this->Csrf_token)));

        			if($shortened !==trim($composite)){

        				Router::forbiden();

        			}else{

	        			if($this->Source->DetermineSourceFromStr($this->Key,$this->Account_sid,$this->Account_token)){

	        				$this->source =$this->InternalSource;

	        				$this->Source->Decide($this->source,$this->Action);

	        			}else{

	        				$this->source =$this->ExternalSource;

	        			}

        			}

        		}else{

        			Router::unAuthorized();
        		}

        	}else{

        		Router::notAcceptable();
        	}

        }else{

        	Router::notAcceptable();
        }
	}

	private function Tasking($method,$action)
	{
		
	}

}