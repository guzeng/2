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
            return Response::json(array('code'=>'1004','message'=>Lang::get('msg.deny_request')));
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

		$messages = array();
		//Lang::get('text.username')Lang::get('text.password')
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
			'name' => 'max:50',
			'accept' => 'accepted'
		);

		$validator = Validator::make($inputs, $rules);

		if ($validator->fails())
		{
            $error['username'] = str_replace('username', Lang::get('text.mobile'), $validator->messages()->get('username'));
            $error['code'] = str_replace('code', Lang::get('text.validate_key'), $validator->messages()->get('code'));
            $error['password'] = str_replace('password', Lang::get('text.password'), $validator->messages()->get('password'));
            $error['name'] = str_replace('name', Lang::get('text.name'), $validator->messages()->get('name'));
            $error['accept'] = str_replace('accept', Lang::get('text.accept'), $validator->messages()->get('accept'));
            
		}
        if(!$mobileCode)
        {
        	//$error['code'] = Lang::get('msg.verify_key_incorrect');
        }
        else
        {
        	if($mobileCode->create_time + 86400 < local_to_gmt())//24小时过期
        	{
        		//$error['code'] = Lang::get('msg.verify_key_incorrect');
        	}
        }
        if(!empty($error))
        {
        	return Response::json(array('code' => '1010', 'error'=>$error));
        }

		$user = new User();
		$user->username = $username;
		$user->pwd = Hash::make($password);
		$user->phone = $username;
		$user->gender = $gender;
		$user->create_time = local_to_gmt();
		if($user->save())
		{
			Auth::login($user);
			User::saveLogin();
            $path = Session::get('url.intended', '/');
            Session::forget('url.intended');
            return Response::json(array('code' => '1000','msg'=>Lang::get('msg.login_success'), 'url'=>asset($path)));
		}
		else
		{
			return Response::json(array('code' => '1010', 'msg'=>Lang::get('msg.register_failed')));
		}
	}

	public function getOut()
	{
        $brower = User::getBrowser();
        if(Auth::check())
        {
            $where = array(
                'user_id' => Auth::user()->id,
                'brower' => $brower[0].$brower[1],
                'ip' => User::ip()
            );
            UserLogin::where('user_id',Auth::user()->id)->where('brower',$brower[0].$brower[1])->where('ip',User::ip())->update(array('out_time'=>local_to_gmt()));
        }
		Session::flush();
		Auth::logout();
		return Redirect::to('/');
	}
}