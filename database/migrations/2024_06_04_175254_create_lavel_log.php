<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLavelLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');
            $table->integer('action')->comment('类型');
            $table->smallInteger('type')->default(0)->comment('1等级 2社区等级');
            $table->smallInteger('level_before')->comment('变动前等级');
            $table->smallInteger('level_after')->comment('变动后等级');

            $table->timestamps();
        });

        Schema::table('shop_level', function (Blueprint $table) {
            $table->decimal('bazaar_pv',12,2)->after('pv')->default(0)->comment('新增市场业绩');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('level_log');
        Schema::table('shop_level', function (Blueprint $table) {
            $table->dropColumn(['bazaar_pv']);
        });
    }
}
