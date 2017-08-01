<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('expense_accounts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->decimal('balance', 20,2);
            $table->text('token');
            $table->integer('income_account_id')->unsigned()->index();
            $table->foreign('income_account_id')->references('id')->on('income_accounts')->onDelete('no action');
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
        Schema::drop('expense_accounts');
    }
}
