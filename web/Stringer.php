<?php
/**
* 
*/

class Stringer
{
	private $date;
	const BAD_CHARACTERS  =[
    " ","#","$","%","^","&","*","(",")","=","<",">","?","!","/","|","{","}","[","]","_","±","«","¬","ð","÷","~","¥","§","¿","¸","Ǽ͛","҈","҉","-"
    ];

	function __construct()
	{
		
	}

	public function similarity($string1, $string2) {

		if(empty($string1) || $string1 =="" || empty($string2) || $string2 ==""):

			return json_encode(["error"=>"faill to get similarity string 1 or string 2 is empty"]);
			
		endif;	
		
		$str1 =strval($string1);
		$str2 =strval($string2);

	    $len1 = strlen($str1);
	    $len2 = strlen($str2);
	    
	    $max = max($len1, $len2);
	    $similarity = $i = $j = 0;
	    
	    while (($i < $len1) && isset($str2[$j])) {
	        if ($str1[$i] == $str2[$j]) {
	            $similarity++;
	            $i++;
	            $j++;
	        } elseif ($len1 < $len2) {
	            $len1++;
	            $j++;
	        } elseif ($len1 > $len2) {
	            $i++;
	            $len1--;
	        } else {
	            $i++;
	            $j++;
	        }
	    }

	    return intval((round($similarity / $max, 2) * 100));
	}

	public function GenerateToken($tokenchar=[],$tokenLenght=10)#GENERATE A TOKEN FOR EACH TEAM
	{
		
		$token =shuffle($tokenchar);

		foreach ($tokenchar as $key => $value) {

			$token .=random_int(5, 8).sha1($value).mt_rand(5,15).("d/m/y/h:i:s").random_bytes(10);

		}
		return substr($token, 0,$tokenLenght);
	}

	public function forTrim($trims,$str,$replacewith=[]){

		$newStr;

		for ($i=0; $i < count($trims) ; $i++) {

			$newStr =trim(str_ireplace($trims, " ", 
					trim(preg_replace('/\s\s+/', ' ',
					str_ireplace($trims, " ", $str)))));
		}

		var_dump($newStr);
	}

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

	#CAPITALIZE THE FIRST LETTER AND RETURN JUST 14 STRING OF A SENTENCE
    public static function Str14($string,$length=14){

        return  mb_strlen($string) >$length ? 
                str_replace(' ', ' ', htmlspecialchars(substr(ucwords($string), 0, $length).'...')) :
                ucwords($string);

    }#END METHOD

    #CAPITALIZE THE FIRST LETTER AND RETURN JUST 16 STRING OF A SENTENCE
    public static function Str16($string){

        return  mb_strlen($string) >16 ? 
                str_replace(' ', ' ', htmlspecialchars(substr(ucwords($string), 0, 16).'...')) : 
                ucwords($string);

    }#END METHODE

    public static function Str20($string){

        return  mb_strlen($string) >20 ? 
                str_replace(' ', ' ', htmlspecialchars(substr(ucwords($string), 0, 20).'...')) : 
                ucwords($string);

    }#END METHODE

    public static function Str125($string){

        return  mb_strlen($string) >125 ? 
                str_replace(' ', ' ', htmlspecialchars(substr(ucwords($string), 0, 125).'...')) : 
                ucwords($string);

    }#END METHODE  

    public static function StrCut($length,$str){
    	
        return  mb_strlen($str) >$length ? 
                str_replace(' ', ' ', htmlspecialchars(substr(ucwords($str), 0, $length).'...')) : 
                ucwords($str);
    }

    public function intMonth($mont_int){

    	if(!is_numeric($mont_int)) return false;
        $month_list =['',

        				'Jan','Feb','March','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec'
        			];
        return  count($month_list < $mont_int) ? htmlspecialchars($month_list[$mont_int]) : false;
    }


    function NowDateToHash()
    {
    	$this->date       =new Dater;
        return mb_strtoupper(md5(str_replace("-", "", $this->date->now)));
    }

	public function StrSlug($str)
	{
		$StrSlug 	=$str ? strval($str) : "";

		$rawSlugF 	=trim($this->defender->NohtmlNotags(preg_replace('/\s\s+/', ' ', 
                      		str_replace(self::BAD_CHARACTERS, " ", $StrSlug)))," ");
		$rawSlug 	=str_ireplace(" ", "-", $rawSlugF);
		
		return $$rawSlug;
	}
	public function generateRandomString($length = 24) {

	    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	    #OR: generateRandomString(24)
	}

    // Shortens a number and attaches K, M, B, etc. accordingly
    public function NumberShorten($number, $precision = 3, $divisors = null,$text="") {

        #Setup default $divisors if not provided
        #FIX NUMBER WITH SMALL NUMBER AFTER
        if (!isset($divisors)) {
            $divisors = array(
                pow(1000, 0) => '', // 1000^0 == 1
                pow(1000, 1) => 'K', // Thousand
                pow(1000, 2) => 'M', // Million
                pow(1000, 3) => 'B', // Billion
                pow(1000, 4) => 'T', // Trillion
                pow(1000, 5) => 'Qa', // Quadrillion
                pow(1000, 6) => 'Qi', // Quintillion
            );    
        }

        // Loop through each $divisor and find the
        // lowest amount that matches
        foreach ($divisors as $divisor => $shorthand) {
            if (abs($number) < ($divisor * 1000)) {
                // We found a match!
                break;
            }
        }

        // We found our match, or there were no matches.
        // Either way, use the last defined value for $divisor.
        return number_format($number / $divisor, $precision) . $shorthand;
    }#END METHODE	

	public function Number_F_Short( $n,$text="",$precision = 1) {
        #FIX NUMBER WITHOUT SMALLNUMBER AFTER
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }
      // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
      // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ( $precision > 0 ) {
            $dotzero = '.' . str_repeat( '0', $precision );
            $n_format = str_replace( $dotzero, '', $n_format );
        }
        return  $n > 1 ? $n_format . $suffix." ".$text."s" :  $n_format . $suffix." ".$text;

    }#END METHODE

}#END CLASS












//the function
//Param 1 has to be an Array
//Param 2 has to be a String
#function multiexplode ($delimiters,$string) {
#    $ary = explode($delimiters[0],$string);
#    array_shift($delimiters);
#    if($delimiters != NULL) {
#        foreach($ary as $key => $val) {
#             $ary[$key] = multiexplode($delimiters, $val);
#        }
#    }
#    return  $ary;
#}

// Example of use
#$string = "1-2-3|4-5|6:7-8-9-0|1,2:3-4|5";
#$delimiters = Array(",",":","|","-");

#$res = multiexplode($delimiters,$string);
#echo '<pre>';
#print_r($res);
#echo '</pre>'