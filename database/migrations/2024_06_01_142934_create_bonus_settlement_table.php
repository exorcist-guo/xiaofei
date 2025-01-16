<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusSettlementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonus_settlement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('status')->default(0)->comment('结算状态');
            $table->bigInteger('admin_id')->default(0)->comment('操作员ID');
            $table->timestamp('start_time')->nullable()->comment('开始时间');
            $table->timestamp('end_time')->nullable()->comment('结束时间');

            $table->timestamps();
        });

        Schema::table('members', function (Blueprint $table) {
            $table->bigInteger('pid_shop_member_id')->default(0)->after('dikouquan')->comment('上级社区');
            $table->smallInteger('lock_shop_level')->default(0)->after('shop_level')->comment('0 自动升降级 1不自动');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonus_settlement');
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['pid_shop_member_id','lock_shop_level']);
        });
    }
}
