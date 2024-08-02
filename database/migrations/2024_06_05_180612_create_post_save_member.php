<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostSaveMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_save_member', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');
            $table->bigInteger('admin_id')->comment('操作员ID');
            $table->bigInteger('audite_admin_id')->comment('审核员ID');
            $table->smallInteger('status')->default(0)->comment('0待检验 1弃用, 3异常,4待导入,6修改异常 7成功');
            $table->smallInteger('type')->default(0)->comment('1会员信息修改,2修改等级，3修改积分,4修改营业额');
            $table->bigInteger('pici')->comment('导入批次');
            $table->string('content')->comment('内容');

            $table->string('error')->default('')->comment('错误');
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
        Schema::dropIfExists('post_save_member');
    }
}
