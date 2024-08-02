<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');
            $table->smallInteger('status')->default(0)->comment('0待审核,1审核失败,2已完成');
            $table->decimal('amount', 12, 2)->comment('数量');
            $table->decimal('fee', 12, 2)->comment('手续费');
            $table->decimal('actual_amount', 12, 2)->comment('实际到账');
            $table->string('name',30)->default('')->comment('姓名');
            $table->string('card_name',30)->default('')->comment('银行名称');
            $table->string('card_number',30)->default('')->comment('银行卡号');

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
        Schema::dropIfExists('withdrawal');
    }
}
