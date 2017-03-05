<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class CustomerViewController extends Controller
{


	public function  listAll(){
		$customers = DB::table('customers')->get();
		return  view('customers',compact('customers'));
	}
}