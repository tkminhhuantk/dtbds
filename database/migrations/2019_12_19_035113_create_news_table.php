<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->text('slug')->unique();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->string('link_avatar')->nullable();
            $table->text('seo_head')->nullable();
            $table->text('except')->nullable();
            $table->text('content')->nullable();
            $table->boolean('status');
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('news');
    }
}
