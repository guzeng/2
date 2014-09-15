<?php

class Admin_NewsController extends BaseController {

	public function getList($cid)
	{
        if(!$cid)
        {
            return Response::view('common.500', array('msg'=>Lang::get('msg.param_incorrect')));
        }
        $data['cid'] = $cid;
		return View::make('admin.news.list', $data);
	}

    public function getDatalist($cid)
    {
        $iDisplayLength = intval(Input::get('iDisplayLength'));
        $iDisplayStart = intval(Input::get('iDisplayStart'));
        $orderby = intval(Input::get('iSortCol_0'));
        $order = trim(Input::get('sSortDir_0'));

        $sEcho = intval(Input::get('sEcho'));
        $sSearch = trim(Input::get('sSearch'));
        
        $records = array();
        $records["aaData"] = array(); 
        $records["sEcho"] = $sEcho;
        if(!$cid)
        {
            $records["iTotalRecords"] = 0;
            $records["iTotalDisplayRecords"] = 0;
            echo json_encode($records);
            exit;
        }

        $end = $iDisplayStart + $iDisplayLength;
        switch ($orderby) {
            case '0':
                $orderby = 'id';
                break;
            case '1':
                $orderby = 'title';
                break;
            case '2':
                $orderby = 'create_time';
                break;
            case '3':
                $orderby = 'status';
                break;
            default:
                $orderby = 'id';
                break;
        }
        $order = in_array($order, array('desc','asc')) ? $order : 'asc';
        $news = News::where('category_id',$cid);
        if($sSearch)
        {
            if(App::getLocale()=='zh')
            {
                $news->where("title", "like", "%".$sSearch."%");
            }
            else
            {
                $news->where("title_en", "like", "%".$sSearch."%");
            }
            
            $iTotalRecords = $news->count();
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $list = $news->take($iDisplayLength)->skip($iDisplayStart)->orderBy($orderby,$order)->get();
        }
        else
        {
            $iTotalRecords = $news->count();
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $list = $news->take($iDisplayLength)->skip($iDisplayStart)->orderBy($orderby,$order)->get();
        }
        if(!empty($list))
        {
            foreach ($list as $key => $item) 
            {
                $records["aaData"][] = array(
                    $item->id,
                    App::getLocale()=='zh' ? stripslashes($item->title) : stripslashes($item->title_en),
                    date('Y-m-d',gmt_to_local($item->create_time)),
                    $item->status,
                    ''
                );
            }
        }
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;
        echo json_encode($records);
        exit;
    }

	public function getDelete($id)
	{
		if(!$id)
		{
			return Response::json(array('code' => '1004', 'msg' => Lang::get('msg.param_incorrect')));
		}
		$news = News::find($id);
		if(!$news)
        {
        	return Response::json(array('code' => '1001', 'msg' => Lang::get('msg.no_data_exist')));
        }
		if(!$news->delete())
		{
            return Response::json(array('code' => '1001', 'msg' => Lang::get('msg.delete_failed')));
		}
        $log_param['object_id'] = $id;
        $log_param['object_name'] = $news->title;
        $log_param['object_type'] = 'news '.News::category($news->category_id);
        $log_param['type'] = 'delete';
        $log_param['message'] =Lang::get('text.delete').' '. $news->title;
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
        $news = News::find($id);
        if(!$news)
        {
            $data['code'] = '1001';
            $data['msg'] = Lang::get('msg.no_data_exist');
            return Response::json($data);
        }
        $news->status = $news->status=='1' ? '0' : '1';
        if($news->save())
        {
            $data['code'] = '1000';
            $data['status'] = $news->status;
            $data['id'] = $id;
        }
        else
        {
            $data['code'] = '1001';
            $data['msg'] = Lang::get('msg.failed');
        }
        $log_param['object_id'] = $id;
		$log_param['object_type'] = 'news '.News::category($news->category_id);
		$log_param['type'] = 'update';
		$log_param['object_name'] = $news->title;
		$log_param['message'] = $news->status == '1' ? (Lang::get('text.close').'=>'.Lang::get('text.open')) : (Lang::get('text.open').'=>'.Lang::get('text.close'));
		MyLog::create($log_param);
        return Response::json($data);
    }
    //-------------------------------------------------------------------------

    public function getAdd($cid)
    {
        if(!$cid)
        {
            return Response::view('common.500', array('msg'=>Lang::get('msg.param_incorrect')));
        }
        $data['cid'] = $cid;
        return View::make('admin.news.edit', $data);
    }

    public function getEdit($id)
    {
        $id = trim(intval($id));
        if($id)
        {
            $news = News::find($id);
            if(!$news)
            {
                return Response::view('common.404', array(), 404);
            }
        }
        else
        {
            return Response::view('common.500', array('msg'=>Lang::get('msg.param_incorrect')));
        }

        return View::make('admin.news.edit', array('item' => $news));
    }

    public function postUpdate()
    {
        $data = array('code' => '1000', 'msg' => '');
        $log_param = array();
        $log = array();
        $cid = Input::get('cid');
        if(!$cid)
        {
            return Response::json(array('code' => '1004', 'msg' => Lang::get('msg.param_incorrect')));
        }
        $id = Input::get('id');
        $title = Input::get('title');
        $title_en = Input::get('title_en');
        $content = Input::get('content');
        $content_en = Input::get('content_en');
        $status = Input::get('status', 0);

        if($id)
        {
            $news = News::find($id);
            if(!$news)
            {
                return Response::json(array('code' => '1005', 'msg' => Lang::get('msg.no_data_exist')));
            }
        }
        else
        {
            $news = new News();
        }

        $text_title = Lang::get('text.title');
        $validator = Validator::make(
            array(
                'jobtitle' => $title,
                'enjobtitle' => $title_en
            ),
            array(
                'jobtitle' => "required|max:100",
                'enjobtitle' => "required|max:200"
            )
        );

        if($validator->fails())
        {
            $data['code'] = '1010';
            $error['title'] = str_replace('jobtitle', Lang::get('text.title'), $validator->messages()->get('jobtitle'));
            $error['title_en'] = str_replace('enjobtitle', Lang::get('text.title'), $validator->messages()->get('enjobtitle'));
            $data['error'] = $error;
            $data['msg'] = Lang::get('msg.submit_error');
            return Response::json($data);
        }
        else
        {
            $news->title = addslashes($title);
            $news->title_en = addslashes($title_en);
            $news->content = $content;
            $news->content_en = $content_en;
            $news->status = $status;
            $news->create_by = Auth::user()->id;
            if($id)
            {
                if(!$news->save())
                {
                    $data['code'] = '1010';
                    $data['msg'] = Lang::get('msg.update_failed');
                    return Response::json($data);
                }
                $log_param['type'] = 'update';
            }
            else
            {
                $news->create_time = local_to_gmt();
                $news->category_id = $cid;
                if(!$news->save())
                {
                    $data['code'] = '1010';
                    $data['msg'] = Lang::get('msg.add_failed');
                    return Response::json($data);
                }
                $log_param['type'] = 'add';
                $log[] = Lang::get('text.news_create').Lang::get('text.colon').date('Y-m-d', $news->create_time);
            }
        }
        $log[] = Lang::get('text.title').Lang::get('text.colon').$news->title . (Lang::get('text.en').Lang::get('text.colon').$news->title_en);
        $log[] = Lang::get('text.content').Lang::get('text.colon').$news->content;
        $log[] = Lang::get('text.create_by').Lang::get('text.colon').$news->create_by;
        $log[] = Lang::get('text.status').Lang::get('text.colon').($status ? Lang::get('text.enable') : Lang::get('text.close'));
        $log_param['object_id'] = $news->id;
        $log_param['object_type'] = 'news '.News::category($cid);
        $log_param['object_name'] = $news->title;
        $log_param['message'] = implode(' ; ', $log);
        MyLog::create($log_param);
        $data['url'] = asset('admin/news/list/'.$cid);

        return Response::json($data);
    }

}