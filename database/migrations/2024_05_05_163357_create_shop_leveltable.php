<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopLeveltable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_level', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('real_name',20)->default('')->comment('名称');
            $table->decimal('pv',12,2)->default(0)->comment('营业额');
            $table->string('tj_ratio',10)->default(0)->comment('推荐奖励');
            $table->string('jc_ratio',10)->default(0)->comment('极差奖励');
            $table->string('jf_ratio',10)->default(0)->comment('积分');
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
        Schema::dropIfExists('shop_level');
    }
}
