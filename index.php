<?php

session_start();
//Define global constants
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(__FILE__) . DS);
define('ROOT_PATH', basename(dirname(__FILE__)) . DS);
define('ROOT_URL', 'http://' . $_SERVER['HTTP_HOST']);
// Bootstrap
include 'config/include.php';
include 'services/authenticate.php';
include 'services/database.php';

$include_path = (DS . ROOT_PATH);

$layouts_path = 'views\\' . 'layouts\\';
include $layouts_path . 'header.php';
include_once 'controllers\\BaseController.php';

$base_controller = new \Controllers\BaseController();

include_once 'services/router.php';
?>	