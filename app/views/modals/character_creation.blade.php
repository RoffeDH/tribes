<div class="modal fade add-character-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<h3 class="col-md-10">Create Character</h3>
			<button class="col-md-2 btn btn-info" onclick="randomizeCharacter()">Randomize</button>

			<div class="row">
				<div class="col-md-12">
					{{ Form::open(array('url' => '/character', 'class' => 'form-horizontal')) }}
						{{ Form::hidden('tribe_id', $tribe->id) }}

						<div class="form-grou p">
							{{ Form::label('name', 'Name', array('class' => 'col-sm-1')) }}
							<div class="col-sm-11">
								{{ Form::text('name', '', array('class' => 'form-control')) }}
							</div>
						</div>


						<div class="form-group">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<label class="col-md-12">
												{{ Form::radio('gender', 'male') }}
												Male
											</label>
										</div>
										<div class="row">
											<label class="col-md-12">
												{{ Form::radio('gender', 'female') }}
												Female
											</label>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<label class="col-md-12">
												{{ Form::radio('strength', 'weak') }}
												Weak
											</label>
										</div>
										<div class="row">
											<label class="col-md-12">
												{{ Form::radio('strength', 'average') }}
												Average
											</label>
										</div>
										<div class="row">
											<label class="col-md-12">
												{{ Form::radio('strength', 'strong') }}
												Strong
											</label>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<label class="col-md-12">
												{{ Form::radio('skill', 'hunter') }}
												Hunter
											</label>
										</div>
										<div class="row">
											<label class="col-md-12">
												{{ Form::radio('skill', 'gatherer') }}
												Gatherer
											</label>
										</div>
										<div class="row">
											<label class="col-md-12">
												{{ Form::radio('skill', 'crafter') }}
												Crafter
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>

						{{ Form::submit('Create', array('class' => 'btn btn-sm btn-success')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>