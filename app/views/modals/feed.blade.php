<div class="modal fade feed-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<h1>Trade</h1>

			<table class="table feed">
				<thead>
					<tr>
						<td>Name</td>
						<td>Food</td>
						<td>Grain</td>
						<td>None</td>
					</tr>
				</thead>
				<tbody>
					{{ Form::open(array('id' => 'feed', 'url' => '/action')) }}
						@foreach($tribe->characters as $character)
							@if(!$character->isFed())
								<tr class="char-{{ $character->id }}">
									<td>{{ $character->name }}</td>
									<td class="food">
										<span  class="item" data-type="food" data-amount="{{ $character->food }}">{{ Form::radio($character->id, 'food') }}</span>
									</td>
									<td class="grain">
										<span  class="item" data-type="grain" data-amount="{{ $character->grain }}">{{ Form::radio($character->id, 'grain') }}</span>
									</td>
									<td class="none">
										<span  class="item" data-type="none" data-amount="">{{ Form::radio($character->id, 'none', true) }}</span>
									</td>
								</tr>
							@endif
						@endforeach
						<tfood>
							<tr>
								<td>
									{{ Form::hidden('character') }}
									{{ Form::hidden('action', 'feed') }}
									{{ Form::submit('Feed', array('class' => 'btn btn-lg btn-success')) }}
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tfood>
					{{ Form::close() }}
				</tbody>
			</table>
		</div>
	</div>
</div>