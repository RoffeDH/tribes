<div class="modal fade craft-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<h1>Craft</h1>

			<button type="button" class="btn btn-xl btn-danger" onclick="crafting('spear')">Spear Head</button>
			<button type="button" class="btn btn-xl btn-warning" onclick="crafting('basket')">Basket</button>

			{{ Form::open(array('url' => '/action', 'id' => 'craft')) }}
				{{ Form::hidden('id') }}
				{{ Form::hidden('action', 'craft') }}
				{{ Form::hidden('type') }}
			{{ Form::close() }}
		
		</div>
	</div>
</div>