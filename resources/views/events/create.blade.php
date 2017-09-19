@extends('main')

@section('title' , '| Create new Event')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2/select2.min.css') !!}
	<style>
	#create_location{
		display:none;
		margin-top:20px;
	}
	#create_tag{
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
				{{ Form::label('category_id', 'Category:' , ['class' => 'col-sm-2 control-label']) }}
				<div class="col-sm-10">
					<select class="form-control" name="category_id">
						@foreach ($data['categories'] as $category)
							<option value="{{ $category->id }}">{{ $category->name }}</option>
						@endforeach
					</select>
				</div>
			</div>


			<div class="form-group">
				{{ Form::label('tags_id', 'Tags:' , ['class' => 'col-sm-2 control-label']) }}
				<div class="col-sm-10">
					<select class="form-control select2-multi" id="tags_id" name="tags[]" multiple="multiple">
						@foreach ($data['tags'] as $tag)
							<option value="{{ $tag->id }}">{{ $tag->name }}</option>
						@endforeach
						<option value="CREATE">Create new tag</option>
					</select>
				</div>
			</div>

			<div id="create_tag" class="form-group row well">
				<div class="col-md-11 col-md-offset-1">
					<div class="form-group">
						{{ Form::label('add_tag_name', 'New tag name:', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-9">
						{{ Form::text('add_tag_name', null, array('class' => 'form-control new-tag'))}}
						</div>
					</div>
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('location_id', 'Location:', ['class' => 'col-sm-2 control-label']) }}
				<div class="col-sm-10">
				<select class="form-control" id="location_id" name="location_id">
					@foreach ($data['locations'] as $location)
						<option value="{{ $location->id }}">{{ $location->name }}</option>
					@endforeach
					<option value="CREATE">Create new location</option>
				</select>
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
				<input type="text" name="creator" class="form-control" value="{{ $data['ip'] }}" readonly="readonly" hidden>
				</div>
			</div>

			{{ Form::submit('Create Event', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px; margin-bottom:20px;')) }}
			{!! Form::close() !!}
		</div>
	</div>



@endsection

@section('scripts')
{!! Html::script('js/jscolor.js') !!}
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2/select2.min.js') !!}
<script>

// Todo : Debug dynamic added class not working with parsley. 

	
	$(function() {

		$('#location_id').on('change', function(){
			if($(this).val() == 'CREATE') {
				console.log('1');
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
		});

		$('.select2-multi').select2();

// 		$('').on('change', function(){
// 			alert('ass');
// 		})

// 		$('#one').on('click', function(){

// alert($(".select2-multi").val());
// 		});
		//console.log($('#tags_id').val());
//$(".select2-multi").val("CREATE").trigger("change");
		$('.select2-multi').on('change', function(){
			var values = $(".select2-multi").val();
			if (values.indexOf("CREATE") >= 0) {
				$('#tags_id').prop('disabled', 'disabled');
				console.log('one');
				$("#create_tag").show();
				//alert(values);
				//$("#tags_id").val(null).trigger("change");
				//$("#tags_id").hide();
				// $(values).val(null).trigger("change"); 
				
				// $("#select2-multi").select2({
				// 	maximumSelectionLength: 1
				// }); 
				//$(".tags_id").val("CREATE"); 



				
			}
			

			// if(values == 'CREATE') {
			// 	alert('1');
			// }
			

			// if($(this).val() === 'CREATE') {
				
			// 	$('select2-multi').attr('maximumSelectionLength', '1');
				
			// 	$('.new-tag').each(function() {
			// 		$(this).attr("required", true);
			// 	});
			// 	return false;
			// }
			// else {
			// 	$('#create_tag').hide();
			// 	$('.new-tag').each(function() {
			// 		$(this).removeAttr('required');
			// 	});
			// 	return false;
			// }
		});
    
	});
	
</script>
@endsection