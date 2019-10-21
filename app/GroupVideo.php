<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;
use App\Video;

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
