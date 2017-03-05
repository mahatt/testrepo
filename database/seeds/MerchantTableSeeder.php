<?php

use Illuminate\Database\Seeder;

class MerchantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('merchants')->insert([
        	'merchant_id' => 1,
        	'merchant_phone_number' => '1122334455',
        	'merchant_name' => 'TestModi',
        	'merchant_pincode'  => '425001',
        	'merchant_points'  => '0',
        	'merchant_enable'  => '1' ,  // enable by default
            'merchant_category' => 'dining',
            'merchant_password' => '111'
        	]);
    }
}
