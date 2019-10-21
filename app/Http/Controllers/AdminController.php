<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\AdminService\AdminServiceInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    protected $adminService;

    public function __construct(AdminServiceInterface $adminService)
    {
        $this->adminService = $adminService;
    }
}
