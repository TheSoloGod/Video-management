<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Video;

class CategoryVideo extends Model
{
    protected $table = 'category_video';

    protected $fillable = ['category_id', 'video_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
