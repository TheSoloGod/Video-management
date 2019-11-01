<?php


namespace App\Http\Controllers\Services\VideoService;


use App\Http\Controllers\Repositories\GroupVideoRepository\GroupVideoRepositoryInterface;
use App\Http\Controllers\Repositories\VideoRepository\VideoRepositoryInterface;
use App\Http\Controllers\Services\CategoryVideoService\CategoryVideoServiceInterface;
use App\Http\Controllers\Services\GroupVideoService\GroupVideoServiceInterface;
use App\Jobs\SetPathVideo;
use App\Jobs\UploadFile;
use App\Services\StoreImageService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VideoService implements VideoServiceInterface
{
    protected $videoRepository;
    protected $categoryVideoService;
    protected $groupVideoService; //loi do 2 service goi nhau
    protected $groupVideoRepository;
    protected $storeImageService;

    public function __construct(VideoRepositoryInterface $videoRepository,
                                CategoryVideoServiceInterface $categoryVideoService,
//                                GroupVideoServiceInterface $groupVideoService,
                                GroupVideoRepositoryInterface $groupVideoRepository,
                                StoreImageService $storeImageService)
    {
        $this->videoRepository = $videoRepository;
        $this->categoryVideoService = $categoryVideoService;
//        $this->groupVideoService = $groupVideoService;
        $this->groupVideoRepository = $groupVideoRepository;
        $this->storeImageService = $storeImageService;
    }

    public function getAll()
    {
        $videos = $this->videoRepository->getAll();
        return $videos;
    }

    public function paginate()
    {
        $number = 5;
        $videos = $this->videoRepository->paginate($number);
        return $videos;
    }

    public function getById($videoId)
    {
        $video = $this->videoRepository->getById($videoId);
        return $video;
    }

    public function store($request)
    {
        $folder = 'preview';
        $imageDefault = 'preview-default.jpg';
        $data = $this->storeImageService->buildData($request, $folder, $imageDefault);

        if ($request->hasFile('video')) {
            $video = $request->video;
            $videoFullName = $video->getClientOriginalName();
            $videoExtension = $video->getClientOriginalExtension();
            $videoName = str_replace('.' . $videoExtension, '', $videoFullName);
            $request->video->storeAs('/', $videoFullName, 'public');
            $data['name'] = $videoName;

            if ($this->checkExistVideo($videoName)) {
                Session::flash('error', 'Video exist!');
                return false;
            } else {
                $data['status'] = $this->videoRepository->uploadStatus[0];
                $newVideo = $this->videoRepository->create($data);
                UploadFile::dispatch($newVideo->id, $videoFullName);
                SetPathVideo::dispatch($newVideo->id, $newVideo->name);
                Session::flash('status', 'Uploading video');
                return $newVideo;
            }
        } else {
            Session::flash('error', 'Choose video to upload');
            return false;
        }
    }

    public function update($request, $videoId)
    {
        $video = $this->videoRepository->getById($videoId);
        $folder = 'preview';
        $imageDefault = $video->image;
        $data = $this->storeImageService->buildData($request, $folder, $imageDefault);

        $this->videoRepository->update($data, $video);
        Session::flash('status', 'Update video information success');
    }

    public function softDelete($videoId)
    {
        $this->videoRepository->softDelete($videoId);
        Session::flash('status', 'Delete video success');
    }

    public function checkExistVideo($name)
    {
        $dir = '/';
        $recursive = false;
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        $video = $contents->where('filename', '=', $name)->first();
        if ($video) {
            return true;
        } else {
            return false;
        }
    }

    public function setUploadStatus($videoId, $statusIndex)
    {
        $this->videoRepository->setUploadStatus($videoId, $statusIndex);
    }

    public function setVideoPath($videoId, $path)
    {
        $this->videoRepository->setVideoPath($videoId, $path);
    }

    public function getVideoNotInGroup($groupId, $number)
    {
        $video = $this->videoRepository->getVideoNotInGroup($groupId, $number);
        return $video;
    }

    public function getAllCategory($videoId)
    {
        $categories = $this->categoryVideoService->getAllCategory($videoId);
        return $categories;
    }

    public function getAllGroup($videoId)
    {
        $groups = $this->groupVideoRepository->getAllGroup($videoId);
        return $groups;
    }
}
