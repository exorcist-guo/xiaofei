<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');
            $table->smallInteger('type')->default(0)->comment('类型');
            $table->bigInteger('admin_id')->default(0)->comment('操作员ID');
            $table->string('mobile',15)->comment('联系电话');
            $table->string('name',15)->comment('姓名');

            $table->smallInteger('status')->default(0)->comment(' 0未回复,1已回复');
            $table->timestamp('question')->comment('问题');
            $table->string('reply')->default('')->comment('回复');

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
        Schema::dropIfExists('message');
    }
}
