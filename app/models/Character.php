<?php

class Character extends Eloquent {

	protected $table = 'characters';

	public function tribe()
	{
		return $this->belongsTo('Tribe');
	}

	public function actions()
	{
		return $this->hasMany('Action');
	}

	public function children()
	{
		if($this->gender === 'female') {
			return $this->hasMany('Child', 'mother_id');
		} else {
			return $this->hasMany('Child', 'father_id');
		}
	}





	public function craft() {
		$res = 0;
		if($this->skill === 'crafter') {
			$res = rand(1, 6);
		}

		return $res;

	}

	public function hasActed() {
		$hasActed = false;
		foreach($this->actions as $action) {
			if($action->year === $this->tribe->year) {
				if($action->action === 'hunt' || $action->action === 'gather' || $action->action === 'craft') {
					$hasActed = true;
				}
			}
		}

		return $hasActed;
	}

	public function isFed() {
		$isFed = false;
		foreach($this->actions as $action) {
			if($action->year === $this->tribe->year) {
				if($action->action === 'feed') {
					$isFed = true;
				}
			}
		}

		return $isFed;
	}

	public function hasProcreated() {
		$procreated = false;
		foreach($this->actions as $action) {
			if($action->year === $this->tribe->year) {
				if($action->action === 'procreate') {
					$procreated = true;
				}
			}
		}
		return $procreated;
	}

	public function modifyHunt() {
		$mod = 0;
		if($this->strength === 'strong') {
			$mod += 1;
		} else if ($this->strength === 'weak') {
			$mod -= 1;
		}

		if($this->skill !== 'hunter') {
			$mod -= 3;
		}
		return $mod;
	}

	public function modifyGather() {
		$mod = 0;
		if($this->strength === 'strong') {
			$mod += 1;
		} else if ($this->strength === 'weak') {
			$mod -= 1;
		}

		if($this->skill !== 'gatherer') {
			$mod -= 3;
		}
		return $mod;
	}

	public function weaken()
	{
		$msg = $this->name . ' is already weak, only miss next turn';
		if ($this->strength === 'strong') {
			$this->strength = 'average';
			$msg = $this->name .  'used to be strong, but ' . $this->getGender(1) . ' injury has made ' . $this->getGender(2) . ' average. ' . ucfirst($this->getGender(2)) . '\'ll also miss the next turn';
		} else if ($this->strength === 'average') {
			$this->strength = 'weak';
			$msg = 'You used to at least be average, now you have become the weakest of the bunch, and you\'ll miss the next turn';
		}

		$this->miss_turn = 1;

		$this->save();
		return $msg;
	}

	public function injure() {
		$msg = $this->name . ' was injured and will miss the next turn';

		$this->miss_turn = 1;
		$this->save();
		return $msg;
	}

	public function addFood($amount) {
		$this->food += $amount;
		$this->save();
	}

	public function getGender($numb) {
		if($numb === 1) {
			if($this->gender === 'male') {
				return 'his';
			} else {
				return 'her';
			}
		} else if ($numb === 2) {
			if($this->gender === 'male') {
				return 'him';
			} else {
				return 'her';
			}
		} else {
			if($this->gender === 'male') {
				return 'he';
			} else {
				return 'she';
			}
		}
	}

	public function pregnant() {
		$isPregnant = false;
		if($this->gender === 'female'){
			foreach($this->children as $child) {
				if($this->tribe->year - $child->conception > 0 && $this->tribe->year - $child->conception < 1) {
					$isPregnant = true;
				}
			}
		}
		return $isPregnant;
	}

	public function actuallyPregnant() {
		$isPregnant = false;
		if($this->gender === 'female'){
			foreach($this->children as $child) {
				if($this->tribe->year - $child->conception >= 0 && $this->tribe->year - $child->conception < 1) {
					$isPregnant = true;
				}
			}
		}
		return $isPregnant;
	}

	public function nursing() {
		$isNursing = false;
		if($this->gender === 'female'){
			foreach($this->children as $child) {
				if($this->tribe->year - $child->conception < 3 && $child->death !== 'NULL' && $this->tribe->year - $child->conception > 0.5 && $this->tribe->year - $child->conception < 13) {
					$isNursing = true;
				}
			}
		}
		return $isNursing;
	}

}
