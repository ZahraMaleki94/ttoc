<?php
spl_autoload_register(function($classname) {
	$classname = str_replace('ttoc\\', '', $classname);
	$class_path = trailingslashit(dirname(dirname(__FILE__))) . $classname . '.php';
	$class_path = str_replace('/', DIRECTORY_SEPARATOR, $class_path);
	if (file_exists($class_path)) {
		include_once $class_path;
	}
});
