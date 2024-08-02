<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewPerformanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_performance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');
            $table->smallInteger('status')->default(0)->comment('0 未发放 1已发放');
            $table->integer('bonus_id')->comment('结算id');
            $table->smallInteger('type')->default(0)->comment('1个人业绩  2市场业绩');
            $table->decimal('performance',10,2)->comment('新增业绩');
            $table->decimal('grant',10,2)->default(0)->comment('发放金额');

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
        Schema::dropIfExists('new_performance');
    }
}
