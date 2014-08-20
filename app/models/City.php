<?php

class City extends Eloquent {

	protected $table = 'city';
    
    //不允许集体赋值的值
	protected $guarded = array('id');
    
    //关闭时间的自动更新
    public $timestamps = false;

}
/* End of file City.php */
/* Location: ./app/models/City.php */