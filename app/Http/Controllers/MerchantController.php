<?php

namespace App\Http\Controllers;

use DB;
use App\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    
    public function index()
    {
    	return DB::table('merchants')->get();

    }

    public function getByPhoneNumber($phoneNumber)
    {
    	return  DB::table('merchants')->where('merchant_phone_number',$phoneNumber)->get();
    }
}
