@extends('main')

@section('title' , '| Create new Event')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	<style>
	#create_location{
		display:none;
		margin-top:20px;
	}
	</style>
@endsection

@section('content')

	<div class="row"> 
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Event</h1>
			<hr>

			{!! Form::open(['route' => 'events.store', 'class' => 'form-horizontal', 'data-parsley-validate' => '']) !!}
			<div class="form-group">
				{{ Form::label('name', 'Name:', ['class' => 'col-sm-2 control-label']) }}
				<div class="col-sm-10">
				{{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('description', 'Description:', ['class' => 'col-sm-2 control-label']) }}
				<div class="col-sm-10">
				{{ Form::textarea('description', null, array('class' => 'form-control', 'required' => '')) }}
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('event_date', 'Event Date:', ['class' => 'col-sm-2 control-label']) }}
				<div class="col-sm-4">
				{{ Form::date('event_date', null, array('class' => 'form-control', 'required' => ''))}}
				</div>

				{{ Form::label('event_time', 'Event Time:', ['class' => 'col-sm-2 control-label']) }}
				<div class="col-sm-4">
				{{ Form::time('event_time', null, array('class' => 'form-control', 'required' => ''))}}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('location_id', 'Location:', ['class' => 'col-sm-2 control-label']) }}
				<div class="col-sm-10">
				{!! Form::select('location_id', $data['locations'] +['CREATE' => 'Create Location']  , null, ['id' => 'location_id', 'placeholder' => 'Pick a location...', 'class' => 'form-control', 'required' => ''])!!}
				</div>
			</div>


			<div id="create_location" class="form-group row well">
				<div class="col-md-11 col-md-offset-1">
					<div class="form-group">
						{{ Form::label('add_location_name', 'New name:', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-9">
						{{ Form::text('add_location_name', null, array('class' => 'form-control new-location'))}}
						</div>
					</div>
						
		            <div class="form-group">
		                {{ Form::label('add_location_street', 'New street:', ['class' => 'control-label col-sm-2']) }}
		                <div class="col-sm-3">
		                    {{ Form::text('add_location_street', null, array('class' => 'form-control new-location'))}}
		                </div>

		                {{ Form::label('add_location_streetnumber', 'Nr:', ['class' => 'control-label col-sm-1']) }}
		                <div class="col-sm-2">
		                    {{ Form::text('add_location_streetnumber', null, array('class' => 'form-control new-location'))}}
		                </div>

		                {{ Form::label('add_location_additional', 'Additio.', ['class' => 'col-sm-1 control-label']) }}
						<div class="col-sm-2">
						{{ Form::text('add_location_additional', null, array('class' => 'form-control'))}}
						</div>
		            </div>

					<div class="form-group">
						{{ Form::label('add_location_city', 'New city:', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-9">
						{{ Form::text('add_location_city', null, array('class' => 'form-control new-location'))}}
						</div>
					</div>

					<div class="form-group">
						{{ Form::label('add_location_zipcode', 'New zipcode:', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-9">
						{{ Form::text('add_location_zipcode', null, array('class' => 'form-control new-location'))}}
						</div>
					</div>

					<div class="form-group">
						{{ Form::label('add_location_country', 'New country:', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-9">
						{{ Form::text('add_location_country', null, array('class' => 'form-control new-location'))}}
						</div>
					</div>
				</div>
			</div>
		
			<div class="form-group">
				{{ Form::label('amount_tickets', 'Amount tickets:', ['class' => 'col-sm-2 control-label']) }}
				<div class="col-sm-10">
				{!! Form::selectRange('amount_tickets', 10, 500, 1, array('class' => 'form-control')) !!}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('event_colour', 'Event Colour:', ['class' => 'col-sm-2 control-label']) }}
				<div class="col-sm-10">
				{!! Form::text('event_colour', null, array('class' => 'form-control jscolor')) !!}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('amount_tickets', 'Creator:', ['class' => 'col-sm-2 control-label']) }}
				<div class="col-sm-10">
				{!! Form::text('creator', null, array('class' => 'form-control', 'placeholder' => $data['ip'], 'readonly')) !!}
				</div>
			</div>

			{{ Form::submit('Create Event', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px; margin-bottom:20px;')) }}
			{!! Form::close() !!}
		</div>
	</div>



@endsection

@section('scripts')
<script>

// Todo : Debug dynamic added class not working with parsley. 

	$('#location_id').on('change', function(){
		if($(this).val() === 'CREATE') {
			$('#create_location').show();
			$('.new-location').each(function() {
				$(this).attr("required", true);
			});
			return false;
		}
		else {
			$('#create_location').hide();
			$('.new-location').each(function() {
				$(this).removeAttr('required');
			});
			return false;
		}
		//alert($(this).val());
	});
</script>
{!! Html::script('js/jscolor.js') !!}
{!! Html::script('js/parsley.min.js') !!}
@endsection