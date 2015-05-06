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
	if (in_array('admin', $request_components)) {
		$admin_routing = true;
		include_once 'controllers/admin/AdminController.php';
		unset($request_components[array_search('admin', $request_components)]);
		echo "im admin";
	} else {
		$admin_routing = false;
	}
	if (count($request_components) > 1) {
		list($controller, $method) = $request_components;
		$param = isset($request_components[2]) ? $request_components[2] : array();
	}
}
echo "</br>request_home:";
var_dump($request_home);
echo "</br>request:";
var_dump($request);
echo "</br>clean request:\n";
var_dump($clean_request);
echo "</br>split request:\n";
var_dump($request_components);
echo "</br>controller:\n";
var_dump($controller);
echo "</br>method:\n";
var_dump($method);
echo "</br>param:\n";
var_dump($param);

echo 'controllers\\' . ucfirst($controller) . 'Controller' . '.php';

if (isset($controller) && file_exists('controllers\\' . ucfirst($controller) . 'Controller' . '.php')) {
	$admin_folder = $admin_routing ? 'admin/' : '';
	include_once 'controllers\\' . $admin_folder . $controller . 'Controller' . '.php';

	$controller_class = 'Controllers\\' . ucfirst($controller) . 'Controller';
	$controller_instance = new $controller_class();

	if (method_exists($controller_instance, $method)) {
		call_user_func_array(array($controller_instance, $method), array($param));
	} else {
		call_user_func_array(array($controller_instance, 'home'), array());
	}

} else {
	$base_controller->home();
}

function dumpVariables() {

}

?>