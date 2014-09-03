<?php

class JobController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| News Controller
	|--------------------------------------------------------------------------
	|
	*/

    public function getIndex()
    {
        $job_list = Job::where('status', 1)->orderBy('create_time', 'desc')->paginate(10);
        $data['job_list'] = $job_list;
        $data['right'] = $this->r();
        return View::make('home/job', $data);
    }

    public function getView($id)
    {
        if(!$id)
        {
            return Response::view('common.404',array(),404); 
        }
        $job = Job::find($id);
        if(!$job)
        {
            return Response::view('common.404',array(),404); 
        }
        $data['job'] = $job;
        $data['right'] = $this->r();
        return View::make('home.job-view', $data);
    }

    private function r()
    {
        $d['job_count'] = Job::where('status', 1)->count();
        return View::make('home.about-right',$d)->render();
    }
}