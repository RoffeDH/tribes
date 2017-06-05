<?php

class HomeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::check()) {
			$tribes = Tribe::where('user_id', '=', Auth::user()->id)->get();
			return View::make('home\index')->withTribes($tribes);
		} else {
			return Redirect::to('/login');
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getLogin()
	{
		return View::make('home\login');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function doLogin()
	{
		$password = Input::get('password');
		$email = Input::get('email');

		if(Auth::attempt(array('email' => $email, 'password' => $password))) {
			return Redirect::to('/');
		} else {
			Session::flash('alert-danger', array('Your credentials didn\'t match our records, please try again'));
			return Redirect::to('/login');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function doLogout()
	{
		Auth::logout();
		return Redirect::to('/');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function doRegister()
	{
		$input = Input::all();

		$validation = Validator::make($input, array(
			'email'		=> 'required|email|unique:users',
			'password'	=> 'required|confirmed|min:8'
		));

		if($validation->fails()){

			Session::flash('alert-danger', $validation->messages()->all());
			return Redirect::to('/login');

		} else {
			$user = new User;
			$user->email = $input['email'];
			$user->password = Hash::make($input['password']);

			$user->save();
			
			Auth::login($user);

			if(Auth::check()) {
				return Redirect::to('/');
			}
		}

	}


}
