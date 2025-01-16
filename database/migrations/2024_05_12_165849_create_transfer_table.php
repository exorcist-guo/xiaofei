<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id')->comment('转出人ID');
            $table->bigInteger('c_member_id')->comment('收款人ID');;
            $table->decimal('amount', 12, 2)->comment('数量');
            $table->decimal('fee', 12, 2)->comment('手续费');
            $table->decimal('actual_amount', 12, 2)->comment('实际到账');

            $table->index(['member_id'], 'idx-member_id');
            $table->index(['c_member_id'], 'idx-c_member_id');
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
        Schema::dropIfExists('transfer');
    }
}
