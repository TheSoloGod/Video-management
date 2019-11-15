<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->name = 'admin one';
        $admin->email = 'admin@gmail.com';
        $admin->password = Hash::make('admin123');
        $admin->save();

        $admin = new Admin();
        $admin->name = 'admin two';
        $admin->email = 'admin2@gmail.com';
        $admin->password = Hash::make('admin123');
        $admin->save();

        $admin = new Admin();
        $admin->name = 'admin three';
        $admin->email = 'admin3@gmail.com';
        $admin->password = Hash::make('admin123');
        $admin->save();
    }
}
