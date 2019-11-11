<?php

namespace App\Jobs;

use App\Http\Controllers\Services\VideoService\VideoServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class UploadFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;
    protected $name;
    protected $videoService;

    /**
     * Create a new job instance.
     *
     * @param $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @param VideoServiceInterface $videoService
     * @return void
     * @throws FileNotFoundException
     */
    public function handle(VideoServiceInterface $videoService)
    {
        $this->videoService = $videoService;
        $fileUpload = Storage::disk('public')->get('/' . $this->name);
        $this->videoService->setUploadStatus($this->id, '1');
        Storage::cloud()->put('/' . $this->name, $fileUpload);  // xu ly phan tram upload o day
        Storage::disk('public')->delete('/' . $this->name);
    }
}
