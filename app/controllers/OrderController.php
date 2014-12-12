<?php

class OrderController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	*/
	public function getIndex()
	{
		$data['city_id'] = trim(Input::get('city_id'));
        $data['area_id'] = trim(Input::get('area_id'));
		$data['type'] = trim(Input::get('type'));
		$time = trim(Input::get('time'));
		if($time)
		{
			$t = strtotime($time);
			$data['time'] = date('Y-m-d H:i',$t);
		}
		//$data['time'] = $time;

		$data['allType'] = Order::getType();
		$data['allCity'] = City::where('parent_id',0)->get();
        if($data['city_id'])
        {
            $data['AllArea'] = City::where('parent_id',$data['city_id'])->get();
            $data['allAirport'] = Airport::where('city_id',$data['city_id'])->get();
        }

		if(Auth::check())
		{
            $address = Address::where('user_id',Auth::user()->id)->with('city')->get();
            if($address)
            {
                foreach ($address as $key => $value) {
                    if($value->area_id)
                    {
                        $value->area = City::find($value->area_id);    
                    }
                }
            }
			$data['addressList'] = $address;
		}
		return View::make('home.order',$data);
	}

	public function postUpdate()
	{
		if (Auth::guest()) return Response::json(array('code'=>'1002','token'=>csrf_token()));
        //csrf验证
        if (Session::token() != Input::get('_token'))
        {
            return Response::json(array('code'=>'1004','message'=>Lang::get('msg.deny_request')));
        }
		$flight_num = trim(Input::get('flight_num'));
		$type = trim(Input::get('type'));
		$time = trim(Input::get('time'));
		$city_id = trim(Input::get('city_id'));
        $area_id = trim(Input::get('area_id'));
		$address = trim(Input::get('address'));
		$airport_id = trim(Input::get('airport_id'));
		$one_num = trim(Input::get('one_num'));
		$two_num = trim(Input::get('two_num'));
		$special_num = trim(Input::get('special_num'));
		$shipper = trim(Input::get('shipper'));
		$gender = trim(Input::get('gender'));
		$phone = trim(Input::get('phone'));
		$distance = trim(Input::get('distance'));

		//需验证字段
		$inputs = array(
			'flight_num' => $flight_num,
			'type' => $type,
			'time' => $time,
			'city_id' => $city_id,
            'area_id' => $area_id,
			'address' => $address,
			'airport_id' => $airport_id,
			'one_num' => $one_num,
			'two_num' => $two_num,
			'special_num' => $special_num,
			'shipper' => $shipper,
			'gender' => $gender,
			'phone' => $phone
		);
		//验证规则
		$rules = array(
			'flight_num' => 'required|size:6',
			'type' => 'required|in:1,2',
			'time' => 'required|date',
			'city_id' => 'required|exists:city,id',
			'address' => 'required',
			'airport_id' => 'required|exists:airport,id',
			'one_num' => 'numeric',
			'two_num' => 'numeric',
			'special_num' => 'numeric',
			'shipper' => 'required',
			'gender' => 'required',
			'phone' => 'required|mobile',
		);

		$validator = Validator::make($inputs, $rules);
		$error = array();
		if ($validator->fails())
		{
			$messages = $validator->messages();
            $error['flight_num'] = str_replace('flight_num', Lang::get('text.flight_num'), $messages->get('flight_num'));
            $error['type'] = str_replace('type', Lang::get('text.ship_type'), $messages->get('type'));
            $error['time'] = str_replace('time', Lang::get('text.ship_time'), $messages->get('time'));
            $error['city_id'] = str_replace('city_id', Lang::get('text.ship_city'), $messages->get('city_id'));
            $error['address'] = str_replace('address', Lang::get('text.address'), $messages->get('address'));
            $error['airport_id'] = str_replace('airport_id', Lang::get('text.airport'), $messages->get('airport_id'));
            $error['one_num'] = str_replace('one_num', Lang::get('text.one_num'), $messages->get('one_num'));
            $error['two_num'] = str_replace('two_num', Lang::get('text.two_num'), $messages->get('two_num'));
            $error['special_num'] = str_replace('special_num', Lang::get('text.special_num'), $messages->get('special_num'));
            $error['shipper'] = str_replace('shipper', Lang::get('text.shipper'), $messages->get('shipper'));
            $error['gender'] = str_replace('gender', Lang::get('text.shiper_gender'), $messages->get('gender'));
            $error['phone'] = str_replace('phone', Lang::get('text.mobile'), $messages->get('phone'));
		}
		if(intval($one_num)==0 && intval($two_num)==0 && intval($special_num)==0)
		{
			$error['one_num'] = Lang::get('msg.luggage_require');
		}
		if(!empty($error))
		{
			return Response::json(array('code' => '1010', 'error'=>$error));
		}

		$order = new Order();

		$order->flight_num = $flight_num;
		$order->type = $type;
		$order->time = strtotime($time);
		$order->city_id = $city_id;
        $order->area_id = $area_id;
		$order->address = $address;
		$order->airport_id = $airport_id;
		$order->one_num = intval($one_num);
		$order->two_num = intval($two_num);
		$order->special_num = intval($special_num);
		$order->shipper = $shipper;
		$order->gender = $gender;
		$order->phone = $phone;
		$order->user_id = Auth::check()?Auth::user()->id:0;
		$order->create_time = local_to_gmt();
		$order->distance = round($distance,2);
		$order->money = Order::price($distance,$one_num,$two_num,$special_num);
		list($usec, $sec) = explode(" ", microtime());
		$order->code = (Auth::check()?'U':'N').$sec.(round($usec*10000));
		if($order->save())
		{
            if(App::getLocale()=='zh')
            {
                $date = date('Y年m月d日',$order->time);
            }
            else
            {
                $date = date('F d,Y',$order->time);
            }
            Sms::send($phone.',18922377691', sprintf(Lang::get('text.order_sms'),$order->code,$date,round($order->money,2)));
			return Response::json(array('code' => '1000','url'=>asset('order/pay/'.$order->code)));
		}
		else
		{
			return Response::json(array('code' => '1001','msg'=>Lang::get('msg.failed')));
		}
	}

	public function getPay($n)
	{    
		if (Auth::guest()) return Redirect::guest('login');
        if(!$n)
        {
            return Response::view('common.404',array(),404); 
        }
        $order = Order::where('code',$n)->first();
        if(!$order)
        {
            return Response::view('common.404',array(),404); 
        }
        if($order->user_id != Auth::user()->id)
        {
            return Response::view('common.404',array(),404); 
        }
        if($order->complete==1)
        {
            return Response::view('common.500',array('msg'=>Lang::get('msg.deny_request'))); 
        }
        $data['order'] = $order;
		return View::make('home.pay',$data);
	}

    public function getSendSms($id)
    {
        if(!$id)
        {
            echo json_encode(array('code'=>'1001','msg'=>Lang::get('msg.param_incorrect')));
            exit;
        }
        $order = Order::find($id);
        if(!$order)
        {
            echo json_encode(array('code'=>'1001','msg'=>Lang::get('msg.param_incorrect')));
            exit;
        }
        if(App::getLocale()=='zh')
        {
            $date = date('Y年m月d日', $order->time);
        }
        else
        {
            $date = date('F d,Y', $order->time);
        }
        if(Sms::send($order->phone, sprintf(Lang::get('text.order_sms'),$order->code,$date,round($order->money,2))))
        {
            echo json_encode(array('code'=>'1000','msg'=>Lang::get('msg.send_success')));
        }
        else
        {
            echo json_encode(array('code'=>'1000','msg'=>Lang::get('msg.send_failed')));
        }
        exit;
    }
}