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

    static public function getType($t='')
    {
        $arr = array(
            '1' => Lang::get('text.to_destination'),
            '2' => Lang::get('text.to_airport')
        );
        if($t)
        {
            if(array_key_exists($t, $arr))
            {
                return $arr[$t];
            }
            else
            {
                return '';
            }
        }
        return $arr;
    }

    static public function price($d,$one_num=0,$two_num=0,$special_num=0)
    {
        if($one_num==0 && $two_num==0 && $special_num==0)
        {
            return false;
        }
        $price = intval($one_num)*49+intval($two_num)*39+intval($special_num)*69;

        if($d > 40)
        {
            $price += intval($d)-40;
        }
        return round($price,2);
    }

    static public function payType($t='')
    {
        $arr = array(
            '1' => 'alipay',
            '2' => 'bank',
            '3' => 'cash'
        );
        if($t)
        {
            if(array_key_exists($t, $arr))
            {
                return $arr[$t];
            }
            else
            {
                return false;
            }
        }
        return $arr;
    }

    static public function pay($p)
    {
        $result = false;
        DB::beginTransaction();
        try
        {
            $id = $p['id'];
            unset($p['id']);
            $result = DB::table('order')->where('id',$id)->update($p);
            DB::commit();
        }
        // If catch an exception, will roll back so nothing gets messed
        // up in the database. Then re-throw the exception so it can
        // be handled how the developer sees fit for their applications.
        catch (Exception $e)
        {
            DB::rollback();

            throw $e;
        }
        return $result;
    }
    static public function getStatus($status)
    {
        $arr = array(
            '0' => Lang::get('text.unprocessed'),
            '1' => Lang::get('text.processed'),
            '2' => Lang::get('text.completed'),
            '3' => Lang::get('text.canceled')
        );
        if($status !== false)
        {
            if(array_key_exists($status, $arr))
            {
                return $arr[$status];
            }
            else
            {
                return false;
            }
        }
        return $arr;
    }
}
/* End of file Order.php */
/* Location: ./app/models/Order.php */