<?php

use Illuminate\Database\Seeder;
use App\GroupUser;

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
        $groupUser->status = 'join';
        $groupUser->save();

        $groupUser = new GroupUser();
        $groupUser->group_id = '2';
        $groupUser->user_id = '1';
        $groupUser->status = 'join';
        $groupUser->save();

        $groupUser = new GroupUser();
        $groupUser->group_id = '2';
        $groupUser->user_id = '2';
        $groupUser->status = 'join';
        $groupUser->save();

        $groupUser = new GroupUser();
        $groupUser->group_id = '3';
        $groupUser->user_id = '2';
        $groupUser->status = 'join';
        $groupUser->save();

        $groupUser = new GroupUser();
        $groupUser->group_id = '1';
        $groupUser->user_id = '3';
        $groupUser->status = 'join';
        $groupUser->save();

        $groupUser = new GroupUser();
        $groupUser->group_id = '2';
        $groupUser->user_id = '3';
        $groupUser->status = 'join';
        $groupUser->save();

        $groupUser = new GroupUser();
        $groupUser->group_id = '3';
        $groupUser->user_id = '3';
        $groupUser->status = 'join';
        $groupUser->save();
    }
}
