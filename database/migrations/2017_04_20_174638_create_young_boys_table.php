<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYoungBoysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('young_boys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('church');
            $table->string('age');
            $table->enum('gender',['man','woman']);
            $table->enum('shirt_size',['14','16','XS','S','M','L','XL','XXL']);
            $table->enum('payment_method',['Transferencia','Deposito','Caja ACSCR']);
            $table->decimal('amount',20,2);
            $table->string('bank');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
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
        Schema::dropIfExists('users');
    }
}
