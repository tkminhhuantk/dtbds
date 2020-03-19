<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->text('slug')->unique();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('address');
            $table->text('price');
            $table->text('seo_head')->nullable();
            $table->text('except')->nullable();
            $table->boolean('seo');
            $table->text('url_images')->nullable();
            $table->text('overview')->nullable();
            $table->bigInteger('investor_id');
            $table->bigInteger('category_id');
            $table->text('map')->nullable();
            $table->bigInteger('view')->default(0);
            $table->integer('state');
            $table->boolean('status');
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
        Schema::dropIfExists('projects');
    }
}
