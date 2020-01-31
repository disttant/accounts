<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DevelopersApplicationRequest extends Mailable
{
    use Queueable, SerializesModels;

    private $_developerId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( int $developerId )
    {
        $this->_developerId = $developerId;
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
            ->subject('[Accounts] Admin action required')
            ->view('mail.admin.developers.application.request', [

                'developer_id'   => $this->_developerId,
                  
            ]); 
    }
}
