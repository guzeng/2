<?php

class PayController extends BaseController {

        //支付类型
    private $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
    private $notify_url = '';//"http://www.yuexingtrip.com/";
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
    private $return_url = '';//asset('pay/alipay-return');//"http://www.yuexingtrip.com/pay/alipay-return";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

        //卖家支付宝帐户
    private $seller_email = '2904015624@qq.com';
        //必填
    function __construct()
    {
        $this->notify_url = asset('pay/alipaynotify');
        $this->return_url = asset('pay/alipay-return');
    }

	public function postIndex()
	{    
        if (Auth::guest()) return Redirect::guest('login');

        $orderId = trim(Input::get('orderid'));
        $pay_type = trim(Input::get('pay_type'));
        $bank_name = trim(Input::get('bank_name'));
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
            case 1:
                $this->alipay($order);
                break;
            case 2:
                $this->bank($order,$bank_name);
                break;
            default:
                # code...
                break;
        }

	}

    public function getSuccess()
    {
        if (Auth::guest()) return Redirect::guest('login');
        return View::make('home.pay-success');
    }

    private function alipay($order)
    {
        $alipayPath = app_path().'/lib/alipay/';
        require_once($alipayPath."alipay.config.php");
        require_once($alipayPath."lib/alipay_submit.class.php");

        /**************************请求参数**************************/

        //商户订单号
        $out_trade_no = $order->code;
        //商户网站订单系统中唯一订单号，必填

        //订单名称
        $subject = Order::getType($order->type).', '.Lang::get('text.order_code').':'.$order->code;
        //必填

        //付款金额
        $total_fee = round($order->money,2);
        //必填

        //订单描述

        $body = $order->info;
        //商品展示地址
        $show_url = '';//$_POST['WIDshow_url'];
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html

        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数

        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1


        /************************************************************/

        //构造要请求的参数数组，无需改动
        $parameter = array(
                "service" => "create_direct_pay_by_user",
                "partner" => trim($alipay_config['partner']),
                "payment_type"  => $this->payment_type,
                "notify_url"    => $this->notify_url,
                "return_url"    => $this->return_url,
                "seller_email"  => $this->seller_email,
                "out_trade_no"  => $out_trade_no,
                "subject"   => $subject,
                "total_fee" => $total_fee,
                "body"  => $body,
                "show_url"  => $show_url,
                "anti_phishing_key" => $anti_phishing_key,
                "exter_invoke_ip"   => $exter_invoke_ip,
                "_input_charset"    => trim(strtolower($alipay_config['input_charset']))
        );

        Log::useFiles(storage_path().'/logs/pay.log');
        Log::debug('付款请求所有数据-- '.implode('--', $parameter));
        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        echo $html_text;

    }
    // 网银支付
    private function bank($order,$bank_name)
    {
        $alipayPath = app_path().'/lib/alipay/';
        require_once($alipayPath."alipay.config.php");
        require_once($alipayPath."lib/alipay_submit.class.php");

        /**************************请求参数**************************/

        //商户订单号
        $out_trade_no = $order->code;
        //商户网站订单系统中唯一订单号，必填

        //订单名称
        $subject = Order::getType($order->type).', '.Lang::get('text.order_code').':'.$order->code;
        //必填

        //付款金额
        $total_fee = round($order->money,2);
        //必填

        //订单描述

        $body = $order->info;
        //默认支付方式
        $paymethod = "bankPay";
        //必填
        //默认网银
        $defaultbank = $bank_name ? $bank_name : 'ICBCB2C';
        //必填，银行简码请参考接口技术文档

        //商品展示地址
        $show_url = '';
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html

        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数

        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1


        /************************************************************/

        //构造要请求的参数数组，无需改动
        $parameter = array(
                "service" => "create_direct_pay_by_user",
                "partner" => trim($alipay_config['partner']),
                "payment_type"  => $this->payment_type,
                "notify_url"    => $this->notify_url,
                "return_url"    => $this->return_url,
                "seller_email"  => $this->seller_email,
                "out_trade_no"  => $out_trade_no,
                "subject"   => $subject,
                "total_fee" => $total_fee,
                "body"  => $body,
                "paymethod" => $paymethod,
                "defaultbank"   => $defaultbank,
                "show_url"  => $show_url,
                "anti_phishing_key" => $anti_phishing_key,
                "exter_invoke_ip"   => $exter_invoke_ip,
                "_input_charset"    => trim(strtolower($alipay_config['input_charset']))
        );

        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        echo $html_text;
    }

    public function postAlipaynotify()
    {
        Log::useFiles(storage_path().'/logs/pay.log');
        Log::debug('接收notify付款返回数据');
        $alipayPath = app_path().'/lib/alipay/';
        require_once($alipayPath."alipay.config.php");
        //require_once($alipayPath."lib/alipay_submit.class.php");
        require_once($alipayPath."lib/alipay_notify.class.php");

        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代

        Log::debug('付款返回数据-- 验证成功');
            
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            
            //商户订单号

            $out_trade_no = $_POST['out_trade_no'];

            //支付宝交易号

            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];

        Log::debug('付款返回所有数据-- '.implode('--', $_POST));

            if($trade_status == 'TRADE_FINISHED') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
                        
                //注意：
                //该种交易状态只在两种情况下出现
                //1、开通了普通即时到账，买家付款成功后。
                //2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。

                //调试用，写文本函数记录程序运行情况是否正常
        Log::debug('付款失败');
                logResult("订单".$out_trade_no."付款失败");
            }
            else if ($trade_status == 'TRADE_SUCCESS') {
        Log::debug('付款成功');
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
                        
                //注意：
                //该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。

                //调试用，写文本函数记录程序运行情况是否正常
                $order = Order::where('code',$out_trade_no)->first();
                if($order)
                {
                    if(Order::pay(array('pay_type'=>1,'pay'=>1,'pay_time'=>local_to_gmt(),'pay_code'=>$trade_no,'complete'=>1,'id'=>$order->id)))
                    {
                        //log
                        logResult("订单".$out_trade_no."付款成功");
                        return Redirect::to('pay/success');
                    }                    
                }

            }

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
                
            echo "success";     //请不要修改或删除
        Log::debug('success');
            
        }
        else {
            //验证失败
            echo "fail";

        Log::debug('fail');
            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }

    public function getAlipayReturn()
    {
        Log::useFiles(storage_path().'/logs/pay.log');
        Log::debug('接收return付款返回数据');
        $alipayPath = app_path().'/lib/alipay/';
        require_once($alipayPath."alipay.config.php");
        //require_once($alipayPath."lib/alipay_submit.class.php");
        require_once($alipayPath."lib/alipay_notify.class.php");

        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码
            
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号

            $out_trade_no = $_GET['out_trade_no'];

            //支付宝交易号

            $trade_no = $_GET['trade_no'];

            //交易状态
            $trade_status = $_GET['trade_status'];


            if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
                echo '成功返回';
            }
            else {
              echo "trade_status=".$_GET['trade_status'];
            }
                
            echo "验证成功<br />";

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "验证失败";
        }
    }
}