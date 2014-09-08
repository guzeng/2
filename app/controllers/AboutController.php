<?php

class AboutController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| News Controller
	|--------------------------------------------------------------------------
	|
	*/

    public function getIndex()
    {
        $about = Setting::where('variable', 'about_us')->first();
        $data['item'] = $about;
        $data['right'] = $this->r();
        $data['cat'] = 'about';
        return View::make('home/about', $data);
    }

    public function getContact()
    {
        $contact = Setting::where('variable', 'contact_us')->first();
        $data['item'] = $contact;
        $data['right'] = $this->r();
        $data['cat'] = 'contact';
        return View::make('home/about', $data);
    }

    private function r()
    {
        $d['job_count'] = Job::where('status', 1)->count();
        return View::make('home.about-right',$d)->render();
    }
}