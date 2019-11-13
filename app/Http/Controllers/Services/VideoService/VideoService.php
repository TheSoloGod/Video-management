<?php


namespace App\Http\Controllers\Services\VideoService;


use App\Http\Controllers\Repositories\CategoryVideoRepository\CategoryVideoRepositoryInterface;
use App\Http\Controllers\Repositories\GroupVideoRepository\GroupVideoRepositoryInterface;
use App\Http\Controllers\Repositories\VideoRepository\VideoRepositoryInterface;
use App\Jobs\SetPathVideo;
use App\Jobs\UploadFile;
use App\Services\SessionService;
use App\Services\StoreImageService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class VideoService implements VideoServiceInterface
{
    protected $videoRepository;
    protected $categoryVideoRepository;
    protected $groupVideoRepository;
    protected $storeImageService;
    protected $sessionService;

    public function __construct(VideoRepositoryInterface $videoRepository,
                                CategoryVideoRepositoryInterface $categoryVideoRepository,
                                GroupVideoRepositoryInterface $groupVideoRepository,
                                StoreImageService $storeImageService,
                                SessionService $sessionService)
    {
        $this->videoRepository = $videoRepository;
        $this->categoryVideoRepository = $categoryVideoRepository;
        $this->groupVideoRepository = $groupVideoRepository;
        $this->storeImageService = $storeImageService;
        $this->sessionService = $sessionService;
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
        //upload to google drive
//        if ($request->hasFile('video')) {
//
//            //store image
//            $folder = 'preview';
//            $imageDefault = 'preview-default.jpg';
//            $data = $this->storeImageService->buildData($request, $folder, $imageDefault);
//
//            //store video
//            $video = $request->video;
//            $videoFullName = $video->getClientOriginalName();
//            $videoExtension = $video->getClientOriginalExtension();
//
//            if ($this->checkVideoExtension($videoExtension)) {
//                $videoName = str_replace('.' . $videoExtension, '', $videoFullName);
//                $data['name'] = $videoName;
//
//                $this->storeVideoOnPublic($request, $videoFullName);
//                $newVideo = $this->storeVideoOnCloud($data, $videoName, $videoFullName);
//                $this->storeNewVideoCategory($request, $newVideo);
//                $this->storeNewVideoGroup($request, $newVideo);
//                return $newVideo;
//            } else {
//                Session::flash('error', 'Video+ only support mp4 file');
//                return false;
//            }
//        } else {
//            Session::flash('error', 'Choose video to upload');
//            return false;
//        }

        //upload to storage
        //store image & build data
        $folder = 'preview';
        $imageDefault = 'preview-default.jpg';
        $data = $this->storeImageService->buildData($request, $folder, $imageDefault);
        $data['status'] = Session::get('uploadStatus', 'not upload');
        // clear session
        if (Session::get('uploadStatus') == 'upload success') {
            Session::forget('uploadStatus');
        }
        if (Session::has('video_name')) {
            $data['name'] = Session::get('video_name');
            Session::forget('video_name');
        }
        $newVideo = $this->videoRepository->create($data);
        $this->storeNewVideoCategory($request, $newVideo);
        $this->storeNewVideoGroup($request, $newVideo);
        return $newVideo;

    }

    public function storeVideoOnPublic($request, $videoFullName)
    {
        $request->video->storeAs('/', $videoFullName, 'public');
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

    public function checkVideoExtension($extension)
    {
        if ($extension == 'mp4') {
            return true;
        } else {
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
        $video = $this->videoRepository->getPaginateVideoNotInGroup($groupId, $number);
        return $video;
    }

    public function getAllCategory($videoId)
    {
        $categories = $this->categoryVideoRepository->getAllCategory($videoId);
        return $categories;
    }

    public function storeNewVideoCategory($request, $newVideo)
    {
        if ($newVideo) {
            if ($request->category != null) {
                $arrayCategory = explode(',', $request->category);
                foreach ($arrayCategory as $key => $value) {
                    $data = [];
                    $data['category_id'] = $value;
                    $data['video_id'] = $newVideo->id;
                    $this->categoryVideoRepository->create($data);
                }
            }
        }
    }

    public function getAllGroup($videoId)
    {
        $groups = $this->groupVideoRepository->getAllGroup($videoId);
        return $groups;
    }

    public function storeNewVideoGroup($request, $newVideo)
    {
        if ($newVideo) {
            if ($request->group != null) {
                $this->videoRepository->markVideoInGroup($newVideo->id);
                $arrayGroup = explode(',', $request->group);
                foreach ($arrayGroup as $key => $value) {
                    $data = [];
                    $data['group_id'] = $value;
                    $data['video_id'] = $newVideo->id;
                    $this->groupVideoRepository->create($data);
                }
            }
        }
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

    public function getPaginateVideoFavorite($userId)
    {
        $number = 4;
        $videos = $this->videoRepository->getPaginateVideoFavorite($userId, $number);
        return $videos;
    }

    public function search($request)
    {
        $number = 8;
        $keyWord = $request->key_word;
        $videos = $this->videoRepository->search($keyWord, $number);
        return $videos;
    }

    public function getByName($name)
    {
        $video = $this->videoRepository->getByName($name);
        return $video;
    }

    public function clearSessionCreateVideo()
    {
//        \SessionService::forgetSession('uploadStatus');
//        \SessionService::forgetSession('video_name');

        $this->sessionService->forgetSession('uploadStatus');
        $this->sessionService->forgetSession('video_name');
    }
}
