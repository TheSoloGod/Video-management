<?php

namespace App\Http\Controllers\Backend\Video;

use App\Http\Controllers\Controller;
use App\Services\VideoService\VideoServiceInterface;
use App\Services\SubService\SessionService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVideoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    protected $videoService;


    public function __construct(VideoServiceInterface $videoService)
    {
        $this->videoService = $videoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = $this->videoService->paginate();
        return view('back_end.video.list', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->videoService->clearSessionCreateVideo();
        return view('back_end.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoRequest $request)
    {
        $video = $this->videoService->store($request);
        if ($video) {
            $videoId = $video->id;
            return redirect()->route('videos.show', compact('videoId'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = $this->videoService->getById($id);
        $categories = $this->videoService->getAllCategory($id);
        $groups = $this->videoService->getAllGroup($id);
        return view('back_end.video.detail', compact('video', 'categories', 'groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = $this->videoService->getById($id);
        $categories = $this->videoService->getAllCategory($id);
        $groups = $this->videoService->getAllGroup($id);
        return view('back_end.video.edit', compact('video', 'categories', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreVideoRequest $request, $id)
    {
        $this->videoService->update($request, $id);
        return redirect()->route('videos.show', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->videoService->softDelete($id);
        return redirect()->route('videos.index');
    }

    public function search(Request $request)
    {
        $videos = $this->videoService->search($request);
        return view('front_end.public.search-result', compact('videos', 'userId'));
    }

    public function getPaginateVideoOfCategory($categoryId)
    {
        $videos = $this->videoService->getPaginateVideoOfCategory($categoryId);
        return view('front_end.public.category-filter', compact('videos'));
    }

    public function uploadVideoProgressBar(Request $request)
    {
        $rules = array(
            'video' => 'required|mimes:mp4|max:2048000'
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            Session::put('uploadStatus', 'upload fail');
            return response()->json(['errors' => $error->errors()->all()]);
        }

        Session::put('uploadStatus', 'uploading');
        $video = $request->file('video');
        $newName = time() . '.' . $video->getClientOriginalExtension();
        Session::put('video_name', $newName);
        $video->move(public_path('storage/video'), $newName);
        Session::put('uploadStatus', 'upload success');

        $newVideo = $this->videoService->getByName($newName);
        if ($newVideo) {
            $newVideo->name = $newName;
            $newVideo->save();
        }

        $output = array(
            'success' => 'Video uploaded successfully',
            'image' => '<video width="100%" height="auto" controls src="/storage/video/' . $newName . '" ></video>'
        );
        return response()->json($output);
    }

    public function storeVideoInfo(Request $request)
    {
        $data = $this->videoService->store($request);
        return response()->json($data);
    }
}
