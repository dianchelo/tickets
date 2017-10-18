@extends('main')

@section('title' , '| Create new Ticket')

 @section('topclass', 'event-bg')

 @section('topcontainer')

	 	<div class="row" style="background-color:; padding:20px; margin-top:0px;">
	 		<div class="col-md-6 col-md-offset-3 text-center" style="background-color:;" >
	 			<h1 class="t-darkgrey">Sell your ticket</h1>
	 			<h5>Little text that needs some editing</h5>
	 		</div>
	 	</div>

 @endsection


@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="well top-30" style="height: auto;">

				<h4>What event you want to sell for?</h4>

				<div id="search-bar-events" class="form-group">
		            <div class="input-group">
		            	<span class="input-group-addon b-white"><span class="glyphicon glyphicon-search"></span></span>
		            	<input id="event-search" class="form-control left-border-none dropdown-toggle"  style="height: 50px; font-size:18px; font-weight: none;" placeholder="Search Events.." type="text" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		        	</div>
	        	</div>

				<div class="row">
					<div id="event-search-results"></div>

					<div id="thing"></div>

					<div id="change-event">Change your event</div>

			</div>
		</div>

		{!! Form::open(['route' => 'tickets.userstore', 'class' => 'form', 'data-parsley-validate' => '']) !!}
		<div class="well top-30" style="min-height:150px;">
				<h4>How much tickets would you like to sell?</h4>
				<input type="text" name="eventid" id="ticket-eventid" value="" readonly="" hidden required>
				<div class="col-sm-4">
				{!! Form::selectRange('amount_tickets', 1, 1, 1, array('class' => 'form-control')) !!}
				</div>
		</div>

		<div class="well top-30" style="min-height:150px;">
			<h4>Price for your ticket</h4>
				<div class="col-sm-4">
				{{ Form::text('price', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255', 'placeholder' => '€', 'maxlength' => '6')) }}
				</div>
			</div>
	</div>
	</div>

	{{ Form::submit('Put ticket for sale', array('id' => 'ticketsubmit', 'class' => 'btn b-pink btn-lg btn-block', 'style' => 'margin-top:20px; margin-bottom:20px;')) }}
		{!! Form::close() !!}

@endsection

@section('scripts')
{{ Html::script('js/ticketHandlers.js') }}

<script type="text/javascript">

$('#change-event').hide();
$('#ticketsubmit').hide();
	
	$('#event-search-results').on('click', '.search-item', function(){

		var clickedEventId = $(this).data('event-id');
		var eventElement = $('[data-event-id='+clickedEventId+']').clone();

		$('#ticket-eventid').val(clickedEventId);

		$('#event-search').val('');
		$('#event-search-results').empty();

		eventElement.removeClass('search-item');
		eventElement.addClass('selected-event');
		eventElement.appendTo('#thing'); 

		

		$('#search-bar-events').hide();
		$('#change-event').show();
		$('#ticketsubmit').show();
	});

	$('#change-event').on('click', function(){
		$('#thing').empty();
		$('#search-bar-events').show();
		$('#change-event').hide();
		$('#ticketsubmit').hide();

	});

</script>
@endsection