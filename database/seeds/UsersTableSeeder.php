<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'user one';
        $user->email = 'user1@gmail.com';
        $user->password = Hash::make('user1234');
        $user->address = 'address 1';
        $user->phone = '0123456789';
        $user->save();

        $user = new User();
        $user->name = 'user two';
        $user->email = 'user2@gmail.com';
        $user->password = Hash::make('user1234');
        $user->address = 'address 2';
        $user->phone = '0123456789';
        $user->save();

        $user = new User();
        $user->name = 'user three';
        $user->email = 'user3@gmail.com';
        $user->password = Hash::make('user1234');
        $user->address = 'address 3';
        $user->phone = '0123456789';
        $user->save();

        $user = new User();
        $user->name = 'user four';
        $user->email = 'user4@gmail.com';
        $user->password = Hash::make('user1234');
        $user->address = 'address 4';
        $user->phone = '0123456789';
        $user->save();

        $user = new User();
        $user->name = 'user five';
        $user->email = 'user5@gmail.com';
        $user->password = Hash::make('user1234');
        $user->address = 'address 5';
        $user->phone = '0123456789';
        $user->save();

        $user = new User();
        $user->name = 'user six';
        $user->email = 'user6@gmail.com';
        $user->password = Hash::make('user1234');
        $user->address = 'address 6';
        $user->phone = '0123456789';
        $user->save();
    }
}
