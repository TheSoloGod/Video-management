<?php


namespace App\Http\Controllers\Repositories\GroupUserRepository;


use App\GroupUser;
use App\Http\Controllers\Repositories\Eloquent\EloquentRepository;
use Illuminate\Support\Facades\DB;

class GroupUserRepository extends EloquentRepository implements GroupUserRepositoryInterface
{
    public $status = ['invited', 'join'];

    public function getModel()
    {
        return GroupUser::class;
    }

    public function getAllMember($groupId, $number)
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
}
