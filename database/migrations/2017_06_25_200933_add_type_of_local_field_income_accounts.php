<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeOfLocalFieldIncomeAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('local_field_income_accounts', function(Blueprint $table) {
            $table->enum('type',['diez','offren','temp'])->default('temp')->after('balance');
           });

        Schema::table('local_field_incomes', function(Blueprint $table) {
            $table->integer('envelope_number')->unsigned()->after('id');
            $table->integer('member_id')->unsigned()->index()->after('status');
            //relations
            $table->foreign('member_id')->references('id')->on('members')->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('local_field_income_accounts', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('local_field_income_accounts', function (Blueprint $table) {
            $table->dropColumn('envelope_number');
            $table->dropForeign('member_id');
            $table->dropColumn('member_id');
        });
    }
}
