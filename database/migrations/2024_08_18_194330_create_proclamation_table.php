<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProclamationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proclamation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',50)->nullable();
            $table->text('description');
            $table->text('abstract');
            $table->integer('sort')->default(10);
            $table->tinyInteger('issue')->default(1);
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
        Schema::dropIfExists('proclamation');
    }
}
