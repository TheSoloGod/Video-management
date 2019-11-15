<?php


namespace App\Repositories\AdminRepository;


use App\Models\Admin;
use App\Repositories\Eloquent\EloquentRepository;


class AdminRepository extends EloquentRepository implements AdminRepositoryInterface
{

    public function getModel()
    {
        return Admin::class;
    }
}
