@extends('main')

@section('title', '| Edit Event')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2/select2.min.css') !!}

@endsection

@section('content')

		<div id="settings" class="row" style="margin-top:20px; display:;" >
		{!! Form::model($event, ['route' => ['events.update', $event->id], 'method' => 'PUT']) !!}
		
		<div class='col-md-7'>
		{{ Form::label('name', 'Name:')}}
		{{ Form::text('name', null, ['class' => "form-control input-lg"]) }}

		{{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
		{{ Form::text('slug', null, ['class' => 'form-control']) }}

		{{ Form::label('category_id', 'Category ID:', ['class' => 'form-spacing-top']) }}
		{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

		{{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
		{{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}

		{{ Form::label('description', 'Description:', ['class' => 'form-spacing-top'])}}
		{{ Form::textarea('description', null, ['class' => "form-control"]) }}


		</div>
		<div class="col-md-5">
			<div class="well">
				<dl class="dl-horizontal">
					<input type="text" id="eventid" value="{{ $event['event']['id'] }}" style="display:none;" readonly>  
					<dt>Event date : </dt>
					<dd>{{ $event->tags()-allRelatedIds()->toArray()  }}::{{ date('l j F, Y', strtotime($event['event']['event_date'])) }}</dd>
				</dl>
				
				<dl class="dl-horizontal">
					<dt>Created at : </dt>
					<dd>time : {{ $event->created_at }}

					</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Updated at : </dt>
					<dd>time : {{ $event->updated_at }}

					</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Total Tickets : </dt>
					<dd>{{ $event->amount_tickets}}

					</dd>
				</dl>

				<hr>

				@if($event['event']['creator'] == $event['ip'])

					<div class="row">
						<div class="col-sm-6">
						{!! Html::linkRoute('events.show', 'Cancel', array($event->id), array('class' => 'btn btn-danger btn-block')) !!}
						</div>
						<div class="col-sm-6">
						{{ Form::submit('Save changes', ['class' => 'btn btn-success  btn-block']) }}
						</div>
					</div>

				@endif
				
				<div class="row">
					<div class="col-md-12">
					{{ HTML::linkAction('EventController@listEvents', 'Display all events', array(), array('class' => 'btn btn-default btn-block btn-h1-spacing')) }}
					</div>
				</div>

			</div>
		</div>

		{!! Form::close() !!}
	</div>


@endsection

@section('scripts')
{!! Html::script('js/jscolor.js') !!}
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2/select2.min.js') !!}

	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>
@endsection