<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnionIdOfLocalFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('local_fields', function(Blueprint $table) {
            $table->integer('union_id')->unsigned()->index()->after('email')->nullable();
            //relation
            $table->foreign('union_id')->references('id')->on('unions')->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('local_fields', function(Blueprint $table) {
            $table->dropColumn('union_id');
        });
    }
}
