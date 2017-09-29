<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvatarOfUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('users', function(Blueprint $table) {
		    $sql = "ALTER TABLE `users` CHANGE `type_user` `type_user` ENUM('admin','dia','union','campo','church','event','shepherds') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL";
		    DB::connection()->getPdo()->exec($sql);
		    $sql = "ALTER TABLE `users` CHANGE `password` `password` VARCHAR(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
		    DB::connection()->getPdo()->exec($sql);
		    $table->string('avatar',150)->after('password');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('users', function(Blueprint $table) {
		    $table->dropColumn('avatar');
	    });
    }
}
