<?php


namespace App\Http\Controllers\Services\VideoService;


use App\Http\Controllers\Repositories\CategoryVideoRepository\CategoryVideoRepositoryInterface;
use App\Http\Controllers\Repositories\GroupVideoRepository\GroupVideoRepositoryInterface;
use App\Http\Controllers\Repositories\VideoRepository\VideoRepositoryInterface;
use App\Jobs\SetPathVideo;
use App\Jobs\UploadFile;
use App\Services\StoreImageService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VideoService implements VideoServiceInterface
{
    protected $videoRepository;
    protected $categoryVideoRepository;
    protected $groupVideoRepository;
    protected $storeImageService;

    public function __construct(VideoRepositoryInterface $videoRepository,
                                CategoryVideoRepositoryInterface $categoryVideoRepository,
                                GroupVideoRepositoryInterface $groupVideoRepository,
                                StoreImageService $storeImageService)
    {
        $this->videoRepository = $videoRepository;
        $this->categoryVideoRepository = $categoryVideoRepository;
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

            return $this->storeVideoOnCloud($data, $videoName, $videoFullName);
        } else {
            Session::flash('error', 'Choose video to upload');
            return false;
        }
    }

    public function storeVideoOnCloud($data, $videoName, $videoFullName)
    {
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
        $video = $this->videoRepository->getPaginateVideoNotInGroup($groupId, $number);
        return $video;
    }

    public function getAllCategory($videoId)
    {
        $categories = $this->categoryVideoRepository->getAllCategory($videoId);
        return $categories;
    }

    public function getAllGroup($videoId)
    {
        $groups = $this->groupVideoRepository->getAllGroup($videoId);
        return $groups;
    }

    public function getPaginateAllVideoPublic()
    {
        $number = 4;
        $publicVideos = $this->videoRepository->getPaginateAllVideoPublic($number);
        return $publicVideos;
    }

    public function getPaginateAllVideoMember()
    {
        $number = 4;
        $memberVideos = $this->videoRepository->getPaginateAllVideoMember($number);
        return $memberVideos;
    }

    public function getRecommendedPublicVideos()
    {
        $number = 5;
        $recommendPublicVideos = $this->videoRepository->getRecommendedPublicVideos($number);
        return $recommendPublicVideos;
    }

    public function getRecommendedMemberVideos()
    {
        $number = 5;
        $recommendMemberVideos = $this->videoRepository->getRecommendedMemberVideos($number);
        return $recommendMemberVideos;
    }

    public function getPaginateVideoDisplayShow()
    {
        $number = 4;
        $allVideos = $this->videoRepository->getPaginateVideoDisplayShow($number);
        return $allVideos;
    }

    public function getPaginateVideoOfGroup($groupId)
    {
        $number = 6;
        $groupVideos = $this->videoRepository->getPaginateVideoOfGroup($groupId, $number);
        return $groupVideos;
    }
}
