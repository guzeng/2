<?php

class Admin_OrderController extends BaseController {

	public function getIndex()
	{
		return View::make('admin.order.list');
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
                $orderby = 'code';
                break;
            case '2':
                $orderby = 'user_id';
                break;
            case '3':
                $orderby = 'flight_num';
                break;
            case '4':
                $orderby = 'type';
                break;
            case '5':
                $orderby = 'time';
                break;
            case '7':
                $orderby = 'airport_id';
                break;
            case '9':
                $orderby = 'status';
                break;
            case '10':
                $orderby = 'create_time';
                break;
            default:
                $orderby = 'id';
                break;
        }
        $order = in_array($order, array('desc','asc')) ? $order : 'asc';
        if($sSearch)
        {
            $_u = User::where('username',$sSearch)->first();
            if($_u)
            {
                $user_id = $_u->id;
            }
            $_a = Airport::where('name',$sSearch)->get()->toArray();
            $_a_id = array();
            if(!empty($_a))
            {
                foreach ($_a as $key => $value) {
                    $_a_id[] = $value['id'];
                }
            }
            $orders = Order::where("code", "like", "%".$sSearch."%")->orWhere('flight_num', 'like', '%'.$sSearch.'%')->orWhere('shipper', 'like', '%'.$sSearch.'%')
                        ->orWhere('phone', 'like', '%'.$sSearch.'%');
            
            if(isset($user_id))
            {
                $orders->orWhere('user_id',$user_id);
            }
            if(!empty($_a_id))
            {
                $orders->orWhere(function($query)
                        {
                            $query->whereIn('airport_id', $_a_id);
                        });
            }
            $iTotalRecords = $orders->count();
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $list = $orders->take($iDisplayLength)->skip($iDisplayStart)->orderBy($orderby,$order)->get();
        }
        else
        {
            $iTotalRecords = Order::count();
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $list = Order::take($iDisplayLength)->skip($iDisplayStart)->orderBy($orderby,$order)->get();
        }
        if(!empty($list))
        {
            foreach ($list as $key => $item) 
            {
                $records["aaData"][] = array(
                    $item->id,
                    $item->code,
                    $item->user ? $item->user->name : '',
                    $item->flight_num,
                    Order::getType($item->type),// == '1' ? Lang::get('text.to_destination') : Lang::get('text.to_airport'),
                    date('Y-m-d H:i:s',gmt_to_local($item->time)),
                    $item->city ? $item->city->name : '',
                    $item->airport ? $item->airport->name : '',
                    $item->shipper,
                    $item->status=='1' ? Lang::get('text.processed') : Lang::get('text.unprocessed'),
                    date('Y-m-d H:i:s',gmt_to_local($item->create_time)),
                    ($item->status=='0' && $item->pay == '0') ? 'true' : 'false'
                );
            }
        }
        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;
        echo json_encode($records);
        exit;
    }

	public function getDetail($id = '')
	{
		$id = trim(intval($id));
		if(!$id)
		{
            $data['code'] = '1004';
            $data['msg'] = Lang::get('msg.param_incorrect');
            return Response::json($data);
        }
		$order = Order::find($id);
		if(!$order)
        {
            $data['code'] = '1004';
            $data['msg'] = Lang::get('msg.no_data_exist');
            return Response::json($data);
        }
        if($order->area_id)
        {
            $order->area = City::find($order->area_id);
        }
		return array('code' => '1000', 'data'=>View::make('admin.order.detail', array('order'=>$order))->render());
	}

	public function getDelete($id)
	{
		if(!$id)
		{
			return Response::json(array('code' => '1004', 'msg' => Lang::get('msg.param_incorrect')));
		}
		$order = Order::find($id);
		if(!$order)
        {
        	return Response::json(array('code' => '1001', 'msg' => Lang::get('msg.no_data_exist')));
        }
        if($order->status == '1')
        {
            return Response::json(array('code' => '1003', 'msg' => Lang::get('msg.order_processed')));    
        }
        if($order->pay == '1')
        {
            return Response::json(array('code' => '1003', 'msg' => Lang::get('msg.order_paid')));    
        }
		if(!$order->delete())
		{
            return Response::json(array('code' => '1001', 'msg' => Lang::get('msg.delete_failed')));
		}

        $log_param['object_id'] = $id;
        $log_param['object_name'] = $order->code;
        $log_param['object_type'] = 'order';
        $log_param['type'] = 'delete';
        $log_param['message'] =Lang::get('text.delete').' '. $order->code;
        MyLog::create($log_param);

        return Response::json(array('code'=>'1000', 'msg'=>Lang::get('msg.delete_success'), 'data' => array('id' => $id)));
	}

	public function getChangeStatus($id)
    {
        $data = array('code' => '1000', 'msg' => '');
        $id = trim(intval($id));
        if(!$id)
        {
            $data['code'] = '1004';
            $data['msg'] = Lang::get('msg.param_incorrect');
            return Response::json($data);
        }
        $order = Order::find($id);
        if(!$order)
        {
            $data['code'] = '1001';
            $data['msg'] = Lang::get('msg.no_data_exist');
            return Response::json($data);
        }
        $order->status = 1;
        if($order->save())
        {
            $data['code'] = '1000';
            $data['status'] = Lang::get('text.processed');
            $data['id'] = $id;
        }
        else
        {
            $data['code'] = '1001';
            $data['msg'] = Lang::get('msg.failed');
        }
        $log_param['object_id'] = $id;
		$log_param['object_type'] = 'order';
		$log_param['type'] = 'update';
		$log_param['object_name'] = $order->code;
		$log_param['message'] = Lang::get('text.processed');
		MyLog::create($log_param);
        return Response::json($data);
    }

    //-------------------------------------------------------------------------

}