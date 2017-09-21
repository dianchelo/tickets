<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location = new \App\Location([
        	'name' => 'Haarlemmerbos',  
        	'capacity' => '50000', 
        	'street' => 'Bospad', 
        	'number' => '2', 
        	'additional' => NULL, 
        	'city' => 'Amsterdam', 
        	'zipcode' => '1212AT', 
        	'country' => 'Netherlands'
        ]);

        $location->save();

        $location = new \App\Location([
        	'name' => 'Antwerpen Stad',  
        	'capacity' => 180000, 
        	'street' => 'Lage dijk', 
        	'number' => 10, 
        	'additional' => NULL, 
        	'city' => 'Antwerpen', 
        	'zipcode' => '6045YY', 
        	'country' => 'Belgium'
        ]);

        $location->save();

        $location = new \App\Location([
        	'name' => 'Plein 1949',  
        	'capacity' => 5000, 
        	'street' => 'Blaak', 
        	'number' => 50, 
        	'additional' => NULL, 
        	'city' => 'Rotterdam', 
        	'zipcode' => '3012RK', 
        	'country' => 'Netherlands'
        ]);

        $location->save();

        $location = new \App\Location([
        	'name' => 'Fabriekplein',  
        	'capacity' => 12000, 
        	'street' => 'Chemielaan', 
        	'number' => 55, 
        	'additional' => NULL, 
        	'city' => 'Amsterdam', 
        	'zipcode' => '6788YY', 
        	'country' => 'Netherlands'
        ]);

        $location->save();

        $location = new \App\Location([
        	'name' => 'Stationplein',  
        	'capacity' => 22000, 
        	'street' => 'Stationsplein', 
        	'number' => 1, 
        	'additional' => NULL, 
        	'city' => 'Tilburg', 
        	'zipcode' => '6666FR', 
        	'country' => 'Netherlands'
        ]);

        $location->save();
    }
}
