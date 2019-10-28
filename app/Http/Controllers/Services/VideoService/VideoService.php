<?php


namespace App\Http\Controllers\Services\VideoService;


use App\Http\Controllers\Repositories\VideoRepository\VideoRepositoryInterface;
use App\Jobs\SetPathFile;
use App\Jobs\UploadFile;
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

    public function paginate($number)
    {
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
            $fileExtension = $image->getClientOriginalExtension();
            $image->move('storage/preview', $imageName);
            $data['image'] = $imageName;
        }else{
            $data['image'] = 'preview-default.jpg';
        }

        if($request->hasFile('video')){
            $videoName = $request->video->getClientOriginalName();
            $request->video->storeAs('/', $videoName, 'public');
            $data['name'] = $videoName;

//            if($this->checkExistVideo($videoName)){
//                echo 'da ton tai video';
//            }else {
                UploadFile::dispatch($videoName);
//            }
        }else{
            echo 'chua chon video upload';
        }

        $data['status'] = 'uploading';

         return $this->videoRepository->create($data);
    }

    public function update($request, $id){
        $video = $this->videoRepository->getById($id);
        $data = $request->all();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $fileExtension = $image->getClientOriginalExtension();
            $image->move('storage/preview', $imageName);
            $data['image'] = $imageName;
        }else{
            $data['image'] = $video->image;
        }

        $this->videoRepository->update($data, $video);
    }

    public function delete($id){
        $video = $this->videoRepository->getById($id);
        $this->videoRepository->delete($video);
    }

    public function setPath($video)
    {
        SetPathFile::dispatch($video->name, $video->id);
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

    public function test($name)
    {
        $dir = '/';
        $recursive = false;
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        $videoPath = $contents->where('filename', '=', $name)->first();
        dd($videoPath);
    }
}
