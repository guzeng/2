<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    public function __construct()
    {
        if(!Cache::has('website_name'))
        {
            Setting::cache();
        }
        App::setLocale($this->getLang());
    }

    public function getLang()
    {
        
        if(Session::has('_lang'))
        {
            return Session::get('_lang'); 
        }
        else
        {
            $_lang = '';
            if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
            {
                $brower_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4);
                if (preg_match("/en/i", $brower_lang))
                {
                    $_lang = "en"; 
                }
                else
                {
                    $_lang = 'zh';
                }
            }
            if($_lang != '')
            {
                Session::put('_lang', $_lang);
                return $_lang;
            }
        }
        return App::getLocale();
    }

    public function brower()
    {
        return View::make('common/brower');
    }
    /**
    * upload image in Editor
    */
    public function postUploadImg()
    {
        //文件保存目录路径
        $save_path = public_path() . '/uploads/';
        //文件保存目录URL
        $save_url = asset('uploads') . '/';
        //定义允许上传的文件扩展名
        $ext_arr = array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp')
        );
        //最大文件大小
        $max_size = 1000000;

        $save_path = realpath($save_path) . '/';

        //PHP上传失败
        if (!empty($_FILES['imgFile']['error'])) {
            $error = '';
            switch($_FILES['imgFile']['error']){
                case '1':
                    $error = Lang::get('msg.upload_file_exceeds_limit');
                    break;
                case '2':
                    $error = Lang::get('msg.upload_file_exceeds_form_limit');
                    break;
                case '3':
                    $error = Lang::get('msg.upload_file_partial');
                    break;
                case '4':
                    $error = Lang::get('msg.upload_no_file_selected');
                    break;
                case '6':
                    $error = Lang::get('msg.upload_no_temp_directory');
                    break;
                case '7':
                    $error = Lang::get('msg.upload_not_writable');
                    break;
                case '8':
                    $error = Lang::get('msg.upload_stopped_by_extension');
                    break;
                case '999':
                default:
                    $error = Lang::get('msg.upload_file_convert_fail');
            }
            echo json_encode(array('error' => 1, 'message' => $error));
            exit;
        }

        //有上传文件时
        if (empty($_FILES) === false) {
            //原文件名
            $file_name = $_FILES['imgFile']['name'];
            //服务器上临时文件名
            $tmp_name = $_FILES['imgFile']['tmp_name'];
            //文件大小
            $file_size = $_FILES['imgFile']['size'];
            //检查文件名
            if (!$file_name) {
                echo json_encode(array('error' => 1, 'message' => Lang::get('msg.upload_no_file_selected')));
                exit;
            }
            //检查目录
            if (@is_dir($save_path) === false) {
                echo json_encode(array('error' => 1, 'message' => Lang::get('msg.upload_no_filepath')));
                exit;
            }
            //检查目录写权限
            if (@is_writable($save_path) === false) {
                echo json_encode(array('error' => 1, 'message' => Lang::get('msg.upload_not_writable')));
                exit;
            }
            //检查是否已上传
            if (@is_uploaded_file($tmp_name) === false) {
                echo json_encode(array('error' => 1, 'message' => Lang::get('msg.upload_file_convert_fail')));
                exit;
            }
            //检查文件大小
            if ($file_size > $max_size) {
                echo json_encode(array('error' => 1, 'message' => Lang::get('msg.upload_invalid_filesize')));
                exit;
            }
            //检查目录名
            $dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
            if (empty($ext_arr[$dir_name])) {
                echo json_encode(array('error' => 1, 'message' => Lang::get('msg.upload_no_filepath')));
                exit;
            }
            //获得文件扩展名
            $temp_arr = explode(".", $file_name);
            $file_ext = array_pop($temp_arr);
            $file_ext = trim($file_ext);
            $file_ext = strtolower($file_ext);
            //检查扩展名
            if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
                echo json_encode(array('error' => 1, 'message' => Lang::get('msg.upload_invalid_filetype')));
                exit;
            }
            //创建文件夹
            if ($dir_name !== '') {
                $save_path .= $dir_name . "/";
                $save_url .= $dir_name . "/";
                if (!file_exists($save_path)) {
                    mkdir($save_path);
                }
            }
            $ymd = date("Ymd");
            $save_path .= $ymd . "/";
            $save_url .= $ymd . "/";
            if (!file_exists($save_path)) {
                mkdir($save_path);
            }
            //新文件名
            $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
            //移动文件
            $file_path = $save_path . $new_file_name;
            if (move_uploaded_file($tmp_name, $file_path) === false) {
                echo json_encode(array('error' => 1, 'message' => Lang::get('msg.upload_file_convert_fail')));
                exit;

            }
            @chmod($file_path, 0644);
            $file_url = $save_url . $new_file_name;
            header('Content-type: text/html; charset=UTF-8');
            echo json_encode(array('error' => 0, 'url' => $file_url));
            exit;
        }
    }

    public function postValidateKey()
    {
        $mobile = trim(Input::get('mobile'));
        $validator = Validator::make(
            array(
                'mobile' => $mobile
            ),
            array(
                'mobile' => 'required|mobile'
            )
        );
        if ($validator->fails())
        {
            $error['mobile'] = str_replace('mobile', Lang::get('text.mobile'), $validator->messages()->get('mobile'));
            return Response::json(array('code' => '1010', 'msg'=>$error));
        }
        $code = mt_rand(100000,999999);
        if(Sms::send($mobile,printf(Lang::get('text.verify_to_mobile'),$code)))
        {
            MobileCode::where('mobile',$mobile)->delete();
            $_m = new MobileCode();
            $_m->mobile = $mobile;
            $_m->code = $code;
            $_m->create_time = local_to_gmt();
            if($_m->save())
            {
                return Response::json(array('code' => '1000'));
            }
        }
        else
        {
            return Response::json(array('code' => '1002','msg'=>Lang::get('msg.send_failed')));
        }
        return Response::json(array('code' => '1010', 'msg'=>Lang::get('msg.error')));
    }

}