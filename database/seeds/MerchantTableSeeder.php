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
        	'merchant_phone_number' => '87905200855',
        	'merchant_name' => 'mahesh',
        	'merchant_emailid'  => 'mahesh@gmail.com',
        	'merchant_points'  => '0',
        	'merchant_enable'  => '1'   // enable by default
        	]);
    }
}
