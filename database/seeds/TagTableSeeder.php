<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = new \App\Tag([
        	'name' => 'latinvillage'
        ]);
        $tag->save();

        $tag = new \App\Tag([
        	'name' => 'tomorrowland'
        ]);
        $tag->save();

        $tag = new \App\Tag([
        	'name' => 'soranje'
        ]);
        $tag->save();

        $tag = new \App\Tag([
        	'name' => 'encorefestival'
        ]);
        $tag->save();

        $tag = new \App\Tag([
        	'name' => 'woohah'
        ]);
        $tag->save();
    }
}
