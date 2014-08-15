<?php

class Folder {

	/***********************
	 * File Class.
	 *
	 * @author Varson
	 * @2014/03/05
	 **********************/
	/**
	 * create floder
	 * 
	 * author varson
	 * 2013/3/27 14:28:17
	 */
	static public function create($path)
	{
	    if (!is_dir($path))
	    {
	      Folder::create(dirname($path));
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
	 * useage
	 * 
	 * 目录大小
	 * @param string directory
	 * @return int (byte)  
	 * author varson
	 * 2013/3/27 15:12:35
	 */
	static public function useage($dirPath)
	{
	    $sumSize = 0;
	    $handle = opendir($dirPath);
	    while (false!==($FolderOrFile = readdir($handle)))
	    {
	        if($FolderOrFile != "." && $FolderOrFile != "..")
	        {
	            if(is_dir("$dirPath/$FolderOrFile"))
	            {
	                $sumSize += Folder::useage("$dirPath/$FolderOrFile");
	            }
	            else
	            {
	                $sumSize += filesize("$dirPath/$FolderOrFile");
	            }
	        }   
	    }
	    closedir($handle);
		return empty ( $sumSize ) ? 0 : $sumSize; 
	}
	//---------------------------------------------------------------------------
	/**
	 * 
	 * 删除目录
	 * 
	 * @param string directory 
	 * @author
	 * 2013/3/27 16:11:00
	 */
	static public function delete($path)
	{
	    if(is_dir($path))
	    {
	        $file_list= scandir($path);
	        foreach ($file_list as $file)
	        {
	            if( $file!='.' && $file!='..')
	            {
	                Folder::delete($path.'/'.$file);
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
	 * Create a Directory Map
	 *
	 * Reads the specified directory and builds an array
	 * representation of it.  Sub-folders contained with the
	 * directory will be mapped as well.
	 *
	 * @access	public
	 * @param	string	path to source
	 * @param	int		depth of directories to traverse (0 = fully recursive, 1 = current dir, etc)
	 * @return	array
	 */
	static function map($source_dir, $directory_depth = 0, $hidden = FALSE)
	{
		if ($fp = @opendir($source_dir))
		{
			$filedata	= array();
			$new_depth	= $directory_depth - 1;
			$source_dir	= rtrim($source_dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;

			while (FALSE !== ($file = readdir($fp)))
			{
				// Remove '.', '..', and hidden files [optional]
				if ( ! trim($file, '.') OR ($hidden == FALSE && $file[0] == '.'))
				{
					continue;
				}

				if (($directory_depth < 1 OR $new_depth > 0) && @is_dir($source_dir.$file))
				{
					$filedata[$file] = Folder::map($source_dir.$file.DIRECTORY_SEPARATOR, $new_depth, $hidden);
				}
				else
				{
					$filedata[] = $file;
				}
			}

			closedir($fp);
			return $filedata;
		}

		return FALSE;
	}
}