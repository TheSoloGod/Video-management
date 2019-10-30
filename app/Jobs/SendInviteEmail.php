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
    protected $token;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userEmail, $groupId, $token)
    {
        $this->userEmail = $userEmail;
        $this->groupId = $groupId;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new EmailInvite($this->groupId, $this->token);
        Mail::to($this->userEmail)->send($email);
    }
}
