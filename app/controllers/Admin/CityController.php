<?php

class Admin_CityController extends BaseController {

	public function getIndex()
	{

		return View::make('admin/city/list');
	}

	public function getDatalist()
	{
        $iDisplayLength = intval(Input::get('iDisplayLength'));
        $iDisplayStart = intval(Input::get('iDisplayStart'));
        $orderby = intval(Input::get('iSortCol_0'));
        $order = trim(Input::get('sSortDir_0'));

        $sEcho = intval(Input::get('sEcho'));
        $sSearch = trim(Input::get('sSearch'));

        $records = array();
        $records["aaData"] = array(); 

        $end = $iDisplayStart + $iDisplayLength;
        switch ($orderby) {
            case '0':
                $orderby = 'id';
                break;
            case '1':
                $orderby = 'name';
                break;
            default:
                $orderby = 'id';
                break;
        }
        $order = in_array($order, array('desc','asc')) ? $order : 'asc';
        if($sSearch)
        {
            $city = City::where("name", "like", "%".$sSearch."%");
            
            $iTotalRecords = $city->count();
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $list = $city->take($iDisplayLength)->skip($iDisplayStart)->orderBy($orderby,$order)->get();
        }
        else
        {
            $iTotalRecords = City::count();
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $list = City::take($iDisplayLength)->skip($iDisplayStart)->orderBy($orderby,$order)->get();
        }
        if(!empty($list))
        {
            foreach ($list as $key => $item) 
            {
                $records["aaData"][] = array(
                    $item->id,
                    $item->name,
                    ''
                );
            }
        }
        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;
        echo json_encode($records);
        exit;
	}

	public function getEdit($id = '')
	{
		$id = trim(intval($id));
        $data = array();
		if($id)
		{
			$city = City::find($id);
			if(!$city)
            {
                return Response::view('common.404', array(), 404);
            }
            $data = array('item' => $city);
		}

		return View::make('admin.city.edit', $data);
	}

    public function postUpdate()
    {
        $data = array('code' => '1000', 'msg' => '');
        $log_param = array();
        $log = array();
        $id = Input::get('id');
        $name = trim(Input::get('name'));
        $parent_id = trim(Input::get('parent_id'));

        if($id)
        {
            $city = City::find($id);
            if(!$city)
            {
                return Response::json(array('code' => '1005', 'msg' => Lang::get('msg.no_data_exist')));
            }
        }
        else
        {
            $city = new City();
        }

        $validator = Validator::make(
            array(
                'citytitle' => $name,
            ),
            array(
                'citytitle' => "required|max:20",
            )
        );

        if($validator->fails())
        {
            $data['code'] = '1010';
            $error['name'] = str_replace('citytitle', Lang::get('text.name'), $validator->messages()->get('citytitle'));
            $data['error'] = $error;
            $data['msg'] = Lang::get('msg.submit_error');
            return Response::json($data);
        }
        else
        {
            $city->name = addslashes($name);
            $city->parent_id = $parent_id;
            if($id)
            {
                if(!$city->save())
                {
                    $data['code'] = '1010';
                    $data['msg'] = Lang::get('msg.update_failed');
                    return Response::json($data);
                }
                $log_param['type'] = 'update';
            }
            else
            {
                if(!$city->save())
                {
                    $data['code'] = '1010';
                    $data['msg'] = Lang::get('msg.add_failed');
                    return Response::json($data);
                }
                $log_param['type'] = 'add';
            }
        }
        $log[] = Lang::get('text.name').Lang::get('text.colon').$city->name;
        $log_param['object_id'] = $city->id;
        $log_param['object_type'] = 'city';
        $log_param['object_name'] = $city->name;
        $log_param['message'] = implode(' ; ', $log);
        MyLog::create($log_param);
        $data['url'] = asset('admin/city');

        return Response::json($data);
    }

	public function getDelete($id)
	{
        if(!$id)
        {
            return Response::json(array('code' => '1004', 'msg' => Lang::get('msg.param_incorrect')));
        }
        $city = City::find($id);
        if(!$city)
        {
            return Response::json(array('code' => '1001', 'msg' => Lang::get('msg.no_data_exist')));
        }
        if(!$city->delete())
        {
            return Response::json(array('code' => '1001', 'msg' => Lang::get('msg.delete_failed')));
        }
        $log_param['object_id'] = $id;
        $log_param['object_name'] = $city->name;
        $log_param['object_type'] = 'city';
        $log_param['type'] = 'delete';
        $log_param['message'] =Lang::get('text.delete').' '. $city->name;
        MyLog::create($log_param);
        return Response::json(array('code'=>'1000', 'msg'=>Lang::get('msg.delete_success'), 'data' => array('id' => $id)));
	}

}