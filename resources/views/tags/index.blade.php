  @extends('main')

 @section('title', ' | All Tags')


 @section('stylesheets')


 @endsection

 @section('topclass', 'event-bg')

 @section('topcontainer')

	 	<div class="" style="background-color:; padding:20px; margin-top:150px;">
	 		<div class="col-md-6 col-md-offset-3 text-center" style="background-color:;" >
	 			<h1 class="t-darkgrey">Tags</h1>
	 		</div>
	 	</div>

 @endsection

 @section('content')

 	<div class="row">
 		<div class="col-md-8">
 			<h1>Tags</h1>

 			<table class="table">
 				<thead>
 					<tr>
 						<th>#</th>
 						<th>Name</th>
 					</tr>
 				</thead>

 				<tbody>
 					@foreach ($tags as $tag)
 					<tr>
 						<th>{{ $tag->id }}</th>
 						<td>#{{ $tag->name }}</td>
 					</tr>
 					@endforeach
 				</tbody>
 			</table>
 		</div>  <!-- end md-8 -->

 		<div class="col-md-3 col-md-offset-1">
 			<div class="well">
 				{!! Form::open(['route' => 'tags.store', 'method' => 'POST']) !!}
 				<h2>New Tag</h2>
 				{{ Form::label('name', 'Name (don\'t put the hashtag) :') }}
 				{{ Form::text('name', null, ['class' => 'form-control'])}}
 				{{ Form::submit('Create new tag', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}

 				{!! Form::close() !!}
 				
 			</div>
 		</div>
 	</div>



 @endsection

