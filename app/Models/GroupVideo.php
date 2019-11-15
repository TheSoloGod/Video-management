<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupVideo extends Model
{
    protected $table = 'group_video';

    protected $fillable = ['group_id', 'video_id'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
