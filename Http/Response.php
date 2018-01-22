<?php
namespace ClientResponse\matibabu;
require "vendor/autoload.php";
use Model\Model;
use Router\Router;
use Sms\matibabu\Sms;
use SmsClass\matibabu\SmsClass; 
/**
* 
*/
class ClientResponse extends Model implements SmsClass
{

	private $Sms;	
	function __construct()
	{
		$this->Sms =new Sms; 
	}

	public function ScheduleSmSFromStageToClient($phone_number,$stage_id,
		$client_profil_code,$schedule_time)
	{
		$query =$this->queryList("INSERT INTO  m_stage_sms_schedule 
			(phone_number,stage_id,client_profil_code,schedule_time) 
			VALUES(:phone_number,:stage_id,:client_profil_code,
			:schedule_time)",
			[
				"phone_number"		=>$phone_number,
				"stage_id"			=>$stage_id,
				"client_profil_code"=>$client_profil_code,
				"schedule_time"		=>$schedule_time,
			]);
		
	}

	public function SimpleSms($phoneNumber,$SmsContent)
	{
		
		$this->Sms->SimpleSms($phoneNumber,func_get_arg(1));

	}
}