<?php

namespace App\Console\Commands;

use App\Http\Controllers\Services\DateVideoService\DateVideoServiceInterface;
use App\Mail\EmailReportDaily;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailReportCommand extends Command
{
    protected $dateVideoService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send view history mail report daily';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DateVideoServiceInterface $dateVideoService)
    {
        parent::__construct();
        $this->dateVideoService = $dateVideoService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $receiver = 'testlaravel20@gmail.com';
        $date = Carbon::now()->toDateString();
        $allVideoViewHistory = $this->dateVideoService->getByDate($date);
        $reportEmail = new EmailReportDaily($date, $allVideoViewHistory);
        Mail::to($receiver)->send($reportEmail);
    }
}
