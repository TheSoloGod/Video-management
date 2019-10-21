<?php


namespace App\Http\Controllers\Repositories\GroupUserRepository;


use App\GroupUser;
use App\Http\Controllers\Repositories\Eloquent\EloquentRepository;

class GroupUserRepository extends EloquentRepository implements GroupUserRepositoryInterface
{

    public function getModel()
    {
        return GroupUser::class;
    }
}
