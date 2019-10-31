<?php


namespace App\Http\Controllers\Services\GroupService;

use App\Http\Controllers\Repositories\GroupRepository\GroupRepositoryInterface;
use Illuminate\Support\Facades\Session;

class GroupService implements GroupServiceInterface
{
    protected $groupRepository;

    public function __construct(GroupRepositoryInterface $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function getAll()
    {
        $groups = $this->groupRepository->getAll();
        return $groups;
    }

    public function paginate($number)
    {
        $groups = $this->groupRepository->paginate($number);
        return $groups;
    }

    public function getById($id)
    {
        $group = $this->groupRepository->getById($id);
        return $group;
    }

    public function store($request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imageExtension = $image->getClientOriginalExtension();
            $image->move('storage/group', $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = 'group-default.jpg';
        }

        $group = $this->groupRepository->create($data);
        return $group;
    }

    public function update($request, $id)
    {
        $group = $this->groupRepository->getById($id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imageExtension = $image->getClientOriginalExtension();
            $image->move('storage/group', $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = $group->image;
        }

        $this->groupRepository->update($data, $group);
    }

    public function delete($id)
    {
        $user = $this->groupRepository->getById($id);
        $this->groupRepository->delete($user);
    }
}
