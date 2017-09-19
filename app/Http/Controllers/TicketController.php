<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
    * Generate tickets for events
    *
    * @param int $amount
    * @param int $event_id
    * @return \Illuminate\Http\Response
    */
    public function generate($amount, $event_id)
    {

        $ticketsToGenerate = [];

        for($i = 1;$i <= $amount;$i++) {
            $hash = random_bytes(10);
            $hash = hash('ripemd160', $hash);

            //echo $i . " " . $hash ."<br>";

            $ticketsToGenerate[$i] = [
                'event_id' => $event_id,
                'user_id' => 0,
                'hash' => $hash,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];

        }

        // TODO validation
        // $this->validate($request, [
        //     'hash' => 'unique:hash'
        // ]);

        \DB::table('tickets')->insert($ticketsToGenerate); // Eloquent

    }


    public function getTicketsByEventId()
    {

        if(isset($_GET['case']) && $_GET['case'] == 'alltickets' && !isset($_GET['limit'])) {
            $offset = $_GET['offset'];
            $event_id = $_GET['event_id'];

            $tickets = DB::table('tickets')
            ->select(DB::raw('tickets.id as tid, tickets.*, ticket_reservations.*'))
            ->where('tickets.event_id', '=', $event_id)
            ->leftJoin('ticket_reservations', 'tickets.id', '=', 'ticket_reservations.ticket_id')
                ->offset($offset)
                ->limit(100000)
                ->get();

        }

        if(isset($_GET['offset']) && isset($_GET['limit']) && isset($_GET['event_id'])){
            $limit = $_GET['limit'];
            $offset = $_GET['offset'];
            $event_id = $_GET['event_id'];

            $tickets = DB::table('tickets')
            ->select(DB::raw('tickets.id as tid, tickets.*, ticket_reservations.*'))
            ->where('tickets.event_id', '=', $event_id)
            ->leftJoin('ticket_reservations', 'tickets.id', '=', 'ticket_reservations.ticket_id')
                ->offset($offset)
                ->limit($limit)
                ->get();          

        }



        foreach($tickets  as $ticket) {
            // TODO : Assign status to the availible tickets
            // Facing problems with usort multidimensional []
            echo '<a href="/events/'. $event_id .'/'. $ticket->hash .'" class="list-group-item" data-ticket-id="'.$ticket->tid.'" '.((isset($ticket->status))?'data-status="'.$ticket->status.'"':"").'>'; 
            echo '<h5><span rel="tag">1</span>'. $ticket->tid. ' </h5>';
            echo '</a>';
        }

        return;
    }

    function getTicketsById($event_id){
        $data = [];
        $availbleTickets = 0;

        $tickets = DB::table('tickets')
            ->select(DB::raw('tickets.id as tid, tickets.*, ticket_reservations.*'))
            ->where(function($query) use ($event_id) {
                $query->where('tickets.event_id', '=', $event_id);       
            })
            ->leftJoin('ticket_reservations', 'tickets.id', '=', 'ticket_reservations.ticket_id')
            ->limit(100000)
            ->get();

        foreach ($tickets as $key => $value) {
            if($value->status != 'R' && $value->status != 'S') {
                $availbleTickets++;
            }
        }

        $data = [
            'tickets' => $tickets,
            'availbleTickets' => $availbleTickets
        ];

        return $data;
    }


}
