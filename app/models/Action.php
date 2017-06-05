<?php

class Action extends Eloquent {

	protected $table = 'actions';
	public $timestamps = true;

	public function user()
	{
		return $this->belongsTo('User');
	}

}