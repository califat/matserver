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
	public 		$MonthsDaysNumber =[
										"JANUARY"	=>31, 
										"FEBRUARY"	=>29, 
										"MARCH"		=>31, 
										"APRIL"		=>30, 
										"MAY"		=>31, 
										"JUNE"		=>30,
										"JULY"		=>31, 
										"AUGUST"	=>31, 
										"SEPTEMBER"	=>30, 
										"OCTOBER"	=>31, 
										"NOVEMBER"	=>30, 
										"DECEMBER"	=>31
									];


	function __construct()
	{
		$this->EnvVars 		=(new \LoadEnv);
		$this->Public_key 	=$this->EnvVars->PUBLIC_KEY;
		$data 				=file_get_contents('./tasks.json', FILE_USE_INCLUDE_PATH);

		$json = json_decode($data, true);
        // foreach ($json as $key => $value) {

        //     if (!is_array($value)) {
        //         echo $key . '=>' . $value . '<br/>';
        //     } 
        //     else {

        //         foreach ($value as $key => $val) {
        //             echo $key. '<br/>';
        //             var_dump( $val);
        //         }
        //     }
        // }
        var_dump(strftime("%d"));
        echo (new \Dater)->getDays($this->MonthsDaysNumber,1);
	}

}