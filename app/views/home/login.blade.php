@extends('../main')

@section('main')
	<div class="col-md-6">
		<h2>Login</h2>
		{{ Form::open(array('class' => 'form-horizontal')) }}

			<div class="form-group">
				{{ Form::label('email', 'E-Mail', array('class' => 'col-md-2 control-label')) }}
				<div class="col-md-10">
					{{ Form::text('email', '',array('class' => 'form-control')) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('password', 'Password', array('class' => 'col-md-2 control-label')) }}
				<div class="col-md-10">
					{{ Form::password('password', array('class' => 'form-control')) }}
				</div>
			</div>

			<div class="row">
				<div class="col-md-10 col-md-offset-2">
					{{ Form::submit('Login', array('class' => 'btn btn-sm btn-info')) }}
				</div>
			</div>

		{{ Form::close() }}
	</div>
	
	<div class="col-md-6">
		<h2>Register</h2>
		{{ Form::open(array('class' => 'form-horizontal', 'url' => '/register')) }}

			<div class="form-group">
				{{ Form::label('email', 'E-Mail', array('class' => 'col-md-2 control-label')) }}
				<div class="col-md-10">
					{{ Form::text('email', '',array('class' => 'form-control')) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('password', 'Password', array('class' => 'col-md-2 control-label')) }}
				<div class="col-md-10">
					{{ Form::password('password', array('class' => 'form-control')) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('password_confirmation', 'Repeat', array('class' => 'col-md-2 control-label')) }}
				<div class="col-md-10">
					{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
				</div>
			</div>

			<div class="row">
				<div class="col-md-10 col-md-offset-2">
					{{ Form::submit('Register', array('class' => 'btn btn-sm btn-warning')) }}
				</div>
			</div>

		{{ Form::close() }}
	</div>

@endsection