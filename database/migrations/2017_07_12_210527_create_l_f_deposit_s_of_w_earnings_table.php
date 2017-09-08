<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLFDepositSOfWEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_f_deposit_s_of_w_earnings', function(Blueprint $table) {
            $table->decimal('balance',20,2);
            $table->integer('local_field_deposit_id')->unsigned()->index();
            $table->integer('summary_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            //relation
            $table->foreign('local_field_deposit_id')->references('id')->on('local_field_deposits')->onDelete('no action');
            $table->foreign('summary_id')->references('id')->on('summary_of_weekly_earnings')->onDelete('no action');
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
        Schema::drop('l_f_deposit_s_of_w_earnings');
    }
}
