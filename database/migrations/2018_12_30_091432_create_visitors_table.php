<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->string('name',60)->nullable()->after('date');
            $table->string('last_name',100)->nullable()->after('name');
            $table->string('phone',15)->nullable()->after('last_name');
            $table->string('email',200)->nullable()->after('phone');
            $table->text('address')->nullable()->after('email');
            $table->integer('user_id')->unsigned()->index()->after('address');
            $table->integer('church_id')->unsigned()->index()->after('address');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('church_id')->references('id')->on('churchs')->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
