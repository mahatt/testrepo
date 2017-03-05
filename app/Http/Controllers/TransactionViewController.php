<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class TransactionViewController extends Controller
{


	public function  listAll(){
		$transactions = DB::table('transactions')->get();
		return  view('transactions',compact('transactions'));
	}
}