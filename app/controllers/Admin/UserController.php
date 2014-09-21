<?php

class Admin_UserController extends BaseController {

	public function getIndex()
	{
		return View::make('admin.user.list');
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
                $orderby = 'name';
                break;
            case '2':
                $orderby = 'username';
                break;
            case '3':
                $orderby = 'gender';
                break;
            case '5':
                $orderby = 'create_time';
                break;
            case '6':
                $orderby = 'active';
                break;
            default:
                $orderby = 'id';
                break;
        }
        $order = in_array($order, array('desc','asc')) ? $order : 'asc';
        if($sSearch)
        {
            $users = User::where("username", "like", "%".$sSearch."%")->orWhere('name', 'like', '%'.$sSearch.'%')->orWhere('gender', 'like', '%'.$sSearch.'%');
            $iTotalRecords = $users->count();
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $list = $users->take($iDisplayLength)->skip($iDisplayStart)->orderBy($orderby,$order)->get();
        }
        else
        {
            $iTotalRecords = User::count();
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $list = User::take($iDisplayLength)->skip($iDisplayStart)->orderBy($orderby,$order)->get();
        }
        if(!empty($list))
        {
            foreach ($list as $key => $item)
            {
                $records["aaData"][] = array(
                    $item->id,
                    $item->username,
                    $item->name,
                    $item->gender,
                    $item->create_time>0 ? date('Y-m-d H:i:s',gmt_to_local($item->create_time)) : '--',
                    $item->active
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
		$user = User::find($id);
		if(!$user)
        {
            $data['code'] = '1004';
            $data['msg'] = Lang::get('msg.no_data_exist');
            return Response::json($data);
        }
		return array('code' => '1000', 'data'=>View::make('admin.user.detail', array('item'=>$user))->render());
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
        $user = User::find($id);
        if(!$user)
        {
            $data['code'] = '1001';
            $data['msg'] = Lang::get('msg.no_data_exist');
            return Response::json($data);
        }
        $user->active = $user->active=='1' ? '0' : '1';
        if($user->save())
        {
            $data['code'] = '1000';
            $data['active'] = $user->active;
            $data['id'] = $id;
        }
        else
        {
            $data['code'] = '1001';
            $data['msg'] = Lang::get('msg.failed');
        }
        $log_param['object_id'] = $id;
		$log_param['object_type'] = 'user';
		$log_param['type'] = 'update';
		$log_param['object_name'] = $user->name;
		$log_param['message'] = $user->active == '1' ? (Lang::get('text.lock').'=>'.Lang::get('text.active')) : (Lang::get('text.active').'=>'.Lang::get('text.lock'));
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
        $number = Input::get('number');
        $location = Input::get('location');
        $department = Input::get('department');
        $date = Input::get('date');
        $description = Input::get('description');
        $requirement = Input::get('requirement');
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
                'jobnumber' => $number,
                'joblocation' => $location,
                'jobdepartment' => $department,
                'jobdate' => $date
            ),
            array(
                'jobtitle' => "required|max:50",
                'jobnumber' => "required|integer|digitsbetween:0,11",
                'joblocation' => "max:30",
                'jobdepartment' => "max:30",
                'jobdate' => "date"
            )
        );

        if($validator->fails())
        {
            $data['code'] = '1010';
            //print_r( $validator->messages()->get('job_title') );exit;
            $error['title'] = str_replace('jobtitle', Lang::get('text.position'), $validator->messages()->get('jobtitle'));
            $error['number'] = str_replace('jobnumber', Lang::get('text.require_number'), $validator->messages()->get('jobnumber'));
            $error['location'] = str_replace('joblocation', Lang::get('text.location'), $validator->messages()->get('joblocation'));
            $error['department'] = str_replace('jobdepartment', Lang::get('text.department'), $validator->messages()->get('jobdepartment'));
            $error['date'] = str_replace('jobdate', Lang::get('text.deadline'), $validator->messages()->get('jobdate'));
            $data['error'] = $error;
            $data['msg'] = Lang::get('msg.submit_error');
            return Response::json($data);
        }
        else
        {
            $job->title = addslashes($title);
            $job->number = $number;
            $job->location = $location;
            $job->department = $department;
            $job->date = strtotime($date);
            $job->description = $description;
            $job->requirement = $requirement;
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