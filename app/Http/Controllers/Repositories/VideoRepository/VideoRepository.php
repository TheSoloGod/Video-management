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

    public function setUploadStatus($id, $statusIndex)
    {
        $video = $this->getById($id);
        $video->status = $this->uploadStatus[$statusIndex];
        $video->save();
    }

    public function setVideoPath($id, $path)
    {
        $video = $this->getById($id);
        $video->status = $this->uploadStatus[2];
        $video->path = $path;
        $video->save();
    }

    public function softDelete($id){
        $video = $this->getById($id);
        $video->delete_at = Carbon::now();
        $video->save();
    }

}
