<?php
/**
 * Created by PhpStorm.
 * User: anwarsarmiento
 * Email: asarmiento@sistemasamigables.com
 * Date: 12/5/17
 * Time: 18:51
 */

namespace App\Http\Controllers;


use App\Entities\User;
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
                Mail::send('vendor/notifications/emailerror', compact('boy'), function ($e) use ($boy) {
                    $e->from('jaacscr@contadventista.org', 'Departamento de Jovenes ACSCR');
                    $e->attach(asset('img/AUTORIZACION.pdf'));
                    $e->attach(asset('img/MI_MALETA.pdf'));
                    $e->attach(asset('img/POLIZA.pdf'));
                    $e->attach(asset('img/REGLAMENTO.pdf'));
                    $e->to($boy->user->email, $boy->user->nameComplete())->subject('Corrigiendo Saldo');
                });

            else:
                

        \Log::info("emailError".$boy->user->email);
            endif;
        endforeach;
       
    }
    public function pendiente()
    {
        $boys = YoungBoy::all();

        foreach ($boys AS $boy):

            if((38500-$boy->retirements()->sum('amount')) > 0):
                Mail::send('vendor/notifications/pendiente', compact('boy'), function ($e) use ($boy) {
                    $e->from('jaacscr@contadventista.org', 'Departamento de Jovenes ACSCR');
                   $e->to($boy->user->email, $boy->user->nameComplete())->subject('Corrigiendo Saldo');
                });

            else:


        \Log::info("emailError".$boy->user->email);
            endif;
        endforeach;
return redirect('/registrado/inscription');
    }


    public function message()
    {
        $users = User::all();

        foreach ($users AS $user):



                Mail::send('vendor/notifications/emailInvitacion', compact('user'), function ($e) use ($user) {
                    $e->from('jaacscr@contadventista.org', 'Departamento de Jovenes ACSCR');
                    $e->to($user->email, $user->nameComplete())->subject('Revisión');
                });
                \Log::info("emailError".$user->email);


        endforeach;
        die;
    }

    public function ver()
    {
        $boy = YoungBoy::find(12);
        return view('vendor.notifications.emailerror',compact('boy'));
    }



}
