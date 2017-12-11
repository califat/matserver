<?php 

abstract class Src
{
	public 	$Public_key;
	public 	$EnvVars;
	public 	$Secure;
	public 	$Source;
	public  $Dater;
	public 	$dataPost;

	public 	$Action;
	public 	$Method;
	public 	$Key;
	public 	$Account_sid;
	public 	$Account_token;
	public 	$Csrf_token;
	public 	$Bill;
	public 	$Elapse;
	public 	$source;
	public 	$compositeArr 	=[];
	public  $InternalSource ="internal";
	public  $ExternalSource ="external";

	public $CreateStage 	="create_stage";
}