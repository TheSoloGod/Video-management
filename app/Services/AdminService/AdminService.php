<?php


namespace App\Services\AdminService;


use App\Repositories\AdminRepository\AdminRepositoryInterface;
use App\Services\CategoryService\CategoryServiceInterface;
use App\Services\GroupService\GroupServiceInterface;
use App\Services\UserService\UserServiceInterface;
use App\Services\VideoService\VideoServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            Session::flash('status', 'Login failed, wrong username or password');
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
