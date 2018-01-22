<?php
namespace Router;
if(!file_exists("vendor/autoload.php"))die();
require "vendor/autoload.php";

use controller\controller;
use Handler\Handler;
use ClientHttp\matibabu\ClientHttp;

class Router extends Controller
{
	public 	$route;
	const 	VIEWS_DIR 		="views/";

	private $url;
	private $Handler400 	="Handler400";
	private $Handler401 	="Handler401";
	private $Handler402 	="Handler402";
	private $Handler403 	="Handler403";
	private $Handler404 	="Handler404";
	private $Handler405 	="Handler405";

	private $Handler500 	="Handler500";
	private $Handler501 	="Handler501";
	private $Handler502 	="Handler502";
	private $Handler503 	="Handler503";
	private $Handler504 	="Handler504";
	private $Handler505 	="Handler505";
	const 	DOCUMENTROOT  	="/viotube";
	
	var $rou =1;
	public function __construct($route)
	{

		if(method_exists(get_class($this),strtolower($route)) && strtolower($route) !=="" ){

			$this->route =$route;

			return static::$route();


		}elseif(strtolower($route) ===""){

			$this->ApiIndex();

		}else{

			(new Handler($this->Handler404));

		}

	}

	public static function isAjax(){

	return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
			&& 
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])
			 == 
			'xmlhttprequest';

	}

	public  static function status200($messageName="",$message="")
	{
		$date 	=new \Dater;
		$now 	=$date->now();
		//header("Content-Type :application/json");

		if(!empty($messageName) && !empty(($message))):

	 		echo json_encode([
		 						"response"=>[
		 							$messageName=>$message,
		 							"status"=>200,
		 							"code"=>"ok",
		 							"time"=>$now
		 						]
	 						]);
	 	
	 	else:
	 		echo json_encode([
	 							"response"=>[
	 								"status"=>200,
	 								"code"=>"ok",
	 								"time"=>$now
	 							]
	 						]);
	 	endif;	
	}

	public static function ErrorMessage($status=401,$errorMessage="")
	{

		if(trim($errorMessage) !==""){

			echo json_encode($errorMessage);
	 		http_response_code($status);
	 		die();
		}else{

			echo json_encode("Something went wrong");
	 		http_response_code($status);
	 		die();
		}

	}
	public static function ajaxRequiredError(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(400);
	 	die();
	} 

	public static function unAuthorized(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(401);
	 	die();
	} 

	public static function payementRequired(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(402);
	 	die();
	}

	public static function forbiden(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(403);
	 	die();
	}

	public static function methodNotAllowed(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(405);
	 	die();
	}

	public static function notAcceptable(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(406);
	 	die();
	}

	public static function networkError(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(407);
	 	die();
	}

	public static function requestTimeout(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(408);
	 	die();
	}
	public static function confilct(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(409);
	 	die();
	}
 	public static function internalServerError(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(500);
	 	die();
	}

	public static function notImplemented(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(501);
	 	die();
	}

	public static function badGateway(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(502);
	 	die();
	}

	public static function serviceUnavailable(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(503);
	 	die();
	}

	public static function gatewayTimeout(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(504);
	 	die();
	}

	public static function httpVersionNotSupported(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(505);
	 	die();
	}

	public static function variantAlsoNegotiate(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(506);
	 	die();
	}

	public static function unsuficientStorage(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(507);
	 	die();
	}

	public static function loopDetected(){

		//header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(508);
	 	die();
	}


	#TAKES AN URL THEN SEARCH SOME ROUTE ACTION AND REPLACE THEM BY NEW ROUTE ACTIONS
	public static function MakeReplace($needlesAndReplacements=[],$route)
	{
		$patterns 			= [];
		$replacements 		= [];

		foreach ($needlesAndReplacements as $needlde => $replacement) {

			$patterns[] 		="/".$needlde."/";
			$replacements[] 	=$replacement; 
		}
		return preg_replace($patterns, $replacements,$route);
		
	}#END METHOD

	final public function moreTesting() {

       /*pass;*/
   	}

   	private static function RouteNameHandler404(){
		
		try {

			(new Handler("Handler404"));
			
		} catch (Exception $e) {
			
		}
	}
	/*INCLUDE A FILE TO PROCESS DATA IN AJAX (NOT A VIEW) */

	public static function webnode(){

		static::IncludeView("webnode_ajaxAutoLoader");
	}

   	public static function DocummentRoot(){

   		return self::MakeRoute(self::DOCUMENTROOT);

   	}

	#MAKES REDIRECTION TO ANY SPECIFIED VIEW PAASSED IN PARAMETER
	public static function MakeRoute($route){

		header('location:' .$route);
        exit();
	}

	#REQUIRE A GIVEN FILE FROM VIEWS DIRECTORY
	private static function Import($view){

		return require self::VIEWS_DIR.$view .".php";

	}

	#INCLUDE A GIVENT VIEW
	public static function IncludeView($path){

		return require $path.".php";

	}

	#ONLY USED FOR INDEX PAGE AND HOME PAGE
	public static function MakeView(){
		
	}

	public static function run(){

		(new ClientHttp);
	}

	public static function activate(){

		require "src/ActivateStage.php";
	}

	public static function client(){

		(new ClientHttp);
	}

	public static function login(){

		(new ClientHttp);
	}

	public static function confirm()
	{
		require "src/confirmLogin.php";
	}

	public static function disconnectDevice()
	{
		(new ClientHttp);
	}	

	public static function searchClient()
	{
		(new ClientHttp);
	}	

	public function ApiIndex()
	{
		echo "vs ete a la page index de l'API";
	}

}#END CLASS
 ##########  ######       ### ############     ##########  ###		     ####	   ########
###########	 ### ###      ### #############   ############ ###		    ######	  #########
###			 ###  ###     ### ###        ###  ###          ###		   ###  ###	  ###
###			 ###   ###    ### ###	     ###  ###          ###		  ###    ###  #########	
###########  ###    ###   ### ###        ###  ###          ###		  ##########  #########	
###########  ###     ###  ### ###        ###  ###          ###		  ##########	    ###   
###			 ###      ### ### ###        ###  ###          ###		  ###    ###	    ###
###########  ###		##### #############   ############ #########  ###    ###   ########
 ##########  ###		 #### ############     ##########  #########  ###    ###   ####### 

interface RouteNameHandler404
{
    public function RouteNameHandler404();
}#END INTERFACE

