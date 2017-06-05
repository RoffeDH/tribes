<?php

class Tribe extends Eloquent {

	protected $table = 'tribes';
	public $timestamps = true;

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function characters()
	{
		return $this->hasMany('Character');
	}

	public function children()
	{
		return $this->hasMany('Child');
	}















	public function season() {
		$year = floor($this->year);
		if($year === $this->year) {
			return 'Summer';
		} else {
			return 'Winter';
		}
	}

	public function year() {
		

		return floor($this->year);
	}

	public function allHasActed() {
		$hasActed = 0;
		foreach($this->characters as $character) {
			if($character->hasActed()) {
				$hasActed++;
			}
		}

		if($this->characters->count() === $hasActed) {
			return true;
		} else {
			return false;
		}
	}

	public function allAreFed() {
		$isFed = 0;
		foreach($this->characters as $character) {
			if($character->isFed()) {
				$isFed++;
			}
		}

		if($this->characters->count() + $this->children->count() === $isFed) {
			return true;
		} else {
			return false;
		}
	}

}