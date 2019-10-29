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
                               ->where('status','join')
                               ->paginate($number);
        return $members;
    }

    public function removeMember($groupId, $userId)
    {
        $this->model->where('group_id', $groupId)
                    ->where('user_id', $userId)
                    ->delete();
    }

    public function getUserIdOutOfGroup($groupId, $number)
    {
        $userIdInGroup = $this->model->where('group_id', $groupId)
                                     ->select('user_id')
                                     ->get();

        $userIdOutOfGroup = DB::table('users')->where('id','!=', $userIdInGroup[0]->user_id)
                                                    ->where('id','!=', $userIdInGroup[1]->user_id)
                                                    ->paginate($number);
        return $userIdOutOfGroup;
    }

}
