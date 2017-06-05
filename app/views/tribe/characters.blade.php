<div id="character-list">
	<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".add-character-modal-lg">Add Character</button>
	<button type="button" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target=".feed-children-modal-lg">Feed Children</button>

	<table class="table">
		<thead>
			<tr>
				<td>Name</td>
				<td>Gender</td>
				<td>Strength</td>
				<td>Skill</td>
				<td>Food</td>
				<td>Grain</td>
				<td>Baskets</td>
				<td>Spears</td>
				<td>Pregnancy</td>
				<td>Nursing</td>
				<td>Children</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			@foreach($tribe->characters as $character)
				@if(!$character->hasProcreated())
					<tr>
						<td>{{ $character->name }}</td>
						<td>{{ $character->gender }}</td>
						<td>{{ $character->strength }}</td>
						<td>{{ $character->skill }}</td>
						<td>{{ $character->food }}</td>
						<td>{{ $character->grain }}</td>
						<td>{{ $character->baskets }}</td>
						<td>{{ $character->spears }}</td>
						<td>{{ ($character->pregnant() ? 'yes' : 'no') }}</td>
						<td>{{ ($character->nursing() ? 'yes' : 'no') }}</td>
						<td>0</td>
					@if(!$character->isFed())
							@if(!$tribe->allHasActed())
								@if($character->hasActed())
									<td><button type="button" class="btn btn-xs" disabled>Hunt</button></td>
									<td><button type="button" class="btn btn-xs" disabled>Gather</button></td>
									<td><button type="button" class="btn btn-xs" disabled>Craft</button></td>
								@endif
								@if(!$character->hasActed())
									<td>{{ Form::open(array('url' => '/action')) }}{{ Form::hidden('data', '{"0":{"id":' . $character->id . '} }') }}{{ Form::hidden('group', 'soloHunting') }}{{ Form::hidden('action', 'hunt') }}{{ Form::submit('Hunt', array('class' => 'btn btn-xs btn-danger')) }}{{ Form::close() }}</td>
									<td>{{ Form::open(array('url' => '/action')) }}{{ Form::hidden('id', $character->id) }}{{ Form::hidden('action', 'gather') }}{{ Form::submit('Gather', array('class' => 'btn btn-xs btn-warning')) }}{{ Form::close() }}</td>
									<td><button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target=".craft-modal-lg" onclick="craft({{ $character->id }})">Craft</button></td>
								@endif
							@elseif(!$tribe->allAreFed())
								<td><button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target=".feed-modal-lg" onclick="feed({{ $character->id }})">Feed</button></td>
							@endif
							<td><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".trade-modal-lg" onclick="trade({{ $character->id }})">Trade</button></td>
						</tr>
					@elseif(!$character->pregnant())
						<td><button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target=".procreate-modal-lg" onclick="procreate({{ $character->id }})">Procreate</button></td>
					@else
						<td></td>
					@endif
				@endif
			@endforeach
		</tbody>
	</table>
</div>

@include('modals.character_creation')
@include('modals.craft')
@include('modals.trade')
@include('modals.feed')
@include('modals.procreate')