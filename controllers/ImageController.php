<?php
/**
 *
 */
namespace Controllers;
class ImageController extends \Controllers\BaseController {

	function __construct() {
		parent::__construct('views\images\\', get_class(), 'image');
	}

	public function catalog() {
		include_once ROOT_DIR . $this->views_dir . 'view-all.php';
	}

	public function view($image) {
		include_once ROOT_DIR . $this->views_dir . 'view-image.php';
	}
	public function upload(){
		$this->home();
	}	
}
?>