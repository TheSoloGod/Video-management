<?php


namespace App\Http\Controllers\Services\CategoryVideoService;


use App\Http\Controllers\Repositories\CategoryVideoRepository\CategoryVideoRepositoryInterface;

class CategoryVideoService implements CategoryVideoServiceInterface
{
    protected $categoryVideoRepository;

    public function __construct(CategoryVideoRepositoryInterface $categoryVideoRepository)
    {
        $this->categoryVideoRepository = $categoryVideoRepository;
    }
}
