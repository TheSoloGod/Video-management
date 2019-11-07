<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\VideoService\VideoServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVideoRequest;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.video.list', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoRequest $request)
    {
        $video = $this->videoService->store($request);
        if($video){
            $videoId = $video->id;
            return redirect()->route('videos.show', compact('videoId'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = $this->videoService->getById($id);
        $categories = $this->videoService->getAllCategory($id);
        $groups = $this->videoService->getAllGroup($id);
        return view('admin.video.detail', compact('video', 'categories', 'groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = $this->videoService->getById($id);
        $categories = $this->videoService->getAllCategory($id);
        $groups = $this->videoService->getAllGroup($id);
        return view('admin.video.edit', compact('video', 'categories', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
     * @param  int  $id
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
        if (Auth::user() == null) {
            $userId = false;
        } else {
            $userId = Auth::user()->id;
        }
        return view('public.search-result', compact('videos', 'userId'));
    }
}
