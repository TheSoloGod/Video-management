<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(CategoryVideoTableSeeder::class);
        $this->call(GroupUserTableSeeder::class);
        $this->call(GroupVideoTableSeeder::class);
        $this->call(UserVideoTableSeeder::class);
    }
}
