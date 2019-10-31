<?php


namespace App\Services;

use Illuminate\Support\Facades\Session;


class SessionService
{
    public function forgetSession($key)
    {
        if(Session::has($key)){
            Session::forget($key);
        }
    }
}
