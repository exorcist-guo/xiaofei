<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivvyPvLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divvy_pv_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');

            $table->decimal('amount', 12, 2)->comment('变动数量');
            $table->decimal('award_amount', 12, 2)->comment('奖励数量');
            $table->bigInteger('s_member_id');
            $table->decimal('s_award_amount', 12, 2)->comment('上级奖励数量');

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
        Schema::dropIfExists('divvy_pv_logs');
    }
}
