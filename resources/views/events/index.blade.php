 @extends('main')

 @section('title', ' | All Events')


 @section('stylesheets')

<style>

.white {
	background-color: #fff;
}

.transparent {
  background-color: transparent !important;
  box-shadow: inset 0px 1px 0 rgba(0,0,0,.075);
}
.left-border-none {
  border-left:none !important;
  box-shadow: inset 0px 1px 0 rgba(0,0,0,.075);
}

</style>

 @endsection

 @section('topclass', 'bg')

 @section('topcontainer')

 	

	 	<div class="" style="background-color:; padding:20px; margin-top:150px;">
	 		<div class="col-md-6 col-md-offset-3 text-center" style="background-color:;" >
	 			<h1 class="t-darkgrey">Create events and simulate them..</h1>
	 		</div>
	 	</div>

	 	 <div class="" style="background-color:; padding:20px; margin-top:15px; text-align: center;">
	 		<div class="col-md-6 col-md-offset-3" style="background-color:;" >
	 			<div class="form-group">
		            <div class="input-group">
		            	<span class="input-group-addon b-white"><span class="glyphicon glyphicon-search"></span></span>
		            	<input id="home-search" class="form-control left-border-none dropdown-toggle"  style="height: 50px; font-size:18px; font-weight: none;" placeholder="keywords..." type="text" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		        	</div>
	        	</div>

				<ul id="home-search-results">
				</ul>
	 		</div>
	 	</div>

 @endsection

 @section('content')

 	<div class="row">
 		<div class="col-md-12 text-center">
 			<h2>Naderende evenementen</h2>
 		</div>
 	</div>

 	<div class="indexEvents" class="row">

 		@foreach($events as $key => $event)
 			@if($key <= 2)
 			<a href="{{route('events.show', ['id' => $event->id], false) }}" >
 			<div class="col-sm-6 col-md-4">
			    <div class="thumbnail @if($key == '0') b-green @elseif($key == '1') b-pink @elseif($key == '2') b-gold @endif ">
			      <div class="caption text-center">
			      	{{ Html::image('img/thumbnail-round.png') }}
			        <h3>{{ $event->name }}</h3>
			        <p>{{ date('j F - Y', strtotime($event->event_date)) }}</p>
			        
			      </div>
			    </div>
			</div>
			</a>
			@endif
			@if($key == 3 || $key == 4)
 			<a href="{{route('events.show', ['id' => $event->id], false) }}" >
 			<div class="col-sm-6 col-md-6">
			    <div class="thumbnail @if($key == '3') b-green @elseif($key == '4') b-pink @endif ">
			      <div class="caption text-center">
			      	{{ Html::image('img/thumbnail-round.png') }}
			        <h3>{{ $event->name }}</h3>
			        <p>{{ date('j F - Y', strtotime($event->event_date)) }}</p>
			        
			      </div>
			    </div>
			</div>
			</a>
			@endif
			@if($key >= 5)
 			<a href="{{route('events.show', ['id' => $event->id], false) }}" >
 			<div class="col-sm-6 col-md-4">
			    <div class="thumbnail @if($key == '7') b-green @elseif($key == '6') b-pink @elseif($key == '5') b-gold @endif ">
			      <div class="caption text-center">
			      	{{ Html::image('img/thumbnail-round.png') }}
			        <h3>{{ $event->name }}</h3>
			        <p>{{ date('j F - Y', strtotime($event->event_date)) }}</p>
			        
			      </div>
			    </div>
			</div>
			</a>
			@endif
 		@endforeach


 	</div>



 @endsection

@section('scripts')
{{ Html::script('js/homeHandlers.js') }}
{{ Html::script('js/fuelux.js') }}

<script type="text/javascript">
       if (window.location.hash == '#_=_'){
       history.replaceState ? history.replaceState(null, null, window.location.href.split('#')[0]) : window.location.hash = '';
       }
</script>

@endsection