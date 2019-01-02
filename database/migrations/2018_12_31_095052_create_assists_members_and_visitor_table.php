<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistsMembersAndVisitorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assists_members_and_visitor', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->time('time');
            $table->text('pray_request')->nullable();
            $table->boolean('liturgia')->default(false);
            $table->integer('member_id')->unsigned()->index()->nullable();
            $table->integer('visitor_id')->unsigned()->index()->nullable();
            $table->integer('user_id')->unsigned()->index();

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('no action');
            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assists_members_and_visitor');
    }
}
