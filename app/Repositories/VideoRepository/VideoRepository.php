<?php


namespace App\Repositories\VideoRepository;


use App\Repositories\Eloquent\EloquentRepository;
use App\Models\Video;
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
        $video->is_display = '0';
        $video->delete_at = Carbon::now();
        $video->save();
    }

    public function getPaginateVideoNotInGroup($groupId, $number)
    {
        $videos = $this->model->whereNotIn('id', function ($query) use ($groupId) {
            $query->select('video_id')
                  ->where('group_id', $groupId)
                  ->from('group_video');
        })->orderBy('created_at', 'desc')
          ->paginate($number);
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
                              ->where('is_in_group', 0)
//                              ->whereIn('id', function ($query) {
//                                    $query->whereIn('group_id', function ($query){
//                                        $query->where('user_id', Auth::user()->id)
//                                              ->select('group_id')
//                                              ->from('group_user');
//                                    })->select('video_id')
//                                      ->from('group_video');
//                            })->where('status', $this->uploadStatus[2])
                              ->orderBy('created_at', 'desc')
                              ->paginate($number);
        return $videos;
    }

    public function getPaginateVideoDisplayShow($number)
    {
        $videos = $this->model->where('is_display',  1)
                              ->where('is_in_group', 0)
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
                                             ->where('is_in_group', 0)
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

    public function getPaginateVideoOfCategory($categoryId, $number)
    {
        $categoryVideos = $this->model->whereIn('id', function ($query) use ($categoryId){
            $query->select('video_id')
                  ->where('category_id', $categoryId)
                  ->from('category_video');
        })->orderBy('created_at', 'desc')
          ->paginate($number);
        return $categoryVideos;
    }

    public function incrementVideoTotalView($videoId)
    {
        $this->model->where('id', $videoId)
                    ->increment('views');
    }

    public function getPaginateVideoFavorite($userId, $number)
    {
        $videos = $this->model->whereIn('id', function ($query) use ($userId){
            $query->select('video_id')
                  ->where('user_id', $userId)
                  ->from('user_video');
        })->orderBy('created_at', 'desc')
          ->paginate($number);
        return $videos;
    }

    public function incrementVideoTotalFavorite($videoId)
    {
        $this->model->where('id', $videoId)
                    ->increment('favorite');
    }

    public function search($keyWord, $number)
    {
        $videos = $this->model->where('title', 'LIKE', '%' . $keyWord . '%')
                              ->where('is_display', '1')
                              ->orderBy('created_at', 'desc')
                              ->paginate($number);
        return $videos;
    }

    public function getByName($name)
    {
        $video = $this->model->where('name', $name)
                             ->first();
        return $video;
    }

    public function markVideoInGroup($videoId)
    {
        $this->model->where('id', $videoId)
                    ->update(['is_in_group' => '1']);
    }

    public function unmarkVideoInGroup($videoId)
    {
        $this->model->where('id', $videoId)
                    ->update(['is_in_group' => '0']);
    }

    public function markVideoMember($videoId)
    {
        $this->model->where('id', $videoId)
                    ->update(['type' => '1']);
    }
}
