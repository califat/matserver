<?php
class LoadEnv
{

	public $SECRET_KEY;
	public $PUBLIC_KEY;

	function __construct()
	{
		$this->SECRET_KEY =$_ENV["SECRET_KEY"];
		$this->PUBLIC_KEY =$_ENV["PUBLIC_KEY"];
	}
}