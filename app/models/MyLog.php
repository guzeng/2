<?php

class MyLog extends Eloquent {

	protected $table = 'log';
	public $timestamps =false;
	protected $guarded = array('id');

	public function __construct($attributes = array())
	{
		if(!empty($attributes))
		{
			$user = Auth::user();
			$attributes['user_id'] = $user->id;
			$attributes['username'] = $user->name;
			$attributes['time'] = local_to_gmt(time());
			$attributes['ip'] = User::ip();
		}
		parent::__construct($attributes);
	}
}
