<?php

class IndexController extends BaseController {

	public function Index()
	{    

		$data['allType'] = Order::getType();
		$data['allCity'] = City::where('parent_id',0)->get();
        $data['faq_list'] = News::where('status', 1)->where('category_id',2)->orderBy('id', 'asc')->take(5)->get();
        $data['news_list'] = News::where('status', 1)->where('category_id',3)->orderBy('id', 'desc')->take(5)->get();
		return View::make('home.index',$data);
	}

	public function Haoli()
	{
		return View::make('home.haoli');
	}
}