<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChurchDepositInternalControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('church_deposit_internal_controls', function(Blueprint $table) {
            $table->decimal('balance',20,2);
            $table->integer('church_deposit_id')->unsigned()->index();
            $table->integer('internal_control_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            //relation
            $table->foreign('church_deposit_id')->references('id')->on('church_deposits')->onDelete('no action');
            $table->foreign('internal_control_id')->references('id')->on('internal_controls')->onDelete('no action');
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
        Schema::drop('church_deposit_internal_controls');
    }
}
