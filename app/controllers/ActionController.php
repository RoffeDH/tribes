<?php

class actionController extends \BaseController {

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
		$msgs = array();
		$equipMsgs = array();
		

		if ($input['action'] === 'hunt') {						/**************************** HUNTING ****************************/

			$chars = json_decode($input['data']);
			$characters = array();
			$huntMod = 0;

			foreach($chars as $char) {
				array_push($characters, Character::findOrFail($char->id));
			}

			foreach($characters as $character) {
				if($character->spears > 0) {
					if(rand(1, 6) <= 2) {
						$character->spears -= 1;
						$character->save();
						array_push($equipMsgs, $character->name . ' lost a spearhead');
					}
				}
			}

			Session::flash('alert-lostEquip', array($equipMsgs));

			$tribe = $characters[0]->tribe;
			if($tribe->season() === 'Winter') {
				$huntMod -= 1;
			}

			if ($input['group'] === 'groupHunting') {

				for ($i = 1; $i < count($characters); $i++) {
					if($characters[$i]->skill === 'hunter') {
						$huntMod += 1;
					} else {
						$huntMod += 0.5;
					}

					if($characters[$i]->spears > 0) {
						$huntMod += 1;
					}
				}

				$huntMod = floor($huntMod);
				if($huntMod > 3) {
					$huntMod = 3;
				}
			}

			foreach($characters as $character) {
				$action = new Action();
				$action->action = 'hunt';
				$action->character_id = $character->id;
				$action->year = $character->tribe->year;
				$action->save();
			}

			$res = throwDice();

			if($res > 6) {
				$res += $huntMod + $characters[0]->modifyHunt();
			}

			if($res <= 8) {
				if($res <= 6) {
					$highestInjury = 0;
					$injury = array();

					foreach($characters as $character) {
						$injured = rand(1, 6);
						if($injured > $highestInjury && $input['group'] === 'groupHunting'){
							$injury = array($character);
							$highestInjury = $injured;
						} else if ($injured === $highestInjury || $input['group'] === 'soloHunting') {
							array_push($injury, $character);
						}
					}

					foreach($injury as $character) {
						switch ($res) {
							case 3:
								$msg = $character->weaken();
								break;
							case 4:
								$msg = $character->injure();
								break;
							case 5:
								$msg = $character->injure();
								break;
							case 6:
								if ($character->skill !== 'hunter') {
									$msg = $character->injure();
								} else {
									$msg = 'Nothing happened to ' . $character->name;
								}
						}

						array_push($msgs, $msg);
					}
					Session::flash('alert-danger', array($msgs));
				} else {
					array_push($msgs, 'Nothing happened to ' . ($input['group'] === 'groupHunting' ? 'the group' : $character->name));
					Session::flash('alert-info', array($msgs));
				}
			} else {						/**************************** SUCCESSFULL HUNT ****************************/
				if($characters[0]->spears > 0) {
					$res += 3;
				}

				$result = groundHuntingResults($res);
				if($input['group'] === 'groupHunting') {
					if($result->type === 'undefined') {
						dd($res);
					}
					$type = $result->type;
					$food = $result->food;
					$name = $characters[0]->name;
					array_push($msgs, 'The group hunted ' . $type . ' and took home ' . $food . ' amount of food - placed in ' . $name . '\'s food bank');
				} else {
					array_push($msgs, $character->name . ' hunted ' . $result->type . ' and took home ' . $result->food . ' amount of food');
				}

				$characters[0]->food += $result->food;
				$characters[0]->save();

				Session::flash('alert-success', array($msgs));
			}
		} else if ($input['action'] === 'craft') {						/**************************** CRAFTING ****************************/

			$character = Character::find($input['id']);
			$tribe = $character->tribe;

			$action = new Action();
			$action->action = 'craft';
			$action->character_id = $character->id;
			$action->year = $character->tribe->year;
			$action->save();

			$res = $character->craft();
			
			if($input['type'] === 'spear') {
				if($res > 2) {
					$character->spears++;
					$character->save();
					array_push($msgs, $character->name . ' successfully crafter a spear');
					Session::flash('alert-success', array($msgs));
				} else {
					array_push($msgs, $character->name . ' wasn\'t successfull in crafting a spear');
					Session::flash('alert-danger', array($msgs));
				}
			} else if($input['type'] === 'basket') {
				if($res > 1) {
					$character->baskets++;
					$character->save();
					array_push($msgs, $character->name . ' successfully crafter a basket');
					Session::flash('alert-success', array($msgs));
				} else {
					array_push($msgs, $character->name . ' wasn\'t successfull in crafting a basket');
					Session::flash('alert-danger', array($msgs));
				}
			}
		} else if($input['action'] === 'gather') {						/**************************** GATHER ****************************/

			$character = Character::find($input['id']);

			$action = new Action();
			$action->action = 'gather';
			$action->character_id = $character->id;
			$action->year = $character->tribe->year;
			$action->save();

			$b = 1;
			if($character->baskets > 0) {
				$b++;
				if(rand(1,6) <= 2) {
					$character->baskets -= 1;
					$character->save();
					Session::flash('alert-lostEquip', array($character->name . ' damaged ' . $character->getGender(1) . ' basket'));
				}
			}

			for($i = 0; $i < $b; $i++) {
				$res = throwDice() + $character->modifyGather();

				if($character->tribe->season() === 'Winter') {
					$res -= 3;
				}

				$result = groundGatherResults($res);

				if($result->type === 'grain') {
					$character->grain += $result->food;
				} else {
					$character->food += $result->food;
				}

				array_push($msgs, array($character->name . ' took home ' . $result->food . ' amount of ' . $result->type));
			}

			Session::flash('alert-success', $msgs);
			$character->save();
		} else if($input['action'] === 'feed') {						/**************************** FEED ****************************/
			$character = Character::findOrFail($input['character']);
			foreach($input as $key => $val) {
				if($val === 'food' || $val === 'grain') {
					if($character[$val] > 0) {
						$character[$val] -= 1;

						$action = new Action();
						$action->action = 'feed';
						$action->character_id = $key;
						$action->year = $character->tribe->year;
						$action->save();
					} else {
						array_push($msgs, array($character->name . ' didn\'t have enough ' . $val));
					}
				}
			}

			Session::flash('alert-danger', $msgs);
			$character->save();
		} else if($input['action'] === 'procreate') {						/**************************** PROCREATE ****************************/
			$initiater = Character::findOrFail($input['character']);
			if($input['target'] !== '0') {
				$target = Character::findOrFail($input['target']);

				$res = rand(1, 6) + rand(1, 6);
				$success = 9;
				if($target->nursing() || $initiater->nursing()) {
					$success++;
				}

				if($initiater->gender !== $target->gender && $res >= $success && !$initiater->actuallyPregnant() && !$target->actuallyPregnant()) {
					$female = ($initiater->gender === 'female' ? $initiater : $target);
					$male = ($initiater->gender === 'male' ? $initiater : $target);

					$child = new Child();
					$child->mother_id = $female->id;
					$child->father_id = $male->id;
					$child->conception = $initiater->tribe->year;
					$child->tribe_id = $initiater->tribe->id;
					$child->save();
				}

				array_push($msgs, $initiater->name . ' tried to procreate with ' . $target->name);
			} else {
				array_push($msgs, $initiater->name . ' didn\'t get to procreate');
			}

			$action = new Action();
			$action->year = $initiater->tribe->year;
			$action->character_id = $initiater->id;
			$action->action = $input['action'];
			$action->save();

			Session::flash('alert-info', array($msgs));

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



function throwDice () {
	return rand(1, 6) + rand(1, 6) + rand(1, 6);
}


function groundGatherResults($res) {
	$result = new stdClass();
	
	if($res <= 7) {
		$result->food = 2;
		$result->type = 'grubs';
	} else if($res === 8) {
		$result->food = 3;
		$result->type = 'roots';
	} else if ($res === 9) {
		$result->food = 3;
		$result->type = 'grain';
	} else if ($res === 10) {
		$result->food = 4;
		$result->type = 'wild vegetables';
	} else if($res === 11 || $res === 12) {
		$result->food = 5;
		$result->type = 'wild vegetables';
	} else if($res === 13 || $res === 14) {
		$result->food = 6;
		$result->type = 'succulent yams';
	} else if($res >= 15) {
		$result->food = 6;
		$result->type = 'grain';
	}

	return $result;
}

function groundHuntingResults($res) {
	$result = new stdClass();
	switch($res) {
		case 9:
			$result->food = 2;
			$result->type = 'small game';
			return $result;
			break;
		case 10:
			$result->food = 8;
			$result->type = 'small game';
			return $result;
			break;
		case 11:
			$result->food = 8;
			$result->type = 'fish';
			return $result;
			break;
		case 12:
			$result->food = 15;
			$result->type = 'deer';
			return $result;
			break;
		case 13:
			$result->food = 25;
			$result->type = 'deer';
			return $result;
			break;
		case 14:
			$result->food = 25;
			$result->type = 'deer';
			return $result;
			break;
		case 15:
			$result->food = 30;
			$result->type = 'deer';
			return $result;
			break;
		case 16:
			$result->food = 40;
			$result->type = 'deer';
			return $result;
			break;
		case 17:
			$result->food = 50;
			$result->type = 'moose';
			break;
			return $result;
		default:
			$result->food = 60;
			$result->type = 'bear';
			return $result;
			break;
	}
}