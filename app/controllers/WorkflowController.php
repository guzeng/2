<?php

class WorkflowController extends BaseController {

	public function getIndex()
	{    
        $d['news_count'] = News::where('status', 1)->where('category_id',3)->count();
        $d['faq_count'] = News::where('status', 1)->where('category_id',2)->count();
        $d['grude_count'] = News::where('status', 1)->where('category_id',1)->count();
        $d['recent'] = News::where('status',1)->orderBy('create_time','desc')->take(5)->get();
		return View::make('home.workflow')->nest('right', 'home.news-right', $d);
	}

}