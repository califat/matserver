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

	}//END CONSTRUCT

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
	}//END METHOD

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
	}//END METHOD
	
	//RETURN NUMBER OF DAYS PER MOMNT 
	public function getDays($integer=""){

		$MonthsDaysNumber =[
								"JANUARY"	=>31, "FEBRUARY"	=>29, "MARCH"		=>31, 
								"APRIL"		=>30, "MAY"			=>31, "JUNE"		=>30,
								"JULLY"		=>31, "AUGUST"		=>31, "SEPTEMBER"	=>30, 
								"OCTOBER"	=>31, "NOVEMBER"	=>30, "DECEMBER"	=>31
							];

		switch ($integer) {

			case 1:
				return $MonthsDaysNumber["JANUARY"];
				break;
			case 2:
				return $MonthsDaysNumber["FEBRUARY"];
				break;
			case 3:
				return $MonthsDaysNumber["MARCH"];
				break;
			case 4:
				return $MonthsDaysNumber["APRIL"];
				break;
			case 5:
				return $MonthsDaysNumber["MAY"];
				break;
			case 6:
				return $MonthsDaysNumber["JUNE"];
				break;
			case 7:
				return $MonthsDaysNumber["JULY"];
				break;
			case 8:
				return $MonthsDaysNumber["AUGUST"];
				break;
			case 9:
				return $MonthsDaysNumber["SEPTEMBER"];
				break;
			case 10:
				return $MonthsDaysNumber["OCTOBER"];
				break;
			case 11:
				return $MonthsDaysNumber["NOVEMBER"];
				break;
			case 12:
				return $MonthsDaysNumber["DECEMBER"];
				break;										
			default:
				return 0;
				break;
		}

	}//END METHOD

	public function FormatNextApointement($DDR)
	{

		$acceptDate 	=["1w","2w","3w","1m","1m_1w","1m_2w","1m_3w","2m"];
		$nextApointment =null;

		if(!in_array(mb_strtolower($DDR), $acceptDate)){

			$nextApointment =strtotime("+1 Months");

		}else{

			switch ($DDR) {
				case $acceptDate[0] :

					$nextApointment =strtotime("+1 weeks");
					return str_ireplace("pm", "", date("Y-m-d h:i:sa", $nextApointment));
					break;

				case $acceptDate[1]:

					$nextApointment =strtotime("+2 weeks");
					return str_ireplace("pm", "", date("Y-m-d h:i:sa", $nextApointment));
					break;

				case $acceptDate[2]:

					$nextApointment =strtotime("+3 weeks");
					return str_ireplace("pm", "", date("Y-m-d h:i:sa", $nextApointment));
					break;

				case $acceptDate[3]:

					$nextApointment =strtotime("+1 Months");
					return str_ireplace("pm", "", date("Y-m-d h:i:sa", $nextApointment));
					break;

				case $acceptDate[4]:

					$nextApointment =strtotime("+5 weeks");
					return str_ireplace("pm", "", date("Y-m-d h:i:sa", $nextApointment));
					break;

				case $acceptDate[5]:

					$nextApointment =strtotime("+6 weeks");
					return str_ireplace("pm", "", date("Y-m-d h:i:sa", $nextApointment));
					break;

				case $acceptDate[6]:

					$nextApointment =strtotime("+7 weeks");
					return str_ireplace("pm", "", date("Y-m-d h:i:sa", $nextApointment));
					break;

				case $acceptDate[7]:

					$nextApointment =strtotime("+8 weeks");
					return str_ireplace("pm", "", date("Y-m-d h:i:sa", $nextApointment));
					break;

				default:

					$nextApointment =$d=strtotime("+1 Months");
					return str_ireplace("pm", "", date("Y-m-d h:i:sa", $nextApointment));
					break;
			}
		}

	}//END METHOD
}







	/*
	echo "The time is " . date("h:i:sa");

	date_default_timezone_set("America/New_York");
	echo "The time is " . date("h:i:sa");

	$d=mktime(11, 14, 54, 8, 12, 2014);
	echo "Created date is " . date("Y-m-d h:i:sa", $d);

	$d=strtotime("10:30pm April 15 2014");
	echo "Created date is " . date("Y-m-d h:i:sa", $d);

	$d=strtotime("tomorrow");
	echo date("Y-m-d h:i:sa", $d) . "<br>";

	$d=strtotime("next Saturday");
	echo date("Y-m-d h:i:sa", $d) . "<br>";

	$d=strtotime("+3 Months");
	echo date("Y-m-d h:i:sa", $d) . "<br>";

	$startdate = strtotime("Saturday");
	$enddate = strtotime("+6 weeks", $startdate);

	while ($startdate < $enddate) {
	  echo date("M d", $startdate) . "<br>";
	  $startdate = strtotime("+1 week", $startdate);
	}

	$d1=strtotime("July 04");
	$d2=ceil(($d1-time())/60/60/24);
	echo "There are " . $d2 ." days until 4th of July.";


	echo date("l"); something like monday

	// Affichage de quelque chose comme : Monday 8th of August 2005 03:12:46 PM
	echo date('l jS \of F Y h:i:s A');

	// Affiche : July 1, 2000 is on a Saturday
	echo "July 1, 2000 is on a " . date("l", mktime(0, 0, 0, 7, 1, 2000));

	// Affichage de quelque chose comme : 2000-07-01T00:00:00+00:00
	echo date(DATE_ATOM, mktime(0, 0, 0, 7, 1, 2000));

	// Affichage de quelque chose comme : Wednesday the 15th
	echo date('l \t\h\e jS');


	// Aujourd'hui, le 10 Mars 2001, 5:16:18 pm, Fuseau horaire 
	// Mountain Standard Time (MST)
	 
	$today = date("F j, Y, g:i a");                   // March 10, 2001, 5:16 pm
	$today = date("m.d.y");                           // 03.10.01
	$today = date("j, n, Y");                         // 10, 3, 2001
	$today = date("Ymd");                             // 20010310
	$today = date('h-i-s, j-m-y, it is w Day');       // 05-16-18, 10-03-01, 1631 1618 6 Satpm01
	$today = date('\i\t \i\s \t\h\e jS \d\a\y.');     // It is the 10th day (10ème jour du mois).
	$today = date("D M j G:i:s T Y");                 // Sat Mar 10 17:16:18 MST 2001
	$today = date('H:m:s \m \e\s\t\ \l\e\ \m\o\i\s'); // 17:03:18 m est le mois
	$today = date("H:i:s");                           // 17:16:18
	$today = date("Y-m-d H:i:s");                     // 2001-03-10 17:16:18 (le format DATETIME de MySQL)

	$timestamp = strtotime('1st January 2004'); //1072915200

	// ceci affiche l'année sur deux chiffres
	// néanmoins, vu que ce chiffre va commencer par "0",
	// seul "4" sera affiché
	echo idate('y', $timestamp);

	echo strtotime("now"), "\n";
	echo strtotime("10 September 2000"), "\n";
	echo strtotime("+1 day"), "\n";
	echo strtotime("+1 week"), "\n";
	echo strtotime("+1 week 2 days 4 hours 2 seconds"), "\n";
	echo strtotime("next Thursday"), "\n";
	echo strtotime("last Monday"), "\n";

	$today = getdate();
	print_r($today);

	*/