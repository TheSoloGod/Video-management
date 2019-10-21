<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Video;
use App\GroupVideo;
use App\GroupUser;

class Group extends Model
{
    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function video()
    {
        return $this->belongsToMany(Video::class);
    }

    public function group_video()
    {
        return $this->hasMany(GroupVideo::class);
    }

    public function group_user()
    {
        return $this->hasMany(GroupUser::class);
    }
}
