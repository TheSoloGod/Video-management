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
        return view('login');//return ra trang login để đăng nhập
    }

    public function postLogin(Request $request)
    {
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if ($request->remember == trans('remember.Remember Me')) {
            $remember = true;
        } else {
            $remember = false;
        }
        //kiểm tra trường remember có được chọn hay không

        if (Auth::guard('admin')->attempt($arr)) {

            dd('đăng nhập thành công');

        } else {

            dd('tài khoản và mật khẩu chưa chính xác');

        }
    }
}
