<?php
namespace ClientHttp\matibabu;
require "vendor/autoload.php";
use Router\Router;
class ClientHttp
{
	
	public 		$Public_key;
	private 	$EnvVars;
	private     $Dater;
	public 		$dataPost;


	function __construct()
	{
		$this->EnvVars 		=(new \LoadEnv);
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

        		echo "string";

        	}else{

        		Router::notAcceptable();
        	}

        }else{

        	Router::notAcceptable();
        }
	}

}