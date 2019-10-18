<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendInviteEmail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function invite()
    {
        $this->dispatch(new SendInviteEmail());
        return redirect()->back()->with('success', 'OK');
    }
}
