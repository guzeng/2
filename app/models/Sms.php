<?php

class Sms{

	static public function send($to,$msg)
	{
        if(!$to || !$msg)
        {
            return false;
        }
        $username = "bjt";
        $password = "G6EFWQ";
        $sendto = $to;
        $message =urlencode($msg);//内容解码

        $url="http://124.173.70.59:8081/SmsAndMms/mt";
        $curlPost = 'Sn='.$username.'&Pwd='.$password.'&mobile='.$sendto.'&content='.$message.'';

        $ch = curl_init();//初始化curl
        curl_setopt($ch,CURLOPT_URL,$url);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  //允许curl提交后,网页重定向  
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);

        if(intval($data) === 0 )
        {
            return true;
        }
	}

}