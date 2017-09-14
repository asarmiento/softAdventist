<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChurchLocalFieldIncomeAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('church_local_field_income_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('church_id')->unsigned()->index();
            $table->integer('l_f_income_account_id')->unsigned()->index();
            $table->decimal('balance',20,2);
            //relation
            $table->foreign('church_id')->references('id')->on('churches')->onDelete('no action');
            $table->foreign('l_f_income_account_id')->references('id')->on('local_field_income_accounts')->onDelete('no action');
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
        Schema::dropIfExists('church_local_field_income_accounts');
    }
}
