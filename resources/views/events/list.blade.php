@extends('main')

@section('title' , ' | List of all events')

@section('topclass', 'list-bg')

@section('topcontainer')

	<div class="">
		<div class="col-md-12 text-center">
			<h1 class="t-black">List of all events</h1>
		</div>
	</div>

@endsection

@section('content')

<div class="row">
	<div class="col-md-12">

	<table id="event-list-table" class="table table-borderless">
	<thead>
    </thead>
    <tbody>
	@foreach($events as $event)
       <tr>
        <td>
        	<span class="event-table-title"><h2><a href="/events/{{$event->id}}" >{{ $event->name }}</a></h2></span>
        	<h6>{{ $event->location->name }}</h6>
        	<h6> {{ $event->tickets['availbleTickets'] }}</h6>
        </td>
      </tr>
	@endforeach

    </tbody>
  </table>



	</div>
</div>

<div class="row">
	<div class="col-md-12 text-center">
		{!! $events->links() !!}
	</div>
	<div class="col-md-12 text-center">
		Page {!! $events->currentPage() !!} of {!! $events->lastPage() !!}
	</div>
</div>





@endsection