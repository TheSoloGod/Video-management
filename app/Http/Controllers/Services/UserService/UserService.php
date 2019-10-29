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

    public function paginate($number)
    {
        $users = $this->userRepository->paginate($number);
        return $users;
    }

    public function update($request, $id)
    {
        $user = $this->userRepository->getById($id);
        $data = $request->all();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imageExtension = $image->getClientOriginalExtension();
            $image->move('storage/avatar', $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = $user->image;
        }

        $this->userRepository->update($data, $user);
    }

    public function delete($id)
    {
        $user = $this->userRepository->getById($id);
        $this->userRepository->delete($user);
    }
}
