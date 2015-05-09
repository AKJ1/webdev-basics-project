<?php

namespace Controllers;

class BaseController {

	public $route = 'public';

	protected $views_dir;

	protected $model = null;

	protected $class_name = null;

	protected $logged_user = array();

	function __construct($views_dir = 'views\public' . DS,
		$class_name = '\Controllers\BaseController',
		$model = 'base') {
		$this->class_name = $class_name;
		$this->views_dir  = $views_dir;
		$this->model      = ucfirst($model);

		include_once ROOT_DIR . "models\\{$this->model}Model" . '.php';


		$model_class = "\Models\\" . $this->model . "Model";		
		// $this->model = new $model_class(array('table'=>'none'));
	}
	function __destruct(){
		unset($this->model);
		unset($this);
	}

	public function home() {
		include_once $this->views_dir . 'home.php';
		include_once '\views\layouts\\' . 'footer.php';
	}


	public function dumpInfo() {
		echo "Views Dir Info";
		var_dump($this->views_dir);

		echo "Model Info :";
		var_dump($this->model);

		echo "Controller Name";
		var_dump($this->class_name);

		echo "string";
		var_dump($this->views_dir);
	}

	public function render_page($method, $params) {
		include_once 'views/layouts/header.php';
		call_user_func_array(array($this, $method), array($params));
		include_once 'views/layouts/footer.php';

	}

	public function not_found() {
		include_once $this->views_dir . "404.php";
	}
}

?>