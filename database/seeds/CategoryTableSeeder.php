<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Category([
        	'name' => 'Summer Festivals'
        ]);
        $category->save();

        $category = new \App\Category([
        	'name' => 'Indoor Winters'
        ]);
        $category->save();

        $category = new \App\Category([
        	'name' => 'Extreme Outdoor'
        ]);
        $category->save();

        $category = new \App\Category([
        	'name' => 'Classic days'
        ]);
        $category->save();

        $category = new \App\Category([
        	'name' => 'Kids'
        ]);
        $category->save();
    }
}
