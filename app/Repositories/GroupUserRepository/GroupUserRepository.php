<?php


namespace App\Repositories\GroupUserRepository;


use App\Models\GroupUser;
use App\Repositories\Eloquent\EloquentRepository;
use Carbon\Carbon;

class GroupUserRepository extends EloquentRepository implements GroupUserRepositoryInterface
{
    public function getModel()
    {
        return GroupUser::class;
    }

    public function getAllMember($groupId)
    {
        $members = $this->model->where('group_id', $groupId)
                               ->whereNotNull('verify_at')
                               ->get();
        return $members;
    }

    public function getAllMemberPaginate($groupId, $number)
    {
        $members = $this->model->where('group_id', $groupId)
                               ->whereNotNull('verify_at')
                               ->paginate($number);
        return $members;
    }

    public function removeMember($groupId, $userId)
    {
        $this->model->where('group_id', $groupId)
                    ->where('user_id', $userId)
                    ->delete();
    }

    public function getToken($groupId, $userId)
    {
        $token = $this->model->where('group_id', $groupId)
                             ->where('user_id', $userId)
                             ->select('token')
                             ->firstOrFail();
        return $token;
    }

    public function verifyMember($groupId, $userId)
    {
        $verify_at = Carbon::now();
        $this->model->where('group_id', $groupId)
                    ->where('user_id', $userId)
                    ->update(['verify_at' => $verify_at]);
    }

    public function getInvitedUser($groupId, $number)
    {
        $users = $this->model->where('group_id', $groupId)
                             ->whereNull('verify_at')
                             ->paginate($number);
        return $users;
    }

    public function getAllGroup($userId)
    {
        $groups = $this->model->where('user_id', $userId)
                              ->whereNotNull('verify_at')
                              ->get();
        return $groups;
    }

    public function getByUserGroupId($userId, $groupId)
    {
        $userGroup = $this->model->where('user_id', $userId)
                                 ->where('group_id', $groupId)
                                 ->whereNotNull('verify_at')
                                 ->first();
        return $userGroup;
    }
}
