<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailReportDaily extends Mailable
{
    use Queueable, SerializesModels;

    public $date;
    public $allVideoViewHistory;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($date, $allVideoViewHistory)
    {
        $this->date = $date;
        $this->allVideoViewHistory = $allVideoViewHistory;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.report');
    }
}
