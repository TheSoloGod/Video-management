<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = 'game';
        $category->save();

        $category = new Category();
        $category->name = 'funny';
        $category->save();

        $category = new Category();
        $category->name = 'anime';
        $category->save();

        $category = new Category();
        $category->name = 'cartoon';
        $category->save();

        $category = new Category();
        $category->name = 'tutorial';
        $category->save();
    }
}
