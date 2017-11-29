<?php
if(!file_exists("vendor/autoload.php"))die();
require "vendor/autoload.php";
/**
* 
*/
use Carbon\Carbon;

date_default_timezone_set('UTC');


class Dater
{
	public 		$today;
	public 		$today_;
	public 		$year;
	public 		$month;
	public 		$leftMonth;
	const 		TOTAL_MONTHS 	=12;
	public 		$intDay;
	public 		$leftDay =[0,31,28,31,30,31,30,31,31,30,31,30,31];#$key=>value ($month=>number of days)
	public 		$lastDay;
	public 		$time;
	public 		$minute;
	public 		$second;
	public 		$remainingTime;
	public 		$now;
	private 	$stringer;

	function __construct()
	{
		$this->stringer 	=new \Stringer;
		$this->now 			=date('Y-m-d-H-i-s');
		$this->today  		=date("Y/m/d");
		$this->today_ 		=date("Y-m-d");
		$this->year 		=intval(date("Y"));
		$this->intMonth 	=intval(date("m"));
		$this->leftMonth	=self::TOTAL_MONTHS -$this->intMonth;
		$this->intDay 		=intval(date("d"));

		foreach ($this->leftDay as $month => $days) {

			if( $month == $this->intMonth ):

				$this->leftDay 		=$days - $this->intDay;

			endif;
		}

		$this->lastDay 			= date('t',strtotime($this->today_));

		$this->time 			=intval(date("h"));#MA MONTRE EST EN ARIERE DE 2 HEURES
		$this->minute 			=intval(date("m"));
		$this->second 			=intval(date("s"));

		$this->remainingTime 	=24 - $this->time;

	}

	public function now()
	{
		return str_ireplace("-", "", $this->now);
	}
	public function LastDayFuture($date){#RETURN LAST DAY OF A MONTH IN A GIVEN YEAR

		return  date('t',strtotime($date));
	}#END METHODE




	public function MakeSqlTimestamp($sqlTimestamp)
	{

		if(count($sqlTimestamp) <6 || count($sqlTimestamp) > 6)return false;

		$sqlTimestamp 	=$sqlTimestamp;

		$dash 			="-";
		$space 			=" ";
		$doubleDot 		=":";
		$zero 			=0;

		$year 			=substr(strval($sqlTimestamp[0]), 0,4);

		if(intval($sqlTimestamp[1]) < 10):

			$month 		=$zero.$sqlTimestamp[1];
		else:
			$month 		=substr(strval($sqlTimestamp[1]), 0,2);
		endif;


		if(intval($sqlTimestamp[2]) < 10):

			$day 		=$zero.$sqlTimestamp[2];
		else:
			$day 		=substr(strval($sqlTimestamp[2]), 0,2);
		endif;

		if(intval($sqlTimestamp[3]) < 10):

			$hour 		=$zero.$sqlTimestamp[3];
		else:
			$hour 		=substr(strval($sqlTimestamp[3]), 0,2);
		endif;

		if(intval($sqlTimestamp[4]) < 10):

			$minute 		=$zero.$sqlTimestamp[4];
		else:
			$minute 		=substr(strval($sqlTimestamp[4]), 0,2);
		endif;

		if(intval($sqlTimestamp[5]) < 10):

			$second 		=$zero.$sqlTimestamp[5];
		else:
			$second 		=substr(strval($sqlTimestamp[5]), 0,2);
		endif;
		return $year.$dash.$month.$dash.$day.$space.$hour.$doubleDot.$minute.$doubleDot.$second;
		   
	}#END METHODE

	public function time_elapsed_string($ptime)
	{
	    $etime = time() - $ptime;

	    if ($etime < 1)
	    {
	        return '0 seconds';
	    }

	    $a = array( 365 * 24 * 60 * 60  =>  'year',
	                 30 * 24 * 60 * 60  =>  'month',
	                      24 * 60 * 60  =>  'day',
	                           60 * 60  =>  'hour',
	                                60  =>  'minute',
	                                 1  =>  'second'
	                );
	    $a_plural = array( 'year'   => 'years',
	                       'month'  => 'months',
	                       'day'    => 'days',
	                       'hour'   => 'hours',
	                       'minute' => 'minutes',
	                       'second' => 'seconds'
	                );

	    foreach ($a as $secs => $str)
	    {
	        $d = $etime / $secs;
	        if ($d >= 1)
	        {
	            $r = round($d);
	            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
	        }
	    }
	}
	#echo $this->time_elapsed_string('2013-05-01 00:22:35');
	#echo $this->time_elapsed_string('@1367367755'); # timestamp input
	#echo $this->time_elapsed_string('2013-05-01 00:22:35', true);

	public function time_elapsed($datetime, $full = false) {

	    $now 		= new DateTime;
	    $ago 		= new DateTime($datetime);
	    $diff 		= $now->diff($ago);

	    $diff->w 	= floor($diff->d / 7);
	    $diff->d 	-= $diff->w * 7;

	    $string = array(
	        'y' => 'an',
	        'm' => 'mois',
	        'w' => 'semaine',
	        'd' => 'jour',
	        'h' => 'heure',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? 'il ya '.implode(', ', $string) : 'maintenant';
	}
	
	//RETURN NUMBER OF DAYS PER MOMNT 
	public function getDays($array,$integer=""){

		switch ($integer) {

			case 1:
				return $array["JANUARY"];
				break;
			case 2:
				return $array["FEBRUARY"];
				break;
			case 3:
				return $array["MARCH"];
				break;
			case 4:
				return $array["APRIL"];
				break;
			case 5:
				return $array["MAY"];
				break;
			case 6:
				return $array["JUNE"];
				break;
			case 7:
				return $array["JULY"];
				break;
			case 8:
				return $array["AUGUST"];
				break;
			case 9:
				return $array["SEPTEMBER"];
				break;
			case 10:
				return $array["OCTOBER"];
				break;
			case 11:
				return $array["NOVEMBER"];
				break;
			case 12:
				return $array["DECEMBER"];
				break;										
			default:
				return 0;
				break;
		}

	}
}




