<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //

    public function  getByPhoneNumber(Request $request)
    {
    	$phone_number  =  $request->phone_number;
    	if(empty(trim($phone_number)))
    	{
    		return  response() -> json([
    				"error" => array(
    						"code" => "404",
    						"message" => "Not Found!"
    					)
    			]);    		
    	}

    	$customerInfo = DB::table('customers')->where('customer_phone_number',$phoneNumber)->first();
 
    	if(empty($customerInfo))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Not Found!"
	    			 )
	    		]);
    	}

    	return  response()->json([
    		 "name" => $customerInfo->customer_name,
    		 "phone_number" => $customerInfo->customer_phone_number,
    		 "pincode" => $customerInfo->customer_pincode,
    		 "points" => $customerInfo->customer_points
    		]);

    }


    public function store(Request $request)
    {
    	$phone_number = $request->phone_number;
    	$name 		  = $request->name;
    	$pincode 	  = $request->pincode;
    	$password	  = $request->password;

    	if(empty(trim($phone_number)) ||
    	   empty(trim($name)) 		  ||
    	   empty(trim($pincode))	  ||
    	   empty(trim($password)))
    	{
    		return  response() -> json([
    				"error" => array(
    						"code" => "404",
    						"message" => "Not Found ! Invalid Inputs"
    					)
    			]);    				
    	}


    	$customerId = DB::table('customers')->insertGetId([
                	'customer_phone_number' => $request->phone_number,
                	'customer_name' => $request->name,
                	'customer_pincode' => $request->pincode,
                	'customer_password' =>  $request->password,
                	'customer_points' => 0
                	]); 

    	 if(empty($customerId))
    	 {
    		return  response() -> json([
    				"error" => array(
    						"code" => "404",
    						"message" => "Not Found ! Duplicates Inputs"
    					)
    			]);    	 	
    	 }	

         return $customerId;       	   	

    }


    public function authenticate(Request $request)
    {
        $phone_number = $request->phone_number;
        $password = $request->password;

        $customerInfo =  DB::table('customers')
                            ->where([['customer_phone_number','=',$phone_number],
                                    ['customer_password','=',$password]])->first(); 


        if(empty($customerInfo))
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
