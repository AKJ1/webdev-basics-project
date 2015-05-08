<?php
namespace Controllers;
class AccountController extends \Controllers\BaseController {

	function __construct() {
		parent::__construct('views\public\\', get_class(), 'account');
		$this->model = new \Models\AccountModel();
	}

	public function login() {
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);

		$user = $auth->get_logged_user();

		if (!isset($user) && isset($password) && isset($username)) {
			$auth->login($username, $password);
			header('Location : ' . ROOT_URL);

		} else {
			include_once ROOT_DIR . $this->views_dir . 'login.php';
		}
	}

	public function logout() {
		$auth->logout();
	}

	public function register() {

		$reg_username = htmlspecialchars($_POST['username']);
		$reg_password = htmlspecialchars($_POST['password']);
		$reg_repeat = htmlspecialchars($_POST['repeat-password']);
		$reg_email = htmlspecialchars($_POST['email']);
		if (!(\Services\Authenticate::get_instance()->is_logged_in())) {
			$validity = false;
			if (!isset($reg_username) &&
				!isset($reg_password) &&
				!isset($reg_repeat) &&
				!isset($reg_email)) {				
				include_once ROOT_DIR . $this->views_dir . 'register.php';
			}else {
				if (!isset($reg_username) ||
				!isset($reg_password) ||
				!isset($reg_repeat) ||
				!isset($reg_email)) {
					echo "<p class='red'>not all fields filled</p>";
				}else{
					$validity = true;
				}
			}
			if (!$validity) {
				include_once ROOT_DIR . $this->views_dir . 'register.php';
			}else{
				$this->model->create_account($reg_username, $reg_password, $reg_repeat, $reg_email);
			}
		} else {
			header('Location: ' . ROOT_URL . '/');
		}
	}
}
?>