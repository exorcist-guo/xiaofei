<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');
            $table->bigInteger('admin_id')->comment('操作员ID');
            $table->bigInteger('audite_admin_id')->comment('审核员ID');
            $table->smallInteger('type')->default(0)->comment('1会员信息修改,2修改等级，3修改积分,4修改营业额');
            $table->smallInteger('status')->default(0)->comment('0待审核,1审核失败,2审核通过,3修改完成');
            $table->string('content')->comment('内容');

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
        Schema::dropIfExists('change_order');
    }
}
