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

    public function getAllCategory($videoId)
    {
        $categories = $this->categoryVideoRepository->getAllCategory($videoId);
        return $categories;
    }

    public function getAllVideo($categoryId)
    {
        $videos = $this->categoryVideoRepository->getAllVideo($categoryId);
        return $videos;
    }
}
