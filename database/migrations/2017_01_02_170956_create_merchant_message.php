<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_messages', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('merchant_phone_number')->index();
            $table->string('message_title');
            $table->string('message_text');
            $table->timestamp('created_at')->index();        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('merchant_message');
    }
}
