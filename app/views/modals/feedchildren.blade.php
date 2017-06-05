<div class="modal fade feed-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<h1>Trade</h1>

			<table class="table feed">
				<thead>
					<tr id="feeder">
						<td>ID</td>
						<td>Mother</td>
						<td data-amount="{{ $child->food }}">Food</td>
						<td data-amount="{{ $child->grain }}">Grain</td>
						<td>None</td>
					</tr>
				</thead>
				<tbody>
					{{ Form::open(array('id' => 'feed', 'url' => '/action')) }}
						@foreach($tribe->children as $child)
							@if(!$child->isFed())
								<tr class="char-{{ $child->id }}">
									<td>{{ $child->id }}</td>
									<td>{{ $child->mother->name }}</td>
									<td class="food">
										<span class="item" data-type="food">{{ Form::radio($child->id, 'food') }}</span>
									</td>
									<td class="grain">
										<span class="item" data-type="grain">{{ Form::radio($child->id, 'grain') }}</span>
									</td>
									<td class="none">
										<span class="item" data-type="none" data-amount="">{{ Form::radio($child->id, 'none', true) }}</span>
									</td>
								</tr>
							@endif
						@endforeach
						<tfood>
							<tr>
								<td>
									{{ Form::hidden('child') }}
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