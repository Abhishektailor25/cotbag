<?php

function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = '',$thumb3 = FALSE, $thumb_folder3 = '', $thumb_width3 = '', $thumb_height3 = ''){
	//folder path setup
	$target_path = $target_folder;
	$thumb_path = $thumb_folder; 
	$thumb_path3 = $thumb_folder3;
	
	//file name setup
	$filename_err = explode(".",$_FILES[$field_name]['name']);
	$filename_err_count = count($filename_err);
	$file_ext = $filename_err[$filename_err_count-1];
	if($file_name != '')
	{
		$fileName = ($file_name).'.'.$file_ext;
	}
	else
	{
		$fileName = ($_FILES[$field_name]['name']);
	}
	
	//upload image path
	$upload_image = $target_path.basename($fileName);
	 
	//upload image
	if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))
	{
		//thumbnail creation
		if($thumb == TRUE)
		{
			$thumbnail = $thumb_path.$fileName;
			list($width,$height) = getimagesize($upload_image);
			$thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
			 
			if($file_ext!='png' && $file_ext!='webp' && $file_ext!='svg')
			{
			switch($file_ext){
				case 'jpg':
					$source = imagecreatefromjpeg($upload_image);
					break;
				case 'jpeg':
					$source = imagecreatefromjpeg($upload_image);
					break;
				case 'png':
					$source = imagecreatefrompng($upload_image);
					break;
				case 'gif':
					$source = imagecreatefromgif($upload_image);
					break;
					case 'webp':
					$source = imagecreatefromgif($upload_image);
					break;
				default:
					$source = imagecreatefromjpeg($upload_image);
			}
			imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
			switch($file_ext){
				case 'jpg' || 'jpeg':
					imagejpeg($thumb_create,$thumbnail,100);
					break;
				case 'png':
					imagepng($thumb_create,$thumbnail,100);
					break;
				case 'gif':
					imagegif($thumb_create,$thumbnail,100);
					break;
					case 'webp':
					imagewebp($thumb_create,$thumbnail,100);
					break;
				default:
					imagejpeg($thumb_create,$thumbnail,100);
			}
			}
			else
			{
				 
			//	echo $fileName;
       			 copy($upload_image,$thumbnail);

				//die();
			}
		}
		
		if($thumb3 == TRUE)
		{
			$thumbnail = $thumb_path3.$fileName;
			list($width,$height) = getimagesize($upload_image);
			$thumb_create = imagecreatetruecolor($thumb_width3,$thumb_height3);
			switch($file_ext){
				case 'jpg':
					$source = imagecreatefromjpeg($upload_image);
					break;
				case 'jpeg':
					$source = imagecreatefromjpeg($upload_image);
					break;
				case 'png':
					$source = imagecreatefrompng($upload_image);
				
					break;
				case 'gif':
					$source = imagecreatefromgif($upload_image);
					break;
				default:
					$source = imagecreatefromjpeg($upload_image);
			}
			imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width3,$thumb_height3,$width,$height);
			switch($file_ext){
				case 'jpg' || 'jpeg':
					imagejpeg($thumb_create,$thumbnail,100);
					break;
				case 'png':
					imagepng($thumb_create,$thumbnail,100);
					break;
				case 'gif':
					imagegif($thumb_create,$thumbnail,100);
					break;
				default:
					imagejpeg($thumb_create,$thumbnail,100);
			}
		}


		return $fileName;
	}
	else
	{
		return false;
	}
	
}

?>