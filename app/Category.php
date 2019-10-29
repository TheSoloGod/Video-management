<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Video;
use App\CategoryVideo;

class Category extends Model
{
    protected $fillable = ['name', 'image'];

    public function video()
    {
        return $this->belongsToMany(Video::class);
    }

    public function categoryVideo()
    {
        return $this->hasMany(CategoryVideo::class);
    }
}
