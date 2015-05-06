<?php

//Define global constants
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(__FILE__) . DS);
define('ROOT_PATH', basename(dirname(__FILE__)) . DS);
define('ROOT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/cframe/');
// Bootstrap
include 'config/include.php';

?>