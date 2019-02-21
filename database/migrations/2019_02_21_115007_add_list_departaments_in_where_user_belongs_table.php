<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddListDepartamentsInWhereUserBelongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('where_user_belongs', function (Blueprint $table) {
            $table->integer('list_departament_id')->unsigned()->index()->nullable()->after('union_id');
            //relation
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
        //
    }
}
