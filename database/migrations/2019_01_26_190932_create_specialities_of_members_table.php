<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialitiesOfMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialities_of_members', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->boolean('status')->default(false);
            $table->string('other_instructor');
            $table->integer('member_id')->unsigned()->index();
            $table->integer('member_in_club_id')->unsigned()->nullable();
            $table->integer('church_id')->unsigned()->index();
            $table->integer('specialty_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->timestamps();
            //relation
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('no action');
            $table->foreign('member_in_club_id')->references('id')->on('members_in_clubs')->onDelete('no action');
            $table->foreign('church_id')->references('id')->on('churches')->onDelete('no action');
            $table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialities_of_members');
    }
}
