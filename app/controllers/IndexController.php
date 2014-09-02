<?php

class IndexController extends BaseController {

	public function Index()
	{    

		$data['allType'] = Order::getType();
		$data['allCity'] = City::all();
        $data['faq_list'] = News::where('status', 1)->where('category_id',2)->orderBy('open_time', 'desc')->take(5)->get();
        $data['news_list'] = News::where('status', 1)->where('category_id',3)->orderBy('open_time', 'desc')->take(5)->get();
		return View::make('home.index',$data);
	}

}