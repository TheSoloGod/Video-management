<?php


namespace App\Repositories\CategoryRepository;


use App\Models\Category;
use App\Repositories\Eloquent\EloquentRepository;

class CategoryRepository extends EloquentRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }
}
