<?php

class Admin_AirportController extends BaseController {

	public function getIndex()
	{

		return View::make('admin/airport/list');
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
            case '2':
                $orderby = 'city_id';
                break;
            default:
                $orderby = 'id';
                break;
        }
        $order = in_array($order, array('desc','asc')) ? $order : 'asc';
        if($sSearch)
        {
            $airport = Airport::where("name", "like", "%".$sSearch."%");
            $c = City::where('name','like',"%".$sSearch."%")->get()->toArray();
            $citys = array();
            if(!empty($c))
            {
                foreach ($c as $key => $value) {
                    $citys[] = $value['id'];
                }
            }
            if(!empty($citys))
            {
                $airport->orWhere(function($query)
                    {
                        $query->whereIn('city_id',$citys);
                    });
            }
            
            $iTotalRecords = $airport->count();
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $list = $airport->take($iDisplayLength)->skip($iDisplayStart)->orderBy($orderby,$order)->get();
        }
        else
        {
            $iTotalRecords = Airport::count();
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $list = Airport::take($iDisplayLength)->skip($iDisplayStart)->orderBy($orderby,$order)->get();
        }
        if(!empty($list))
        {
            foreach ($list as $key => $item) 
            {
                $records["aaData"][] = array(
                    $item->id,
                    $item->name,
                    $item->city ? $item->city->name : '',
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
        $data['citys'] = City::all();
		if($id)
		{
			$airport = Airport::find($id);
			if(!$airport)
            {
                return Response::view('common.404', array(), 404);
            }
            $data['item'] = $airport;
		}
		return View::make('admin.airport.edit', $data);
	}

    public function postUpdate()
    {
        $data = array('code' => '1000', 'msg' => '');
        $log_param = array();
        $log = array();
        $id = Input::get('id');
        $name = Input::get('name');
        $city_id = Input::get('city_id');
        if($city_id)
        {
            $c = City::find($city_id);
            if($c)
            {
                $cname = $c->name;
            }
            else
            {
                $city_id = 0;
            }
        }
        if($id)
        {
            $airport = Airport::find($id);
            if(!$airport)
            {
                return Response::json(array('code' => '1005', 'msg' => Lang::get('msg.no_data_exist')));
            }
        }
        else
        {
            $airport = new Airport();
        }

        $validator = Validator::make(
            array(
                'airporttitle' => $name,
            ),
            array(
                'airporttitle' => "required|max:30|unique:airport,name,$id",
            )
        );

        if($validator->fails())
        {
            $data['code'] = '1010';
            $error['name'] = str_replace('airporttitle', Lang::get('text.name'), $validator->messages()->get('airporttitle'));
            $data['error'] = $error;
            $data['msg'] = Lang::get('msg.submit_error');
            return Response::json($data);
        }
        else
        {
            $airport->name = addslashes($name);
            $airport->city_id = $city_id;
            if($id)
            {
                if(!$airport->save())
                {
                    $data['code'] = '1010';
                    $data['msg'] = Lang::get('msg.update_failed');
                    return Response::json($data);
                }
                $log_param['type'] = 'update';
            }
            else
            {
                if(!$airport->save())
                {
                    $data['code'] = '1010';
                    $data['msg'] = Lang::get('msg.add_failed');
                    return Response::json($data);
                }
                $log_param['type'] = 'add';
            }
        }
        $log[] = Lang::get('text.name').Lang::get('text.colon').$airport->name;
        $log[] = Lang::get('text.city').Lang::get('text.colon').(isset($cname)?$cname:'');
        $log_param['object_id'] = $airport->id;
        $log_param['object_type'] = 'airport';
        $log_param['object_name'] = $airport->name;
        $log_param['message'] = implode(' ; ', $log);
        MyLog::create($log_param);
        $data['url'] = asset('admin/airport');

        return Response::json($data);
    }

	public function getDelete($id)
	{
        if(!$id)
        {
            return Response::json(array('code' => '1004', 'msg' => Lang::get('msg.param_incorrect')));
        }
        $airport = Airport::find($id);
        if(!$airport)
        {
            return Response::json(array('code' => '1001', 'msg' => Lang::get('msg.no_data_exist')));
        }
        if(!$airport->delete())
        {
            return Response::json(array('code' => '1001', 'msg' => Lang::get('msg.delete_failed')));
        }
        $log_param['object_id'] = $id;
        $log_param['object_name'] = $airport->name;
        $log_param['object_type'] = 'airport';
        $log_param['type'] = 'delete';
        $log_param['message'] =Lang::get('text.delete').' '. $airport->name;
        MyLog::create($log_param);
        return Response::json(array('code'=>'1000', 'msg'=>Lang::get('msg.delete_success'), 'data' => array('id' => $id)));
	}

}