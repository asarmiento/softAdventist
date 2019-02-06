<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberClubByClubCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_club_by_club_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_club_id')->unsigned()->index();
            $table->integer('club_card_id')->unsigned()->index();
            $table->timestamps();
            //relation
            $table->foreign('member_club_id')->references('id')->on('members_in_clubs')->onDelete('no action');
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
        Schema::dropIfExists('member_club_by_club_cards');
    }
}
