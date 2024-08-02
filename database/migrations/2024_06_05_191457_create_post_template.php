<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_template', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',30)->default('')->comment('模版名称');
            $table->string('mobanurl')->default('')->comment('模版URL');
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
        Schema::dropIfExists('post_template');
    }
}
