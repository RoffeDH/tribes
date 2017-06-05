<div class="modal fade trade-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<h1>Trade</h1>

			<table class="table trade">
				<thead>
					<tr>
						<td>Name</td>
						<td>Food</td>
						<td>Grain</td>
						<td>Baskets</td>
						<td>Spears</td>
					</tr>
				</thead>
				<tbody>
					@foreach($tribe->characters as $character)
						<tr class="{{ $character->id }}">
							<td>{{ $character->name }}</td>
							<td class="food">
								<button class="btn btn-xs btn-danger" onclick="doTrade('food', -1, {{ $character->id }})">-</button>
								<span  class="item" data-orig="{{ $character->food }}"></span>
								<button class="btn btn-xs btn-success" onclick="doTrade('food', 1, {{ $character->id }})">+</button>
							</td>
							<td class="grain">
								<button class="btn btn-xs btn-danger" onclick="doTrade('grain', -1, {{ $character->id }})">-</button>
								<span  class="item" data-orig="{{ $character->grain }}"></span>
								<button class="btn btn-xs btn-success" onclick="doTrade('grain', 1, {{ $character->id }})">+</button>
							</td>
							<td class="baskets">
								<button class="btn btn-xs btn-danger" onclick="doTrade('baskets', -1, {{ $character->id }})">-</button>
								<span  class="item" data-orig="{{ $character->baskets }}"></span>
								<button class="btn btn-xs btn-success" onclick="doTrade('baskets', 1, {{ $character->id }})">+</button>
							</td>
							<td class="spears">
								<button class="btn btn-xs btn-danger" onclick="doTrade('spears', -1, {{ $character->id }})">-</button>
								<span  class="item" data-orig="{{ $character->spears }}"></span>
								<button class="btn btn-xs btn-success" onclick="doTrade('spears', 1, {{ $character->id }})">+</button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
				
			
			{{ Form::open(array('id' => 'trade', 'url' => '/trade')) }}
				{{ Form::hidden('character') }}
				{{ Form::hidden('data', '{}') }}
				{{ Form::submit('Trade', array('class' => 'btn btn-lg btn-success')) }}
			{{ Form::close() }}
		</div>
	</div>
</div>