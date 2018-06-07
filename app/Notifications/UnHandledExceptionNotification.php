<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

/**
 * UnHandledExceptionNotification
 * Send notification to the user in case of unhandled exeption
 *
 * @author Bastien Nicoud
 * @package App\Notifications
 */
class UnHandledExceptionNotification extends Notification
{
    use Queueable;

    /**
     * @var Exeption
     */
    private $exception;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($exception)
    {
        $this->exception = $exception;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'exception_class' => get_class($this->exception),
            'exception_http_code' => $this->exception->getCode(),
            'exception_message' => $this->exception->getMessage(),
            'exception_file' => $this->exception->getFile(),
            'exception_line' => $this->exception->getLine(),
            'time' => Carbon::now()->toDateTimeString(),
            'current_page' => url()->current(),
            'previous_page' => url()->previous(),
            'route' => request()->route(),
            'user_id' => Auth::user() ? Auth::user()->id : null
            //'session' => request()->session()->all()
        ];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }
}
