<?php

class Admin_SettingController extends BaseController
{
	protected $layout = 'admin.layout';

	public function getIndex()
	{
		$data = array();
		$list = DB::table('setting')->get();
		if(!empty($list))
		{
			foreach($list as $key => $item)
			{
				$data[$item->variable] = $item->value;
			}
		}
		return View::make('admin.system.setting')->with('data',$data);
	}

	public function postUpdate()
	{
		//csrf验证
		if (Session::token() != Input::get('_token'))
		{
			return Response::json(array('code'=>'1004','msg'=>Lang::get('msg.deny_request')));
		}

		$data = array(
			'code' => '1000', 
			'msg' => Lang::get('msg.success')
		);
		$post = array(
			'website_name' 		=> trim(Input::get('website_name')),
			'website_title' 		=> trim(Input::get('website_title')),
			'website_keyword' 		=> trim(Input::get('website_keyword')),
			'website_description' 	=> trim(Input::get('website_description')),
			'copyright' 	=> trim(Input::get('copyright')),
			'phone' 		=> trim(Input::get('phone')),
			'icp' 			=> trim(Input::get('icp')),
			'address' 		=> trim(Input::get('address')),
			'post' 			=> trim(Input::get('post')),
			'email' 		=> trim(Input::get('email')),
			'hotline' 		=> trim(Input::get('hotline'))
		);
		$logo_pic_path = trim(Input::get('logo_pic_path'));

		//表单验证
		$rule =array(
			'website_name'=>array('website_name',Lang::get('text.website_name'),'max:100'),
			'website_title'=>array('website_title',Lang::get('text.website_title'),'max:100'),
			'website_keyword'=>array('website_keyword',Lang::get('text.website_keyword'),'max:100'),
			'website_description'=>array('website_description',Lang::get('text.website_description'),'max:100'),
			'copyright'=>array('copyright',Lang::get('text.copy_right'),'max:100'),
			'phone'=>array('phone',Lang::get('text.contact_phone'),'max:100'),
			'icp'=>array('icp',Lang::get('text.icp'),'max:100'),
			'address'=>array('address',Lang::get('text.address'),'max:200'),
			'post'=>array('post',Lang::get('text.post'),'max:20'),
			'hotline'=>array('post',Lang::get('text.hotline'),'max:100')
			);
		if($post['email'])
		{
			$rule['email'] = array('email',Lang::get('text.contact_email'),'max:100|email');
		}
		
		foreach($rule as $key => $value)
        {
            $r[$key] = $value[2];
        }
        $validator = Validator::make($post,$r);
		if($validator->fails())
		{
			$messages = $validator->messages();
			$data['code'] = '1010';
			$data['msg'] = Lang::get('msg.submit_error');

			foreach($rule as $key => $value)
            {
                if($messages->has($key))
                {
                	$reKey = str_replace('_'," ",$key);
                    $error[$value[0]] = str_replace($reKey, $value[1], $messages->first($key));
                }
            }
            if(isset($error) && !empty($error))
            {
            	$data['error'] = $error;
            }
		} 
	 	else
		{
	    	$log_param = array();
			$log_param['object_id'] = 0;
			$log_param['object_name'] = '';
			$log_param['object_type'] = 'setting';
			$log_param['type'] = 'update';

			$all_settings = Setting::all();
			$all = array();
			if($all_settings)
			{
				foreach($all_settings as $key => $value)
				{
					$all[$value->variable] = array('id'=>$value->id, 'value'=>$value->value);
				}
			}
			
			foreach($post as $key => $value)
			{
				$success = false;
				if(array_key_exists($key, $all))
				{
					if($value !== $all[$key]['value'])
					{
						$system = Setting::find($all[$key]['id']);
						$system->value = $value;
						if($system->save())
						{
							$success = true;
						}
					}
				}
				else
				{
					$system = new Setting();
					$system->variable = $key;
					$system->value = $value;
					if($system->save())
					{
						$success = true;
					}
				}
				//写入缓存
				Cache::forever($key,$value);
				//写入log
				if($success)
				{
					$log[] = Lang::get('text.'.$key).Lang::get('text.colon').$value;
				}
			}
            if($logo_pic_path)
            {
                $filePath = Files::uploadDir('temp').'/thumbnail/'.$logo_pic_path;	//缩略图
                $filePath2 = Files::uploadDir('temp').'/'.$logo_pic_path;  //原图
                if(file_exists($filePath))
                {
                	Files::createFolder('uploads');
                    $new_file = './uploads/logo.png';
                    if(copy($filePath,$new_file))
                    {
                        @unlink($filePath);
                        @unlink($filePath2);
						$log[] = Lang::get('text.upload_btn').' '.Lang::get('text.logo');
                    }
                }
            }
		}
		if($data['code']=='1000')
		{
			if(!empty($log))
			{
				$log_param['message'] = implode(' ; ', $log);
				$myLog = new MyLog($log_param);
				$myLog->save();
			}
			$data['url'] = asset('').'admin/index';
		}                                   
		return Response::json($data);
	}

    public function getSecurity()
    {
        return View::make('admin.system.security');
    }

    public function postPasswordUpdate()
    {
        //csrf验证
        if (Session::token() != Input::get('_token'))
        {
            return Response::json(array('code'=>'1004','msg'=>Lang::get('msg.deny_request')));
        }
        $old = trim(Input::get('old'));
        $password = trim(Input::get('password'));
        $password_confirmation = trim(Input::get('password_confirmation'));

        $error = array();

        //需验证字段
        $inputs = array(
            'password' => $password,
            'password_confirmation' => $password_confirmation
        );
        //验证规则
        $rules = array(
            'password' => 'required|confirmed|min:6'
        );

        $validator = Validator::make($inputs, $rules);

        if ($validator->fails())
        {
            $error['password'] = str_replace('password', Lang::get('text.password'), $validator->messages()->get('password'));
        }
        $user = Auth::user();
        if(! Hash::check($old,$user->getAuthPassword()))
        {
            $error['old'] = Lang::get('msg.pwd4');
        }
        if(!empty($error))
        {
            return Response::json(array('code' => '1010', 'msg'=>Lang::get('msg.submit_error'), 'error'=>$error));
        }
        $user->pwd = Hash::make($password);
        if($user->save())
        {
            return Response::json(array('code' => '1000','msg'=>Lang::get('msg.pwd_changed_success')));
        }
        else
        {
            return Response::json(array('code' => '1000','msg'=>Lang::get('msg.update_failed')));
        }
    }
}

?>