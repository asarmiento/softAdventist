<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class IncriptionsError extends Notification
{
    use Queueable;
    /**
     * @var
     */
    public $boy;

    /**
     * Create a new notification instance.
     *
     * @param $boy
     */
    public function __construct($boy)
    {
        //
        $this->boy = $boy;
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
                    ->greeting('Feliz Sabado')
                    ->line('Hola: '.$this->boy->user->nameComplete())
                    ->line('Hemos tenido un problema con algunos registros incluyendo el tuyo, y les estamos solcitando.')
                    ->line('Poder ingresar nuevamente al sistema de inscripción y poder registrar nuevamente el deposito que ya habian registrado')
                    ->action('Notification Action', url('/'))
                    ->line('Gracias por tu ayuda!');
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
