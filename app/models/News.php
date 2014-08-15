<?php

class News extends Eloquent {

	protected $table = 'news';
    
    //不允许集体赋值的值
	protected $guarded = array('id');
    
    //关闭时间的自动更新
    public $timestamps = false;

	//创建人和公告是一对多关系
	public function user()
	{
		return $this->belongsTo('User', 'create_by', 'id');
	}
}
/* End of file News.php */
/* Location: ./app/models/News.php */