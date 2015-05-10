<?php
/**
 *
 */
namespace Controllers;
class AlbumController extends \Controllers\BaseController {

	function __construct() {
		parent::__construct('views\albums\\', get_class(), 'album');
	}

	public function home() {
		include_once ROOT_DIR . $this->views_dir . 'home.php';
	}

	public function upload(){
		include_once ROOT_DIR . $this->views_dir . 'upload.php';
	}
}
?>