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

    public function getOrder()
    {
        $data['left'] = $this->left();
        $data['orders'] = Order::where('user_id',Auth::user()->id)->paginate(10);
        return View::make('home.user-order-list', $data);
    }
    public function getOrderView($id)
    {
        if(!$id)
        {
            return Response::view('common.404',array(),404); 
        }
        $order = Order::find($id);
        if(!$order)
        {
            return Response::view('common.404',array(),404); 
        }
        $data['order'] = $order;
        $data['left'] = $this->left();
        return View::make('home.user-order-view', $data);
    }
    
    public function getAddress()
    {
        $data['left'] = $this->left();
        $data['address'] = Address::where('user_id',Auth::user()->id)->paginate(10);
        return View::make('home.user-address-list', $data);
    }

    public function getAddressDelete($id)
    {
        if(!$id)
        {
            return Response::json(array('code'=>'1004','msg'=>Lang::get('msg.param_error'))); 
        }
        $address = Address::find($id);
        if(!$address || $address->user_id != Auth::user()->id)
        {
            return Response::json(array('code'=>'1004','msg'=>Lang::get('msg.no_data_exist')));    
        }
        if($address->delete())
        {
            return Response::json(array('code'=>'1000','msg'=>Lang::get('msg.delete_success')));  
        }
        else
        {
            return Response::json(array('code'=>'1001','msg'=>Lang::get('msg.delete_failed')));  
        }
    }

    public function getAddressEdit($id='')
    {
        $data['left'] = $this->left();
        $data['allCity'] = City::all();
        if($id)
        {
            $address = Address::find($id);
            if(!$address || $address->user_id != Auth::user()->id)
            {
                return Response::view('common.404',array(),404);
            }
            $data['address'] = $address;
        }
        return View::make('home.user-address-edit', $data);
    }

    public function postAddressUpdate()
    {
        //csrf验证
        if (Session::token() != Input::get('_token'))
        {
            return Response::json(array('code'=>'1004','msg'=>Lang::get('msg.deny_request')));
        }
        $shipper = trim(Input::get('shipper'));
        $city_id = trim(Input::get('city_id'));
        $address = trim(Input::get('address'));
        $phone = trim(Input::get('phone'));
        $is_default = trim(Input::get('is_default'));
        $id = trim(Input::get('id'));
        if($id)
        {
            $_a = Address::find($id);
            if(!$_a || $_a->user_id != Auth::user()->id)
            {
                return Response::json(array('code'=>'1004','msg'=>Lang::get('msg.no_data_exist')));
            }
        }
        else
        {
            $_a = new Address();
            $_a->user_id = Auth::user()->id;
        }
        //需验证字段
        $inputs = array(
            'shipper' => $shipper,
            'cityid' => $city_id,
            'address' => $address,
            'phone' => $phone
        );
        //验证规则
        $rules = array(
            'shipper' => 'required|max:50',
            'cityid' => 'required',
            'address' => 'required|max:200',
            'phone' => 'required|max:20|mobile'
        );

        $validator = Validator::make($inputs, $rules);

        if ($validator->fails())
        {
            $error['shipper'] = str_replace('shipper', Lang::get('text.shipper'), $validator->messages()->get('shipper'));
            $error['city_id'] = str_replace('cityid', Lang::get('text.ship_city'), $validator->messages()->get('cityid'));
            $error['address'] = str_replace('address', Lang::get('text.address'), $validator->messages()->get('address'));
            $error['phone'] = str_replace('phone', Lang::get('text.mobile'), $validator->messages()->get('phone'));
            return Response::json(array('code' => '1010', 'msg'=>Lang::get('msg.submit_error'), 'error'=>$error));
        }
        $_a->shipper = $shipper;
        $_a->city_id = $city_id;
        $_a->address = $address;
        $_a->phone = $phone;
        $_a->is_default = $is_default ? $is_default : '0';
        $_a->create_time = local_to_gmt();
        if($_a->save())
        {
            if($id)
            {
                return Response::json(array('code'=>'1000','url'=>asset('user/address'),'msg'=>Lang::get('msg.update_success'))); 
            }
            else
            {
                return Response::json(array('code'=>'1000','url'=>asset('user/address'),'msg'=>Lang::get('msg.add_success')));
            }
        }
        else
        {
            if($id)
            {
                return Response::json(array('code'=>'1001','msg'=>Lang::get('msg.update_failed'))); 
            }
            else
            {
                return Response::json(array('code'=>'1001','msg'=>Lang::get('msg.add_failed')));
            }
        }
    }

    private function left()
    {
        return View::make('home.user-left')->render();
    }
}