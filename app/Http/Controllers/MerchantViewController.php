<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class MerchantViewController extends Controller
{


	public function  listAll(){
		$merchants = DB::table('merchants')->get();
		return  view('merchants',compact('merchants'));
	}
}