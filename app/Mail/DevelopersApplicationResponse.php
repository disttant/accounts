<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DevelopersApplicationResponse extends Mailable
{
    use Queueable, SerializesModels;

    private $_applicationAccepted;
    private $_applicationMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( bool $applicationAccepted, string $applicationMessage )
    {
        $this->_applicationAccepted = $applicationAccepted;
        $this->_applicationMessage  = $applicationMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this
            ->from( config('mail.from.address') )
            ->subject('Developer application response')
            ->view('mail.admin.developers.application.response', [

                'applicationAccepted'  => $this->_applicationAccepted,
                'applicationMessage'   => $this->_applicationMessage

            ]); 
    }
}
