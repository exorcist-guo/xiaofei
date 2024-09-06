<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDikouquanLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dikouquan_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');
            $table->integer('action')->comment('类型ID');
            $table->smallInteger('type')->default(0)->comment('1冻结 2可用');
            $table->decimal('amount', 12, 2)->comment('变动数量');
            $table->decimal('balance_before', 12, 2)->comment('变动后数量');
            $table->decimal('balance_after', 12, 2)->comment('变动前数量');
            $table->string('remark',100);
            $table->bigInteger('related_id')->comment('关联id');

            $table->index(['member_id'], 'idx-member_id');
            $table->timestamps();
        });
        Schema::table('members', function (Blueprint $table) {
            $table->bigInteger('shop_member_id')->default(0)->after('divvy_pv')->comment('所属社区');
            $table->decimal('dikouquan',12,2)->after('divvy_pv')->default(0)->comment('抵扣券数量');
            $table->decimal('dikouquan_k',12,2)->after('divvy_pv')->default(0)->comment('可用抵扣券数量');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dikouquan_log');
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['dikouquan','shop_member_id']);
        });
    }
}
