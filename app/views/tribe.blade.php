<!DOCTYPE html>
<html>
	<head>
		<title>{{{ GlobalSettings::name }}}</title>


		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/6.0.0/normalize.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="/style/style.css">
</head>
	<body>
		<div class="container">
			<div class="row">
				@yield('main')
			</div>
			
			<div class="row">
				<div class="col-sm-12">
					<header class="col-xs-12">
						@include('helpers/flash')
					</header>
				</div>
			</div>

			<div class="row">
				@include('tribe/characters')
			</div>
		</div>






		@yield('script')
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="http://johnny.github.io/jquery-sortable/js/jquery-sortable.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="/js/tribes.js"></script>
	</body>
</html>