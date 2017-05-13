<?php
/**
 * Created by PhpStorm.
 * User: anwarsarmiento
 * Email: asarmiento@sistemasamigables.com
 * Date: 12/5/17
 * Time: 18:51
 */

namespace App\Http\Controllers;


use App\Entities\YoungBoy;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    use Notifiable;

    public function index()
    {
        $boys = YoungBoy::all();

        foreach ($boys AS $boy):

            if($boy->retirements()->count()>0):


            else:
                Mail::send('vendor/notifications/emailerror', compact('boy'), function ($e) use ($boy) {
                    $e->from('jaacscr@contadventista.org', 'Departamento de Jovenes ACSCR');
                    $e->to($boy->user->email, $boy->user->nameComplete())->subject('Ayuda');

                });
        \Log::info("emailError".$boy->user->email);
            endif;
        endforeach;
        die;
    }

}