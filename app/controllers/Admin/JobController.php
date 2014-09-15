<?php

class Admin_JobController extends BaseController {

	public function getIndex()
	{
		return View::make('admin.job.list');
	}

    public function getDatalist()
    {

        $iDisplayLength = intval(Input::get('iDisplayLength'));
        $iDisplayStart = intval(Input::get('iDisplayStart'));
        $orderby = intval(Input::get('iSortCol_0'));
        $order = trim(Input::get('sSortDir_0'));

        $sEcho = intval(Input::get('sEcho'));
        $sSearch = trim(Input::get('sSearch'));

        $records = array();
        $records["aaData"] = array(); 

        $end = $iDisplayStart + $iDisplayLength;
        switch ($orderby) {
            case '0':
                $orderby = 'id';
                break;
            case '1':
                $orderby = 'title';
                break;
            case '2':
                $orderby = 'number';
                break;
            case '3':
                $orderby = 'location';
                break;
            case '5':
                $orderby = 'date';
                break;
            case '6':
                $orderby = 'status';
                break;
            default:
                $orderby = 'id';
                break;
        }
        $order = in_array($order, array('desc','asc')) ? $order : 'asc';
        if($sSearch)
        {
            if(App::getLocale()=='zh')
            {
                $jobs = Job::where("title", "like", "%".$sSearch."%")->orWhere('number', 'like', '%'.$sSearch.'%')->orWhere('location', 'like', '%'.$sSearch.'%')
                            ->orWhere('department', 'like', '%'.$sSearch.'%');
            }
            else
            {
                $jobs = Job::where("title_en", "like", "%".$sSearch."%")->orWhere('number', 'like', '%'.$sSearch.'%')->orWhere('location_en', 'like', '%'.$sSearch.'%')
                            ->orWhere('department_en', 'like', '%'.$sSearch.'%');
            }
            
            $iTotalRecords = $jobs->count();
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $list = $jobs->take($iDisplayLength)->skip($iDisplayStart)->orderBy($orderby,$order)->get();
        }
        else
        {
            $iTotalRecords = Job::count();
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $list = Job::take($iDisplayLength)->skip($iDisplayStart)->orderBy($orderby,$order)->get();
        }
        if(!empty($list))
        {
            foreach ($list as $key => $item) 
            {
                $records["aaData"][] = array(
                    $item->id,
                    App::getLocale()=='zh' ? stripslashes($item->title) : stripslashes($item->title_en),
                    $item->number,
                    App::getLocale()=='zh' ? $item->location : $item->location_en,
                    App::getLocale()=='zh' ? $item->department : $item->department_en,
                    date('Y-m-d',gmt_to_local($item->date)),
                    $item->status,
                    ''
                );
            }
        }
        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;
        echo json_encode($records);
        exit;
    }

	public function getDetail($id = '')
	{
		$id = trim(intval($id));
		if(!$id)
		{
            $data['code'] = '1004';
            $data['msg'] = Lang::get('msg.param_incorrect');
            return Response::json($data);
        }
		$job = Job::find($id);
		if(!$job)
        {
            $data['code'] = '1004';
            $data['msg'] = Lang::get('msg.no_data_exist');
            return Response::json($data);
        }
		return array('code' => '1000', 'data'=>View::make('admin.job.detail', array('item'=>$job))->render());
	}

	public function getDelete($id)
	{
		if(!$id)
		{
			return Response::json(array('code' => '1004', 'msg' => Lang::get('msg.param_incorrect')));
		}
		$job = Job::find($id);
		if(!$job)
        {
        	return Response::json(array('code' => '1001', 'msg' => Lang::get('msg.no_data_exist')));
        }
		if(!$job->delete())
		{
            return Response::json(array('code' => '1001', 'msg' => Lang::get('msg.delete_failed')));
		}
        $log_param['object_id'] = $id;
        $log_param['object_name'] = $job->title;
        $log_param['object_type'] = 'join us';
        $log_param['type'] = 'delete';
        $log_param['message'] =Lang::get('text.delete').' '. $job->title;
        MyLog::create($log_param);
        return Response::json(array('code'=>'1000', 'msg'=>Lang::get('msg.delete_success'), 'data' => array('id' => $id)));
	}

	public function getChangeStatus($id)
    {
        $data = array('code' => '1000', 'msg' => '');
        $id = trim(intval($id));
        if(!$id)
        {
            $data['code'] = '1004';
            $data['msg'] = Lang::get('msg.param_incorrect');
            return Response::json($data);
        }
        $job = Job::find($id);
        if(!$job)
        {
            $data['code'] = '1001';
            $data['msg'] = Lang::get('msg.no_data_exist');
            return Response::json($data);
        }
        $job->status = $job->status=='1' ? '0' : '1';
        if($job->save())
        {
            $data['code'] = '1000';
            $data['status'] = $job->status;
            $data['id'] = $id;
        }
        else
        {
            $data['code'] = '1001';
            $data['msg'] = Lang::get('msg.failed');
        }
        $log_param['object_id'] = $id;
		$log_param['object_type'] = 'join us';
		$log_param['type'] = 'update';
		$log_param['object_name'] = $job->title;
		$log_param['message'] = $job->status == '1' ? (Lang::get('text.close').'=>'.Lang::get('text.open')) : (Lang::get('text.open').'=>'.Lang::get('text.close'));
		MyLog::create($log_param);
        return Response::json($data);
    }
    //-------------------------------------------------------------------------

    public function getEdit($id = '')
    {
        $id = trim(intval($id));
        if($id)
        {
            $job = Job::find($id);
            if(!$job)
            {
                return Response::view('common.404', array(), 404);
            }
        }
        else
        {
            return View::make('admin.job.edit');
        }

        return View::make('admin.job.edit', array('item' => $job));
    }

    public function postUpdate()
    {
        $data = array('code' => '1000', 'msg' => '');
        $log_param = array();
        $log = array();
        $id = Input::get('id');
        $title = Input::get('title');
        $title_en = Input::get('title_en');
        $number = Input::get('number');
        $location = Input::get('location');
        $location_en = Input::get('location_en');
        $department = Input::get('department');
        $department_en = Input::get('department_en');
        $date = Input::get('date');
        $description = Input::get('description');
        $description_en = Input::get('description_en');
        $requirement = Input::get('requirement');
        $requirement_en = Input::get('requirement_en');
        $status = Input::get('status', 0);

        if($id)
        {
            $job = Job::find($id);
            if(!$job)
            {
                return Response::json(array('code' => '1005', 'msg' => Lang::get('msg.no_data_exist')));
            }
        }
        else
        {
            $job = new Job();
        }

        $text_title = Lang::get('text.title');
        $validator = Validator::make(
            array(
                'jobtitle' => $title,
                'enjobtitle' => $title_en,
                'jobnumber' => $number,
                'joblocation' => $location,
                'enjoblocation' => $location_en,
                'jobdepartment' => $department,
                'enjobdepartment' => $department_en,
                'jobdate' => $date
            ),
            array(
                'jobtitle' => "required|max:50",
                'enjobtitle' => "required|max:100",
                'jobnumber' => "required|integer|digitsbetween:0,11",
                'joblocation' => "max:30",
                'enjoblocation' => "max:100",
                'jobdepartment' => "max:30",
                'enjobdepartment' => "max:100",
                'jobdate' => "date"
            )
        );

        if($validator->fails())
        {
            $data['code'] = '1010';
            $m = $validator->messages();
            $error['title'] = str_replace('jobtitle', Lang::get('text.position'), $m->get('jobtitle'));
            $error['title_en'] = str_replace('enjobtitle', Lang::get('text.position'), $m->get('enjobtitle'));
            $error['number'] = str_replace('jobnumber', Lang::get('text.require_number'), $m->get('jobnumber'));
            $error['location'] = str_replace('joblocation', Lang::get('text.location'), $m->get('joblocation'));
            $error['location_en'] = str_replace('enjoblocation', Lang::get('text.location'), $m->get('enjoblocation'));
            $error['department'] = str_replace('jobdepartment', Lang::get('text.department'), $m->get('jobdepartment'));
            $error['department_en'] = str_replace('enjobdepartment', Lang::get('text.department'), $m->get('enjobdepartment'));
            $error['date'] = str_replace('jobdate', Lang::get('text.deadline'), $m->get('jobdate'));
            $data['error'] = $error;
            $data['msg'] = Lang::get('msg.submit_error');
            return Response::json($data);
        }
        else
        {
            $job->title = addslashes($title);
            $job->title_en = addslashes($title_en);
            $job->number = $number;
            $job->location = $location;
            $job->location_en = $location_en;
            $job->department = $department;
            $job->department_en = $department_en;
            $job->date = strtotime($date);
            $job->description = $description;
            $job->description_en = $description_en;
            $job->requirement = $requirement;
            $job->requirement_en = $requirement_en;
            $job->status = $status;
            if($id)
            {
                if(!$job->save())
                {
                    $data['code'] = '1010';
                    $data['msg'] = Lang::get('msg.update_failed');
                    return Response::json($data);
                }
                $log_param['type'] = 'update';
            }
            else
            {
                $job->user_id = Auth::user()->id;
                $job->create_time = local_to_gmt();
                if(!$job->save())
                {
                    $data['code'] = '1010';
                    $data['msg'] = Lang::get('msg.add_failed');
                    return Response::json($data);
                }
                $log_param['type'] = 'add';
                $log[] = Lang::get('text.position').Lang::get('text.colon').date('Y-m-d', $job->create_time);
            }
        }
        $log[] = Lang::get('text.position').Lang::get('text.colon').$job->title;
        $log[] = Lang::get('text.require_number').Lang::get('text.colon').$job->number;
        $log[] = Lang::get('text.location').Lang::get('text.colon').$job->location;
        $log[] = Lang::get('text.department').Lang::get('text.colon').$job->department;
        $log[] = Lang::get('text.deadline').Lang::get('text.colon').$date;
        $log[] = Lang::get('text.job_desc').Lang::get('text.colon').$job->description;
        $log[] = Lang::get('text.job_require').Lang::get('text.colon').$job->requirement;
        $log[] = Lang::get('text.status').Lang::get('text.colon').($status ? Lang::get('text.enable') : Lang::get('text.close'));
        $log_param['object_id'] = $job->id;
        $log_param['object_type'] = 'join us';
        $log_param['object_name'] = $job->title;
        $log_param['message'] = implode(' ; ', $log);
        MyLog::create($log_param);
        $data['url'] = asset('admin/job');

        return Response::json($data);
    }

}