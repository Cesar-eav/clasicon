<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LikeNotification extends Notification
{
    use Queueable;

      // Definir las propiedades para $liker y $recommendation
      protected $liker;
      protected $recommendation;

    /**
     * Create a new notification instance.
     */
    public function __construct($liker, $recommendation)

    {
        $this->liker = $liker;
        $this->recommendation = $recommendation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'liker_id' => $this->liker->id,
            'liker_name' => $this->liker->name,
            'recommendation_id' => $this->recommendation->id,
            'recommendation_title' => $this->recommendation->title,
            'message' => $this->liker->name . ' le ha dado me gusta a <span class="font-bold">"' . $this->recommendation->title . '"</span>',
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
