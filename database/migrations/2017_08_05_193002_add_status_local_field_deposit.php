<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusLocalFieldDeposit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('check_i_c_by_l_f', function(Blueprint $table) {
            $table->enum('status',['no aplicado','aplicado'])->default('no aplicado')->after('balance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('check_i_c_by_l_f', function(Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
