<?php

namespace App\Http\Controllers;

use DB;
use App\Merchant;
use Illuminate\Http\Request;
use DateTime;
use DateInterval;

class MerchantController extends Controller
{
    
    public function index()
    {
    	return DB::table('merchants')->get();

    }

    public function getByPhoneNumber($phoneNumber)
    {
    	$merchantinfo = DB::table('merchants')->where('merchant_phone_number',$phoneNumber)->first();

    	if(empty($merchantinfo))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Not Found!"
	    			 )
	    		]);
    	}

    	return  response()->json([
    		 "name" => $merchantinfo->merchant_name,
    		 "pincode" => $merchantinfo->merchant_pincode,
    		 "category" => $merchantinfo->merchant_category,
    		 "phone_number" => $merchantinfo->merchant_phone_number,
    		 "enabled" => $merchantinfo->merchant_enable,
    		 "points" => $merchantinfo->merchant_points
    		]);
    }


    public function  store(Request $request)
    {	

    	// check if any input is valid
    	//TODO : add checks here do
    	if(empty(trim($request->phone_number)) || 
    	   empty(trim($request->name)) || 
    	   empty(trim($request->category)) || 
    	   empty(trim($request->pincode)))
    	{
    		return  response() -> json([
    				"error" => array(
    						"code" => "404",
    						"message" => "Not Found ! Invalid Inputs" 
    					)
    			]);
    	}	

        $merchantinfo  =  DB::table('merchants')->where('merchant_phone_number',$request->phone_number)->first();

        if(!empty($merchantinfo))
        {
            return  response()->json([
                    "error" => array(
                        "code" => "402",
                        "message"=> "User Already Exists!"
                     )
                ]);
        }  

    	$merchantid = DB::table('merchants')->insertGetId([
        	'merchant_phone_number' => $request->phone_number,
        	'merchant_name' => $request->name,
        	'merchant_pincode'  => $request->pincode,
        	'merchant_category'  => $request->category,
        	'merchant_points'  => '0',
        	'merchant_enable'  => '1',   // enable by default
        	'merchant_password' => $request->password
    		]);	

    	// NO need to check for object , we just inserted this
    	return  $request->phone_number;
    }



    // DO NOT USE THIS API
    public function  remove(Request $request){


    	if(empty($request->phone_number))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Not Found!"
	    			 )
	    		]);
    	}

    	$merchantinfo = DB::table('merchants')->where('merchant_phone_number','=',$request->phone_number)->first();

    	if(empty($merchantinfo))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Not Found!"
	    			 )
	    		]);
    	}    		

    	DB::table('merchants')->where('merchant_phone_number','=',$request->phone_number)->delete();
    	return  $request->phone_number;
    }


    public  function  addpoints(Request $request){

    	$points = $request->points;
    	$phone_number = $request->phone_number;

    	if(empty(trim($request->phone_number)) ||
    		empty(trim($request->points)))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Not Found!"
	    			 )
	    		]);
    	}

    	$merchantinfo  =  DB::table('merchants')->where('merchant_phone_number',$phone_number)->first();

    	if(empty($merchantinfo))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Not Found!"
	    			 )
	    		]);
    	}   

    	$final_points = $merchantinfo->merchant_points + $points ;
    	DB::table('merchants')->where('merchant_phone_number',$phone_number)->update(['merchant_points' => $final_points]);

		$merchantinfo  =  DB::table('merchants')->where('merchant_phone_number',$phone_number)->first();

    	return  response()->json([
    		 "name" => $merchantinfo->merchant_name,
    		 "emailid" => $merchantinfo->merchant_emailid,
    		 "phone_number" => $merchantinfo->merchant_phone_number,
    		 "enabled" => $merchantinfo->merchant_enable,
    		 "points" => $merchantinfo->merchant_points
    		]);


    }


    public  function  subpoints(Request $request){
    	$final_points = 0;
    	$points = $request->points;
    	$phone_number = $request->phone_number;

    	$merchantinfo  =  DB::table('merchants')->where('merchant_phone_number',$phone_number)->first();

    	if(empty($merchantinfo))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Not Found!"
	    			 )
	    		]);
    	}   

    	if($merchantinfo->merchant_points - $points > 0 )
	    	$final_points = $merchantinfo->merchant_points - $points ;
	    else
	    {
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "403",
	    			 	"message"=> "Negative balance are Forbidden!"
	    			 )
	    		]);	    	
	    }	


	    //TODO: handle error for negative case

    	DB::table('merchants')->where('merchant_phone_number',$phone_number)->update(['merchant_points' => $final_points]);

		$merchantinfo  =  DB::table('merchants')->where('merchant_phone_number',$phone_number)->first();

    	return  response()->json([
    		 "name" => $merchantinfo->merchant_name,
    		 "emailid" => $merchantinfo->merchant_emailid,
    		 "phone_number" => $merchantinfo->merchant_phone_number,
    		 "enabled" => $merchantinfo->merchant_enable,
    		 "points" => $merchantinfo->merchant_points
    		]);


    }


    public function transact(Request $request)
    {
        $merchant_phone_number  = $request->merchant_phone_number;
        $customer_phone_number  = $request->customer_phone_number;
        $amount                 = $request->amount;
        // check if merchant exist
        // 

        $merchantinfo = DB::table('merchants')->where('merchant_phone_number','=',$merchant_phone_number)->first();

        if(empty($merchantinfo))
        {
            return  response()->json([
                    "error" => array(
                        "code" => "404",
                        "message"=> " Merchant Not Found!"
                     )
                ]);
        }   

        if($merchantinfo->merchant_enable == 0)
        {	
            return  response()->json([
                    "error" => array(
                        "code" => "404",
                        "message"=> " Merchant is Disabled for transactions!"
                     )
                ]);        	
        }
        // Get Policy for now 2 points for 100 rs
        $policy  = 2  / 100;   
        $points = ceil( $amount *  $policy );
        $final_points = 0;
        $return_points = 0;
        if($merchantinfo->merchant_points - $points > 0 )
        {
            $final_points = $merchantinfo->merchant_points - $points ;
            $return_points = $final_points;
        }
        else
        {
            return  response()->json([
                    "error" => array(
                        "code" => "403",
                        "message"=> "Negative balance are Forbidden!"
                     )
                ]);         
        }   

        DB::table('merchants')->where('merchant_phone_number',$merchant_phone_number)->update(['merchant_points' => $final_points]);

        // $merchantinfo  =  DB::table('merchants')->where('merchant_phone_number',$merchant_phone_number)->first();

        // return  response()->json([
        //      "name" => $merchantinfo->merchant_name,
        //      "emailid" => $merchantinfo->merchant_emailid,
        //      "phone_number" => $merchantinfo->merchant_phone_number,
        //      "enabled" => $merchantinfo->merchant_enable,
        //      "points" => $merchantinfo->merchant_points
        //     ]);


        $customerInfo =  DB::table('customers')->where('customer_phone_number','=',$customer_phone_number)->first();

        if(empty($customerInfo))
        {
            return  response()->json([
                    "error" => array(
                        "code" => "404",
                        "message"=> " Customer Not Found!"
                     )
                ]);
        }


        $final_points = $customerInfo->customer_points + $points;
        DB::table('customers')->where('customer_phone_number',$customer_phone_number)->update(['customer_points' => $final_points]);

        DB::table('transactions')->insertGetId([
                    'merchant_phone_number' => $merchant_phone_number,
                    'customer_phone_number' => $customer_phone_number,
                    'points' => $points,
                    'amount' =>  $amount,
                    'policy' => 'default-2',
                    'created_at' =>  new DateTime
                    ]);

        return $return_points;

    }

    public function authenticate(Request $request)
    {
    	$phone_number = $request->phone_number;
    	$password = $request->password;

    	$merchantinfo =  DB::table('merchants')
    						->where([['merchant_phone_number','=',$phone_number],
    								['merchant_password','=',$password]])->first();	


    	if(empty($merchantinfo))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Not Found!"
	    			 )
	    		]);
    	}   

    	return $phone_number;
    }


}
