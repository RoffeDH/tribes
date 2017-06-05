<div class="modal fade procreate-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<h1>Trade</h1>

			<table class="table" id="procreate">
				<thead>
					<tr>
						<td>Name</td>
						<td>Gender</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					@foreach($tribe->characters as $character)
						@if(!$character->pregnant())
							<tr class="char-{{ $character->id }}">
									<td>{{ $character->name }}</td>
									<td>{{ $character->gender }}</td>
									<td>{{ Form::open(array('class' => 'procreate', 'url' => '/action')) }}{{ Form::hidden('action', 'procreate') }}{{ Form::hidden('character') }}{{ Form::hidden('target', $character->id) }}{{ Form::submit('Procreate', array('class' => 'btn btn-xs btn-success')) }}{{ Form::close() }}</td>
							</tr>
						@endif
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td>
							{{ Form::open(array('class' => 'procreate', 'url' => '/action')) }}
								{{ Form::hidden('action', 'procreate') }}
								{{ Form::hidden('character') }}
								{{ Form::hidden('target', 0) }}
								{{ Form::submit('Procreate', array('class' => 'btn btn-xs btn-warning')) }}
							{{ Form::close() }}
						</td>
						<td></td><td></td><td></td>
					</tr>
				</tfoot>
			</table>

		</div>
	</div>
</div>