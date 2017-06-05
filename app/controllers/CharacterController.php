<?php

class CharacterController extends \BaseController {

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
			'name'		=> 'required',
			'gender'	=> 'required',
			'strength'	=> 'required',
			'skill'		=> 'required',
			'tribe_id'	=> 'required'
		));

		if($validation->fails()){

			Session::flash('alert-danger', $validation->messages()->all());
			return Redirect::to('/');

		} else {
			$character = new Character;

			$character->name = $input['name'];
			$character->gender = $input['gender'];
			$character->strength = $input['strength'];
			$character->skill = $input['skill'];
			$character->tribe_id = $input['tribe_id'];
			$character->food = 10;
			$character->grain = 4;
			$character->save();

			return Redirect::to('/tribe/' . $input['tribe_id']);
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
		//
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
