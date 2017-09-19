<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;

use App\Http\Controllers\InstagramController;

class PublicTicketController extends Controller
{
    public function getSingle($slug, $hash){

    	$ticket = Ticket::where('hash', $hash)->first();
    	$images = (new InstagramController)->displayByHashtag('blijdorpfestival');

    	$images = $images['items']['data'];

    	return view('tickets.single')->withTicket($ticket)->withImages($images);


    }
}
