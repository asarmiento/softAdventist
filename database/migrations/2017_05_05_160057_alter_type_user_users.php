<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTypeUserUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table)  {
            $sql = "ALTER TABLE `users` CHANGE `type_user` `type_user` ENUM('joven','admin','cont') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL";
            DB::connection()->getPdo()->exec($sql);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_due_suppliers', function($table) {
            $table->decimal('amount',20,2)->change();
        });
    }
}
