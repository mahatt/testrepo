<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OnetimePasswords', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_number')->index();
            $table->string('code');
            $table->integer('used');
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
        //
    }
}
