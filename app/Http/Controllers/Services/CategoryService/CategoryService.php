<?php


namespace App\Http\Controllers\Services\CategoryService;


use App\Http\Controllers\Repositories\CategoryRepository\CategoryRepositoryInterface;

class CategoryService implements CategoryServiceInterface
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
}
