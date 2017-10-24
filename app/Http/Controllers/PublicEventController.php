<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class PublicEventController extends Controller
{
    //
    public function getSingle($slug) {
    	
    	$event = Event::where('slug', '=', $slug)->first();

    	return view('events.show')->withEvent($event);
    }
}
