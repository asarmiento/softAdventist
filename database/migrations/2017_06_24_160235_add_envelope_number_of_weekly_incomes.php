<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnvelopeNumberOfWeeklyIncomes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('weekly_incomes', function(Blueprint $table) {
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
        Schema::drop('weekly_incomes');
    }
}
