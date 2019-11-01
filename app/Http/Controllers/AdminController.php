<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\AdminService\AdminServiceInterface;
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
        return view('admin.auth.login');//return ra trang login để đăng nhập
    }

    public function postLogin(Request $request)
    {
        $loginResult = $this->adminService->postLogin($request);
        if ($loginResult) {
            return redirect()->route('admin.over-view');
        } else {
            dd('tài khoản và mật khẩu chưa chính xác');
        }
    }

    public function overView()
    {
        $totalArray = $this->adminService->getQuantityInfomation();
        return view('admin.over-view', compact('totalArray'));
    }
}
