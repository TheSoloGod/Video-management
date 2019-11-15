<?php


namespace App\Http\Controllers\Repositories\CategoryRepository;


use App\Models\Category;
//use App\Category;
use App\Http\Controllers\Repositories\Eloquent\EloquentRepository;

class CategoryRepository extends EloquentRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }
}
