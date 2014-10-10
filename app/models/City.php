<?php

class City extends Eloquent {

	protected $table = 'city';
	protected $guarded = array('id');
	public $timestamps = false;

	static public function tree()
	{
		$rows = DB::table('city')->orderByRaw('parent_id asc, id asc')->get();

		if(!empty($rows))
		{
			$items = self::treeItems($rows);
			return self::buildTree($items);
		}
		return false;
	}
	//---------------------------------------------------------

    static public function treeItems($arr,$pid=0) 
    {
        $ret = array();
       
        foreach($arr as $k => $v) {
            if($v->parent_id == $pid) {
                $tmp = $arr[$k];
                unset($arr[$k]);
                $tmp->children = self::treeItems($arr,$v->id);
                $ret[] = $tmp;
            }
        }
        return $ret;
    }
	//---------------------------------------------------------

    /**
     * 返回带有深度参数的一维数组
     * param deep int 深度
     */
	static public function buildTree($arr, $deep=0)
	{
		$a = array();
		if (is_array($arr) && !empty($arr)){
		   	foreach ($arr as $key=>$val){
		   		$b = array('id'=>$val->id,'name'=>$val->name, 'name_en'=>$val->name_en,'parent_id'=>$val->parent_id,'deep'=>$deep);
		   		if(!empty($val->children))
		   		{
		   			$b['hasChild'] = true;
		   		}
		   		else
		   		{
		   			$b['hasChild'] = false;
		   		}
		   		$a[] = $b;
				$a = array_merge($a, self::buildTree($val->children, $deep+1));
		    }
		}
		return $a;
	}
	//---------------------------------------------------------

	static public function getAllChildren($pid=0)
    {
    	$result = DB::table('city')->orderByRaw('parent_id asc')->get();
		if($result)
		{
			return self::getChild($result, $pid);
		}
		return false;
    }
	//---------------------------------------------------------

    static public function getChild($arr, $pid=0)
    {
        $ret = array();
        foreach($arr as $k => $v) {
            if($v->parent_id == $pid) {
                $ret[] = $v->id;
                unset($arr[$k]);
                $ret = array_merge($ret, self::getChild($arr,$v->id));
            }
        }
        return $ret;
    }

	//---------------------------------------------------------
}
