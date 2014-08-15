<?php

class Admin_IndexController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Admin Index Controller
	|--------------------------------------------------------------------------
	|
	*/
	protected $layout = 'admin.layout';

	public function getIndex()
	{
		$data['user_count'] = User::count();
		$data['order_count'] = Order::count();
		$data['news_count'] = News::count();

		$today = strtotime(date('Y-m-d',local_to_gmt()));
		$firstDay = $today-30*24*3600;//30天前时间戳
		$allLogin = UserLogin::where('login_time','>',$firstDay)->get();
		$days = array();
        for($i=30;$i>=0;$i--)
        {
            $days[date('Y-m-d',$today-$i*86400)] = array('visitors'=>0,'avi_time'=>0,'join_course_num'=>0,'pass_course'=>0,'join_exam'=>0,'pass_exam'=>0,'user_num'=>0);
        }

		if(!empty($allLogin))
		{
			foreach ($allLogin as $key => $value) 
			{
				$d = date('Y-m-d',gmt_to_local($value->login_time));
				if(isset($days[$d]))
				{
					$days[$d]['visitors']++;
					if($value->out_time > 0)
					{
						if(date('Y-m-d',$value->login_time) == date('Y-m-d',$value->out_time))//同一天登录，同一天退出
						{
							$days[$d]['avi_time']+= round(($value->out_time-$value->login_time)/60,1);//该天登录时间相加
						}
						else
						{
					        $Date_end = strtotime(date("Y-m-d", $value->out_time));
					        $Date_start = strtotime(date("Y-m-d", $value->login_time));
					        $Days_diff = round(($Date_end-$Date_start)/86400);//相差的天数
					        for($i=1;$i<=$Days_diff;$i++)
					        {
					        	$next_day = $Date_start + $i*86400;
					        	$date = date('Y-m-d',$next_day);
					        	if($value->out_time - $next_day < 86400)
					        	{
					        		if(isset($days[$date]))
					        		{
					        			$days[$date]['avi_time'] = round(($value->out_time - $next_day)/60,1);
					        		}
					        	}
					        	else
					        	{
					        		$days[$date]['avi_time'] = 24*60;
					        	}
					        }
						}	
					}
					else
					{
						$days[$d]['avi_time'] += 15;
					}
					
				}
			}
		}
		$data['days'] = $days;

		return View::make('admin/index',$data);
	}

}