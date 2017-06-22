<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomeAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('income_accounts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->decimal('balance', 20,2);
            $table->string('token');
            $table->integer('departament_id')->unsigned()->index();
            $table->foreign('departament_id')->references('id')->on('departaments')->onDelete('no action');
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
        Schema::drop('income_accounts');
    }
}
