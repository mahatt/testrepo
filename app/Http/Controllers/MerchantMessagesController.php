<?php

namespace App\Http\Controllers;

use DB;
use App\Merchant;
use Illuminate\Http\Request;
use DateTime;
use DateInterval;

class MerchantMessagesController extends Controller
{


	public function  store(Request $request){

		$phone_number = $request->phone_number;
		$message_title  = $request->message_title;
		$message_text  = $request->message_text;

		if(empty(trim($phone_number))  || 
			empty(trim($message_title)) ||
			empty(trim($message_text)) ){
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "402",
	    			 	"message"=> "Invalid Fields for Message!!"
	    			 )
	    		]);			
		}


		
		$message_id  = DB::table('merchant_messages')->insertGetId([
				"merchant_phone_number" =>  $phone_number,
				"message_title" => $message_title,
				"message_text" => $message_text,
				"created_at" =>  new DateTime
			]);

		return $message_id;

	}
}