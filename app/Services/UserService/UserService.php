<?php


namespace App\Services\UserService;


use App\Repositories\GroupUserRepository\GroupUserRepositoryInterface;
use App\Repositories\UserRepository\UserRepositoryInterface;
use App\Services\SubService\StoreImageService;
use Illuminate\Support\Facades\Session;

class UserService implements UserServiceInterface
{
    protected $userRepository;
    protected $groupUserRepository;
    protected $storeImageService;

    public function __construct(UserRepositoryInterface $userRepository,
                                GroupUserRepositoryInterface $groupUserRepository,
                                StoreImageService $storeImageService)
    {
        $this->userRepository = $userRepository;
        $this->groupUserRepository = $groupUserRepository;
        $this->storeImageService = $storeImageService;
    }

    public function getAll()
    {
        $users = $this->userRepository->getAll();
        return $users;
    }

    public function getById($userId)
    {
        $user = $this->userRepository->getById($userId);
        return $user;
    }

    public function paginate()
    {
        $number = 5;
        $users = $this->userRepository->paginate($number);
        return $users;
    }

    public function update($request, $userId)
    {
        $user = $this->userRepository->getById($userId);
        $folder = 'avatar';
        $imageDefault = $user->image;
        $data = $this->storeImageService->buildData($request, $folder, $imageDefault);

        $this->userRepository->update($data, $user);
        Session::flash('status', 'Update user information success');
    }

    public function delete($userId)
    {
        $user = $this->userRepository->getById($userId);
        $this->userRepository->delete($user);
        Session::flash('status', 'Delete user success');
    }

    public function getUserNotInGroup($groupId, $number)
    {
        $users = $this->userRepository->getUserNotInGroup($groupId, $number);
        return $users;
    }

    public function getAllGroup($userId)
    {
        $groups = $this->groupUserRepository->getAllGroup($userId);
        return $groups;
    }

    public function getUserOfGroup($groupId)
    {
        $limit = 4;
        $users = $this->userRepository->getUserOfGroup($groupId, $limit);
        return $users;
    }
}
