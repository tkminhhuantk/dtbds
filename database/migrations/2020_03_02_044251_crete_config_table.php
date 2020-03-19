<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreteConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('website_name')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->text('seo_head')->nullable();
            $table->text('logo')->nullable();
            $table->text('except')->nullable();
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->text('time')->nullable();
            $table->text('address')->nullable();
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
        //
    }
}
