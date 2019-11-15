<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DateVideo extends Model
{
    protected $table = 'date_video';

    protected $fillable = ['date', 'video_id', 'today_views', 'yesterday_views', 'view_rate'];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
