<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDistrictIdOfChurches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('churches', function(Blueprint $table) {
            $table->integer('district_id')->unsigned()->index()->after('latitud');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('no action');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('churches');
    }
}
