<?php

namespace App\Exceptions;

use App\Jobs\SendStatiticsExceptionMail;
use App\Notifications\StatiticsException;
use App\Models\User;
//use App\User;
use Exception;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;

class ReportFutureDateException extends Exception
{
    use Notifiable;

    public function report()
    {
        $user = User::findOrFail(7);
        $user->notify(new StatiticsException());

//        SendStatiticsExceptionMail::dispatch();
    }

    public function render($request)
    {
        return redirect()->back()->with('error', 'Must choose a past day');
    }
}
