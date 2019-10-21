<?php


namespace App\Http\Controllers\Services\UserService;


use App\Http\Controllers\Repositories\UserRepository\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
}
