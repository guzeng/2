<?php

class CommonController extends BaseController {

    /**
     * error
     * @param int n  (404 403 500 ...)
     * 显示错误页面
     */
    public function error($n)
    {
        switch ($n) {
            case '404':
                return Response::view('common.404',array(),403);
                break;
            case '403':
                return Response::view('common.403',array(),403);
                break;
            
            default:
                # code...
                break;
        }
    }

	public function validationCode()
	{
        Files::createValidationCode();
	}

    public function changeLang($lang='')
    {
       
        $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : action('/');

        if($lang && in_array($lang, array('zh','en')))
        {
            App::setLocale($lang);
            Session::put('_lang', $lang);
        }
        return Redirect::to($url);
    }

}