<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Video;
use App\GroupVideo;
use App\GroupUser;

class Group extends Model
{
    protected $fillable = ['name', 'image'];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function video()
    {
        return $this->belongsToMany(Video::class);
    }

    public function groupVideo()
    {
        return $this->hasMany(GroupVideo::class);
    }

    public function groupUser()
    {
        return $this->hasMany(GroupUser::class);
    }
}
