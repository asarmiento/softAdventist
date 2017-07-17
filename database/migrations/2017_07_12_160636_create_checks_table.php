<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('number');
            $table->string('image');
            $table->date('date');
            $table->text('detail');
            $table->decimal('balance',20,2);
            $table->enum('type',['church','local_field']);
            $table->enum('status',['no aplicado','aplicado']);
            $table->text('token');
            $table->integer('bank_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            //relation
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('no action');
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
        Schema::drop('checks');
    }
}
