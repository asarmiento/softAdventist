<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckICByLFTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_i_c_by_l_f', function(Blueprint $table) {
            $table->increments('id');
            $table->decimal('balance',20,2);
            $table->text('token');
            $table->integer('internal_control_id')->unsigned()->index();
            $table->integer('check_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            //relation
            $table->foreign('internal_control_id')->references('id')->on('internal_controls')->onDelete('no action');
            $table->foreign('check_id')->references('id')->on('checks')->onDelete('no action');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
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
        Schema::drop('check_i_c_by_l_f');
    }
}
