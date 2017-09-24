@extends('main')

@section('topclass', 'event-bg')

 @section('topcontainer')

 	<div class="">
 		<div class="col-md-6 col-md-offset-3 text-center">
 			<h1 class="t-white">Cart</h1>
 		</div>
 	</div>

@endsection

@section('content')

	@if(Cart::count() > 0)

	<div class="row" style="border:2px solid #ccc; margin-top:20px; margin-bottom:20px; border-radius:20px;">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
					<h2>Cart</h2>
				</div>
			</div>
			<hr>


			<table class="table table-hover" style="padding:0px;">
			    <thead>
			      <tr>
			        <th width="80%">Event</th>
			        <th></th>
			        <th style="text-align:right;">Price</th>
			      </tr>
			    </thead>
			    <tbody>
			     	@foreach(Cart::content() as $row)
			     		<tr>
							<td>
								<strong><a href="/events/{{$row->model->event->id}}/{{$row->model->hash}}">{{ $row->qty }}x {{ $row->name }}</a></strong><br>
								<strong>{{ date('l j F, Y', strtotime($row->model->event->event_date)) }}, {{ $row->model->event->location->name }},  {{ $row->model->event->location->city }},  {{ $row->model->event->location->country }}</strong>
							</td>
							<td style="text-align:right;">


								<form action="{{ route('cart.destroy', $row->id) }}" method="POST">
								    {{ method_field('DELETE') }}
								    {{ csrf_field() }}
								    <button><i class="fa fa-trash-o" aria-hidden="true"></i></button>
								</form>



							</td>
			        		<td style="text-align:right;">{{ $row->total }}</td>
			        	</tr>	
					@endforeach

					<tr>
						<td colspan="2" style="text-align:right;"><strong>Totaal</strong></td>
						<td  style="text-align:right;">{{ Cart::total() }}</td>
					</tr>
			    </tbody>
      		</table>

      		
		</div>
	</div>

	<div class="row">
      			<div class="col-md-12">
      				<button type="button" class="btn btn-gold btn-lg btn-block" style="margin-bottom:20px;">Buy now</button>
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
