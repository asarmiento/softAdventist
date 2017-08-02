<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternalControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('internal_controls', function(Blueprint $table) {
            $table->increments('id');
            $table->string('image',250);
            $table->integer('number');
            $table->decimal('balance', 20,2);
            $table->string('number_of_envelopes',200);
            $table->date('saturday');
            $table->text('token');
            $table->integer('church_id')->unsigned()->index();
            $table->foreign('church_id')->references('id')->on('churches')->onDelete('no action');
            $table->engine = 'InnoDB';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('internal_controls');
    }
}
