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
}
