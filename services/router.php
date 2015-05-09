<?php

if (!isset($request_home)) {
	$request_home = '/';
}
$request = $_SERVER['REQUEST_URI'];
if ($request != null) {
	//Clean up request
	$clean_request = substr($request, strpos($request, $request_home) + 1);

	$request_components = array();
	$request_components = explode('/', $clean_request);
	foreach ($request_components as $key => $component) {
		$request_components[$key] = strtolower($component);
	}
	if (in_array('admin', $request_components)) {
		if (\Services\Authenticate::get_instance()->is_administrator()) {
			$admin_routing = true;
			include_once 'controllers/admin/AdminController.php';
			echo "im admin";
		} else {
			$request = strtolower($request);
			$regular_page = str_replace('/admin', '', $request);
			header('Location: ' . $regular_page);
		}
		unset($request_components[array_search('admin', $request_components)]);

		$request_components = array_values($request_components);
	} else {
		$admin_routing = false;
	}
	if (count($request_components) > 1) {
		$controller = $request_components[0];
		$method = $request_components[1];
		$controller = ucfirst($controller);

		unset($request_components[0]);
		unset($request_components[1]);

		$param = array($request_components);

		// foreach ($request_components as $key => $value) {
		// 	$param = array_push($param, $value);
		// }
		// $param = isset($request_components[2]) ? $request_components[2] : array();
	}
}
// echo "</br>request_home:";
// var_dump($request_home);
// echo "</br>request:";
// var_dump($request);
// echo "</br>clean request:\n";
// var_dump($clean_request);
// echo "</br>split request:\n";
// var_dump($request_components);
// echo "</br>controller:\n";
// var_dump($controller);
// echo "</br>method:\n";
// var_dump($method);
// echo "</br>param:\n";
// var_dump($param);

// echo 'controllers\\' . $controller . 'Controller' . '.php';

if (isset($controller) && file_exists('controllers\\' . ucfirst($controller) . 'Controller' . '.php')) {
	$admin_folder = $admin_routing ? 'admin\\Admin' : '';

	include_once 'controllers\\' . $admin_folder . $controller . 'Controller' . '.php';
	$controller_class = 'Controllers\\' . $controller . 'Controller';
	$controller_instance = new $controller_class();

	if (method_exists($controller_instance, $method)) {
		$args = array($method, array($param));
		call_user_func_array(array($controller_instance, 'render_page'), $args);
	} else {
		call_user_func_array(array($controller_instance, 'home'), array());
	}

} else if (!isset($controller)) {
	$base_controller->home();
} else {
	$base_controller->not_found();
}

function dumpVariables() {

}

?>