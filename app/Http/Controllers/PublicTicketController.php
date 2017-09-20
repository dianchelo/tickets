<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Event;

use App\Http\Controllers\InstagramController;

class PublicTicketController extends Controller
{
    public function getSingle($slug, $hash){

    	$ticket = Ticket::where('hash', $hash)->first();
    	$event = Event::find($ticket->event_id);

    	$tags = $event->tags()->get();

    	if(isset($tags->first()->name)) {
    		$images = (new InstagramController)->displayByHashtag($tags->first()->name);
    		$images = $images['items']['data'];
    	}else{
    		$images = "";
    	}

    	

    	return view('tickets.single')->withTicket($ticket)->withImages($images)->withEvent($event)->withTags($tags);


    }
}
