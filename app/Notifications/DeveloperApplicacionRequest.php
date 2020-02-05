<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeveloperApplicacionRequest extends Notification
{
    use Queueable;

    public $_developerId;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $developer_id )
    {
        //
        $this->_developerId = $developer_id;
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
        $url = route('admin.developers.application', ['developer_id' => $this->_developerId]);

        return (new MailMessage)
                    ->subject( __('Developer application') )
                    ->greeting( __('Hello!') )
                    ->line( 
                        __('A user has applied to be a developer into the platform.' ) . ' ' .
                        __('Please, click the link below to enter and see the information about it.') . ' ' .
                        __('For security reasons, it is not possible to show it into this email.')
                    )
                    ->action( __('Make a decition') , $url )
                    ->line(__('Be careful and make a good decition.'));
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
