<?php

class ForgetPasswordController extends BaseController {

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
		return View::make('home.forgetpwd');
	}


	public function postReset()
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

        $mobileCode = MobileCode::where('mobile',$username)->where('code',$code)->first();
        $user = User::where('username',$username)->first();

        $error = array();

		$messages = array();
		//需验证字段
		$inputs = array(
			'username' => $username,
			'code' => $code,
			'password' => $password,
			'password_confirmation' => $password_confirmation
		);
		//验证规则
		$rules = array(
			'username' => 'required|mobile',
			'code' => 'required',
			'password' => 'required|confirmed|min:6'
		);

		$validator = Validator::make($inputs, $rules);

		if ($validator->fails())
		{
            $error['username'] = str_replace('username', Lang::get('text.mobile'), $validator->messages()->get('username'));
            $error['code'] = str_replace('code', Lang::get('text.validate_key'), $validator->messages()->get('code'));
            $error['password'] = str_replace('password', Lang::get('text.password'), $validator->messages()->get('password'));
		}
        if(!$user)
        {

        	$error['username'] = Lang::get('msg.user_not_exist');
        }
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
        if(!empty($error))
        {
        	return Response::json(array('code' => '1010', 'error'=>$error));
        }

		$user->pwd = Hash::make($password);

		if($user->save())
		{
            return Response::json(array('code' => '1000'));
		}
		else
		{
			return Response::json(array('code' => '1010', 'msg'=>Lang::get('msg.failed')));
		}
	}

}