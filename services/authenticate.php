<?php

namespace Services;

class Authenticate {

	function __construct() {
		session_set_cookie_params(1800, "/");
	}

	public function get_instance() {

		static $instance = null;
		if (null === $instance) {
			$instance = new self();
		}
		return $instance;
	}

	public function is_logged_in() {
		if (isset($_SESSION['user_name'])) {
			return true;
		}
		return false;
	}
	
	public function is_administrator() {
		if (isset($_SESSION['is_admin']) == true) {
			return true;
		}
		return false;
	}
	public function logout() {
		session_destroy();
		header("Location: " . '/');
	}

	public function get_logged_user() {
		if (!isset($_SESSION['username'])) {
			return array();
		}

		return array(
			'username' => $_SESSION['username'],
			'user_id' => $_SESSION['user_id'],
		);

	}
}
?>