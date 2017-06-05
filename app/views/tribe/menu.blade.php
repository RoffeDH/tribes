<nav class="navbar navbar-default">
	<div class="container-fluid">
		<ul class="nav navbar-nav navbar-right">
			@if (Auth::check())
				<li><a href="/"><button type="button" class="btn btn-danger navbar-btn">Exit</button></a></li>
			@endif
		</ul>
	</div>
</nav>