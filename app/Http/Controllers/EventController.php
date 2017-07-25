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
use Session;
use DB;

class EventController extends Controller
{
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

        //return view('events.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TODO : Fix Request IP
        $ip = \Request::ip();
        $locations = Location::all();

        $locations = DB::table('locations')->pluck('name')->toArray();

        $data = [
            'locations' => $locations,
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

        // validate stata
        $this->validate($request, array(
            'name' => 'required|max:255',
            'description' => 'required',
            // 'location_id' => 'required',
            // 'amount_tickets' => 'required',
            // 'event_colour' => 'required',
            // 'creator' => 'required'
        ));

        $event = new Event;

        $event->name = $request->name;
        
        $url_name = preg_replace("/ {2,}/", " ", $request->name);
        $url_name = str_replace(" ", "-", $url_name);
        // Hier moet nog een preg_replace komen om alle rare tekens behalve mijn - te verwijderen 

        $event->url_name = $url_name;
        $event->description = $request->description;

        $event->hash = hash('ripemd160', preg_replace('/[^A-Za-z0-9\-]/', '', $url_name));

        $event->event_date = $request->event_date . " " . $request->event_time;

        // Location_id - nieuwe aanmaken of huidige gebruiken
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
        $event->creator = \ Request::ip();



        $event->save();
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

            DB::table('ticket_reservations')
            ->where('event_id' , '=', $id)
            ->delete();
            
            // Set to active
            $update = DB::table('event_simulation')
                ->where('event_id', $id)
                ->update(['status' => 'N', 'updated_at' => date("Y/m/d h:i:s"), 'end_simulation' => date("Y/m/d h:i:s")]);

            // Start simulation tickets

            // Get all tickets
            $allTickets = DB::table('tickets')
                ->where('event_id', '=', $id)
                ->get();

            // Get all potentially reserved tickets
            $reservedTickets = DB::table('ticket_reservations')
                ->where('event_id', '=', $id)
                ->pluck('ticket_id')->toArray();

            $availibleTickets = array();

            // R = Reserved - S = Sold - A = Availible
            $statusOptions = ['R', 'S'];

            foreach($allTickets as $ticket) {
                $ticket_id = $ticket->id;
                if(!in_array($ticket_id, $reservedTickets)) {
                    array_push($availibleTickets, $ticket->id);
                }
            }

            $random_num = rand(2,4);
            $random_keys = array_rand($availibleTickets, $random_num);

            $insertArray = [];

            foreach($random_keys as $key) {

                $optionsIndex = array_rand($statusOptions);
                

                $insertArray[] = [
                    'ticket_id' => $availibleTickets[$key],
                    'event_id' => $id,
                    'buyer_id' => '0',
                    'status' => $statusOptions[$optionsIndex]
                ];
            }

            DB::table('ticket_reservations')->insert($insertArray);
            return $insertArray;

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
    public function checkSimulation($event_id) {

        $eventSim = DB::table('event_simulation')
            ->where('event_id', '=', $event_id)
            ->get();

        if(count($eventSim) > 0) {
            // Row exist
            
            // If simulation is already running don't display toggle
            if($eventSim[0]->status == 'A') {
                var_dump($eventSim[0]->status);
            exit;
            }
            // If simulation isn't running, start it up.
            if($eventSim[0]->status == 'N') {
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
                ->where('name', 'like',  $searchKey.'%')
                ->limit($limit)
                ->get();

            foreach($eventList as $eventItem) {
                echo '<li><a href="events/'. $eventItem->id .'" class="list-group-item">' . $eventItem->name . '</a></li>';
            }
            // var_dump($eventList);
            // exit;
        }
    }


}
