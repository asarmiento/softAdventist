<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubDirectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club_directors', function (Blueprint $table) {
            $table->increments('id');
            $table->year('year')->unsigned()->index();
            $table->integer('member_id')->unsigned()->index();
            $table->integer('club_id')->unsigned()->index();
            $table->integer('church_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->timestamps();
            //relation
            $table->foreign('member_id')->references('id')->on('members')->onDelete('no action');
            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('no action');
            $table->foreign('church_id')->references('id')->on('churches')->onDelete('no action');
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
        Schema::dropIfExists('club_directors');
    }
}
