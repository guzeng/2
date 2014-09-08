<?php

class Admin_AboutController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Admin Index Controller
	|--------------------------------------------------------------------------
	|
	*/
	public function getAbout()
	{
		$data = Setting::where('variable','about_us')->first();

		return View::make('admin.system.about',$data);
	}
	
	public function postUpdate()
	{
		$data = array();
		//csrf验证
		if (Session::token() != Input::get('_token'))
		{
			$data['error'] = Lang::get('msg.deny_request');
		}
		else
		{
			$content = Input::get('content');
			$content_en = Input::get('content_en');
			if(Input::get('type') == 'aboutus')
			{
				$about = Setting::where('variable','about_us')->first();

				if(Setting::where('variable','about_us')->update(array('value'=>$content,'value_en'=>$content_en)))
				{
					$data['success'] = Lang::get('msg.update_success');

			    	$log_param = array();
					$log_param['object_id'] = 0;
					$log_param['object_name'] = 'about us';
					$log_param['object_type'] = 'about';
					$log_param['type'] = 'update';
					$log_param['message'] = $about->value.' => '.$content;
					MyLog::c($log_param);
					$log_param['message'] = $about->value_en.' => '.$content_en;
					MyLog::c($log_param);
				}
				else
				{
					$data['error'] = Lang::get('msg.update_failed');
				}
				$data['value'] = $content;
				$data['value_en'] = $content_en;		
			}
			else if(Input::get('type') == 'contactus')
			{
				$contact = Setting::where('variable','contact_us')->first();
				if(Setting::where('variable','contact_us')->update(array('value'=>$content,'value_en'=>$content_en)))
				{
					$data['success'] = Lang::get('msg.update_success');

			    	$log_param = array();
					$log_param['object_id'] = 0;
					$log_param['object_name'] = 'contact us';
					$log_param['object_type'] = 'contact';
					$log_param['type'] = 'update';
					$log_param['message'] = $contact->value.' => '.$content;
					MyLog::c($log_param);
					$log_param['message'] = $contact->value_en.' => '.$content_en;
					MyLog::c($log_param);
				}
				else
				{
					$data['error'] = Lang::get('msg.update_failed');
				}
			}
			$data['value'] = $content;
			$data['value_en'] = $content_en;
		}
		if(Input::get('type') == 'aboutus')
		{
			return View::make('admin.system.about',$data);
		}
		else if(Input::get('type') == 'contactus')
		{
			return View::make('admin.system.contact',$data);
		}
	}

	public function getContact()
	{
		$data = Setting::where('variable','contact_us')->first();

		return View::make('admin.system.contact',$data);
	}


    //-------------------------------------------------------------------------
}