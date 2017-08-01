<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_expenses', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('reference')->unsigned()->nullabel();
            $table->string('number',200);
            $table->date('date');
            $table->text('detail');
            $table->string('image',200);
            $table->decimal('balance',20,2);
            $table->enum('status',['no aplicado','aplicado'])->default('no aplicado');
            $table->text('token');
            $table->integer('expense_account_id')->unsigned()->index();
            $table->integer('check_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            //relation
            $table->foreign('expense_account_id')->references('id')->on('expense_accounts')->onDelete('no action');
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
        Schema::drop('check_expenses');
    }
}
