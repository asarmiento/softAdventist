<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusOfInternalControls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('internal_controls', function(Blueprint $table) {
            $table->enum('status',['no aplicado','aplicado'])->default('no aplicado')->after('saturday');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('internal_controls', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
