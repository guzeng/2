<?php

class PayController extends BaseController {

	public function postIndex()
	{    
        $orderId = trim(Input::get('orderid'));
        $pay_type = trim(Input::get('pay_type'));
        $payType = Order::payType();
        if(!$orderId || !array_key_exists($pay_type, $payType))
        {
            return Response::view('common.500',array('msg'=>Lang::get('msg.param_incorrect')));
        }
        $order = Order::find($orderId);
        if(!$order)
        {
            return Response::view('common.500',array('msg'=>Lang::get('msg.no_data_exist')));
        }
        if($order->user_id != Auth::user()->id)
        {
            return Response::view('common.404',array(),404); 
        }
        if($order->complete==1)
        {
            return Response::view('common.500',array('msg'=>Lang::get('msg.deny_request'))); 
        }
        switch ($pay_type) {
            case 3:
                if(Order::pay(array('pay_type'=>3,'complete'=>1,'id'=>$orderId)))
                {
                    return Redirect::to('pay/success');
                }
                break;
            
            default:
                # code...
                break;
        }

	}

    public function getSuccess()
    {
        return View::make('home.pay-success');
    }

}