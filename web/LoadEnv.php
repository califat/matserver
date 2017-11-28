<?php
class LoadEnv
{

	public $SECRET_KEY;

	function __construct()
	{
		$this->SECRET_KEY =$_ENV["SECRET_KEY"];
	}
}