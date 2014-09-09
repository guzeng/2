<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| User Controller
	|--------------------------------------------------------------------------
	|
	*/

    public function getProfile()
    {
        $data['left'] = $this->left();
        return View::make('home.profile', $data);
    }

    public function postProfileUpdate()
    {
        //csrf验证
        if (Session::token() != Input::get('_token'))
        {
            return Response::json(array('code'=>'1004','msg'=>Lang::get('msg.deny_request')));
        }
        $name = trim(Input::get('name'));
        $email = trim(Input::get('email'));
        $gender = trim(Input::get('gender'));
        $error = array();
        //需验证字段
        $inputs = array(
            'name' => $name
        );
        //验证规则
        $rules = array(
            'name' => 'required'
        );
        if($email)
        {
            $inputs['email'] = $email;
            $rules['email'] = 'email';
        }

        $validator = Validator::make($inputs, $rules);
        if ($validator->fails())
        {
            $error['name'] = str_replace('name', Lang::get('text.user_name'), $validator->messages()->get('name'));
            $error['email'] = str_replace('code', Lang::get('text.email'), $validator->messages()->get('email'));
            return Response::json(array('code' => '1010', 'msg'=>Lang::get('msg.submit_error'), 'error'=>$error));
        }
        $user = Auth::user();
        $user->name = $name;
        $user->email = $email;
        $user->gender = $gender;
        if($user->save())
        {
            return Response::json(array('code' => '1000','msg'=>Lang::get('msg.update_success')));
        }
        else
        {
            return Response::json(array('code' => '1010', 'msg'=>Lang::get('msg.failed')));
        }
    }

    public function getSecurity()
    {
        $data['left'] = $this->left();
        return View::make('home.security', $data);
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

    private function left()
    {
        return View::make('home.user-left')->render();
    }
}