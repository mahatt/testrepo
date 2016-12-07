<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class LoyaltyTransactionController extends Controller
{
    //


    public function transfer(Request  $request)
    {
   		$customer_phone_number =  $request->customer_phone_number;
   		$merchant_phone_number =  $request->merchant_phone_number;   		
   		$offer_id			   =  $request->offer_id;

   		//TODO offer points should part of offer
   		$offer_cost =  10;

   		if(empty(trim($customer_phone_number)) ||
   			empty(trim($merchant_phone_number))||
   			empty(trim($offer_id)))
   		{
    		return  response() -> json([
    				"error" => array(
    						"code" => "404",
    						"message" => "Not Found ! Invalid Inputs"
    					)
    			]);      			
   		}	

   		// remove points from  merchant
   		$merchantinfo  =  DB::table('merchants')->where('merchant_phone_number',$merchant_phone_number)->first();

    	if(empty($merchantinfo))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Merchant Not Found!"
	    			 )
	    		]);
    	}   

    	if($merchantinfo->merchant_points - $offer_cost  < 0){

	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "403",
	    			 	"message"=> "Negative balance are Forbidden!"
	    			 )
	    		]);	   
    	}
  
    	$final_points = $merchantinfo->merchant_points - $offer_cost;
    	DB::table('merchants')->where('merchant_phone_number',$merchant_phone_number)->update(['merchant_points' => $final_points]);


   		$customerInfo   = DB::table('customers')->where('customer_phone_number',$customer_phone_number)->first();

    	if(empty($customerInfo))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Customer Not Found!"
	    			 )
	    		]);
    	} 

    	$final_points = $customerInfo->customer_points + $offer_cost;

   		// add points to customer
    	DB::table('customers')->where('customer_phone_number',$customer_phone_number)->update(['customer_points' => $final_points]);

    	return $merchant_phone_number;
    }



    public function claim(Request $request)
    {

   		$customer_phone_number =  $request->customer_phone_number;
   		$merchant_phone_number =  $request->merchant_phone_number;       	
    	$offer_id  =  $request->offer_id;
    	// TODO : This should be dynammic	
    	$offer_cost = 10;

   		if(empty(trim($customer_phone_number)) ||
   			empty(trim($merchant_phone_number))||
   			empty(trim($offer_id)))
   		{
    		return  response() -> json([
    				"error" => array(
    						"code" => "404",
    						"message" => "Not Found ! Invalid Inputs"
    					)
    			]);      			
   		}	


   		// remove points from  customer
   		$customerInfo   = DB::table('customers')->where('customer_phone_number',$customer_phone_number)->first();

    	if(empty($customerInfo))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Customer Not Found!"
	    			 )
	    		]);
    	} 

    	if($customerInfo->customer_points - $offer_cost  < 0){

	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "403",
	    			 	"message"=> "Negative balance are Forbidden!"
	    			 )
	    		]);	   
    	}

    	$final_points = $customerInfo->customer_points - $offer_cost;
   		// add points to customer
    	DB::table('customers')->where('customer_phone_number',$customer_phone_number)->update(['customer_points' => $final_points]);


   		$merchantinfo  =  DB::table('merchants')->where('merchant_phone_number',$merchant_phone_number)->first();

    	if(empty($merchantinfo))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Merchant Not Found!"
	    			 )
	    		]);
    	}   


    	$final_points = $merchantinfo->merchant_points + $offer_cost;  
    	DB::table('merchants')->where('merchant_phone_number',$merchant_phone_number)->update(['merchant_points' => $final_points]);
		return $customer_phone_number;

    }
}
