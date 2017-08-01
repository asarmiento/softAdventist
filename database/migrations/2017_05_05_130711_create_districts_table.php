<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('districts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name',200);
            $table->string('shepherd',200);
            $table->text('token');
            $table->integer('local_field_id')->unsigned()->index();
            $table->foreign('local_field_id')->references('id')->on('local_fields')->onDelete('no action');
            $table->engine = 'InnoDB';
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('districts');
    }
}
