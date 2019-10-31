<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailInvite;

class SendInviteEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userEmail;
    protected $groupId;
    protected $userId;
    protected $token;

    /**
     * Create a new job instance.
     *
     * @param $userEmail
     * @param $groupId
     * @param $userId
     * @param $token
     */
    public function __construct($userEmail, $groupId, $userId, $token)
    {
        $this->userEmail = $userEmail;
        $this->groupId = $groupId;
        $this->userId = $userId;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $inviteEmail = new EmailInvite($this->groupId, $this->userId, $this->token);
        Mail::to($this->userEmail)->send($inviteEmail);
    }
}
