<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChengeColumnsOfDepartaments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departaments', function(Blueprint $table) {
           // $table->dropColumn('name');
            $table->integer('list_departament_id')->unsigned()->index()->after('id');
            $table->enum('status',['activo','desactivo'])->after('balance');
            $table->enum('authorized',['yes','no'])->after('status');
            //
            $table->foreign('list_departament_id')->references('id')->on('list_departaments')->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departaments', function (Blueprint $table) {
            $table->dropColumn('balance');
        });
    }
}
