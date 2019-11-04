<?php


namespace App\Http\Controllers\Repositories\VideoRepository;


use App\Http\Controllers\Repositories\Eloquent\EloquentRepository;
use App\Video;
use Carbon\Carbon;

class VideoRepository extends EloquentRepository implements VideoRepositoryInterface
{

    public function getModel()
    {
        return Video::class;
    }

    public $uploadStatus = ['not upload', 'uploading', 'upload success', 'upload fail'];

    public function setUploadStatus($videoId, $statusIndex)
    {
        $video = $this->getById($videoId);
        $video->status = $this->uploadStatus[$statusIndex];
        $video->save();
    }

    public function setVideoPath($videoId, $path)
    {
        $video = $this->getById($videoId);
        $video->status = $this->uploadStatus[2];
        $video->path = $path;
        $video->save();
    }

    public function softDelete($videoId)
    {
        $video = $this->getById($videoId);
        $video->delete_at = Carbon::now();
        $video->save();
    }

    public function getPaginateVideoNotInGroup($groupId, $number)
    {
        $videos = $this->model->whereNotIn('id', function ($query) use ($groupId) {
            $query->select('video_id')
                  ->where('group_id', $groupId)
                  ->from('group_video');
        })->paginate($number);
        return $videos;
    }

    public function getPaginateAllVideoPublic($number)
    {
        $videos = $this->model->where('type', 0)
                              ->where('is_display', 1)
                              ->where('status', $this->uploadStatus[2])
                              ->orderBy('created_at', 'desc')
                              ->paginate($number);
        return $videos;
    }

    public function getPaginateAllVideoMember($number)
    {
        $videos = $this->model->where('type', 1)
                              ->where('is_display', 1)
                              ->where('status', $this->uploadStatus[2])
                              ->orderBy('created_at', 'desc')
                              ->paginate($number);
        return $videos;
    }

    public function getPaginateVideoDisplayShow($number)
    {
        $videos = $this->model->where('is_display',  1)
                              ->where('status', $this->uploadStatus[2])
                              ->orderBy('created_at', 'desc')
                              ->paginate($number);
        return $videos;
    }

    public function getRecommendedPublicVideos($number)
    {
        $recommendPublicVideos = $this->model->where('type', 0)
                                             ->where('is_display', 1)
                                             ->where('status', $this->uploadStatus[2])
                                             ->limit($number)
                                             ->get();
        return $recommendPublicVideos;
    }

    public function getRecommendedMemberVideos($number)
    {
        $recommendPublicVideos = $this->model->where('type', 1)
            ->where('is_display', 1)
            ->where('status', $this->uploadStatus[2])
            ->limit($number)
            ->get();
        return $recommendPublicVideos;
    }

    public function getPaginateVideoOfGroup($groupId, $number)
    {
        $groupVideos = $this->model->whereIn('id', function ($query) use ($groupId){
            $query->select('video_id')
                  ->where('group_id', $groupId)
                  ->from('group_video');
        })->orderBy('created_at', 'desc')
          ->paginate($number);
        return $groupVideos;
    }
}
