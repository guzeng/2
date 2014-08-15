<?php

class UserLogin extends Eloquent {

	protected $table = 'user_login';
	public $timestamps =false;
	protected $guarded = array('id');

	public function user()
	{
		return $this->belongsTo('User','user_id');
	}

}