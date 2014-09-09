<?php

class RegisterController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	*/
	public function getIndex()
	{    
		if(Auth::check())
    	{
        	return Redirect::to('/');
    	}
		return View::make('home.register');
	}


	public function postVerify()
	{
        //csrf验证
        if (Session::token() != Input::get('_token'))
        {
            return Response::json(array('code'=>'1004','msg'=>Lang::get('msg.deny_request')));
        }
		$username = trim(Input::get('username'));
		$code = trim(Input::get('validate_code'));
		$password = trim(Input::get('password'));
		$password_confirmation = trim(Input::get('password_confirmation'));
		$name = trim(Input::get('name'));
		$gender = Input::has('gender')&&in_array(trim(Input::get('gender')),array('male','female')) ? trim(Input::get('gender')) : 'male';
		$accept = trim(Input::get('accept'));
        if( !$password )
        {
            $password = Input::get('password');
        }
        $mobileCode = MobileCode::where('mobile',$username)->where('code',$code)->first();

        $error = array();

		//需验证字段
		$inputs = array(
			'username' => $username,
			'code' => $code,
			'password' => $password,
			'password_confirmation' => $password_confirmation,
			'name' => $name,
			'accept' => $accept
		);
		//验证规则
		$rules = array(
			'username' => 'required|mobile|unique:account,username',
			'code' => 'required',
			'password' => 'required|confirmed|min:6',
			'name' => 'required|max:50',
			'accept' => 'accepted'
		);

		$validator = Validator::make($inputs, $rules);

		if ($validator->fails())
		{
            $error['username'] = str_replace('username', Lang::get('text.mobile'), $validator->messages()->get('username'));
            $error['validate_code'] = str_replace('code', Lang::get('text.validate_key'), $validator->messages()->get('code'));
            $error['password'] = str_replace('password', Lang::get('text.password'), $validator->messages()->get('password'));
            $error['name'] = str_replace('name', Lang::get('text.user_name'), $validator->messages()->get('name'));
            $error['accept'] = str_replace('accept', Lang::get('text.register_agreement'), $validator->messages()->get('accept'));
            
		}
		if(!isset($error['validate_code']) || empty($error['validate_code']))
		{
	        if(!$mobileCode)
	        {
	        	$error['validate_code'] = Lang::get('msg.verify_key_incorrect');
	        }
	        else
	        {
	        	if($mobileCode->create_time + 300 < local_to_gmt())//5分钟过期
	        	{
	        		$error['validate_code'] = Lang::get('msg.validate_dated');
	        	}
	        }
		}
        if(!empty($error))
        {
        	return Response::json(array('code' => '1010', 'msg'=>Lang::get('msg.submit_error'), 'error'=>$error));
        }

		$user = new User();
		$user->username = $username;
		$user->pwd = Hash::make($password);
		$user->phone = $username;
		$user->name = $name;
		$user->gender = $gender;
		$user->create_time = local_to_gmt();
		if($user->save())
		{
			Auth::login($user);
			User::saveLogin();
            $path = Session::get('url.intended', '/');
            Session::forget('url.intended');
            //Sms::send($username, Lang::get('text.register_success'));
            return Response::json(array('code' => '1000','msg'=>Lang::get('msg.register_success'), 'url'=>asset($path)));
		}
		else
		{
			return Response::json(array('code' => '1010', 'msg'=>Lang::get('msg.register_failed')));
		}
	}

}