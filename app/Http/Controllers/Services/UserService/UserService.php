<?php


namespace App\Http\Controllers\Services\UserService;


use App\Http\Controllers\Repositories\UserRepository\UserRepositoryInterface;
use App\Services\StoreImageService;
use Illuminate\Support\Facades\Session;

class UserService implements UserServiceInterface
{
    protected $userRepository;
    protected $storeImageService;

    public function __construct(UserRepositoryInterface $userRepository,
                                StoreImageService $storeImageService)
    {
        $this->userRepository = $userRepository;
        $this->storeImageService = $storeImageService;
    }

    public function getAll()
    {
        $users = $this->userRepository->getAll();
        return $users;
    }

    public function getById($id)
    {
        $user = $this->userRepository->getById($id);
        return $user;
    }

    public function paginate()
    {
        $number = 5;
        $users = $this->userRepository->paginate($number);
        return $users;
    }

    public function update($request, $id)
    {
        $user = $this->userRepository->getById($id);
        $folder = 'avatar';
        $imageDefault = $user->image;
        $data = $this->storeImageService->buildData($request, $folder, $imageDefault);
        
        $this->userRepository->update($data, $user);
        Session::flash('status', 'Update user information success');
    }

    public function delete($id)
    {
        $user = $this->userRepository->getById($id);
        $this->userRepository->delete($user);
        Session::flash('status', 'Delete user success');
    }

    public function getUserNotInGroup($groupId, $number)
    {
        $users = $this->userRepository->getUserNotInGroup($groupId, $number);
        return $users;
    }
}
