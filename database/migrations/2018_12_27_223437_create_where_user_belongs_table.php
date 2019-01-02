<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhereUserBelongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('where_user_belongs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->enum('cargo',['presidente','tesorero','secretario','departamental','pastor','director','digitador','miembro']);
            $table->integer('church_id')->unsigned()->index()->nullable();
            $table->integer('local_field_id')->unsigned()->index()->nullable();
            $table->integer('union_id')->unsigned()->index()->nullable();
            //relation
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('church_id')->references('id')->on('churches')->onDelete('no action');
            $table->foreign('local_field_id')->references('id')->on('local_fields')->onDelete('no action');
            $table->foreign('union_id')->references('id')->on('unions')->onDelete('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('where_user_belongs');
    }
}
