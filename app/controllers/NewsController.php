<?php

class NewsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| News Controller
	|--------------------------------------------------------------------------
	|
	*/

    public function getIndex()
    {
        $news_list = News::where('status', 1)->where('category_id',3)->orderBy('open_time', 'desc')->paginate(10);
        $data['news_list'] = $news_list;
        $data['right'] = $this->r();
        $data['category'] = "3";
        return View::make('home/news', $data);
    }

    public function getFaq()
    {
        $news_list = News::where('status', 1)->where('category_id',2)->orderBy('id', 'asc')->paginate(10);
        $data['news_list'] = $news_list;
        $data['right'] = $this->r();
        $data['category'] = "2";
        return View::make('home/news', $data);
    }

    public function getGrude()
    {
        $news_list = News::where('status', 1)->where('category_id',1)->orderBy('id', 'asc')->paginate(10);
        $data['news_list'] = $news_list;
        $data['right'] = $this->r();
        $data['category'] = "1";
        return View::make('home/news', $data);
    }

    public function getView($id)
    {
        if(!$id)
        {
            return Response::view('common.404',array(),404); 
        }
        $news = News::find($id);
        if(!$news)
        {
            return Response::view('common.404',array(),404); 
        }
        $news->view = $news->view+1;
        $news->save();
        $data['news'] = $news;
        $data['right'] = $this->r();
        $data['category'] = $news->category_id;
        return View::make('home.news-view', $data);
    }

    private function r()
    {
        $d['news_count'] = News::where('status', 1)->where('category_id',3)->count();
        $d['faq_count'] = News::where('status', 1)->where('category_id',2)->count();
        $d['grude_count'] = News::where('status', 1)->where('category_id',1)->count();
        $d['recent'] = News::where('status',1)->orderBy('create_time','desc')->take(5)->get();

        //print_r($d);
        return View::make('home.news-right',$d)->render();
    }
}