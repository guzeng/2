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

	static public function c($log)
	{
		if(!empty($log))
		{
			$log['user_id'] = Auth::user()->id;
			$log['username'] = Auth::user()->name;
			$log['time'] = local_to_gmt(time());
			$log['ip'] = User::ip();
			DB::table('log')->insert($log);
		}
	}
}
