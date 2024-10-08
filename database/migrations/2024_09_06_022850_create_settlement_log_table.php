<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlement_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bonus_settlement_id')->comment('结算id');
            $table->bigInteger('member_id')->comment('用户id');
            $table->smallInteger('type')->comment('类型');

            $table->decimal('amount',10,2)->comment('收益');
            $table->decimal('balance_after', 12, 2)->comment('变动后数量');
            $table->bigInteger('related_id')->comment('关联id');
            $table->decimal('yuan_amount',10,2)->comment('计算基数');
            $table->string('ratio')->comment('结算比率');
            $table->string('remark')->comment('备注');
            $table->timestamps();

            $table->index(['member_id','bonus_settlement_id'], 'idx-settlement-member_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settlement_log');
    }
}
