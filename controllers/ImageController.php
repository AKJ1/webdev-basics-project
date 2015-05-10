<?php
/**
 *
 */
namespace Controllers;
class ImageController extends \Controllers\BaseController {

	function __construct() {
		parent::__construct('views\images\\', get_class(), 'image');
	}

	public function gallery($page = 0){
		$gallery_images = $this->model->get_images($page);
		include ROOT_DIR . $this->views_dir . 'gallery.php';
	}
	public function view() {
		include_once ROOT_DIR . $this->views_dir . 'view.php';
	}
	public function upload(){
		var_dump($_POST);
		var_dump($_FILES);
		if (!isset($_FILES['image'])) {
			include_once ROOT_DIR . $this->views_dir . 'upload.php';
		}else{
			$uploader = null;
			$image_name = $_FILES['image']['name']; 
			if (isset($_SESSION['user_id'])) {
				$uploader = $_SESSION['user_id'];
			}
			if (isset($_POST['image_name'])) {
				$image_name = $_POST['image_name'];
			}
			$this->model->add_image($_FILES['image'], $image_name, $uploader);
		}
	}	
}
?>