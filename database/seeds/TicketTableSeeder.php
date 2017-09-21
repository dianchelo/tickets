<?php

use Illuminate\Database\Seeder;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    for($i = 1;$i <= 50;$i++) {
	    	$hash = random_bytes(10);
	    	$hash = hash('ripemd160', $hash);
	    	$ticket = new \App\Ticket([
		        	'event_id' => 3, 
		        	'user_id' => '1', 
		        	'price' => '20.00', 
		        	'hash' => $hash
			]);
			$ticket->save();
	    }
	   for($i = 1;$i <= 50;$i++)  {
	   		$hash = random_bytes(10);
	    	$hash = hash('ripemd160', $hash);
	    	$ticket = new \App\Ticket([
		        	'event_id' => 4, 
		        	'user_id' => '1', 
		        	'price' => '25.00', 
		        	'hash' => $hash
			]);
			$ticket->save();
	    }
	    for($i = 1;$i <= 50;$i++)  {
	    	$hash = random_bytes(10);
	    	$hash = hash('ripemd160', $hash);
	    	$ticket = new \App\Ticket([
		        	'event_id' => 5, 
		        	'user_id' => '1', 
		        	'price' => '7.50', 
		        	'hash' => $hash
			]);
			$ticket->save();
	    }
	    for($i = 1;$i <= 50;$i++)  {
	    	$hash = random_bytes(10);
	    	$hash = hash('ripemd160', $hash);
	    	$ticket = new \App\Ticket([
		        	'event_id' => 6, 
		        	'user_id' => '1', 
		        	'price' => '50.00', 
		        	'hash' => $hash
			]);
			$ticket->save();
	    }
	    for($i = 1;$i <= 50;$i++)  {
	    	$hash = random_bytes(10);
	    	$hash = hash('ripemd160', $hash);
	    	$ticket = new \App\Ticket([
		        	'event_id' => 7, 
		        	'user_id' => '1', 
		        	'price' => '10.00', 
		        	'hash' => $hash
			]);
			$ticket->save();
	    }
        
    }
}
