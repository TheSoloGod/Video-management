<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

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
