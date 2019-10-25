<?php


namespace App\Http\Controllers\Services\VideoService;


use App\Http\Controllers\Repositories\VideoRepository\VideoRepositoryInterface;

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

    public function update($request, $id){
        $video = $this->videoRepository->getById($id);
        $data = $request->all();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            $file->move('storage/preview', $fileName);
            $data['image'] = $fileName;
        } else {
            $data['image'] = $video->image;
        }

        $this->videoRepository->update($data, $video);
    }

    public function delete($id){
        $video = $this->videoRepository->getById($id);
        $this->videoRepository->delete($video);
    }
}
