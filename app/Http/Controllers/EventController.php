<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ColourController;
use App\Event;
use App\Location;
use App\Category;
use App\Tag;
use Session;
use DB;

class EventController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $events = DB::table('events')
            ->where('event_date', '>', date('Y-m-d').' 00:00:00')
            ->orderBy('event_date', 'asc')
            ->take(8)
            ->get();

         return view('events.index')->withEvents($events);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $ip = \Request::ip();
        $locations = Location::all();
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'locations' => $locations,
            'categories' => $categories,
            'tags' => $tags,
            'ip' =>$ip,
        ];

        return view('events.create')->withData($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, array(
            'name' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|integer',
            'location_id' => 'required',
            'amount_tickets' => 'required',
            'event_colour' => 'required'
        ));

        $event = new Event;

        $event->name = $request->name;
        
        $slug = preg_replace("/ {2,}/", " ", $request->name);
        $slug = str_replace(" ", "-", $slug);
        $slug = strtolower($slug); 

        $event->slug = $slug;
        $event->description = $request->description;

        $event->hash = hash('ripemd160', preg_replace('/[^A-Za-z0-9\-]/', '', $slug));

        $event->event_date = $request->event_date . " " . $request->event_time;


        if($request->location_id == 'CREATE') 
        {
            $location = (new LocationController)->createLocation($request->add_location_name, 1000, $request->add_location_street, $request->add_location_streetnumber, $request->add_location_additional, $request->add_location_city, $request->add_location_zipcode, $request->add_location_country);
            $event->location_id = $location;
        }
        else 
        {
            $event->location_id = $request->location_id;
        }

        $event->amount_tickets = $request->amount_tickets;
        $event->event_colour = $request->event_colour;
        $event->dark_event_colour = (new ColourController)->darken_colour($event->event_colour);
        $event->creator = \Request::ip();
        $event->category_id = $request->category_id;

        $event->save();

        if($request->add_tag_name !== NULL) {
            $tag = (new TagController)->createTag($request->add_tag_name);
            $event->tags()->sync($tag, false);
        } else {
            $event->tags()->sync($request->tags, false);
        }

        $tickets = (new TicketController)->generate($event->amount_tickets, $event->id);

        Session::flash('success', 'The event was succesfully created.');

        return redirect()->route('events.show', $event->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $event = Event::find($id);

        $tickets = DB::table('tickets')
            ->where('tickets.event_id', '=', $id)
            ->leftJoin('ticket_reservations', 'tickets.id', '=', 'ticket_reservations.ticket_id')
            ->get();

        $availableTicketCount = 0;
        $reservedTicketCount = 0;
        $soldTicketCount = 0;

        foreach($tickets as $ticket) {
            if($ticket->status == 'R') {
                $reservedTicketCount++;
            }
            elseif($ticket->status == 'S') {
                $soldTicketCount++;
            }
            else {
                $availableTicketCount++;
            }
        }

        $data = [
            'event' => $event,
            'ip' => \Request::ip(),
            'tickets' => $tickets,
            'availableTickets' => $availableTicketCount,
            'reservedTickets' => $reservedTicketCount,
            'soldTickets' => $soldTicketCount
        ];

        return view('events.show')->withData($data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $event = Event::find($id);
        $categories = Category::all();

        $cats = [];

        foreach($categories as $category){
            $cats[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $tags2 = [];

        foreach($tags as $tag){
            $tags2[$tag->id] = $tag->name;
        }

        return view('events.edit')->withEvent($event)->withCategories($cats)->withTags($tags2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event =  Event::find($id);

        if($request->input('slug') == $event->slug ) {
            $this->validate($request, array(
                'name' => 'required|max:255',
                'description' => 'required',
                'category_id' => 'required|integer'
            ));
        }else{
            $this->validate($request, array(
                'name' => 'required|max:255',
                'description' => 'required',
                'category_id' => 'required|integer',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:events,slug'
            ));
        }

        $event->name = $request->input('name');
        $event->slug = $request->input('slug');
        $event->category_id = $request->input('category_id');
        $event->description = $request->input('description');

        $event->save();

        if(isset($request->tags)) {
            $event->tags()->sync($request->tags, true);
        }else{
            $event->tags()->sync(array());
        }

        Session::flash('success', 'This event was succesfully edited.');

        return redirect()->route('events.show', $event->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TODO : Delete function needs to delete all records with this event_id in other tables.
        $event = Event::find($id);

        $event->delete();

        Session::flash('success', 'Succesfully deleted');

        return redirect()->route('events.list');
    }

    public function getEvents()
    {

        if(isset($_GET['offset']) && isset($_GET['limit'])){
            $limit = $_GET['limit'];
            $offset = $_GET['offset'];

            $events = DB::table('events')
                ->offset($offset)
                ->limit($limit)
                ->get();


            foreach($events  as $event) {
                echo '<tr>';
                echo '<th>'. $event->id .'</th>';
                echo '<td>'. $event->name .'</td>';
                echo '<td>'. $event->description .'</td>';
                echo '<td>'. date('l j F, Y', strtotime($event->event_date)) .'</td>';
                echo '<td><a href="/events/'.$event->id .'" class="btn btn-default btn-sm">View</a> <a href="/events/'.$event->id .'/edit" class="btn btn-default btn-sm">Edit</a></td>';
                echo '</tr>';
            }

        }

    }

    public function listEvents() {

        $events = Event::orderBy('id', 'desc')->paginate(5);
        foreach($events as $key => $event) {
            $tickets = (new TicketController)->getTicketsById($event->id);
            $events[$key]['tickets'] = $tickets;
            $events[$key]['location'] = DB::table('locations')
                ->select('locations.*')
                ->leftJoin('events', 'events.location_id', '=', 'locations.id')
                ->where('events.location_id', '=', $event['location_id'])
                ->where('events.id', '=', $event['id'])
                ->first();
        }

        return view('events.list')->withEvents($events);
    }


    /**
    *
    *
    * @param  int  $id
    **/
    public function simulateEvent(){

        if(isset($_GET['event_id'])) { 
            $id = $_GET['event_id'];
        }

        if($this->checkSimulation($id) === false) {

            // Delete all reservations for this event
            DB::table('ticket_reservations')
            ->where('event_id' , '=', $id)
            ->delete();
            
            // Set event simulation to active
            $update = DB::table('event_simulation')
                ->where('event_id', $id)
                ->update(['status' => 'N', 'updated_at' => date("Y/m/d h:i:s"), 'end_simulation' => date("Y/m/d h:i:s", strtotime('+1 hour'))]);


            // Below we're going to start simulating the current event

            // Get all event tickets
            $allTickets = DB::table('tickets')
                ->where('event_id', '=', $id)
                ->get();

            $allTicketsArray = $allTickets->toArray();

            $reservedTickets = array();
            $availibleTickets = array();

            // R = Reserved - S = Sold - A = Availible
            $statusOptions = ['R', 'S'];

            $random_num = rand(2,4);
            $random_keys = array_rand($allTicketsArray, $random_num);

            $insertArray = [];


            foreach($random_keys as $key) {

                $optionsIndex = array_rand($statusOptions);
                
                $insertArray[] = [
                    'ticket_id' => $allTickets[$key]->id,
                    'event_id' => $id,
                    'buyer_id' => '0',
                    'status' => $statusOptions[$optionsIndex]
                ];
            }

            DB::table('ticket_reservations')->insert($insertArray);

            $reservedTickets = DB::table('ticket_reservations')
                ->where('event_id', '=', $id)
                ->pluck('ticket_id')->toArray();

            foreach($allTickets as $ticket) {
                $ticket_id = $ticket->id;
                if(!in_array($ticket_id, $reservedTickets)) {
                    $availibleTickets[] = [
                    'ticket_id' => $ticket->id,
                    'status' => 'A',
                    ];
                }
            }
            $simulatedTickets = array_merge($insertArray, $availibleTickets);

            return $simulatedTickets;

        }
    }

    /**
    *
    *
    * @param  int  $id
    **/
    public function stopEventSimulation(){
        if(isset($_GET['event_id'])) { 
            $id = $_GET['event_id']; 
            
            $update = DB::table('event_simulation')
                ->where('event_id', $id)
                ->update(['status' => 'N', 'updated_at' => date("Y/m/d h:i:s"), 'end_simulation' => date("Y/m/d h:i:s")]);
        }
    }

    // Status A = Active , Status N = Not active
    // This function is to check if the simulation is running in a other browser
    public function checkSimulation($event_id) {

        $eventSim = DB::table('event_simulation')
            ->where('event_id', '=', $event_id)
            ->get();

        // Check if there is a row for this event id in the simulation table
        if(count($eventSim) > 0) {
            if($eventSim[0]->status == 'A') {
                // Here we're going to do put a action to get this browser paralel with the other browser which started the simulation

            }elseif($eventSim[0]->status == 'N') {
                // The simulation is not running (yet)
                return false;
            }
        }
        else {
            // Row doesn't exist , create one, start sim.
            DB::table('event_simulation')->insert(
                ['event_id' => $event_id, 'status' => 'A','created_at' => date("Y/m/d h:i:s"), 'updated_at' => date("Y/m/d h:i:s"), 'end_simulation' => date("Y/m/d h:i:s", strtotime("+30 minutes"))]
            );
        }

    }


    public function checkSimulationOnLoad() {

        if(isset($_GET['event_id'])) { 
            $id = $_GET['event_id'];

            $eventSim = DB::table('event_simulation')
                ->where('event_id', '=', $id)
                ->get();
        }

        //return $eventSim[0]->status;
    }

    public function displayTicket($id, $hash) {

        $event = Event::find($id);

        $ticket = DB::table('tickets')
            ->select(DB::raw('tickets.id as tid, tickets.*, ticket_reservations.*'))
            ->where('tickets.hash', '=', $hash)
            ->leftJoin('ticket_reservations', 'tickets.id', '=', 'ticket_reservations.ticket_id')
            ->get();

            $data = [ 
                'event' => $event,
                'ticket' => $ticket
            ];
        return view('events.ticket')->withData($data);
    }

    public function getEventList() {
        if(isset($_GET['searchKey']) && isset($_GET['limit'])) {
            $searchKey = $_GET['searchKey'];
            $limit = $_GET['limit'];

            $eventList = DB::table('events')
                ->where('name', 'like', '%'.$searchKey.'%')
                ->limit($limit)
                ->get();

            foreach($eventList as $eventItem) {
                echo '<li><a href="events/'. $eventItem->id .'" class="list-group-item">' . $eventItem->name . '</a></li>';
            }
        }
    }

    public function getSingle($slug) {
       return  $slug;
    }

}
