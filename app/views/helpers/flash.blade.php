@foreach (['danger', 'warning', 'success', 'info', 'lostEquip'] as $type)
	@if(Session::has('alert-' . $type))
		@foreach(Session::get('alert-' . $type) as $msgs)
			@foreach($msgs as $msg)
				<div class="alert alert-{{ $type }}" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					{{ $msg }}
				</div>

			 @endforeach
		@endforeach
	@endif
@endforeach