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
		$data['type'] = trim(Input::get('type'));
		$data['time'] = trim(Input::get('time'));

		$data['allType'] = Order::getType();
		$data['allCity'] = City::all();
		$data['allAirport'] = Airport::all();


		return View::make('home.order',$data);
	}

	public function postUpdate()
	{
        //csrf验证
        if (Session::token() != Input::get('_token'))
        {
            return Response::json(array('code'=>'1004','message'=>Lang::get('msg.deny_request')));
        }
		$flight_num = trim(Input::get('flight_num'));
		$type = trim(Input::get('type'));
		$time = trim(Input::get('time'));
		$city_id = trim(Input::get('city_id'));
		$address = trim(Input::get('address'));
		$airport_id = trim(Input::get('airport_id'));
		$normal_luggage_num = trim(Input::get('normal_luggage_num'));
		$special_luggage_num = trim(Input::get('special_luggage_num'));
		$shiper = trim(Input::get('shiper'));
		$gender = trim(Input::get('gender'));
		$phone = trim(Input::get('phone'));

		//需验证字段
		$inputs = array(
			'flight_num' => $flight_num,
			'type' => $type,
			'time' => $time,
			'city_id' => $city_id,
			'address' => $address,
			'airport_id' => $airport_id,
			'normal_luggage_num' => $normal_luggage_num,
			'special_luggage_num' => $special_luggage_num,
			'shiper' => $shiper,
			'gender' => $gender,
			'phone' => $phone
		);
		//验证规则
		$rules = array(
			'flight_num' => 'required|length:6',
			'type' => 'required|digits:1',
			'time' => 'required|date',
			'city_id' => 'required|exists:City,id',
			'address' => 'required',
			'airport_id' => 'required|exists:Airport,id',
			'normal_luggage_num' => 'required|digits',
			'special_luggage_num' => 'required|digits',
			'shiper' => 'required',
			'gender' => 'required',
			'phone' => 'required|mobile',
		);

		$validator = Validator::make($inputs, $rules);

		if ($validator->fails())
		{
			$messages = $validator->messages();
            $error['flight_num'] = str_replace('flight_num', Lang::get('text.flight_num'), $messages->get('flight_num'));
            $error['type'] = str_replace('type', Lang::get('text.ship_type'), $messages->get('type'));
            $error['time'] = str_replace('time', Lang::get('text.ship_time'), $messages->get('time'));
            $error['city_id'] = str_replace('city_id', Lang::get('text.ship_city'), $messages->get('city_id'));
            $error['address'] = str_replace('address', Lang::get('text.address'), $messages->get('address'));
            $error['airport_id'] = str_replace('airport_id', Lang::get('text.airport'), $messages->get('airport_id'));
            $error['normal_luggage_num'] = str_replace('normal_luggage_num', Lang::get('text.normal_luggage_num'), $messages->get('normal_luggage_num'));
            $error['special_luggage_num'] = str_replace('special_luggage_num', Lang::get('text.special_luggage_num'), $messages->get('special_luggage_num'));
            $error['shiper'] = str_replace('shiper', Lang::get('text.shiper'), $messages->get('shiper'));
            $error['gender'] = str_replace('gender', Lang::get('text.shiper_gender'), $messages->get('gender'));
            $error['phone'] = str_replace('phone', Lang::get('text.mobile'), $messages->get('phone'));
		}

		$order = new Order();

		$order->flight_num = $flight_num;
		$order->type = $type;
		$order->time = $time;
		$order->city_id = $city_id;
		$order->address = $address;
		$order->airport_id = $airport_id;
		$order->normal_luggage_num = $normal_luggage_num;
		$order->special_luggage_num = $special_luggage_num;
		$order->shiper = $shiper;
		$order->gender = $gender;
		$order->phone = $phone;
		$order->user_id = Auth::check()?Auth::user()->id:0;
		$order->create_time = local_to_gmt();
		list($usec, $sec) = explode(" ", microtime());
		$order->code = (Auth::check()?'U':'N').$sec.(round($usec*10000));
	}
}