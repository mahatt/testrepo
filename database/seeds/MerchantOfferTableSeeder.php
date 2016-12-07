<?php

use Illuminate\Database\Seeder;

class MerchantOfferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
                DB::table('merchant_offers')->insertGetId([
                	'merchant_phone_number' => '8790520855',
                	'merchant_offer_title' => 'Koolest Offer in Town',
                	'merchant_offer_description' => 'SOmething more cool description',
                	'created_at' =>  new DateTime(),
                	'updated_at' =>  new DateTime()
                	]);
    }
}
