<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameLastEmailYoungBoysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('young_boys', function(Blueprint $table) {
            $table->string('name',200)->after('code');
            $table->string('last_name',200)->after('name');
            $table->string('email',200)->after('last_name');
            $table->boolean('launch')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
