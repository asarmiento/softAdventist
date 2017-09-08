<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherChurchSummaryWeekly extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('summary_of_weekly_earnings', function(Blueprint $table) {
            $table->decimal('other_church',20,2)->after('other');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('summary_of_weekly_earnings', function (Blueprint $table) {
            $table->dropColumn('other_church');
        });
    }
}
