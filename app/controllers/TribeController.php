<?php

class TribeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		$validation = Validator::make($input, array(
			'name'		=> 'required'
		));

		if($validation->fails()){

			Session::flash('alert-danger', $validation->messages()->all());
			return Redirect::to('/');

		} else {
			$tribe = new Tribe;

			$tribe->name = $input['name'];
			$tribe->user_id = Auth::user()->id;
			$tribe->save();

			return Redirect::to('/tribe/' . $tribe->id);
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$tribe = Tribe::findOrFail($id);
		$moveTime = 0;
		foreach($tribe->characters as $character) {
			if($character->hasProcreated() || $character->actuallyPregnant()) {
				$moveTime++;
			}
		}
		if($moveTime === $tribe->characters->count()) {
			$tribe->year += 0.5;
			$tribe->save();
			$tribe = Tribe::findOrFail($id);
		}
		return View::make('tribe\show')->withTribe($tribe);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
