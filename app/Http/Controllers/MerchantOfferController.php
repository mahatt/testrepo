<?php

namespace App\Http\Controllers;

use DB;
use DateTime;
use Illuminate\Http\Request;

class MerchantOfferController extends Controller
{
    //

    public  function  getByPhoneNumber(Request $request){

    	$phone_number  = $request->phone_number;
    	$step		   = $request->step;
    	$offset 	   = $request->offset;

    	// Find out clever way to do this paginate
    	if(empty(trim($phone_number)))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Not Found! Imcomplete Details for Offer"
	    			 )
	    		]);    			    		
    	}

    	if(empty(trim($step)))
    	{
    		$step = 10;
    	}

    	if(empty(trim($offset)))
    	{
    		$offset = 0;
    	}

     	$merchantInfo =  DB::table('merchants')->where('merchant_phone_number',$phone_number)->first();
 

      	if(empty($merchantInfo))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Not Found! Merchant is Invalid"
	    			 )
	    		]);
    	}



    	$offers = DB::table('merchant_offers')->where('merchant_phone_number',$phone_number)
    								->orderBy('created_at', 'desc')
    								->offset($offset)
    								->limit($step)
    								->get();

    	return json_encode($offers);							
    }


    public  function  store(Request $request){

    	$offer_text =  $request->offer_text;
    	$offer_title =  $request->offer_title;
    	$phone_number = $request->phone_number;


    	//check if either of them is empty return error

    	if (empty(trim($offer_title)) ||
    		empty(trim($offer_text))  ||
    		empty(trim($phone_number)))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Not Found! Imcomplete Details for Offer"
	    			 )
	    		]);    				
    	}	

	
    	// check if merchant exist
     	$merchantInfo =  DB::table('merchants')->where('merchant_phone_number',$phone_number)->first();
 

      	if(empty($merchantInfo))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Not Found! Merchant is Invalid"
	    			 )
	    		]);
    	}

    
    	//insert into table 


        $offerid = DB::table('merchant_offers')->insertGetId([
                    'merchant_phone_number' => $phone_number,
                	'merchant_offer_title' => $offer_title,
                	'merchant_offer_description' =>  $offer_text,
                	'created_at' =>  new DateTime,
                	'updated_at' =>  new DateTime
                	]);


       return DB::table('merchant_offers')->where('id',$offerid)->first();
    }



    public  function  remove(Request $request){

    	$offerid =  $request->offer_id;
    	$phone_number = $request->phone_number;

    	// Find out clever way to do this paginate
    	if(empty(trim($phone_number))||
    		empty(trim($offerid)))
    	{
	    	return  response()->json([
	    			"error" => array(
	    			 	"code" => "404",
	    			 	"message"=> "Not Found! Imcomplete Details for Offer"
	    			 )
	    		]);    			    		
    	}  



    	DB::table('merchant_offers')->where([['merchant_phone_number','=' ,$phone_number],
    										 ['id','=',$offerid]])->delete();

    	return  $request->phone_number;
    }


    public function getByPincode(Request $request){
        $pincode = $request->pincode;
        $step  = $request->step;
        $offset = $request->offset;

        if(empty(trim($pincode)))
        {
            return  response()->json([
                    "error" => array(
                        "code" => "404",
                        "message"=> "Not Found! Imcomplete Details for Offer"
                     )
                ]);                         
        }  

        if(empty(trim($step)))
        {
            $step = 10;
        }

        if(empty(trim($step)))
        {
            $offset = 0;
        }


        // TODO:  Add pattern for  pincode to cvoer more areas
        // pincode equality is optimistic    
        $offers = DB::table('merchant_offers')
                  ->join('merchants','merchants.merchant_phone_number','=','merchant_offers.merchant_phone_number')
                  ->select('merchant_offers.*')
                  ->where('merchants.merchant_pincode',$pincode)
                  ->offset($offset)
                  ->limit($step)
                  ->get();

        return json_encode($offers);        

    }

    public function getByCategory(Request $request){
        $pincode = $request->pincode;
        $category = $request->category;
        $step  = $request->step;
        $offset = $request->offset;

        if(empty(trim($pincode)) ||
            empty(trim($category)))
        {
            return  response()->json([
                    "error" => array(
                        "code" => "404",
                        "message"=> "Not Found! Imcomplete Details for Offer"
                     )
                ]);                         
        }  

        if(empty(trim($step)))
        {
            $step = 10;
        }

        if(empty(trim($step)))
        {
            $offset = 0;
        }


        // TODO:  Add pattern for  pincode to cvoer more areas
        // pincode equality is optimistic    
        $offers = DB::table('merchant_offers')
                  ->join('merchants','merchants.merchant_phone_number','=','merchant_offers.merchant_phone_number')
                  ->select('merchant_offers.*')
                  ->where([['merchants.merchant_pincode',$pincode],
                           ['merchants.merchant_category',$category]])
                  ->offset($offset)
                  ->limit($step)
                  ->get();

        return json_encode($offers);        

    }

}

