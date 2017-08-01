<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalFieldIncomeAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('local_field_income_accounts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->decimal('balance', 20,2);
            $table->text('token');
            $table->integer('local_field_id')->unsigned()->index();
            $table->foreign('local_field_id')->references('id')->on('local_fields')->onDelete('no action');
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
        Schema::drop('local_field_income_accounts');
    }
}
