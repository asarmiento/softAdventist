<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsertClubCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("INSERT INTO `club_cards` (`id`, `name`, `age`, `description`, `url_card`, `url_book`, `local_field_id`, `club_id`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'Amigo', '9', '', '', '', '1', '6', '6', '2019-01-26 00:00:00', '2019-01-26 00:00:00'), (NULL, 'Guias Mayores', '16+', '', '', '', '1', '7', '6', '2019-01-26 00:00:00', '2019-01-26 00:00:00');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insert_club_cards');
    }
}
