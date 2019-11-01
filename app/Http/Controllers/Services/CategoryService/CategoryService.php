<?php


namespace App\Http\Controllers\Services\CategoryService;


use App\Http\Controllers\Repositories\CategoryRepository\CategoryRepositoryInterface;
use App\Http\Controllers\Services\CategoryVideoService\CategoryVideoServiceInterface;
use App\Services\StoreImageService;
use Illuminate\Support\Facades\Session;

class CategoryService implements CategoryServiceInterface
{
    protected $categoryRepository;
    protected $categoryVideoService;
    protected $storeImageService;

    public function __construct(CategoryRepositoryInterface $categoryRepository,
                                CategoryVideoServiceInterface $categoryVideoService,
                                StoreImageService $storeImageService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryVideoService = $categoryVideoService;
        $this->storeImageService = $storeImageService;
    }

    public function getAll()
    {
        $categories = $this->categoryRepository->getAll();
        return $categories;
    }

    public function paginate()
    {
        $number = 6;
        $categories = $this->categoryRepository->paginate($number);
        return $categories;
    }

    public function getById($categoryId)
    {
        $category = $this->categoryRepository->getById($categoryId);
        return $category;
    }

    public function store($request)
    {
        $folder = 'category';
        $imageDefault = 'category-default.jpg';
        $data = $this->storeImageService->buildData($request, $folder, $imageDefault);

        $category = $this->categoryRepository->create($data);
        Session::flash('status', 'Create new category success');
        return $category;
    }

    public function update($request, $id)
    {
        $category = $this->categoryRepository->getById($id);
        $folder = 'category';
        $imageDefault = $category->image;
        $data = $this->storeImageService->buildData($request, $folder, $imageDefault);

        $this->categoryRepository->update($data, $category);
        Session::flash('status', 'Update category success');
    }

    public function delete($id)
    {
        $category = $this->categoryRepository->getById($id);
        $this->categoryRepository->delete($category);
        Session::flash('status', 'Delete category success');
    }

    public function countAllVideo($category_id)
    {
        $videos = $this->categoryVideoService->getAllVideo($category_id);
        $totalVideos = count($videos);
        return $totalVideos;
    }
}
