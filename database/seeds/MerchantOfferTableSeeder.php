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
                $expire_at =  new DateTime();
                $expire_at->add(new DateInterval('P3D'));

                DB::table('merchant_offers')->insertGetId([
                	'merchant_phone_number' => '1122334455',
                	'merchant_offer_title' => 'Koolest Offer in Town',
                	'merchant_offer_description' => 'SOmething more cool description',
                    'expires_at' => $expire_at,
                	'created_at' =>  new DateTime(),
                	'updated_at' =>  new DateTime()
                	]);
    }
}
