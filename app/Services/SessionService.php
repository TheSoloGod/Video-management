<?php


namespace App\Services;

use Illuminate\Support\Facades\Session;


class SessionService
{
    public function forgetSession($key)
    {
        if (Session::has($key)) {
            Session::forget($key);
        }
    }

    public function checkGroupSessionExist($key, $groupId)
    {
        if (Session::has($key)) {
            $groupIdInKey = Session::get($key)->groupId;
            if ($groupIdInKey == $groupId) {
                return true;
            } else {
                return false;
            }
        }
    }
}
