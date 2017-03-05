<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class MerchantMessagesViewController extends Controller
{


	public function  listAll(){
		$messages = DB::table('merchant_messages')->get();
		return  view('messages',compact('messages'));
	}

}	