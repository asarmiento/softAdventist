<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalFieldIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('local_field_incomes', function(Blueprint $table) {
            $table->increments('id');
            $table->decimal('balance', 20,2);
            $table->enum('status',['no aplicado','aplicado']);
            $table->text('token');
            $table->integer('local_field_income_account_id')->unsigned()->index();
            $table->integer('internal_control_id')->unsigned()->index();
            //relation
            $table->foreign('local_field_income_account_id')->references('id')->on('local_field_income_accounts')->onDelete('no action');
            $table->foreign('internal_control_id')->references('id')->on('internal_controls')->onDelete('no action');
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
        Schema::drop('local_field_incomes');
    }
}
