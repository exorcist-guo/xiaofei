<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePushOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('status')->default(0);
            $table->string('order_no',50)->unique()->comment('订单号');
            $table->string('type',20)->comment('类型');
            $table->bigInteger('related_id')->comment('关联id');
            $table->text('content')->comment('详细内容');


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
        Schema::dropIfExists('push_order');
    }
}
