<?php
/**
* 
MAIN ROUTER
*/
namespace Router;
if(!file_exists("vendor/autoload.php"))die();
require "vendor/autoload.php";

use controller\controller;
use Find_session\Find_session;
use Template\Template;
use Handler\Handler;
use UserProfil\FindUserByUrl;

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
	const 	PAGELET_FOLDER	="pagelet/";
	const 	DOCUMENTROOT  	="/viotube";
	const 	INDEX_VIEW 		="index.view.php";
	const 	EMPTY_ROOT 		="viotube";
	
	var $rou =1;
	public function __construct($route)
	{

		if(method_exists(get_class($this),strtolower($route))){

			$this->route =$route;

			return static::$route();

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
		header("Content-Type :application/json");

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
	public static function ajaxRequiredError(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(400);
	 	die();
	} 

	public static function unAuthorized(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(401);
	 	die();
	} 

	public static function payementRequired(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(402);
	 	die();
	}

	public static function forbiden(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(403);
	 	die();
	}

	public static function methodNotAllowed(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(405);
	 	die();
	}

	public static function notAcceptable(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(406);
	 	die();
	}

	public static function networkError(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(407);
	 	die();
	}

	public static function requestTimeout(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(408);
	 	die();
	}
	public static function confilct(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(409);
	 	die();
	}
 	public static function internalServerError(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(500);
	 	die();
	}

	public static function notImplemented(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(501);
	 	die();
	}

	public static function badGateway(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(502);
	 	die();
	}

	public static function serviceUnavailable(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(503);
	 	die();
	}

	public static function gatewayTimeout(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(504);
	 	die();
	}

	public static function httpVersionNotSupported(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(505);
	 	die();
	}

	public static function variantAlsoNegotiate(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(506);
	 	die();
	}

	public static function unsuficientStorage(){

		header("Content-Type :application/json");
	 	echo json_encode("error");
	 	http_response_code(507);
	 	die();
	}

	public static function loopDetected(){

		header("Content-Type :application/json");
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

       pass;
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

	/*INCLUDE TYPEAHEAD FILE IN AJAX (NOT A VIEW) */
	public static function typeahead(){

		static::IncludeView("typeahead");
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

		if(!isset($_GET["url"]) || empty($_GET["url"]) || trim($_GET["url"]) ==""):

			static::Import("index.view");
		endif;
		// if(!Find_session::UserId() && !parent::ReturnUrl())static::Import("index.view");
		//if(!Find_session::UserId() && !parent::ReturnUrl())static::Import("home.view");
		
	}


	/*RETURN THE HOMME VIEW */
	public static function home(){

		self::DocummentRoot();
	}


	#RETURN THE INDEX VIEW

	public static function index(){

		self::DocummentRoot();
	}

	// public static function sinup(){

	// 	return require(static::VIEWS_DIR."connect_or_register.view.php");
	// }

	public static function login(){

		return require(static::VIEWS_DIR."login.view.php");
	}

	# RETURN THE LOGIN VIEW
	public static function connect(){

		return require(static::VIEWS_DIR."connect_or_register.view.php");
	}

	# RETURN THE UPLOAD FILE IN AJAX
	public static function upload(){

		return require(static::VIEWS_DIR."uploader.view.php");
	}

	# RETURN THE UPLOAD PROCESS FILE IN AJAX
	public static function uploadPost(){

		return require(static::VIEWS_DIR."uploader.view.php");
	}

	public static function uploadTerm(){
		
		return require(static::VIEWS_DIR."uploadTerm.view.php");
	}


	public static function activation(){

		return require(static::VIEWS_DIR."activate_viotuber_account.view.php");
	}

	public function films()
	{
		return require(static::VIEWS_DIR."films.view.php");
	}

	public function emissions()
	{
		return require(static::VIEWS_DIR."emissions.view.php");
	}

	public function music()
	{
		return require(static::VIEWS_DIR."music.view.php");
	}

	public function action_adventure()
	{
		return require(static::VIEWS_DIR."action_adventure.view.php");
	}

	public function animation()
	{
		return require(static::VIEWS_DIR."animation.view.php");
	}
	public function comedie()
	{
		return require(static::VIEWS_DIR."comedie.view.php");
	}

	public function documentaire()
	{
		return require(static::VIEWS_DIR."documentaire.view.php");
	}

	public function sport()
	{
		return require(static::VIEWS_DIR."sport.view.php");
	}
	public function help()
	{
		return require(static::VIEWS_DIR."help.view.php");
	}
	public function products()
	{
		return require(static::VIEWS_DIR."help.view.php");
	}

	public function langues()
	{
		return require(static::VIEWS_DIR."langues.view.php");
	}

	public function develloper()
	{
		return require(static::VIEWS_DIR."develloper.view.php");
	}

	public function about()
	{
		return require(static::VIEWS_DIR."about.view.php");
	}
	public function business()
	{
		return require(static::VIEWS_DIR."business.view.php");
	}
	public function ads()
	{
		return require(static::VIEWS_DIR."ads.view.php");
	}

	public function how_ads_works()
	{
		return require(static::VIEWS_DIR."how_ads_work.view.php");
	}

	public function businessIntro()
	{
		return require(static::VIEWS_DIR."businessIntro.view.php");
	}
	public function company()
	{
		return require(static::VIEWS_DIR."company.view.php");
	}

	public function verifier()
	{
		return require(static::VIEWS_DIR."verifier.view.php");
	}

	public function careers()
	{
		return require(static::VIEWS_DIR."careers.view.php");
	}
	
	
	public function player()
	{

		return require(static::VIEWS_DIR."video_player_powered_by_viotube.view.php");
		
	}

	public function trends(){

		return require(static::VIEWS_DIR."trends.view.php");

	}

	public function publicApi(){

		return require(static::VIEWS_DIR."publicApi.view.php");

	}

	public function join_develloper_team(){

		return require(static::VIEWS_DIR."join_develloper_team.view.php");		

	}
	public function develloper_customer_service(){

		return require(static::VIEWS_DIR."verifier.view.php");		

	}

	public function serviceApp(){

		return require(static::VIEWS_DIR."serviceApp.view.php");

	}

	public function mission(){

		return require(static::VIEWS_DIR."mission.view.php");

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

