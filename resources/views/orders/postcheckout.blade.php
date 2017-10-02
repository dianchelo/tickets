@extends('main')

@section('topclass', 'small-bg')

@section('content')

@if($payment->isPaid()) 
	<div class="row">
		<div class="well" style="border:1px solid #2eef2b; background-color:#9dff9b; margin:20px;">
			<h4>Hi <strong>{{$order->user->name}}</strong>,<br>
			Thank you for your order.</h4><br><br>

			<h4>Order Details:</h4><br>
			<table class="table table-striped">
			    <thead>
			      <tr>
			        <th>Ticket Amount</th>
			        <th>Event</th>
			        <th>Ticket Link</th>
			      </tr>
			    </thead>
			    <tbody>
			    	@foreach($cart as $key => $ticket)
			    	<tr>
			    		<td>{{ $ticket->qty}}</td>
			    		<td> {{ $ticket->name }} </td>
			    		<td> LINK TBA.</td>
			    	</tr>


			    	@endforeach
			    </tbody>
			</table>
		</div>
	</div>

@endif

@if($payment->isFailed()) 


@endif


@endsection