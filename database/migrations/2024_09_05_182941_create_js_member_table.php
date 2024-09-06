<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJsMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlement_member', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bonus_settlement_id')->comment('结算id');
            $table->bigInteger('member_id')->comment('用户id');
            $table->decimal('jihuo_amount')->comment('激活数量');
            $table->decimal('')->comment('积分');



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
        Schema::dropIfExists('settlement_member');
    }
}
