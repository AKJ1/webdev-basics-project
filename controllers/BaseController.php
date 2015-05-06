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
		$this->views_dir = $views_dir;
		$this->model = $model;
	}

	public function home() {
		include_once $this->views_dir . "home.php";
	}

	public function login() {
		include_once $this->views_dir . "login.php";
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
}

?>