<?php

class LoginController extends BaseController {

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
		return View::make('home.login');
	}


	public function postVerify()
	{
        //csrf验证
        if (Session::token() != Input::get('_token'))
        {
            return Response::json(array('code'=>'1004','message'=>Lang::get('msg.deny_request')));
        }
		$username = Input::get('username');
		$pwd = Input::get('pwd');
        $remember = Input::has('remember') ? true : false;
        if( !$pwd )
        {
            $pwd = Input::get('password');
        }

		$messages = array();
		//需验证字段
		$inputs = array(
			Lang::get('text.username') => $username,
			Lang::get('text.password') => $pwd
		);
		//验证规则
		$rules = array(
			Lang::get('text.username') => 'required',
			Lang::get('text.password') => 'required'
		);

		$validator = Validator::make($inputs, $rules);

		if ($validator->fails())
		{
		    $messages = $validator->messages()->all('<div>:message</div>');
		    return Response::json(array('code' => '1010', 'msg'=>implode('', $messages)));
		}

        if (Auth::attempt(array('username' => $username, 'pwd' => $pwd,'active'=>1), $remember))
        {
            User::saveLogin();
            $path = Session::get('url.intended', 'user/profile');
            Session::forget('url.intended');
            return Response::json(array('code' => '1000','msg'=>Lang::get('msg.login_success'), 'url'=>asset($path)));
        }
        else
        {
            return Response::json(array('code' => '1010', 'msg'=>Lang::get('msg.verify_incorrect')));
        }
	}

	public function getOut()
	{
        User::saveLogout();
		Session::flush();
		Auth::logout();
		return Redirect::to('login');
	}
}