<?php


namespace App\Repositories\GroupRepository;


use App\Models\Group;
use App\Repositories\Eloquent\EloquentRepository;

class GroupRepository extends EloquentRepository implements GroupRepositoryInterface
{
    public function getModel()
    {
        return Group::class;
    }

    public function getPaginateGroupMember($userId, $number)
    {
        $groups = $this->model->whereIn('id', function ($query) use ($userId) {
            $query->select('group_id')
                  ->where('user_id', $userId)
                  ->from('group_user');
        })->paginate($number);
        return $groups;
    }

    public function getPaginateOtherGroup($userId, $number)
    {
        $otherGroups = $this->model->whereNotIn('id', function ($query) use ($userId) {
            $query->select('group_id')
                  ->where('user_id', $userId)
                  ->from('group_user');
        })->paginate($number);
        return $otherGroups;
    }

    public function getAllGroupOfUser($userId)
    {
        $groups = $this->model->whereIn('id', function ($query) use ($userId) {
            $query->select('group_id')
                ->where('user_id', $userId)
                ->from('group_user');
        })->get();
        return $groups;
    }
}
