<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Child extends Eloquent {

	protected $table = 'children';
	public $timestamps = true;

	public function tribe()
	{
		return $this->belongsTo('Tribe');
	}

	public function father()
	{
		return $this->belongsTo('Character', 'father_id');
	}

	public function mother()
	{
		return $this->belongsTo('Character', 'mother_id');
	}









	public function isFed() {
		$isFed = false;
		$action = Action::findOrFail($this->id)->where('action', 'feed child')->where('year', $this->tribe->year);
		dd($isFed);

		return $isFed;
	}

}
