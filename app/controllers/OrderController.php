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
		$data['allType'] = Order::getType();
		$data['allCity'] = City::all();
		$data['allAirport'] = Airport::all();
		return View::make('home.order',$data);
	}


}