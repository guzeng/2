<?php

class Address extends Eloquent {

	protected $table = 'address';
	public $timestamps =false;
	protected $guarded = array('id');

	public function city()
	{
		return $this->belongsTo('City','city_id');
	}

}