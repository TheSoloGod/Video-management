<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\User;
use App\Group;
use App\CategoryVideo;
use App\GroupVideo;
use App\UserVideo;

class Video extends Model
{
    public $fillable = [
        'title',
        'description',
        'type',
        'status',
        'image',
        'views',
        'is_display',
        'delete_at',
        'name',
        'path',
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function group()
    {
        return $this->belongsToMany(Group::class);
    }

    public function categoryVideo()
    {
        return $this->hasMany(CategoryVideo::class);
    }

    public function groupVideo()
    {
        return $this->hasMany(GroupUser::class);
    }

    public function userVideo()
    {
        return $this->hasMany(UserVideo::class);
    }

    public function dateVideo()
    {
        return $this->hasMany(DateVideo::class);
    }
}
