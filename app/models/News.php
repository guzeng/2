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

	static public function category($c='')
	{
		$category = array(
			'1' => Lang::get('text.newcomer_grude'),
			'2' => Lang::get('text.FAQ'),
			'3' => Lang::get('text.news')
		);
		if($c)
		{
			if(array_key_exists($c, $category))
			{
				return $category[$c];
			}
			else
			{
				return '';
			}
			
		}
		else
		{
			return $category;
		}
	}
}
/* End of file News.php */
/* Location: ./app/models/News.php */