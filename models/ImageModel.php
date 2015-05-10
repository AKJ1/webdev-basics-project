<?php 


/**
* 
*/
namespace Models;
class ImageModel extends \Models\BaseModel
{
	
	function __construct()
	{
		parent::__construct(array('table'=>'images', 'limit' => 15, 'columns' => '*' ));
		
	}

	function get_images($page = 0){
		$offset = intval($page) * 15;
		$args = array('where' => '', 'columns' => 'content, name, type, uploaded_by, album_id', 'limit'=>'15 OFFSET ' . strval($offset));
		$result = $this->find($args);
		return $result;
	}

	function add_image($image, $name = "",  $user = null, $album = null){
		if ($image!= null){
			$file = $image['tmp_name'];
			$filestream = fopen($file, 'r');

			$data = fread($filestream, filesize($file));
			// $data = addslashes($data);
			fclose($filestream);


			$image_type = exif_imagetype($file);
			if ($image_type == IMAGETYPE_GIF || 
				$image_type == IMAGETYPE_JPEG ||
				$image_type == IMAGETYPE_PNG ||
				$image_type == IMAGETYPE_BMP ||
				$image_type == IMAGETYPE_PSD) {

				$image_type = image_type_to_mime_type($image_type);
				$pairs = array('content' => $data, 'name' => $name, 'type' => $image_type, 'uploaded_by' => $user);
				if ($album != null) {
					$pairs['album_id'] = $album;
				}
				$this->add($pairs);	

			}else{
				die("invalid image format");
			}
			
		}
	}
}


 ?>