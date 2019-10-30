<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailInvite extends Mailable
{
    use Queueable, SerializesModels;

    protected $groupId;
    protected $token;

    /**
     * Create a new message instance.
     *
     * @param $groupId
     * @param $token
     */
    public function __construct($groupId, $token)
    {
        $this->groupId = $groupId;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $groupId = $this->groupId;
        $token = $this->token;
        return $this->view('mail.invite', compact('groupId', 'token'));
    }
}
