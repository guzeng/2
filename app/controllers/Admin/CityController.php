<?php

class Admin_CityController extends BaseController {

	public function getIndex()
	{
		$data['datalist'] = $this->getDatalist();

		return View::make('admin/city/list', $data);
	}

	public function getDatalist()
	{
		$data['tree'] = City::tree();

		return View::make('admin/city/datalist', $data)->render();
	}

	public function getEdit($id = '')
	{
        $id = trim(intval($id));
		if($id)
		{
			$city = City::find($id);
			if(!$city)
            {
                return Response::view('common.404', array(), 404);
            }
            $data['city'] = $city;
		}
		else
		{
			return View::make('admin.city.edit');
		}

		return View::make('admin.city.edit', $data);
	}

	public function postUpdate()
	{
		$data = array('code' => '1000', 'msg' => '');
		$id = trim(Input::get('id'));
        $name = trim(Input::get('name'));
        $name_en = trim(Input::get('name_en'));
        $parent_id = trim(Input::get('parent_id', 0));

		if($id)
		{
			$city = City::find($id);
            if(!$city)
            {
                $data['code'] = '1005';
                $data['msg'] = Lang::get('msg.no_data_exist');
                return Response::json($data);
            }
            $old_name = $city->name;
            $old_name_en = $city->name_en;
            $old_parent = $city->parent_id;
        }
        else
        {
            $city = new City();
        }

    	//表单验证
        $ignore_id = $id ? $id : 'NULL';
		$validator = Validator::make(
            array('name' => $name,'enname'=>$name_en),
            array('name' => "required|max:20|unique:city,name,$ignore_id", 'enname'=>"required|max:100")
        );

		if($validator->fails())
		{
			$data['code'] = '1010';
            $error['name'] = str_replace('name', Lang::get('text.city'), $validator->messages()->get('name'));
            $error['name_en'] = str_replace('enname', Lang::get('text.city'), $validator->messages()->get('enname'));
			$data['error'] = $error;
			$data['msg'] = Lang::get('msg.submit_error');
			return Response::json($data);
		}
		//验证名称是否存在结束
        if($id && $id == $parent_id)
        {
            return Response::json(array('code'=>'1004','msg'=>Lang::get('msg.param_incorrect')));
        }
        //验证上级部门是否符合逻辑
        if($id)
        {
            $all_children = City::getAllChildren($id);
            if(!empty($all_children) && in_array($parent_id, $all_children) && intval($parent_id) != 0)
            {
                $data['code'] = '1010';
                $data['msg'] = Lang::get('text.city_parent_error');
                return Response::json($data);
            }
        }
        $city->name = addslashes($name);
        $city->name_en = addslashes($name_en);
        $city->parent_id = $parent_id;
        if($city->save())
        {
            if($id)
            {
                $log_param['type'] = 'update';
                $log[] = Lang::get('text.city').Lang::get('text.colon').$old_name.'=>'.$name.','.$old_name_en.'=>'.$name_en;
                if($old_parent != $parent_id)
                {
                    $log[] = Lang::get('text.up_level_city').Lang::get('text.colon')
                             .(($old_parent > 0)?(City::find($old_parent)->name):'None').'=>'
                             .(($parent_id > 0)?(City::find($parent_id)->name):'None');
                }
            }
            else
            {
                $id = $city->id;
                $log_param['type'] = 'add';
                $log[] = Lang::get('text.city').Lang::get('text.colon').$name.','.$name_en;
                if($parent_id > 0)
                {
                    $log[] = Lang::get('text.up_level_city').Lang::get('text.colon').City::find($parent_id)->name;
                }
            }
        }        
        $log_param['object_id'] = $id;
        $log_param['object_type'] = 'city';
		$log_param['object_name'] = $name;
        $log_param['message'] = implode(' ; ', $log);
        MyLog::create($log_param);

		$data['data'] = $this->getDatalist();
        $data['did'] = $id;

		return Response::json($data);
	}

    public function postAddChild()
    {
        $data = array('code' => '1000', 'msg' => '');
        $id = trim(Input::get('id'));
        $name = trim(Input::get('name'));
        $name_en = trim(Input::get('name_en'));
        $type = trim(Input::get('type'));


        //表单验证
        $validator = Validator::make(
            array('name' => addslashes($name), 'enname'=>addslashes($name_en)),
            array('name' => "required|max:20|unique:city,name", 'enname'=>"required|max:100")
        );
        if($validator->fails())
        {
            $data['code'] = '1010';
            $error['name'] = str_replace('name', Lang::get('text.city'), $validator->messages()->get('name'));
            $error['name_en'] = str_replace('enname', Lang::get('text.city'), $validator->messages()->get('enname'));
            $data['error'] = $error;
            $data['msg'] = Lang::get('msg.submit_error');
            return Response::json($data);
        }
        $d = City::find($id);
        if(!$d)
        {
            return Response::json(array('code'=>'1004','msg'=>Lang::get('msg.no_data')));
        }
        $city = new City();
        $city->name = addslashes($name);
        $city->name_en = addslashes($name_en);
        $log[] = Lang::get('text.city').Lang::get('text.colon').$name.','.'=>'.$name_en;
        switch (strtolower($type)) {
            case 'parent':
                if($city->save())
                {
                    $pid = $city->id;
                    if(City::where('id',$id)->update(array('parent_id'=>$pid)))
                    {
                        MyLog::create(
                            array(
                                'type' => 'update',
                                'object_id' => $id,
                                'object_type' => 'city',
                                'object_name' => $d->name,
                                'messages' => Lang::get('text.up_level_city') . Lang::get('text.colon') . (($d->parent_id > 0)?(City::find($d->parent_id)->name):'None') . '=>' .$name
                            )
                        );
                    }
                }
                else
                {
                    return Response::json(array('code'=>'1001','msg'=>Lang::get('msg.update_failed')));
                }
                break;
            
            case 'child':
                $city->parent_id = $id;
                if(!$city->save())
                {
                    return Response::json(array('code'=>'1001','msg'=>Lang::get('msg.update_failed')));
                }
                $log[] = Lang::get('text.parent') . Lang::get('text.colon') . $d->name;
                break;
        }
        $log_param['type'] = 'add';
        $log_param['object_id'] = $id;
        $log_param['object_type'] = 'city';
        $log_param['object_name'] = $name;
        $log_param['message'] = implode(' ; ', $log);
        MyLog::create($log_param);
        $data['data'] = $this->getDatalist();

        return Response::json($data);

    }

	public function getDelete($id)
	{
	    $data = array('code' => '1000', 'msg' => '');
		$children_node = array();

		if($id)
		{
            $row = City::find($id);
            if(!$row)
            {
                Response::json(array('code'=>'1001','msg'=>Lang::get('msg.no_data_exist')));
            }
	        //循环删除该节点下的所有节点
	        $children_node = City::getAllChildren($id);
            $children_node[] = $id;
	        foreach($children_node as $key => $child_id)
	        {
	        	$d = City::find($child_id);
		        if(!$d)
		        {
                    return Response::json(array('code'=>'1001','msg'=>Lang::get('msg.no_data_exist')));
		        }
                $object_name = $d->name;
                $parent_id = $d->parent_id;
	        	if(!$d->delete())
				{
                    return Response::json(array('code'=>'1001','msg'=>Lang::get('msg.delete_failed')));
				}
				else
				{
                    MyLog::create(array(
                        'object_id' => $child_id,
                        'object_type' => 'city',
                        'object_name' => $object_name,
                        'type' => 'delete',
                        'message' => Lang::get('text.delete').' '. $object_name
                    ));
				}
	        }
			$data['data'] = $this->getDatalist();
		}
		else
		{
		 	$data['code'] = '1004';
		 	$data['msg'] =Lang::get('msg.param_incorrect');
		}
		
		return Response::json($data);
	}

}