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

    static public function price($d,$normal_luggage_num=0,$special_luggage_num=0)
    {
        if($normal_luggage_num==0 && $special_luggage_num==0)
        {
            return false;
        }
        $price = 0;
        if($normal_luggage_num > 0)
        {
            switch($normal_luggage_num)
            {
                case 1:
                    $price = 69;
                    break;
                case 2:
                    $price = 118;
                    break;
            }
            if($normal_luggage_num > 2)
            {
                $price += 118+(intval($normal_luggage_num)-2)*29;
            }
        }
        if($special_luggage_num > 0)
        {
            $price += intval($special_luggage_num)*89;
        }

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
}
/* End of file Order.php */
/* Location: ./app/models/Order.php */