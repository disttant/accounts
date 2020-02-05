<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeveloperApplicacionResult extends Notification
{
    use Queueable;


    public $_result;
    public $_message;



    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $result, $message )
    {
        //
        $this->_result   = $result;
        $this->_message  = $message;
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
                    ->subject( __('Developer application result') )
                    ->greeting( __('Hello!') )
                    ->line( 
                        __('You asked us for being developer and this is a hand made process.' ) . ' ' .
                        __('We inspect each request in order to keep our high quality standards.') . ' ' .
                        __('As a developer, you accepted our TOS and our Privacy Policy,'). ' ' .
                        __('and sent us some data that can not be changed because of the verification.')
                    )
                    ->line( __('Your developing application has been: :result', ['result' => $this->_result]) )
                    ->line(
                        __('As we said before, there is a person behing each developing application') . ' ' .
                        __('so we check all requests by hand.') . ' ' .
                        __('Because we love your effort, asked our team to send you a message') . ' ' .
                        __('giving information about the status of the application and why.') . ' ' .
                        __('So the following words are just for you:') . ' '
                    )
                    ->line( $this->_message )
                    ->line('Thank you for using our services!');
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
