<?php

class Setting extends Eloquent {

	protected $table = 'setting';
	public $timestamps =false;
	protected $guarded = array('id');
	//----------------------------------------------------------
	
	/**
	* save the settings to cache
	*
	* @2014/6/3
	* @author Varson
	*/
	static public function cache()
	{
        $settings = Setting::all();
        if(!empty($settings))
        {
            foreach ($settings as $key => $value) {
                Cache::forever($value->variable, ($value->value ? $value->value : ''));
                Cache::forever($value->variable.'_en', ($value->value_en ? $value->value_en : ''));
            }
        }
	}
	//----------------------------------------------------------
}