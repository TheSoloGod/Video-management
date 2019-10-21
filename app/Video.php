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
    public $fillable = ['title', 'description', 'type', 'status', 'views', 'is_display', 'is_in_group', 'delete_at'];

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

    public function category_video()
    {
        return $this->hasMany(CategoryVideo::class);
    }

    public function group_video()
    {
        return $this->hasMany(GroupUser::class);
    }

    public function user_video()
    {
        return $this->hasMany(UserVideo::class);
    }
}
