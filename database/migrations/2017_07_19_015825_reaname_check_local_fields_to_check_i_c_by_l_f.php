<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReanameCheckLocalFieldsToCheckICByLF extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //  Schema::rename('check_local_fields', 'check_i_c_by_l_f');
        Schema::table('check_i_c_by_l_f', function(Blueprint $table) {
            $table->integer('internal_control_id')->unsigned()->index();
            //relation
            $table->foreign('internal_control_id')->references('id')->on('internal_controls')->onDelete('no action');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('check_i_c_by_l_f', 'check_local_fields');
        Schema::table('check_local_fields', function(Blueprint $table) {
            $table->dropForeign(['internal_control_id']);
            $table->dropIndex(['internal_control_id']);
            $table->dropColumn('internal_control_id');
            $table->integer('local_field_id')->unsigned()->index();
            //relation
            $table->foreign('local_field_id')->references('id')->on('local_fields')->onDelete('no action');
        });
    }
}
