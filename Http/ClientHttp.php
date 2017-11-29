<?php
namespace ClientHttp\matibabu;
require "vendor/autoload.php";
/**
* 
*/

class ClientHttp
{
	
	public 		$Public_key;
	private 	$EnvVars;


	function __construct()
	{
		$this->EnvVars 		=(new \LoadEnv);
		$this->Public_key 	=$this->EnvVars->PUBLIC_KEY;
		$data 				=file_get_contents('./tasks.json', FILE_USE_INCLUDE_PATH);

		$json = json_decode($data, true);
        foreach ($json as $key => $value) {

            if (!is_array($value)) {
                echo $key . '=>' . $value . '<br/>';
            } 
            else {

                foreach ($value as $key => $val) {
                    echo $key. '<br/>';
                    var_dump( $val);
                }
            }
        }
	}
}