<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = new Group();
        $group->name = 'Group 1';
        $group->save();

        $group = new Group();
        $group->name = 'Group 2';
        $group->save();

        $group = new Group();
        $group->name = 'Group 3';
        $group->save();
    }
}
