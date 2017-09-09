<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsForChurches extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('churches', function (Blueprint $table) {
            $table->string('url',100)->after('name');
            $table->string('phone',80)->after('url');
            $table->string('email',80)->after('phone');
            $table->integer('user_id')->unsigned()->after('district_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('churches', function (Blueprint $table) {
            $table->dropColumn('url');
            $table->dropColumn('treasurer');
        });
    }
}
