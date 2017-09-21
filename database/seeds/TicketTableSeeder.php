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

		    if($i >= 1 || $i <= 10) {
		    	$ticket = new \App\Ticket([
			        	'event_id' => 1, 
			        	'user_id' => '1', 
			        	'price' => '20.00', 
			        	'hash' => $hash
				]);
		    }

		   	if($i >= 11 || $i <= 20) {
		    	$ticket = new \App\Ticket([
			        	'event_id' => 2, 
			        	'user_id' => '1', 
			        	'price' => '25.00', 
			        	'hash' => $hash
				]);
		    }

		     if($i >= 21 || $i <= 30) {
		    	$ticket = new \App\Ticket([
			        	'event_id' => 3, 
			        	'user_id' => '1', 
			        	'price' => '7.50', 
			        	'hash' => $hash
				]);
		    }

		    if($i >= 31 || $i <= 40) {
		    	$ticket = new \App\Ticket([
			        	'event_id' => 4, 
			        	'user_id' => '1', 
			        	'price' => '50.00', 
			        	'hash' => $hash
				]);
		    }

		    if($i >= 41 || $i <= 50) {
		    	$ticket = new \App\Ticket([
			        	'event_id' => 5, 
			        	'user_id' => '1', 
			        	'price' => '10.00', 
			        	'hash' => $hash
				]);
		    }
		    
			$ticket->save();

	    }
        
    }
}
