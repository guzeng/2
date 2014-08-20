<?php

class Job extends Eloquent {

	protected $table = 'job';
    
    //不允许集体赋值的值
	protected $guarded = array('id');
    
    //关闭时间的自动更新
    public $timestamps = false;

	//和创建人是一对多关系
	public function user()
	{
		return $this->belongsTo('User', 'user_id', 'id');
	}
}
/* End of file Job.php */
/* Location: ./app/models/Job.php */