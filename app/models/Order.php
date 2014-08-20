<?php

class Order extends Eloquent {

	protected $table = 'order';
    
    //不允许集体赋值的值
	protected $guarded = array('id');
    
    //关闭时间的自动更新
    public $timestamps = false;

	//创建人和公告是一对多关系
	public function user()
	{
		return $this->belongsTo('User', 'user_id', 'id');
	}
    public function city()
    {
        return $this->belongsTo('City', 'city_id', 'id');
    }
    public function airport()
    {
        return $this->belongsTo('Airport', 'airport_id');
    }
}
/* End of file Order.php */
/* Location: ./app/models/Order.php */