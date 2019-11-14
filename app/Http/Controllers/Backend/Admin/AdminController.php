<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\AdminService\AdminServiceInterface;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminServiceInterface $adminService)
    {
        $this->adminService = $adminService;
    }

    public function getLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.over-view');
        } else {
            return view('back_end.auth.login');
        }
    }

    public function postLogin(AdminLoginRequest $request)
    {
        $loginResult = $this->adminService->postLogin($request);
        if ($loginResult) {
            return redirect()->route('admin.over-view');
        } else {
            return redirect()->route('admin.login');
        }
    }

    public function overView()
    {
        $totalArray = $this->adminService->getQuantityInfomation();
        return view('back_end.over-view', compact('totalArray'));
    }

    public function getLogout()
    {
        $this->adminService->getLogout();
        return redirect()->route('admin');
    }
}
