<?php

if (!isset($request_home)) {
	$request_home = DS + ROOT_PATH;
}
$request = $_SERVER['REQUEST_URI'];
if ($request != null) {
	//Clean up request
	$clean_request = substr($request, strpos($request, $request_home));

	$request_components = explode(DS, $clean_request);

	if (in_array('admin', $request_components)) {
		$admin_routing = true;
		include_once 'controllers/admin/AdminController.php';
		unset($request_components[array_search('admin', $request_components)]);
		echo "im admin";
	}
	if (count($request_components) > 1) {
		list($controller, $method) = $request_components;
		$param = isset($request_components[2]) ? $request_components[2] : array();
	}
}

if (isset($controller) && file_exists('controllers/' . $controller . '.php')) {
	$admin_folder = $admin_routing ? 'admin/' : '';
	include_once 'controllers' . $admin_folder . $controller . '.php';

	$controller_class = '\Controllers\\' . ucfirst($controller) . 'Controller';
	$controller_instance = new $controller_class();

	if (method_exists($controller_instance, $method)) {
		call_user_func_array(array($controller_instance, $method), array($param));
	} else {
		call_user_func_array(array($controller_instance, 'home'), array());
	}

} else {
	$base_controller->home();
}
?>