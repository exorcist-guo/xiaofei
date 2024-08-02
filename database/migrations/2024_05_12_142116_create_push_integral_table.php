<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePushIntegralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_integral', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');
            $table->smallInteger('status')->default(0)->comment(' 1推送中,2推送成功');
            $table->decimal('amount', 12, 2)->comment('数量');
            $table->Integer('star_amount')->comment('铸源星数量');

            $table->index(['member_id'], 'idx-member_id');
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
        Schema::dropIfExists('push_integral');
    }
}
