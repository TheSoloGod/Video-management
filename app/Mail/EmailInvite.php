<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailInvite extends Mailable
{
    use Queueable, SerializesModels;

    public $groupId;
    public $userId;
    public $token;

    /**
     * Create a new message instance.
     *
     * @param $groupId
     * @param $userId
     * @param $token
     */
    public function __construct($groupId, $userId, $token)
    {
        $this->groupId = $groupId;
        $this->userId = $userId;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.invite');
//                    ->with([
//                        'groupId' => $this->groupId,
//                        'userId' => $this->userId,
//                        'token' => $this->token,
//                    ]);
    }
}
