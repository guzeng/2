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
}