<?php 

function my_autoload($class){
	
	$class = ucfirst($class);
	
	$path = str_replace('\\',DIRECTORY_SEPARATOR,$class) . '.php';
	if (file_exists($path)) {
		require $path;
	}
 
}

spl_autoload_register('my_autoload');
include '/vendor/autoload.php';



?>