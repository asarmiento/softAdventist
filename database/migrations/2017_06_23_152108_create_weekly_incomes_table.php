<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeklyIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('weekly_incomes', function(Blueprint $table) {
            $table->increments('id');
            $table->decimal('balance',20,2);
            $table->enum('status',['no aplicado','aplicado']);
            $table->integer('internal_control_id')->unsigned()->index();
            $table->integer('income_account_id')->unsigned()->index();
            $table->string('token');


            $table->foreign('internal_control_id')->references('id')->on('internal_controls')->onDelete('no action');
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
        Schema::drop('weekly_incomes');
    }
}
