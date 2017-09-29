<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageOfLocalFieldDeposits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('local_field_deposits', function(Blueprint $table) {
		     $table->string('image',200)->after('balance');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('local_field_deposits', function(Blueprint $table) {
		    $table->dropColumn('avatar');
	    });
    
    }
}
