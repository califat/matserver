<?php
	require "vendor/autoload.php";
	use Model\Model;


	//TABLEAUX CONTENANT LE SOURCE DE REQUETES;
	$requestSource =["internalSource","dashBoardSource","automatedArtificialInteligence","externalSource"];

	//TABLEAUX CONTENANT LES DEVISES MONETAIRE;
	$devisesMonetaires =["Dollar americans","Franc congolais","Euro","Livre sterling"];

	//TABLEAU CONTENANT LES RESEAUX DE TELECOMUNICATION DE LA RDC
	$networks 			=["Airtel","Orange","Vodacom","Tigo"];


	// TABLEAUX CONTENANT LA LISTE D"
	$provinces =[
					"A"=>"Bas-uele",
					"B"=>"Equateur",
					"C"=>"Haut-katanga",
					"D"=>"Haut-lomami",
					"E"=>"Haut-uele",
					"F"=>"Ituri",
					"G"=>"Kassai",
					"H"=>"Kassai occidental",
					"I"=>"Kassai oriental",
					"J"=>"Kwango central",
					"K"=>"Kwamgo",
					"L"=>"Kwilu",
					"M"=>"Lomami",
					"N"=>"Lualaba",
					"O"=>"Maindombe",
					"P"=>"Maniema",
					"Q"=>"Mongala",
					"R"=>"Nork-kivu",
					"S"=>"Nord-ubangi",
					"T"=>"Sankuru",
					"U"=>"Sud-kivu",
					"V"=>"Sud-ubangi",
					"W"=>"Tanganyika",
					"X"=>"Tshopo",
					"Y"=>"Tshuapa",
					"Z"=>"Kinshasa"
				];
	// TABLEAUX CONTENANT LES ZONES DU NORD-KIVU"
	$nordKivuZone =[
					"A"=>"OICHA",
					"B"=>"KAMANGO",
					"C"=>"BENI",
					"D"=>"MABALAKO",
					"E"=>"KALUNGUTA",
					"F"=>"MUTWANGA",
					"G"=>"VUHAI",
					"H"=>"MANGAREDJIPA",
					"I"=>"BIENA",
					"J"=>"KATWA",
					"K"=>"BUTEMBO",
					"L"=>"KYONDO",
					"M"=>"MASEREKA",
					"N"=>"MUSIENENE",
					"O"=>"LUBERO",
					"P"=>"ALIMBONGO",
					"Q"=>"KAYINA",
					"R"=>"PINGA",
					"S"=>"KIBIRIZA",
					"U"=>"WALIKALE",
					"V"=>"KIBUA",
					"W"=>"MWENGA",
					"X"=>"BIRAMBIZO",
					"Y"=>"BAMBO",
					"AA"=>"MBIZA",
					"AB"=>"RWANGUBA",
					"AC"=>"RUTSHURU",
					"AD"=>"MASISI",
					"AE"=>"KIROTSHE",
					"AF"=>"KARISIMBI",
					"AG"=>"KATOYI",
					"AH"=>"GOMA",
					"AI"=>"NYIRAGONGO",
					"AJ"=>"ITEBERO"
				];


/**
* 
*/
class InsertDB extends Model
{
	
	function __construct()
	{
		# code...
	}

	public function insertProvinces($provinces){

		foreach ($provinces as $key => $value) {

			$query 	=parent::queryList("INSERT IGNORE INTO m_provinces (alphabet,province) 
					VALUES (:alphabet,:province) ",
					[
						"alphabet"=>$key,
						"province"=>$value
				]);

		}
		echo "Provinces added";

	}
	public function insertZones($zones,$provinceId,$provinceAlphabet){

		$index 	=0;

		foreach ($zones as $key => $value) {

			$index ++;

			$query 	=parent::queryList("INSERT IGNORE INTO m_zones (province,zone_number,alphabet_composed,zone) 
				VALUES (:province,:zoneNumber,:alphabetComposed,:zone) ",
				[
					"province"			=>$provinceId,
					"zoneNumber"		=>$index,
					"alphabetComposed"	=>$provinceAlphabet.$index,
					"zone"				=>$value
			]);

		}

		echo  $index." Zones added";

	}

	public function insertRequestSource($sources){

		$index =0;
		foreach ($sources as $key => $value) {

			$index ++;

			$query 	=parent::queryList("INSERT IGNORE INTO m_request_source (source) 
				VALUES (:source) ",["source"=>$value]);

		}

		echo  $index." Request source added";

	}
	public function insertMoneyDevise($devises){

		$index =0;
		foreach ($devises as $key => $value) {

			$index ++;

			$query 	=parent::queryList("INSERT IGNORE INTO m_devise (devise) 
				VALUES (:devise) ",["devise"=>$value]);

		}

		echo  $index." Devises added";

	}


	public function insertNetwork($networks){

		$index =0;
		foreach ($networks as $key => $value) {

			$index ++;

			$query 	=parent::queryList("INSERT IGNORE INTO m_networks (network) 
				VALUES (:network) ",["network"=>$value]);

		}
		echo  $index." Networks added";

	}	

}
			
$insertion =new InsertDB;
//$insertion->insertProvinces($provinces);
//$insertion->insertZones($nordKivuZone,18,"R");
//$insertion->insertRequestSource($requestSource);
//$insertion->insertMoneyDevise($devisesMonetaires);
//$insertion->insertNetwork($networks);


/**
* 
*/
class TestInit extends Model
{
	
	function __construct()
	{
		
	}

	public function getRandomInteger($min, $max)
    {
        $range = ($max - $min);

        if ($range < 0) {
            // Not so random...
            return $min;
        }

        $log = log($range, 2);

        // Length in bytes.
        $bytes = (int) ($log / 8) + 1;

        // Length in bits.
        $bits = (int) $log + 1;

        // Set all lower bits to 1.
        $filter = (int) (1 << $bits) - 1;

        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));

            // Discard irrelevant bits.
            $rnd = $rnd & $filter;

        } while ($rnd >= $range);

        return ($min + $rnd);
    }

	public function ActivateStageAccount($tageId){

		$query =parent::queryList("UPDATE m_stages SET active =1 WHERE id =:id",
			["id"=>$tageId]);

		echo "Stage activated";
	}
				    
}


$test =(new TestInit);
//$test->getRandomInteger(50,10000);
//$test->ActivateStageAccount(2);


/**
* 
*/

$phoneValidator 		=new PhoneNumberValidator;

$phoneNumberFormated 	=$phoneValidator->PhoneNumberFormater("+243899688045");
$phoneNumberSufix 		=$phoneValidator->GetPhoneNumberSufix("+243899688045");
$phoneNumberNetwork 	=$phoneValidator->GetPhoneNumberNetwork($phoneNumberSufix);

echo $phoneNumberFormated;
echo "<hr>";
echo $phoneNumberSufix;
echo "<hr>";
echo $phoneNumberNetwork;


