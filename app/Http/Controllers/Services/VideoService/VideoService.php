<?php


namespace App\Http\Controllers\Services\VideoService;


use App\Http\Controllers\Repositories\VideoRepository\VideoRepositoryInterface;
use App\Jobs\SetPathVideo;
use App\Jobs\UploadFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VideoService implements VideoServiceInterface
{

    protected $videoRepository;

    public function __construct(VideoRepositoryInterface $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function getAll()
    {
        $videos = $this->videoRepository->getAll();
        return $videos;
    }

    public function paginate()
    {
        $number = 3;
        $videos = $this->videoRepository->paginate($number);
        return $videos;
    }

    public function getById($id){
        $video = $this->videoRepository->getById($id);
        return $video;
    }

    public function store($request){
        $data = $request->all();

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imageExtension = $image->getClientOriginalExtension();
            $image->move('storage/preview', $imageName);
            $data['image'] = $imageName;
        }else{
            $data['image'] = 'preview-default.jpg';
        }

        if($request->hasFile('video')){
            $video = $request->video;
            $videoFullName = $video->getClientOriginalName();
            $videoExtension = $video->getClientOriginalExtension();
            $videoName = str_replace('.' . $videoExtension, '', $videoFullName);
            $request->video->storeAs('/', $videoFullName, 'public');
            $data['name'] = $videoName;

            if($this->checkExistVideo($videoName)){
                Session::flash('error', 'Video exist!');
                return false;
            }else {
                $data['status'] = $this->videoRepository->uploadStatus[0];
                $newVideo = $this->videoRepository->create($data);
                UploadFile::dispatch($newVideo->id, $videoFullName);
                SetPathVideo::dispatch($newVideo->id, $newVideo->name);
                Session::flash('status', 'Uploading video');
                return $newVideo;
            }
        }else{
            Session::flash('error', 'Choose video to upload');
            return false;
        }
    }

    public function update($request, $id){
        $video = $this->videoRepository->getById($id);
        $data = $request->all();

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imageExtension = $image->getClientOriginalExtension();
            $image->move('storage/preview', $imageName);
            $data['image'] = $imageName;
        }else{
            $data['image'] = $video->image;
        }

        $this->videoRepository->update($data, $video);
        Session::flash('status', 'Update video information success');
    }

    public function softDelete($id)
    {
        $this->videoRepository->softDelete($id);
        Session::flash('status', 'Delete video success');
    }

    public function checkExistVideo($name)
    {
        $dir = '/';
        $recursive = false;
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        $video = $contents->where('filename', '=', $name)->first();
        if ($video){
            return true;
        } else {
            return false;
        }
    }

    public function setUploadStatus($id, $statusIndex)
    {
        $this->videoRepository->setUploadStatus($id, $statusIndex);
    }

    public function setVideoPath($id, $path)
    {
        $this->videoRepository->setVideoPath($id, $path);
    }

    public function getVideoNotInGroup($groupId, $number)
    {
        $video = $this->videoRepository->getVideoNotInGroup($groupId, $number);
        return $video;
    }
}
