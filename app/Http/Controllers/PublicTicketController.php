<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Event;
use \Cart as Cart;
use DB;
use Auth;
use Session;

use App\Http\Controllers\InstagramController;

class PublicTicketController extends Controller
{
    public function getSingle($slug, $hash){

    	$ticket = Ticket::where('hash', $hash)->first();

        if(!isset($ticket->reservation->status)){ 
            $ticket->status = 'A';
        }else{
            $ticket->status = $ticket->reservation->status;
        }

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

    public function getAddToCart(Request $request, $id){
        $ticket = Ticket::find($id);

        dd(Cart::content());

    }

    public function sellTicket(Request $request){
        $events = Event::all();

        return view('tickets.create')->withEvents($events);
    }

    public function storeTicket(Request $request){

        $ticket = new Ticket();

        $this->validate($request, array(
            'eventid' => 'required|max:255',
            'amount_tickets' => 'required',
            'price' => 'required|max:6',
        ));

        $hash = random_bytes(10);
        $hash = hash('ripemd160', $hash);

        $ticket->event_id = $request->eventid;
        $ticket->user_id = Auth::user()->id;
        $ticket->price = $request->price;
        $ticket->hash = $hash;

        $ticket->save();

        Session::flash('success', 'The ticket was succesfully put up for sale.');

        return redirect('/events/'.$request->eventid.'/'. $hash)->with('status', 'Profile updated!');
    }
}
