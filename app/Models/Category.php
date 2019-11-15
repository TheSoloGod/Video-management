<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

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
