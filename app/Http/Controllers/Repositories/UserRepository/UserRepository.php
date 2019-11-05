<?php


namespace App\Http\Controllers\Repositories\UserRepository;


use App\Http\Controllers\Repositories\Eloquent\EloquentRepository;
use App\User;

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
}
