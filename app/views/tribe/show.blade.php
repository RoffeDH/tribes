@extends('../tribe')

@section('main')
	<div class="col-sm-12">
		<h1>{{ $tribe->season() }} of year {{ $tribe->year() }}</h1>

		<div class="row">
			<div class="col-sm-6">
				<h3>Unassigned characters</h3>
				<div id="unAssigned" class="serialization vertical">
					@foreach($tribe->characters as $character)
						@if(!$character->hasActed())
							<li data-id="{{ $character->id }}"><i class="fa fa-bars" aria-hidden="true"></i> {{ $character->name }}</li>
						@endif
					@endforeach
				</div>
			</div>
			
			<div class="col-sm-6">
				<h3>Assigned characters</h3>
				<div id="assigned">
					@foreach($tribe->characters as $character)
						@if($character->hasActed())
							<li data-id="{{ $character->id }}" data-name="{{ $character->name }}"><i class="fa fa-bars" aria-hidden="true"></i> {{ $character->name }}</li>
						@endif
					@endforeach
				</div>
			</div>
		</div>

		<div class="row" data-group="hunting" id="huntingGroups">
			<div class="col-sm-12">
				<div class="col-sm-3">
					<h3>Hunting</h3>
				</div>
			</div>

			<div class="col-sm-12 grouping groupHunting">
				<div class="row">
					<div class="col-md-10">
						<h4>Group hunting</h4>
					</div>
					<div class="col-md-2">
						<button class="btn btn-xs btn-warning" onclick="goHunt()">Hunt</button>
					</div>
				</div>
				<ol class="serialization" data-name="groupHunting" data-order="0">
				</ol>
			</div>


			{{ Form::open(array('url' => '/action', 'class' => 'huntingForm')) }}
				{{ Form::hidden('action', 'hunt') }}
				{{ Form::hidden('grounds', 'veldt') }}
				{{ Form::hidden('group', 'groupHunting') }}
				{{ Form::hidden('data') }}
			{{ Form::close() }}

		</div>

@endsection