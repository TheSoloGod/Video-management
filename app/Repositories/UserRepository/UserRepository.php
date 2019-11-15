<?php


namespace App\Repositories\UserRepository;


use App\Models\User;
use App\Repositories\Eloquent\EloquentRepository;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getUserNotInGroup($groupId, $number)
    {
        $users = $this->model->whereNotIn('id', function ($query) use ($groupId) {
            $query->select('user_id')
                  ->where('group_id', $groupId)
                  ->from('group_user');
        })->paginate($number);
        return $users;
    }

    public function getUserOfGroup($groupId, $limit)
    {
        $users = $this->model->whereIn('id', function ($query) use ($groupId) {
            $query->select('user_id')
                  ->where('group_id', $groupId)
                  ->from('group_user');
        })->limit($limit)
          ->get();
        return $users;
    }

    public function markUserInGroup($userId)
    {
        $this->model->where('id', $userId)
            ->update(['is_in_group' => '1']);
    }

    public function unmarkUserInGroup($userId)
    {
        $this->model->where('id', $userId)
            ->update(['is_in_group' => '0']);
    }
}
