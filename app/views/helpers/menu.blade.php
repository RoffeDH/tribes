<nav class="navbar navbar-default">
	<div class="container-fluid">
		<ul class="nav navbar-nav navbar-right">
			@if (Auth::check())
				<li><a href="/logout"><button type="button" class="btn btn-danger navbar-btn">logout</button></a></li>
			@endif
		</ul>
	</div>
</nav>