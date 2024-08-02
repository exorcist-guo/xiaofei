<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePvOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pv_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');
            $table->string('mobile',12)->comment('手机号');
            $table->decimal('amount', 12, 2)->comment('变动数量');
            $table->string('order_no',50)->unique()->comment('订单号');
            $table->smallInteger('status')->default(0);

            $table->index(['mobile'], 'idx-mobile');
            $table->timestamps();
        });

        Schema::create('integral_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');
            $table->string('mobile',12)->comment('手机号');
            $table->decimal('amount', 12, 2)->comment('变动数量');
            $table->string('order_no',50)->unique()->comment('订单号');
            $table->smallInteger('status')->default(0);

            $table->index(['mobile'], 'idx-mobile');
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
        Schema::dropIfExists('pv_order');
        Schema::dropIfExists('integral_order');
    }
}
