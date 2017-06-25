<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSummaryOfWeeklyEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('summary_of_weekly_earnings', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->decimal('tithes',20,2);
            $table->decimal('offering',20,2);
            $table->decimal('forty',20,2);
            $table->decimal('sixty',20,2);
            $table->decimal('other',20,2);
            $table->string('token');
            $table->integer('internal_control_id')->unsigned()->index();
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
        Schema::drop('summary_of_weekly_earnings');
    }
}
