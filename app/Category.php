<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Video;
use App\CategoryVideo;

class Category extends Model
{
    protected $fillable = ['name'];

    public function video()
    {
        return $this->belongsToMany(Video::class);
    }

    public function category_video()
    {
        return $this->hasMany(CategoryVideo::class);
    }
}
