<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pid')->default(0);
            $table->integer('deep')->default(0);
            $table->longText('path')->nullable();
            $table->integer('level')->default(0);
            $table->integer('shop_level')->default(0);
            $table->string('mobile',40);
            $table->char('number',18)->unique()->comment('账号');
            $table->decimal('integral',12,2)->default(0)->comment('积分');
            $table->decimal('all_integral',12,2)->default(0)->comment('全部积分');
            $table->decimal('pv',12,2)->default(0)->comment('业绩');
            $table->decimal('divvy_pv',12,2)->default(0)->comment('分红业绩');
            $table->string('avatar',200)->default('')->comment('图像');
            $table->smallInteger('certificate_type')->default(2)->comment('证件类型');
            $table->string('real_name',50)->default('')->comment('真实姓名');
            $table->char('id_number',30)->default('')->comment('身份证号');
            $table->string('certificate_image',500)->default('')->comment('证件照');
            $table->smallInteger('is_active')->default(0)->comment('是否激活');
            $table->smallInteger('nation')->default(1)->comment('国家');
            $table->string('mobile_nation',15)->default('')->nullable()->comment('手机区号');



            $table->string('password',100);
            $table->string('last_ip', 64)->default('');
            $table->timestamp('last_login')->nullable();
            $table->smallInteger('is_disabled')->default(0);
            $table->timestamp('disabled_at')->nullable();
            $table->string('transaction_password',100)->nullable();
            $table->smallInteger('is_set_transaction_password')->default(0);

            $table->index(['mobile'], 'idx-mobile');

            $table->timestamps();
        });

        Schema::create('login_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');
            $table->string('ip', 30)->default('')->comment('登录IP');

            $table->timestamps();
        });

        Schema::create('integral_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');
            $table->integer('action')->comment('类型ID');
            $table->decimal('amount', 12, 2)->comment('变动数量');
            $table->decimal('balance_before', 20, 4)->comment('变动后数量');
            $table->decimal('balance_after', 20, 4)->comment('变动前数量');
            $table->string('remark',100);
            $table->bigInteger('related_id')->comment('关联id');

            $table->index(['member_id'], 'idx-member_id');
            $table->timestamps();
        });

        Schema::create('pv_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');
            $table->integer('action')->comment('类型ID');
            $table->decimal('amount', 12, 2)->comment('变动数量');
            $table->decimal('balance_before', 20, 4)->comment('变动后数量');
            $table->decimal('balance_after', 20, 4)->comment('变动前数量');
            $table->string('remark',100);
            $table->bigInteger('related_id')->comment('关联id');

            $table->index(['member_id'], 'idx-member_id');
            $table->timestamps();
        });

        for($i = 0;$i<\App\Member::SUBNUM;$i++){
            Schema::create('integral_logs_'.$i, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('bid')->default(0)->comment('总id');
                $table->bigInteger('member_id');
                $table->integer('action')->comment('类型ID');
                $table->decimal('amount', 12, 2)->comment('变动数量');
                $table->decimal('balance_before', 12, 2)->comment('变动后数量');
                $table->decimal('balance_after', 12, 2)->comment('变动前数量');
                $table->string('remark');
                $table->bigInteger('related_id')->comment('关联id');

                $table->index(['member_id'], 'idx-member_id');
                $table->index(['bid'], 'idx-bid');
                $table->timestamps();
            });

            Schema::create('pv_logs_'.$i, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('bid')->default(0)->comment('总id');
                $table->bigInteger('member_id');
                $table->integer('action')->comment('类型ID');
                $table->decimal('amount', 12, 2)->comment('变动数量');
                $table->decimal('balance_before', 20, 4)->comment('变动后数量');
                $table->decimal('balance_after', 20, 4)->comment('变动前数量');
                $table->string('remark',100);
                $table->bigInteger('related_id')->comment('关联id');

                $table->index(['member_id'], 'idx-member_id');
                $table->index(['bid'], 'idx-bid');
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('members');
        Schema::dropIfExists('integral_logs');
        Schema::dropIfExists('pv_logs');
        Schema::dropIfExists('login_log');
        for($i = 0;$i<\App\Member::SUBNUM;$i++){
            Schema::dropIfExists('members_'.$i);
            Schema::dropIfExists('integral_logs_'.$i);
            Schema::dropIfExists('pv_logs_'.$i);
        }
    }
}
