<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retirements', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->enum('shirt_size',['14','16','XS','S','M','L','XL','XXL']);
            $table->enum('payment_method',['Transferencia','Deposito','Caja ACSCR']);
            $table->decimal('amount',20,2);
            $table->string('voucher');
            $table->string('bank');
            $table->integer('young_boy_id')->unsigned()->index();
            $table->foreign('young_boy_id')->references('id')->on('young_boys')->onDelete('no action');
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
        Schema::dropIfExists('retirements');
    }
}
