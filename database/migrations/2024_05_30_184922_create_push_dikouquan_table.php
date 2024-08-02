<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePushDikouquanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_dikouquan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');
            $table->smallInteger('status')->default(0)->comment(' 1推送中,2推送成功');
            $table->decimal('amount', 12, 2)->comment('数量');
            $table->Integer('dikou_amount')->comment('抵扣券数量');


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
        Schema::dropIfExists('push_dikouquan');
    }
}
