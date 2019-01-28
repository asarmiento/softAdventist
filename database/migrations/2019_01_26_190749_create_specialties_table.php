<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('url_img');
            $table->string('url_quiz');
            $table->string('url_book');
            $table->integer('local_field_id')->unsigned()->index();
            $table->integer('prerequisite_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->timestamps();
            //relation
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('prerequisite_id')->references('id')->on('specialties')->onDelete('no action');
            $table->foreign('local_field_id')->references('id')->on('local_fields')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialties');
    }
}
