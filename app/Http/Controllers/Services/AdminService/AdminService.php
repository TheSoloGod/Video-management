<?php


namespace App\Http\Controllers\Services\AdminService;


use App\Http\Controllers\Repositories\AdminRepository\AdminRepositoryInterface;

class AdminService implements AdminServiceInterface
{

    protected $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }
}
