<?php


namespace App\Http\Controllers\Services\VideoService;


use App\Http\Controllers\Repositories\VideoRepository\VideoRepositoryInterface;
use App\Jobs\SetPathVideo;
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
                dd('da ton tai video');
            }else {
                UploadFile::dispatch($videoFullName);
            }
        }else{
            dd('chua chon video upload');
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
            $imageExtension = $image->getClientOriginalExtension();
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
        SetPathVideo::dispatch($video->name, $video->id);
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

}
