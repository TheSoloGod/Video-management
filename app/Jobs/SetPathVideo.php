<?php

namespace App\Jobs;

use App\Http\Controllers\Services\VideoService\VideoServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class SetPathVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;
    protected $name;
    protected $videoService;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(VideoServiceInterface $videoService)
    {
        $this->videoService = $videoService;
        $dir = '/';
        $recursive = false;
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        $videoPath = null;
        while (!$videoPath) {
            $videoPath = $contents->where('filename', '=', $this->name)->first()['path'];
        }
        $this->videoService->setVideoPath($this->id, $videoPath);
    }
}
