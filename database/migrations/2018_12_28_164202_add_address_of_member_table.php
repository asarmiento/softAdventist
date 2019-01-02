<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressOfMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function(Blueprint $table) {
            $table->string('address',200)->after('birthdate');
            $table->enum('civil_status',['Casado(a)','Soltero(a)','Union Libre'])->after('address');
        });
        DB::statement("ALTER TABLE `members` CHANGE `charter` `charter` VARCHAR(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL, CHANGE `bautizmoDate` `bautizmoDate` DATE NULL, CHANGE `birthdate` `birthdate` DATE NULL, CHANGE `address` `address` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL, CHANGE `phone` `phone` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL, CHANGE `cell` `cell` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL, CHANGE `email` `email` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function(Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('civil_status');
        });
    }
}
