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
            $table->smallInteger('status')->default(0)->nullable()->comment('状态');
            $table->decimal('jh',10,2)->comment('激活数量');
            $table->decimal('jc',10,2)->comment('极差');
            $table->decimal('tj',10,2)->comment('推荐');
            $table->decimal('fw',10,2)->comment('服务');
            $table->decimal('bt',10,2)->comment('补贴');
            $table->decimal('cx',12,2)->comment('促销奖');

            $table->decimal('yj',12,2)->comment('业绩');
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
