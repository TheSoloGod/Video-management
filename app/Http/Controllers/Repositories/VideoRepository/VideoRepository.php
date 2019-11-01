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

    public function getVideoNotInGroup($groupId, $number)
    {
        $videos = $this->model->whereNotIn('id', function ($query) use ($groupId) {
            $query->select('video_id')
                  ->where('group_id', $groupId)
                  ->from('group_video');
        })->paginate($number);
        return $videos;
    }
}
