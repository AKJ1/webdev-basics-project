<?php
namespace Controllers;
class AccountController extends \Controllers\BaseController {

	function __construct() {
		parent::__construct('views\public\\', get_class(), 'account');

		$this->model = new \Models\AccountModel(array('table'=>'users'));
	}

	public function login() {
		if (isset($_POST['username'])) {
			$username = htmlspecialchars($_POST['username']);
		}
		if (isset($_POST['password'])) {
			$password = htmlspecialchars($_POST['password']);
		}
	
		if (!isset($username) &&
			!isset($password)) { 
				include_once ROOT_DIR . $this->views_dir . 'login.php';
		} else{

			if (!\Services\Authenticate::get_instance()->is_logged_in()) {
				$this->model->login($username, $password);
			}
		}
	}

	public function logout() {
		\Services\Authenticate::get_instance()->logout();	
	}

	public function register() {

	if (isset($_POST['username'])) {
		$username = htmlspecialchars($_POST['username']);
	}
	if (isset($_POST['password'])) {
		$password = htmlspecialchars($_POST['password']);
	}
	if (isset($_POST['repeat-password'])) {
		$repeat = htmlspecialchars($_POST['repeat-password']);
	}
	if (isset($_POST['emai'])) {
		$email = htmlspecialchars($_POST['email']);
	}
	if (!isset($username) &&
		!isset($password) &&
		!isset($repeat) &&
		!isset($email)) { 
		include_once ROOT_DIR . $this->views_dir . 'register.php';
	} else {
		if (!(\Services\Authenticate::get_instance()->is_logged_in())) {
			$validity = false;
			if (!isset($reg_username) ||
					!isset($reg_password) ||
					!isset($reg_repeat) ||
					!isset($reg_email)) {
					echo "<p class='red'>not all fields filled</p>";
			} else {
				$validity = true;
			}
			if (!$validity) {
				include_once ROOT_DIR . $this->views_dir . 'register.php';
			} else {
				$this->model->create_account($username, $password, $repeat, $email);
			}
			} else {
				header('Location: ' . ROOT_URL . '/');
				}
			}
		}
	}
?>