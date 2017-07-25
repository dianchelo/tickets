@extends('main')

@section('topclass', 'event-bg')

@section('stylesheets')

<style>


span[rel="tag"]:before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0; 
    left: 0;
    z-index:1;
    
    background: -moz-radial-gradient(.6em .6em, circle, white .55em, rgba(255,255,255,0) .6em) -.6em -.6em,
                -moz-radial-gradient(1em 50%, circle, white .35em, rgba(255,255,255,0) .4em),
                -moz-radial-gradient(1em 47%, circle, rgba(0,0,0,.4) .4em, transparent .43em);
    background: -o-radial-gradient(.6em .6em, circle, white .55em, rgba(255,255,255,0) .6em) -.6em -.6em,
                -o-radial-gradient(1em 50%, circle, white .35em, rgba(255,255,255,0) .4em),
                -o-radial-gradient(1em 47%, circle, rgba(0,0,0,.4) .4em, transparent .43em);
    background: -ms-radial-gradient(.6em .6em, circle, white .55em, rgba(255,255,255,0) .6em) -.6em -.6em,
                -ms-radial-gradient(1em 50%, circle, white .35em, rgba(255,255,255,0) .4em),
                -ms-radial-gradient(1em 47%, circle, rgba(0,0,0,.4) .4em, transparent .43em);
    background: -webkit-radial-gradient(.6em .6em, circle, white .55em, rgba(255,255,255,0) .6em) -.6em -.6em,
                -webkit-radial-gradient(1em 50%, circle, white .35em, rgba(255,255,255,0) .4em),
                -webkit-radial-gradient(1em 47%, circle, rgba(0,0,0,.4) .4em, transparent .43em);
}

span[rel="tag"]:after {
    content: '';
    position:absolute;
    top:.25em;
    right:.25em;
    bottom:.25em;
    left:.25em;
    border: 1px rgba(0,0,0,.3) dashed;
    outline: 1px rgba(255,255,255,.5) dashed;
}

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
    height: 150px;
    width:310px;
}

span[rel="tag"]:hover {
    background:#{{$data['event']['dark_event_colour']}};
    color:white;
}


.bigger{
	margin-top:10px;
	font-size:70px;
}
</style>
@endsection

 @section('topcontainer')

 	<div class="">
 		<div class="col-md-6 col-md-offset-3 text-center">
 			<a href="/events/{{ $data['event']['id'] }}"><h1 class="t-white">{{ $data['event']['name'] }}</h1></a>
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

 	<div class="" >
 		<div  style="background-color:white; padding:20px; border-radius:30px; border:1px dashed #{{$data['event']['event_colour']}}" class="col-md-4 col-md-offset-4 text-center">
 			<span href="#" rel="tag" data-ticket-id=""> 
				<div class="bigger">{{ $data['ticket'][0]->tid }}</div><br>
				 <br>
			</span>
		</div>
 	</div>


 @endsection

@section('content')

	<div class="row" style="margin-top:20px;">
		<div class="col-md-3" style="background-color:green;">x</div>

		<div class="col-md-9" style="background-color:red;">f</div>
	</div>

@endsection