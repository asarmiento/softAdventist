<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsertClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("INSERT INTO `clubs` (`id`, `name`, `ages`, `url_img`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'Aventureros', '4-9', '', '6', NULL, NULL), (NULL, 'Conquistadores', '10-15', '', '6', NULL, NULL), (NULL, 'Guias Mayores', '16+', '', '6', NULL, NULL), (NULL, 'Lider Juvenil', '16+', '', '6', NULL, NULL);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insert_clubs');
    }
}
