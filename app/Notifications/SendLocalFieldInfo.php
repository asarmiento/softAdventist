<?php

namespace App\Notifications;

use App\Entities\Check;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Storage;

class SendLocalFieldInfo extends Notification
{
    use Queueable;
	/**
	 * @var Check
	 */
	private $check;
	
	/**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Check $check)
    {
        //
	    $this->check = $check;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Informes de '.userChurch()->name )
                    ->line('Hola !' )
                    ->line('La iglesia de '. userChurch()->name. ' te esta enviando los informes siguientes:' )
                    ->action('Notification Action', url('/'))
                    /*->attach(response()->download(
	                    storage_path('app/'.$profile->avatar),
	                    'avatar.jpg',
	                    [],
	                    ResponseHeaderBag::DISPOSITION_INLINE
                    ))
                    */->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
