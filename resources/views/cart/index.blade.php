@extends('main')

@section('topclass', 'small-bg')


@section('content')
	@if(count($tickets) >= 1 && count($tickets) != null)

	<div class="row" style="margin-top:20px;">
		<div class="col-md-12">
			<div class="well">
				<div class="row">
					<div class="col-md-12">
						<h2>Cart</h2>
					</div>
				</div>
				<hr>


				<table class="table table-hover" style="padding:0px;">
				    <thead>
				      <tr>
				        <th width="70%">Event</th>
				        <th>Reserved Till</th>
				        <th></th>
				        <th style="text-align:right;">Price</th>
				      </tr>
				    </thead>
				    <tbody>
				     	@foreach($tickets as $ticket)
				     		<tr>
								<td>
									<strong><a href="{{route('ticket.single', ['slug' => $ticket->model->event->id, 'hash' => $ticket->model->hash], false) }}">{{ $ticket->qty }}x {{ $ticket->name }}</a></strong><br>
									<strong>{{ date('l j F, Y', strtotime($ticket->model->event->event_date)) }}, {{ $ticket->model->event->location->name }},  {{ $ticket->model->event->location->city }},  {{ $ticket->model->event->location->country }}</strong>
								</td>
								<td>{{ $ticket->ticket->reservation->reserved_till }}</td>
								<td style="text-align:right;">


									<form action="{{ route('cart.destroy', $ticket->id) }}" method="POST">
									    {{ method_field('DELETE') }}
									    {{ csrf_field() }}
									    <button><i class="fa fa-trash-o" aria-hidden="true"></i></button>
									</form>



								</td>
				        		<td style="text-align:right;">€{{ $ticket->total }}</td>
				        	</tr>	
						@endforeach

						<tr>
							<td colspan="3" style="text-align:right;"><strong>Totaal</strong></td>
							<td  style="text-align:right;">€{{ Cart::total() }}</td>
						</tr>
				    </tbody>
	      		</table>

      		</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<a href="{{route('cart.checkout')}}" class="btn btn-gold btn-lg btn-block" style="margin-bottom:20px;">
		        <i class="fa fa-cog" aria-hidden="true"></i> Buy now
		    </a>
		</div>
	</div>

	@else

	<div class="row">
		<div class="col-md-12" style="text-align:center;">
			<img src="http://www.wovenandknit.com/img/empty-cart.jpg" alt="empty-cart"><br>
			Start ordering tickets and have it filled up in no-time.
		</div>

	</div>


	@endif

@endsection

@section('scripts')


@endsection