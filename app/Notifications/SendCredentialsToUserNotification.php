<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;

/**
 * SendCredentialsToUserNotification
 * Send mail notification to the user with a random pass.
 *
 * @author Bastien Nicoud
 * @package App\Notifications
 */
class SendCredentialsToUserNotification extends Notification
{
    use Queueable;
    /**
     * @var User
     */
    private $user;
    private $pass;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     */
    public function __construct(User $user, $pass)
    {
        $this->user = $user;
        $this->pass = $pass;
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
                    ->subject('Vos identifiants Runners')
                    ->greeting('Vos identifiants Runners')
                    ->line("Bojour {$this->user->firstname}, voici vos identifiants pour vous connecter a Runners.")
                    ->line('Suivez le lien, et renseignez vous identifiants.')
                    ->line('Une fois connecté, changez immédiatement votre mot de passe.')
                    ->action('Se connecter', url('/login'))
                    ->line("E-mail de connexion : **{$this->user->email}**")
                    ->line("Mot de passe : **$this->pass**");
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
