<?php
namespace AppKernel\matibabu;
require "vendor/autoload.php";
use Model\Model;

class AppKernel extends Model
{
	
	function __construct(){}

	public function CreateStageFromInternal()
	{
		echo "creating a new stage from internal source";
	}
}