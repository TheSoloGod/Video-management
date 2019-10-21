<?php


namespace App\Http\Controllers\Repositories\GroupRepository;


use App\Group;
use App\Http\Controllers\Repositories\Eloquent\EloquentRepository;

class GroupRepository extends EloquentRepository implements GroupRepositoryInterface
{

    public function getModel()
    {
        return Group::class;
    }
}
