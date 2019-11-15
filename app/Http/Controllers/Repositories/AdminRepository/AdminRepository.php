<?php


namespace App\Http\Controllers\Repositories\AdminRepository;


use App\Models\Admin;
//use App\Admin;
use App\Http\Controllers\Repositories\Eloquent\EloquentRepository;


class AdminRepository extends EloquentRepository implements AdminRepositoryInterface
{

    public function getModel()
    {
        return Admin::class;
    }
}
