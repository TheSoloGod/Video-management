<?php


namespace App\Http\Controllers\Services\GroupService;

use App\Http\Controllers\Repositories\GroupRepository\GroupRepositoryInterface;
use App\Services\SessionService;
use App\Services\StoreImageService;
use Illuminate\Support\Facades\Session;

class GroupService implements GroupServiceInterface
{
    protected $groupRepository;
    protected $sessionService;
    protected $storeImageService;

    public function __construct(GroupRepositoryInterface $groupRepository,
                                SessionService $sessionService,
                                StoreImageService $storeImageService)
    {
        $this->groupRepository = $groupRepository;
        $this->sessionService = $sessionService;
        $this->storeImageService = $storeImageService;
    }

    public function getAll()
    {
        $groups = $this->groupRepository->getAll();
        return $groups;
    }

    public function paginate()
    {
        $number = 8;
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
        $folder = 'group';
        $imageDefault = 'group-default.jpg';
        $data = $this->storeImageService->buildData($request, $folder, $imageDefault);

        $group = $this->groupRepository->create($data);
        Session::flash('status', 'Create new group success');
        return $group;
    }

    public function update($request, $id)
    {
        $group = $this->groupRepository->getById($id);
        $folder = 'group';
        $imageDefault = $group->image;
        $data = $this->storeImageService->buildData($request, $folder, $imageDefault);

        $this->groupRepository->update($data, $group);
        Session::flash('status', 'Update group information success');
    }

    public function delete($id)
    {
        $user = $this->groupRepository->getById($id);
        $this->groupRepository->delete($user);
        Session::flash('status', 'Delete group success');
    }

    public function checkGroupSessionExist($id)
    {
        $group = $this->groupRepository->getById($id);
        $groupId = $group->id;

        $groupIdInvitationListExist = $this->sessionService
            ->checkGroupSessionExist('invitationList', $groupId);
        if (!$groupIdInvitationListExist) {
            $this->sessionService->forgetSession('invitationList');
        }

        $groupIdAdditionVideoListExist = $this->sessionService
            ->checkGroupSessionExist('additionVideoList', $groupId);
        if (!$groupIdAdditionVideoListExist) {
            $this->sessionService->forgetSession('additionVideoList');
        }
    }
}
