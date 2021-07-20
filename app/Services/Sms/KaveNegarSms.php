<?php
namespace App\Services\Sms;
use App\Interfaces\SmsInterface;
use Kavenegar;

class KaveNegarSms implements SmsInterface {

    public function send($receptor, $message)
    {
        try{
            $sender = "10004346";		//This is the Sender number
            $receptor = array($receptor);			//Receptors numbers
            $result = Kavenegar::Send($sender,$receptor,$message);
        }
        catch(\Kavenegar\Exceptions\ApiException $e){
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            return $e->errorMessage();
        }
        catch(\Kavenegar\Exceptions\HttpException $e){
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            return $e->errorMessage();
        }
    }


}
