@extends('../main')

@section('main')
	<div class="col-sm-12">
		<p>To create a new game give the tribe a name and click on 'create' or choose an existing game below to continue the game</p>

		{{ Form::open(array('url' => '/tribe', 'class' => 'form-horizontal')) }}

			<div class="form-group">
				<div class="col-xs-3 col-sm-2 col-md-1">
					{{ Form::submit('Create', array('class' => 'pull-right btn btn-success', 'tabindex' => '2')) }}
				</div>
				<div class="col-xs-9 col-sm-10 col-md-11">
					{{ Form::text('name', '', array('placeholder' => 'Name', 'class' => 'form-control', 'tabindex' => '1')) }}
				</div>
			</div>

		{{ Form::close() }}
	</div>


	<table class="table table-hover">
		<thead style="font-weight: bold">
			<tr>
				<td style="font-style: bold">Name</td>
				<td>Current Year</td>
				<td># of Characters</td>
			</tr>
		</thead>
		<tbody>
		@foreach($tribes as $tribe)

					<tr>
						<td><a href="/tribe/{{ $tribe->id }}">{{ $tribe->name }}</a></td>
						<td>{{ $tribe->year }}</td>
						<td>{{ $tribe->characters->count() }}</td>
					</tr>
				

		@endforeach
		</tbody>

	</table>

@endsection