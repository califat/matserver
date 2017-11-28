<?php
/**
* CONTROLLEUR PRINCIPALE
*/
namespace controller;
if(!file_exists("vendor/autoload.php"))die();
require "vendor/autoload.php";

use Find_session\Find_session;
use Router\Router;
use Model\Model;
use PDO;

class Controller extends Model
{

	protected 	$route_array;
	private 	$url;
	protected 	$route;
	protected	$route_action;
	protected 	$route_revome_dot;
	private 	$parent;

	public function __construct()
	{


		$this->parent =new parent;

		if(isset($_GET["url"]) && !empty($_GET["url"])){

		 	$this->url 					=$_GET["url"];
		}

		$this->route_array 				=explode("/", $this->url);
	
		$this->route_revome_dot 		=explode(".", $this->route_array[0]);

		$this->route 					=$this->route_revome_dot[0];

		(new Router($this->route));
		
	}

	protected static function ReturnUrl(){

		return !empty($_GET["url"]) ? $_GET["url"] : false;

	}

}
