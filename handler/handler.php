<?php
/**
* 
*/
namespace Handler;


class Handler
{
	
	protected $serverError;

	public function __construct($serverError)
	{
		$this->serverError =$serverError;

		return static::$serverError();
	}

	private static function Import($handlerEror){

		return require $handlerEror .".php";

	}
	public static function Handler400(){

		echo "Error 400";
	}

	public static function Handler401(){

		echo "Error 401";
	}

	public static function Handler402(){

		echo "Error 402";
	}

	public static function Handler403(){

		echo "Error 400";
	}

	public static function Handler404(){

		static::Import("handler404");
	}

	public static function Handler405(){

		echo "Error 405";
	}

	public static function Handler500(){

		echo "Error 500";
	}

	public static function Handler501(){

		echo "Error 501";
	}

	public static function Handler502(){

		echo "Error 502";
	}

	public static function Handler503(){

		echo "Error 503";
	}

	public static function Handler504(){

		echo "Error 504";
	}

	public static function Handler505(){

		echo "Error 505";
	}

}