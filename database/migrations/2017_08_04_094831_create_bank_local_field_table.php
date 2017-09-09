<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankLocalFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_local_fields', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code',200);
            $table->string('name',200);
            $table->decimal('balance',20,2);
            $table->text('token');
            $table->integer('local_field_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            //relation
            $table->foreign('local_field_id')->references('id')->on('local_fields')->onDelete('no action');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->engine = 'InnoDB';
            $table->timestamps();
        });
        Schema::table('local_field_deposits', function (Blueprint $table) {
            $sql = "ALTER TABLE local_field_deposits DROP FOREIGN KEY local_field_deposits_local_field_id_foreign;";
            DB::connection()->getPdo()->exec($sql);
            $table->dropColumn('local_field_id');
        });

        Schema::table('local_field_deposits', function(Blueprint $table) {
            $table->integer('bank_local_field_id')->unsigned()->index()->after('user_id');
            //relation
            $table->foreign('bank_local_field_id')->references('id')->on('bank_local_fields')->onDelete('no action');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('bank_local_fields');

    }
}
