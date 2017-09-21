<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new \App\User([
        	'name' => 'Dianchelo Bazoer',
        	'email' => 'diianchelo@gmail.com',
        	'facebook_id' => '1667119799964745',
        ]);

        $user->save();
    }
}
