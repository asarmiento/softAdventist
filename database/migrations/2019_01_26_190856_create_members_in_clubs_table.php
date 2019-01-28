<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersInClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members_in_clubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_gm')->nullable();
            $table->string('code_lj')->nullable();
            $table->date('date');
            $table->boolean('status')->default(false);
            $table->integer('member_id')->unsigned()->index();
            $table->integer('club_director_id')->unsigned()->index()->nullable();
            $table->integer('church_id')->unsigned()->index();
            $table->integer('club_card_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->timestamps();
            //relation
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('no action');
            $table->foreign('club_director_id')->references('id')->on('club_directors')->onDelete('no action');
            $table->foreign('church_id')->references('id')->on('churches')->onDelete('no action');
            $table->foreign('club_card_id')->references('id')->on('club_cards')->onDelete('no action');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members_in_clubs');
    }
}
