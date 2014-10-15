<?php

class Admin_OrderController extends BaseController {

	public function getIndex()
	{
		return View::make('admin.order.list');
	}

    public function getCancel()
    {
        $data['type'] = 'cancel';
        return View::make('admin.order.list',$data);
    }
    public function getDatalist($type='')
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
        $prefix = Config::get('database.connections.mysql.prefix');
        if($sSearch)
        {
            $_u = User::where('name',$sSearch)->first();
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
            $v = array('%'.$sSearch.'%','%'.$sSearch.'%','%'.$sSearch.'%');
            $select = " from ".$prefix."order as u";
            $where = " where ( code like ? or flight_num like ? or shipper like ? or phone like ? ";
            if(isset($user_id))
            {
                $where .= " or user_id = ?";
                $v[] = $user_id;
            }
            if(!empty($_a_id))
            {
                $where .= " or airport_id in (".implode(',', $_a_id).")";
            }

            $where .= ")";
            if($type=='cancel')
            {
                $where .= " and status = '3'";
            }
            $c = DB::select("select count(u.id) as count" .$select.$where,$v);
            $iTotalRecords = $c[0]->count;
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $list = DB::select("select u.* " .$select.$where ." order by ".$orderby." ".$order." limit ".$iDisplayLength." offset ".$iDisplayStart ,$v);
        }
        else
        {
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            if($type=='cancel')
            {
                $iTotalRecords = Order::where('status',3)->count();
                $list = Order::where('status',3)->take($iDisplayLength)->skip($iDisplayStart)->orderBy($orderby,$order)->get();
            }
            else
            {
                $iTotalRecords = Order::count();
                $list = Order::take($iDisplayLength)->skip($iDisplayStart)->orderBy($orderby,$order)->get();
            }
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
                    Order::getStatus($item->status),
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
        $order->status=3;
		if(!$order->save())
		{
            return Response::json(array('code' => '1001', 'msg' => Lang::get('msg.failed')));
		}

        $log_param['object_id'] = $id;
        $log_param['object_name'] = $order->code;
        $log_param['object_type'] = 'order';
        $log_param['type'] = 'cancel';
        $log_param['message'] =Lang::get('text.canceled').' '. $order->code;
        MyLog::create($log_param);

        return Response::json(array('code'=>'1000', 'msg'=>Lang::get('msg.cancel_success'), 'data' => array('id' => $id)));
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

    public function getExport($type='')
    {
        require_once(app_path().'/lib/PHPExcel/PHPExcel.php');
        require_once(app_path().'/lib/PHPExcel/PHPExcel/IOFactory.php');
        require_once(app_path().'/lib/PHPExcel/PHPExcel/Writer/IWriter.php');
        require_once(app_path().'/lib/PHPExcel/PHPExcel/Writer/Excel5.php');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setCellValue('a1', Lang::get('text.order_code'));//设置列的值
        $objPHPExcel->getActiveSheet()->setCellValue('b1', Lang::get('text.flight_num'));
        $objPHPExcel->getActiveSheet()->setCellValue('c1', Lang::get('text.ship_type'));
        $objPHPExcel->getActiveSheet()->setCellValue('d1', Lang::get('text.ship_time'));
        $objPHPExcel->getActiveSheet()->setCellValue('e1', Lang::get('text.ship_city'));
        $objPHPExcel->getActiveSheet()->setCellValue('f1', Lang::get('text.airport'));
        $objPHPExcel->getActiveSheet()->setCellValue('g1', Lang::get('text.one_num'));
        $objPHPExcel->getActiveSheet()->setCellValue('h1', Lang::get('text.two_num'));
        $objPHPExcel->getActiveSheet()->setCellValue('i1', Lang::get('text.special_num'));
        $objPHPExcel->getActiveSheet()->setCellValue('j1', Lang::get('text.distance'));
        $objPHPExcel->getActiveSheet()->setCellValue('K1', Lang::get('text.shipper'));
        $objPHPExcel->getActiveSheet()->setCellValue('l1', Lang::get('text.gender'));
        $objPHPExcel->getActiveSheet()->setCellValue('m1', Lang::get('text.mobile'));
        $objPHPExcel->getActiveSheet()->setCellValue('n1', Lang::get('text.create_date'));
        $objPHPExcel->getActiveSheet()->setCellValue('o1', Lang::get('text.status'));
        $objPHPExcel->getActiveSheet()->setCellValue('p1', Lang::get('text.money'));
        $objPHPExcel->getActiveSheet()->setCellValue('q1', Lang::get('text.pay_type'));
        $objPHPExcel->getActiveSheet()->setCellValue('r1', Lang::get('text.pay'));
        $objPHPExcel->getActiveSheet()->setCellValue('s1', Lang::get('text.pay_code'));
        $objPHPExcel->getActiveSheet()->setCellValue('t1', Lang::get('text.pay_time'));
        $objPHPExcel->getActiveSheet()->setCellValue('u1', Lang::get('text.ship_note'));

        $orderby = intval(Input::get('iSortCol_0'));
        $order = trim(Input::get('sSortDir_0'));

        $sSearch = trim(Input::get('sSearch'));

        $records = array();
        $records["aaData"] = array(); 

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
        $order = in_array($order, array('desc','asc')) ? $order : 'desc';
        $prefix = Config::get('database.connections.mysql.prefix');
        if($sSearch)
        {
            $_u = User::where('name',$sSearch)->first();
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
            $v = array('%'.$sSearch.'%','%'.$sSearch.'%','%'.$sSearch.'%');
            $select = " from ".$prefix."order as u";
            $where = " where ( code like ? or flight_num like ? or shipper like ? or phone like ? ";
            if(isset($user_id))
            {
                $where .= " or user_id = ?";
                $v[] = $user_id;
            }
            if(!empty($_a_id))
            {
                $where .= " or airport_id in (".implode(',', $_a_id).")";
            }

            $where .= ")";
            if($type=='cancel')
            {
                $where .= " and status = '3'";
            }
            $list = DB::select("select u.* " .$select.$where ." order by ".$orderby." ".$order, $v);
        }
        else
        {
            if($type=='cancel')
            {
                $list = Order::where('status',3)->orderBy($orderby,$order)->get();
            }
            else
            {
                $iTotalRecords = Order::count();
                $list = Order::orderBy($orderby,$order)->get();
            }
        }
        if($list)
        {
            $areas = City::all();
            $a = array();
            if($areas)
            {
                foreach ($areas as $key => $value) {
                    $a[$value->id] = App::getLocale()=='zh'?$value->name:$value->name_en;
                }
            }
            foreach($list as $key => $item)
            {
                $city_name = $item->city ? (App::getLocale()=='zh'?$item->city->name:$item->city->name_en) : '';
                if($item->area_id && array_key_exists($item->area_id, $a))
                {
                    $city_name .= ' '.$a[$item->area_id];
                }
                $i = $key+2;
                $objPHPExcel->getActiveSheet()->setCellValue('a'.$i, $item->code);
                $objPHPExcel->getActiveSheet()->setCellValue('b'.$i, $item->flight_num);
                $objPHPExcel->getActiveSheet()->setCellValue('c'.$i, Order::getType($item->type));
                $objPHPExcel->getActiveSheet()->setCellValue('d'.$i, date('Y-m-d H:i:s',gmt_to_local($item->time)));
                $objPHPExcel->getActiveSheet()->setCellValue('e'.$i, $city_name);
                $objPHPExcel->getActiveSheet()->setCellValue('f'.$i, $item->airport ? $item->airport->name : '');
                $objPHPExcel->getActiveSheet()->setCellValue('g'.$i, $item->one_num);
                $objPHPExcel->getActiveSheet()->setCellValue('h'.$i, $item->two_num);
                $objPHPExcel->getActiveSheet()->setCellValue('i'.$i, $item->special_num);
                $objPHPExcel->getActiveSheet()->setCellValue('j'.$i, $item->distance);
                $objPHPExcel->getActiveSheet()->setCellValue('k'.$i, $item->shipper);
                $objPHPExcel->getActiveSheet()->setCellValue('l'.$i, Lang::get('text.'.$item->gender));
                $objPHPExcel->getActiveSheet()->setCellValue('m'.$i, $item->phone);
                $objPHPExcel->getActiveSheet()->setCellValue('n'.$i, date('Y-m-d H:i:s',gmt_to_local($item->create_time)));
                $objPHPExcel->getActiveSheet()->setCellValue('o'.$i, Order::getStatus($item->status));
                $objPHPExcel->getActiveSheet()->setCellValue('p'.$i, $item->money);
                $objPHPExcel->getActiveSheet()->setCellValue('q'.$i, $item->pay_type>0 ?Lang::get('text.pay_type_'.Order::payType($item->pay_type)):'');
                $objPHPExcel->getActiveSheet()->setCellValue('r'.$i, $item->pay=='1' ? Lang::get('text.paid') : Lang::get('text.unpaid'));
                $objPHPExcel->getActiveSheet()->setCellValue('s'.$i, $item->pay_code);
                $objPHPExcel->getActiveSheet()->setCellValue('t'.$i, $item->pay_time>0 ? date('Y-m-d H:i:s',$item->pay_time) : '');
                $objPHPExcel->getActiveSheet()->setCellValue('u'.$i, $item->info);

            }            
        }

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);//设置宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //创建表格类型，目前支持老版的excel5,和excel2007,也支持生成html,pdf,csv格式
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header('Content-Disposition:attachment;filename="orders-'.date("Y-m-d-H-i-s").'.xls"');
        header("Content-Transfer-Encoding:binary");
        $objWriter->save('php://output');
    }
}