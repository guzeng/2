<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'account';
    public $timestamps =false;
    protected $guarded = array('id');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
    
	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->pwd;
	}
	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getUsername()
	{
		return $this->username;
	}

    /**
     *  encrypt
     *           
     * 密码加密
     * @param string
     * @param string
     * @return string               
     */
    public function sha1Encrypt($psw,$auth_code='')
    {
        return sha1(sha1(trim($psw)).strtolower(trim($auth_code)));
    }

    //---------------------------------------------------------------------

    static public function saveLogin()
    {
        $login_time = local_to_gmt();
        $update_row['login_num'] =  Auth::user()->login_num + 1;
        $update_row['last_login'] = $login_time;

        User::where('id',Auth::user()->id)->update($update_row);

        $brower = User::getBrowser();
        $login_row = array( 
            'user_id' => Auth::user()->id,
            'ip' => User::ip(),
            'brower' => $brower[0].$brower[1],
            'login_time' => $login_time
        );
        UserLogin::create($login_row);//记录 login time
    }
    //---------------------------------------------------------------------

    /**
     * getBrowser
     *
     * Fetches a language variable and optionally
     *
     * @access  public
     * @return  string
     */
    static public function getBrowser() {
        $sys = User::agent();
        if (stripos($sys, "NetCaptor") > 0) {
            $exp[0] = "NetCaptor";
            $exp[1] = "";
        } elseif (stripos($sys, "Firefox/") > 0) {
            preg_match("/Firefox\/([^;)]+)+/i", $sys, $b);
            $exp[0] = "Mozilla Firefox";
            $exp[1] = $b[1];
        } elseif (stripos($sys, "MAXTHON") > 0) {
            preg_match("/MAXTHON\s+([^;)]+)+/i", $sys, $b);
            preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
            // $exp = $b[0]." (IE".$ie[1].")";
            $exp[0] = $b[0] . " (IE" . $ie[1] . ")";
            $exp[1] = $ie[1];
        } elseif (stripos($sys, "MSIE") > 0) {
            preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
            //$exp = "Internet Explorer ".$ie[1];
            $exp[0] = "Internet Explorer";
            $exp[1] = $ie[1];
        } elseif(stripos($sys, "rv") > 0){
            preg_match("/rv.([0-9\.]+)+/i", $sys, $ie);
            $exp[0] = "Internet Explorer";
            $exp[1] = $ie[1];
        }elseif (stripos($sys, "Netscape") > 0) {
            $exp[0] = "Netscape";
            $exp[1] = "";
        } elseif (stripos($sys, "Opera") > 0) {
            $exp[0] = "Opera";
            $exp[1] = "";
        } elseif (stripos($sys, "Chrome") > 0) {
            $exp[0] = "Chrome";
            $exp[1] = "";
        } else {
            $exp[0] = "other";
            $exp[1] = "";
        }
        return $exp;
    }
    // --------------------------------------------------------------------

    /**
    * User Agent
    *
    * @access   public
    * @return   string
    */
    static public function agent()
    {
        return !isset($_SERVER['HTTP_USER_AGENT']) ? FALSE : $_SERVER['HTTP_USER_AGENT'];
    }
    // ------------------------------------------------------------------------

    /**
    * Fetch the IP Address
    *
    * @return   string
    */
    static public function ip()
    {
        $ip_address = $_SERVER['REMOTE_ADDR'];

        if ( !User::valid_ip($ip_address))
        {
            $ip_address = '0.0.0.0';
        }
        return $ip_address;
    }
    // --------------------------------------------------------------------

    /**
    * Validate IP Address
    *
    * @access   public
    * @param    string
    * @param    string  ipv4 or ipv6
    * @return   bool
    */
    static public function valid_ip($ip, $which = '')
    {
        $which = strtolower($which);
        // First check if filter_var is available
        if (is_callable('filter_var'))
        {
            switch ($which) {
                case 'ipv4':
                    $flag = FILTER_FLAG_IPV4;
                    break;
                case 'ipv6':
                    $flag = FILTER_FLAG_IPV6;
                    break;
                default:
                    $flag = '';
                    break;
            }

            return (bool) filter_var($ip, FILTER_VALIDATE_IP, $flag);
        }

        if ($which !== 'ipv6' && $which !== 'ipv4')
        {
            if (strpos($ip, ':') !== FALSE)
            {
                $which = 'ipv6';
            }
            elseif (strpos($ip, '.') !== FALSE)
            {
                $which = 'ipv4';
            }
            else
            {
                return FALSE;
            }
        }
        $func = '_valid_'.$which;
        return self::$func($ip);
    }
    // --------------------------------------------------------------------

    /**
    * Validate IPv4 Address
    *
    * Updated version suggested by Geert De Deckere
    *
    * @access   protected
    * @param    string
    * @return   bool
    */
    static protected function _valid_ipv4($ip)
    {
        $ip_segments = explode('.', $ip);
        // Always 4 segments needed
        if (count($ip_segments) !== 4)
        {
            return FALSE;
        }
        // IP can not start with 0
        if ($ip_segments[0][0] == '0')
        {
            return FALSE;
        }
        // Check each segment
        foreach ($ip_segments as $segment)
        {
            // IP segments must be digits and can not be
            // longer than 3 digits or greater then 255
            if ($segment == '' OR preg_match("/[^0-9]/", $segment) OR $segment > 255 OR strlen($segment) > 3)
            {
                return FALSE;
            }
        }

        return TRUE;
    }
    // --------------------------------------------------------------------

    /**
    * Validate IPv6 Address
    *
    * @access   protected
    * @param    string
    * @return   bool
    */
    static protected function _valid_ipv6($str)
    {
        // 8 groups, separated by :
        // 0-ffff per group
        // one set of consecutive 0 groups can be collapsed to ::
        $groups = 8;
        $collapsed = FALSE;
        $chunks = array_filter(
            preg_split('/(:{1,2})/', $str, NULL, PREG_SPLIT_DELIM_CAPTURE)
        );
        // Rule out easy nonsense
        if (current($chunks) == ':' OR end($chunks) == ':')
        {
            return FALSE;
        }
        // PHP supports IPv4-mapped IPv6 addresses, so we'll expect those as well
        if (strpos(end($chunks), '.') !== FALSE)
        {
            $ipv4 = array_pop($chunks);

            if ( ! $this->_valid_ipv4($ipv4))
            {
                return FALSE;
            }

            $groups--;
        }
        while ($seg = array_pop($chunks))
        {
            if ($seg[0] == ':')
            {
                if (--$groups == 0)
                {
                    return FALSE;   // too many groups
                }
                if (strlen($seg) > 2)
                {
                    return FALSE;   // long separator
                }
                if ($seg == '::')
                {
                    if ($collapsed)
                    {
                        return FALSE;   // multiple collapsed
                    }

                    $collapsed = TRUE;
                }
            }
            elseif (preg_match("/[^0-9a-f]/i", $seg) OR strlen($seg) > 4)
            {
                return FALSE; // invalid segment
            }
        }
        return $collapsed OR $groups == 1;
    }
    // --------------------------------------------------------------------
    
    /**
     * user's avatar
     *
     * @author varson
     * @2013/4/15
     */
    static public function avatar($user_id='', $type='big')
    {
        $default = asset('assets/img/avatar_'.$type.'.jpg');
        if($user_id)
        {
            $filePath = '';
            $dir = Files::uploadFolderMin($user_id);
            $file_name = Files::UploadMinName($user_id);
            $_user_folder = Files::uploadDir('user');

            switch ($type) {
                case 'big':
                    $filePath = $_user_folder.'/'.$dir.'/'.$file_name.'.png';
                    break;
                case 'thumb':
                case 'small':
                    $filePath = $_user_folder.'/'.$dir.'/'.$file_name.'_thumb.png';
                    $create_new = false;
                    if(file_exists($filePath))
                    {
                        list($img_width, $img_height) = @getimagesize($filePath);
                        if($img_width<36 || $img_height<36)//缩略图太小，重新生成
                        {
                            $create_new = true;
                        }
                    }
                    else
                    {
                        $create_new = true;
                    }
                    if($create_new)
                    {
                        $bigPicPath = $_user_folder.'/'.$dir.'/'.$file_name.'.png';
                        Files::createThumb($bigPicPath, $filePath, 36, 36);
                    }
                    break;
            }
            if(file_exists($filePath))
            {
                return asset($filePath);
            }
        }
        return $default;
    }
    //---------------------------------------------------------------------

    /**
     * user picture
     *
     * @author varson
     * @2013/4/15
     */
    public static function pic($user_id='', $type='big')
    {
        return self::avatar($user_id, $type);
    }
    //---------------------------------------------------------------------
}