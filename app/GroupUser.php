<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;
use App\User;

class GroupUser extends Model
{
    protected $table = 'group_user';

    protected $fillable = ['group_id', 'user_id', 'verify_at', 'token'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
