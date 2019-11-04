<?php


namespace App\Http\Controllers\Services\AdminService;


use App\Http\Controllers\Repositories\AdminRepository\AdminRepositoryInterface;
use App\Http\Controllers\Services\CategoryService\CategoryServiceInterface;
use App\Http\Controllers\Services\GroupService\GroupServiceInterface;
use App\Http\Controllers\Services\UserService\UserServiceInterface;
use App\Http\Controllers\Services\VideoService\VideoServiceInterface;
use Illuminate\Support\Facades\Auth;

class AdminService implements AdminServiceInterface
{

    protected $adminRepository;
    protected $userService;
    protected $videoService;
    protected $groupService;
    protected $categoryService;

    public function __construct(AdminRepositoryInterface $adminRepository,
                                UserServiceInterface $userService,
                                VideoServiceInterface $videoService,
                                GroupServiceInterface $groupService,
                                CategoryServiceInterface $categoryService)
    {
        $this->adminRepository = $adminRepository;
        $this->userService = $userService;
        $this->videoService = $videoService;
        $this->groupService = $groupService;
        $this->categoryService = $categoryService;
    }

    public function postLogin($request)
    {
        $info = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        //kiểm tra trường remember có được chọn hay không
        if ($request->remember == trans('remember.Remember Me')) {
            $remember = true;
        } else {
            $remember = false;
        }

        if (Auth::guard('admin')->attempt($info)) {
            return true;
        } else {
            return false;
        }
    }

    public function getLogout()
    {
        Auth::guard('admin')->logout();
    }

    public function getQuantityInfomation()
    {
        $totalArray = [];
        $totalUsers = count($this->userService->getAll());
        $totalGroups = count($this->groupService->getAll());
        $totalVideos = count($this->videoService->getAll());
        $totalCategories = count($this->categoryService->getAll());

        $totalArray[] = $totalUsers;
        $totalArray[] = $totalGroups;
        $totalArray[] = $totalVideos;
        $totalArray[] = $totalCategories;

        return $totalArray;
    }
}
