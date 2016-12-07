<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
                DB::table('customers')->insertGetId([
                	'customer_phone_number' => '8790520855',
                	'customer_name' => 'Rahuhl',
                	'customer_pincode' => '425001',
                	'customer_password' =>  '0',
                	'customer_points' => 0
                	]);
    }
}
