<?php

use Illuminate\Database\Seeder;
use App\Models\GroupUser;
use Carbon\Carbon;
use Illuminate\Support\Str;

class GroupUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupUser = new GroupUser();
        $groupUser->group_id = '1';
        $groupUser->user_id = '1';
        $groupUser->verify_at = Carbon::now();
        $groupUser->token = Str::random(10);
        $groupUser->save();

        $groupUser = new GroupUser();
        $groupUser->group_id = '2';
        $groupUser->user_id = '1';
        $groupUser->verify_at = Carbon::now();
        $groupUser->token = Str::random(10);
        $groupUser->save();

        $groupUser = new GroupUser();
        $groupUser->group_id = '2';
        $groupUser->user_id = '2';
        $groupUser->verify_at = Carbon::now();
        $groupUser->token = Str::random(10);
        $groupUser->save();

        $groupUser = new GroupUser();
        $groupUser->group_id = '3';
        $groupUser->user_id = '2';
        $groupUser->verify_at = Carbon::now();
        $groupUser->token = Str::random(10);
        $groupUser->save();

        $groupUser = new GroupUser();
        $groupUser->group_id = '1';
        $groupUser->user_id = '3';
        $groupUser->verify_at = Carbon::now();
        $groupUser->token = Str::random(10);
        $groupUser->save();

        $groupUser = new GroupUser();
        $groupUser->group_id = '2';
        $groupUser->user_id = '3';
        $groupUser->verify_at = Carbon::now();
        $groupUser->token = Str::random(10);
        $groupUser->save();

        $groupUser = new GroupUser();
        $groupUser->group_id = '3';
        $groupUser->user_id = '3';
        $groupUser->verify_at = Carbon::now();
        $groupUser->token = Str::random(10);
        $groupUser->save();

        $groupUser = new GroupUser();
        $groupUser->group_id = '1';
        $groupUser->user_id = '7';
        $groupUser->verify_at = Carbon::now();
        $groupUser->token = Str::random(10);
        $groupUser->save();
//
//        $groupUser = new GroupUser();
//        $groupUser->group_id = '2';
//        $groupUser->user_id = '6';
//        $groupUser->verify_at = Carbon::now();
//        $groupUser->token = Str::random(10);
//        $groupUser->save();
    }
}
