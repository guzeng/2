<?php

class Airport extends Eloquent {

	protected $table = 'airport';
    
    //不允许集体赋值的值
	protected $guarded = array('id');
    
    //关闭时间的自动更新
    public $timestamps = false;

}
/* End of file Airport.php */
/* Location: ./app/models/Airport.php */