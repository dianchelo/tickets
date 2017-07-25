@extends('main')

@section('title' , ' | View event')

@section('stylesheets')

{{ Html::style('css/events/show.css')}}
<style>
span[rel="tag"] {
    display: inline-block;
    position:relative;
    padding: .7em;
    padding-left: 2em;
    margin: 0 .5em .5em 0;
    background: #{{$data['event']['event_colour']}};
    color: rgba(255,255,255,.6);
    text-decoration:none;
    font-weight: bold;
    height: 50px;
    width:100px;
}

span[rel="tag"]:hover {
    background:#{{$data['event']['dark_event_colour']}};
    color:white;
}

</style>
@endsection

@section('scripts')
{{ Html::script('js/eventHandlers.js') }}

@endsection

 @section('topclass', 'event-bg')

 @section('topcontainer')

 	<div class="">
 		<div class="col-md-6 col-md-offset-3 text-center">
 			<h1 class="t-white">{{ $data['event']['name'] }}</h1>
 			<input id="eventid" value="{{ $data['event']['id'] }}" hidden>
 		</div>
 	</div>

 	<div class="">
 		<div class="col-md-2 col-md-offset-4 text-center ">
 			<span class="glyphicon glyphicon-calendar btn-lg" aria-hidden="true"></span>  {{ date('l j F, Y', strtotime($data['event']['event_date'])) }}
 		</div>
 		<div class="col-md-2 col-md-offset-0 text-center  ">
 			 <span class="glyphicon glyphicon-map-marker btn-lg" aria-hidden="true"></span>  {{ date('l j F, Y', strtotime($data['event']['event_date'])) }}
 		</div>
 	</div>


 @endsection

@section('content')

	<div id="settings" class="row" style="margin-top:20px; display:;" >
		<div class="col-md-12">
			<div class="well">
				<dl class="dl-horizontal">
					<input type="text" id="eventid" value="{{ $data['event']['id'] }}" style="display:none;" readonly>  
					<dt>Event date : </dt>
					<dd>{{ date('l j F, Y', strtotime($data['event']['event_date'])) }}</dd>
				</dl>
				
				<dl class="dl-horizontal">
					<dt>Updated at : </dt>
					<dd>time : {{ $data['event']['creator'] }}

					</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Total Tickets : </dt>
					<dd>{{ $data['event']['amount_tickets'] }}

					</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Sim : </dt>
					<dd><input id="sim-event" type="checkbox" checked data-toggle="toggle" data-onstyle="success" data-width="100" data-on="Enabled" data-off="Disabled"><div id="sim-notice"></div> </dd>
				</dl>

				
				<hr>






				@if($data['event']['creator'] == $data['ip'])

					<div class="row">
						<div class="col-sm-6">
						{!! Html::linkRoute('events.edit', 'Edit', array($data['event']['id']), array('class' => 'btn btn-primary btn-block')) !!}
						</div>
						<div class="col-sm-6">
							{!! Html::linkRoute('events.destroy', 'Delete', array($data['event']['id']), array('class' => 'btn btn-danger btn-block')) !!}
						</div>
					</div>

				@endif
				

			</div>
		</div>
	</div>


	<div class="row" style="margin-top:20px;">
		<div class="col-md-8 col-md-offset-2">
			<ul class="nav nav-pills" role="tablist">
				<li><a id="a" class="btn btn-default btn-outline btn-lg avail-tick-amount">Available Tickets <span class="badge avail-badge">{{ $data['availableTickets'] }}</span></a> </li>
				<li><a class="btn btn-default btn-outline btn-lg reserved-tick-amount">Reserved Tickets <span class="badge reserved-badge">{{ $data['reservedTickets'] }}</span></a> </li>
			  	<li><a class="btn btn-default btn-outline btn-lg sold-tick-amount">Sold Tickets <span class="badge sold-badge">{{ $data['soldTickets'] }}</span></a> </li>
			</ul>
		</div>
	</div>


	<div class="row"">
		<div class="col-md-12">
			<h1 class="ticket-title">Available Tickets</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="list-group event-tickets">
							
			</div>

            <div class="list-group event-tickets-reserved" style="display: none;">
                            
            </div>

            <div class="list-group event-tickets-sold" style="display: none;">
                            
            </div>
		</div>
	</div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <button type="button" class="btn btn-gold btn-block btn-lg" id="ticketLoader">Load more..</button>
        </div>
    </div>




	<div id="row" style="display: none;">
		<div class="col-md-12">

			@foreach($data['tickets'] as $ticket)

				<a href="#" rel="tag" data-ticket-id="{{ $ticket->id }}"> 
					<div class="bigger">{{ $ticket->id }}</div><br>
					{{ $ticket->user_id }} <br>
			    </a>


			@endforeach		    	
			    
			</div>	
		</div>
	</div>



@endsection