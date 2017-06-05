<?php

class TradeController extends \BaseController {

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
		$data = JSON_decode($input['data'], true);
		$character = Character::find($input['character']);
		$chars = $character->tribe->characters;
		foreach($chars as $char){
			$blaja = '';
			if(isset($data[$char->id])) {
				foreach(array_keys($data[$char->id]) as $key) {
					if(isset($data[$char->id][$key])) {
						$amount = $data[$char->id][$key];
						$character[$key] -= $amount;
						$char[$key] += $amount;
						$character->save();
						$char->save();
					}
				}
			}
		}

		return Redirect::back();
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
