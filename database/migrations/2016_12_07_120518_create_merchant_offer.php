<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantOffer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_offers', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('merchant_phone_number')->index();
            $table->string('merchant_offer_title');
            $table->string('merchant_offer_description');        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_offers');
    }
}
