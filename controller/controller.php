<?php
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

		 	$this->url 					=mb_strtolower($_GET["url"]);
		}

		$this->route_array 				=explode("/", $this->url);
	
		$this->route_revome_dot 		=explode(".", $this->route_array[0]);

		$this->route 					=$this->route_revome_dot[0];

		$this->ExceptionalRoute($this->url);
		(new Router($this->route));
		
	}

	protected static function ReturnUrl(){

		return !empty($_GET["url"]) ? $_GET["url"] : false;

	}

	#PROCESS EXPTIONAL URL (MAY CONTAIN DASH OR OTHER CHARACTER)
	private function ExceptionalRoute($route){


		switch ($route) {

			case "api/run":

				$this->route ="run";
				break;

			case "api/activate":

				$this->route ="activate";
				break;

			case "api/client":

				$this->route ="client";
				break;

			case "api/login":

				$this->route ="login";
				break;

			case "api/confirm":

				$this->route ="confirm";
				break;

			case "api/disconnect":

				$this->route ="disconnectDevice";
				break;

			case "api/search/client":

				$this->route ="searchClient";
				break;

			default:
				# code...
				break;
		}

	}#END METHOD

}
