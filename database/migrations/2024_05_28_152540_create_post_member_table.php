<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_member', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('status')->default(0)->comment('0待检验 1弃用, 3异常,4待导入,6导入异常 7成功');
            $table->bigInteger('pici')->comment('导入批次');
            $table->string('mobile',15)->default(0);

            $table->string('pid_id_number',18)->default(0)->comment('上级身份证号');
            $table->char('number',18)->default('')->comment('账号');
            $table->string('real_name',30)->default('')->comment('真实姓名');
            $table->char('id_number',18)->default('')->comment('身份证号');
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
        Schema::dropIfExists('post_member');
    }
}
