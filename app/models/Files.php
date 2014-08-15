<?php

class Files {

	/***********************
	 * File Class.
	 *
	 * @author Varson
	 * @2014/03/05
	 **********************/

	/**
	 * create validation code
	 */
	static public function createValidationCode()
	{
	    Header("Content-type: image/gif");
	    /*
	    * 初始化
	    */
	    $border = 0; 	//是否要边框 1要:0不要
	    $how = 4; 		//验证码位数
	    $w = $how*15; 	//图片宽度
	    $h = 20; 		//图片高度
	    $fontsize = 16; //字体大小
	    $alpha = "abcdefghijkmnpqrstuvwxyzABCDEFGHIGKLMNPQRSTUVWXYZ"; 	//验证码内容1:字母
	    $number = "23456789"; 											//验证码内容2:数字
	    $randcode = ""; 												//验证码字符串初始化
	    srand((double)microtime()*1000000); 							//初始化随机数种子
	    $im = ImageCreate($w, $h); 										//创建验证图片
	    /*
	    * 绘制基本框架
	    */
	    $bgcolor = ImageColorAllocate($im, 255, 255, 255); 				//设置背景颜色
	    ImageFill($im, 0, 0, $bgcolor); 								//填充背景色
	    if($border)
	    {
	        $black = ImageColorAllocate($im, 0, 0, 0); 					//设置边框颜色
	        ImageRectangle($im, 0, 0, $w-1, $h-1, $black);				//绘制边框
	    }
	    /*
	    * 逐位产生随机字符
	    */
	    for($i=0; $i<$how; $i++)
	    {   
	        $alpha_or_number = mt_rand(0, 1); 							//字母还是数字
	        $str = $alpha_or_number ? $alpha : $number;
	        $which = mt_rand(0, strlen($str)-1); 						//取哪个字符
	        $code = substr($str, $which, 1); 							//取字符
	        $j = !$i ? 4 : $j+15; 										//绘字符位置
	        $color3 = ImageColorAllocate($im, mt_rand(0,100), mt_rand(0,100), mt_rand(0,100)); 		//字符随即颜色
	        ImageChar($im, $fontsize, $j, 3, $code, $color3); 										//绘字符
	        $randcode .= $code; 																	//逐位加入验证码字符串
	    }
	    /*
	    * 添加干扰
	    */
	    for($i=0; $i<2; $i++)																					//绘背景干扰线
	    {   
	        $color1 = ImageColorAllocate($im, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255)); 					//干扰线颜色
	        ImageArc($im, mt_rand(-5,$w), mt_rand(-5,$h), mt_rand(20,300), mt_rand(20,200), 55, 44, $color1); 	//干扰线
	    }   
	    for($i=0; $i<$how*7; $i++)																				//绘背景干扰点
	    {   
	        $color2 = ImageColorAllocate($im, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255)); 					//干扰点颜色 
	        ImageSetPixel($im, mt_rand(0,$w), mt_rand(0,$h), $color2); 											//干扰点
	    }
	    //$_SESSION['login_check_number'] = strtoupper($randcode);												//把验证码字符串写入session
	    Session::put('validationCode', strtoupper($randcode));
	    /*绘图结束*/
	    Imagegif($im);
	    ImageDestroy($im);
	    /*绘图结束*/
	}

	/**
	 * unzip
	 * 
	 * 解压zip压缩包
	 * @param string zip file path
	 * @param string dest path
	 * @param string zip method
	 * 2013/3/27 11:18:07   
	 *  
	 */

	static public function unzip($zip_file_path, $dest_path) 
	{
	    require_once app_path().DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'PclZip.php';
		$dest_path = str_replace ( "\\", '/', $dest_path );
	    if (! is_dir ( $dest_path )) Files::createFolder($dest_path);
		if (file_exists ( $zip_file_path ) && is_dir ( $dest_path )) {
			$ext_match = preg_match ( "/.zip$/", strtolower ( $zip_file_path ) );
			if ($ext_match) {
				set_time_limit ( 0 );
				
				$zipFile = new pclZip ( $zip_file_path );

				$unzippingState = $zipFile->extract(PCLZIP_OPT_PATH, $dest_path);

				if (! $unzippingState) {
					return false;
				}
	            return Folder::useage($dest_path);
			} else {
				//$zipContentArray = array ();
			}
		}
		return false;
	}
	//------------------------------------------------------------------------

	/**
	 * copy2dest
	 * 
	 * 拷贝pdf和swf文件至目标文件
	 * @param string file path
	 * @param string dest path
	 * @param string file type
	 * 2013/3/27 11:18:07   
	 *  
	 */

	static public function copy2dest($file_path, $dest_path, $file_name, $file_type)
	{
		$dest_path = str_replace ( "\\", '/', $dest_path );
		$dest_prefix_name = Files::getFilePrefix($file_name);

	    if (! is_dir ( $dest_path )) Files::createFolder($dest_path);		//创建目录

		if (file_exists ( $file_path ) && is_dir ( $dest_path )) {
			set_time_limit(0);
			if(copy($file_path,$dest_path.'/'.$dest_prefix_name.$file_type))
			{
				return filesize($dest_path.'/'.$dest_prefix_name.$file_type);
			}
			else
			{
				return false;
			}	
				
		}
		return false;
	}
	//------------------------------------------------------------------------

	/**
	 * get_file_sufix
	 * 
	 * 获取文件后缀名
	 * @param string file name
	 * 2013/11/12 11:18:07   
	 *  
	 */

	static public function getFileSufix($file_name) {
		return strtolower(strrchr($file_name,'.'));
	}
	//------------------------------------------------------------------------

	/**
	 * get_file_prefix
	 * 
	 * 获取文件后缀名前部分
	 * @param string file name
	 * 2013/11/12 11:18:07   
	 *  
	 */

	static public function getFilePrefix($file_name) 
	{
		$index = strripos($file_name,strrchr($file_name,'.'));
		return substr($file_name,0,$index);
	}
	//------------------------------------------------------------------------

	static public function download($file, $file_name)
	{
	    header("Content-type:text/html;charset=utf-8");
	    //首先要判断给定的文件存在与否 
	    if(!file_exists($file)){ 
	        return Response::view('common.404',array(),404);
	        exit; 
	    } 
	    $fp=fopen($file,"r"); 
	    $file_size=filesize($file); 
	    //下载文件需要用到的头 
	    Header("Content-type: application/octet-stream"); 
	    Header("Accept-Ranges: bytes"); 
	    Header("Accept-Length:".$file_size); 
	    Header("Content-Disposition: attachment; filename=".$file_name); 
	    $buffer=1024; 
	    $file_count=0; 
	    //向浏览器返回数据 
	    while(!feof($fp) && $file_count<$file_size){ 
	        $file_con=fread($fp,$buffer); 
	        $file_count+=$buffer; 
	        echo $file_con; 
	    }
	    fclose($fp); 
	}  

    /**
    * get cover
    * @param int
    * @param varchar
    * @return picture url
    *
    * @author varson
    * @2013/11/11
    */
    static public function cover($type, $id, $model='default')
    {
        $default = asset('assets/img/cover_'.$model.'.jpg');
        if($id)
        {
            $dir = Files::fileSaveDir($id);
            $filePath = '';
            if($model=='default')
            {
                $filePath = Files::uploadDir($type).'/'.$dir.'/cover.png';
            }
            else if($model=='thumb')
            {
                $filePath = Files::uploadDir($type).'/'.$dir.'/cover_thumb.png';
            }
            if(file_exists($filePath))
            {
                return asset($filePath.'?'.rand());
            }
        }
        return $default;
    }

	/**
	 * savePlace
	 * 
	 * 目录层级结构
	 * author varson
	 * 2013/3/27 14:55:24
	 */
	static public function uploadFolder($id)
	{
	    $str = str_pad($id,11,"0",STR_PAD_LEFT);
	    $str1 = substr($str,0,2).'/'.substr($str,2,3).'/'.substr($str,5,3).'/'.substr($str,-3);
	    return $str1;
	}
	//----------------------------------------------------------------------------

	/**
	 * avatarSaveDir
	 * 
	 * 头像上传文件保存的文件夹
	 * author varson
	 * 2013/4/15 14:55:24
	 */
	static public function uploadFolderMin($id)
	{
	    $str = str_pad($id,11,"0",STR_PAD_LEFT);
	    $str1 = substr($str,0,2).'/'.substr($str,2,3).'/'.substr($str,5,3);
	    return $str1;
	}
	//----------------------------------------------------------------------------
	static public function uploadMinName($id)
	{
	    $str = str_pad($id,11,"0",STR_PAD_LEFT);
	    $str1 = substr($str,-3);
	    return $str1;
	}
	//----------------------------------------------------------------------------

	/**
	 * upload dir
	 * @param varchar
	 * @2013/11/22
	 * @varson
	 */
	static public function uploadDir($type)
	{
		$folder = Config::get('app.upload.'.$type);
		if($folder)
		{
			Folder::create($folder);
			return $folder;
		}
		return 'upload folder '.$type.' not exists, maybe not config, please check app.php';
	}
	//---------------------------------------------------------------------------

	/**
	 * file_save_dir
	 * 
	 * 课件所在文件夹
	 * author varson
	 * 2013/3/27 14:55:24
	 */
	static function fileSaveDir($id)
	{
	    $str = str_pad($id,11,"0",STR_PAD_LEFT);
	    $str1 = substr($str,0,2).'/'.substr($str,2,3).'/'.substr($str,5,3).'/'.substr($str,-3);
	    return $str1;
	}
	//----------------------------------------------------------------------------
	/**
	 * 
	 * 删除目录
	 * 
	 * @param string directory 
	 * @author
	 * 2013/3/27 16:11:00
	 */
	static function deleteDir($path)
	{
	    if(is_dir($path))
	    {
	        $file_list= scandir($path);
	        foreach ($file_list as $file)
	        {
	            if( $file!='.' && $file!='..')
	            {
	                Files::deleteDir($path.'/'.$file);
	            }
	        }
	        @rmdir($path);  
	    }
	    else if(is_file($path))
	    {
	        @unlink($path); 
	    }
	}
	//---------------------------------------------------------------------------

	/**
	 * create floder
	 * 
	 * author varson
	 * 2013/3/27 14:28:17
	 */
	static public function createFolder($path)
	{
	    if (!is_dir($path))
	    {
	      Files::createFolder(dirname($path));
	      mkdir($path, 0777);
	      chmod($path, 0777);
	      $filename = rtrim($path,'/').'/index.html';
	      $content = "<html>
	                  <head>
	                  	<title>403 Forbidden</title>
	                  </head>
	                  <body>
	                  
	                  <p>Directory access is forbidden.</p>
	                  
	                  </body>
	                  </html>";
	      $handle =fopen($filename,"w");
	      fwrite($handle,$content);
	      fclose($handle);
	    }
	}
	//----------------------------------------------------------------------------

	/**
	 * urlExist
	 * check url whether or not exists
	 * author varson
	 * 2014/3/27
	 */
	static public function urlExist($url)
	{
	    try{
	        $headeraar = get_headers($url);
	        if(strpos($headeraar[0],'HTTP/1.0 1')===false 
	                && strpos($headeraar[0],'HTTP/1.0 2')===false 
	                && strpos($headeraar[0],'HTTP/1.0 3')===false 
	                && strpos($headeraar[0],'HTTP/1.1 1')===false 
	                && strpos($headeraar[0],'HTTP/1.1 2')===false 
	                && strpos($headeraar[0],'HTTP/1.1 3')===false)
	        {
	            return false;
	        }
	    }catch(Exception $e){
	        //执行错误处理
	        return false;
	    }
	    return true;
	}
	//----------------------------------------------------------------------------

	/**
	 * allow
	 * whether the file's mime allowed
	 */
	static public function allow($types,$mime)
	{
		if(!$types || !$mime)
		{
			return false;
		}
		$t = explode('|', $types);
		$all_mime = Config::get('mimes');
		foreach ($t as $key => $value) 
		{
			if(is_array($all_mime[$value]))
			{
				if(in_array($mime,$all_mime[$value]))
				{
					return true;
				}
			}
			else
			{
				if($mime == $all_mime[$value])
				{
					return true;
				}
			}
		}
		return false;
	}

	// ------------------------------------------------------------------------

	/**
	 * course_dir
	 * 
	 * 课件所在文件夹
	 * author varson
	 * 2013/3/27 14:55:24
	 */
	static function courseDir($id)
	{
	    $str = str_pad($id,11,"0",STR_PAD_LEFT);
	    $str1 = substr($str,0,2).'/'.substr($str,2,3).'/'.substr($str,5,3).'/'.substr($str,-3);//.'/'.substr($str,-3)
	    return $str1;
	}
	//----------------------------------------------------------------------------

	/**
	 * Tests for file writability
	 *
	 * is_writable() returns TRUE on Windows servers when you really can't write to
	 * the file, based on the read-only attribute.  is_writable() is also unreliable
	 * on Unix servers if safe_mode is on.
	 *
	 * @access	private
	 * @return	void
	 */
	static function writable($file)
	{
		// If we're on a Unix server with safe_mode off we call is_writable
		if (DIRECTORY_SEPARATOR == '/' AND @ini_get("safe_mode") == FALSE)
		{
			return is_writable($file);
		}

		// For windows servers and safe_mode "on" installations we'll actually
		// write a file then read it.  Bah...
		if (is_dir($file))
		{
			$file = rtrim($file, '/').'/'.md5(mt_rand(1,100).mt_rand(1,100));

			if (($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE)
			{
				return FALSE;
			}

			fclose($fp);
			@chmod($file, DIR_WRITE_MODE);
			@unlink($file);
			return TRUE;
		}
		elseif ( ! is_file($file) OR ($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE)
		{
			return FALSE;
		}

		fclose($fp);
		return TRUE;
	}
    static public function createThumb($file_path, $new_file_path, $max_width, $max_height) 
    {
    	self::createFolder(dirname($new_file_path));

        if (!function_exists('getimagesize')) {
            error_log('Function not found: getimagesize');
            return false;
        }
        if(!file_exists($file_path))
        {
        	return false;
        }
        list($img_width, $img_height) = @getimagesize($file_path);
        if (!$img_width || !$img_height) {
            return false;
        }
        $scale = max(
            $max_width / $img_width,
            $max_height / $img_height
        );
        if ($scale >= 1) {
            if ($file_path !== $new_file_path) {
                return copy($file_path, $new_file_path);
            }
            return true;
        }
        if (!function_exists('imagecreatetruecolor')) {
            error_log('Function not found: imagecreatetruecolor');
            return false;
        }
        if (true) {
            $new_width = $img_width * $scale;
            $new_height = $img_height * $scale;
            $dst_x = 0;
            $dst_y = 0;
            $new_img = imagecreatetruecolor($new_width, $new_height);
        } else {
            if (($img_width / $img_height) >= ($max_width / $max_height)) {
                $new_width = $img_width / ($img_height / $max_height);
                $new_height = $max_height;
            } else {
                $new_width = $max_width;
                $new_height = $img_height / ($img_width / $max_width);
            }
            $dst_x = 0 - ($new_width - $max_width) / 2;
            $dst_y = 0 - ($new_height - $max_height) / 2;
            $new_img = imagecreatetruecolor($max_width, $max_height);
        }

        //switch (strtolower(substr(strrchr($file_path, '.'), 1))) {
        $img_info = getimagesize($file_path);
        switch ($img_info[2]) {
            //case 'jpg':
            case 2://'jpeg':
                $src_img = imagecreatefromjpeg($file_path);
                $write_image = 'imagejpeg';
                $image_quality = 80;
                break;
            case 1://'gif':
                imagecolortransparent($new_img, imagecolorallocate($new_img, 0, 0, 0));
                $src_img = imagecreatefromgif($file_path);
                $write_image = 'imagegif';
                $image_quality = null;
                break;
            case 3://'png':
                imagecolortransparent($new_img, imagecolorallocate($new_img, 0, 0, 0));
                imagealphablending($new_img, false);
                imagesavealpha($new_img, true);
                $src_img = imagecreatefrompng($file_path);
                $write_image = 'imagepng';
                $image_quality = 9;
                break;
            default:
                imagedestroy($new_img);
                return false;
        }
        $success = imagecopyresampled(
            $new_img,
            $src_img,
            $dst_x,
            $dst_y,
            0,
            0,
            $new_width,
            $new_height,
            $img_width,
            $img_height
        ) && $write_image($new_img, $new_file_path, $image_quality);
        // Free up memory (imagedestroy does not delete files):
        imagedestroy($src_img);
        imagedestroy($new_img);
        return $success;
    }

}