<?php

/**
 * Automatically includes classes
 * 
 * @throws Exception
 * 
 * @param  string $class_name  Name of the class to load
 * @return void
 */
function __autoload ($class) {
	if(file_exists(TH_CORE."/$class.php")) {
		include TH_CORE."/$class.php";
	}
	elseif(file_exists(TH_LIB."/flourish/$class.php")) {
		include TH_LIB."/flourish/$class.php";
	}
	elseif(file_exists(TH_LIB."/$class.php")) {
		include TH_LIB."/$class.php";
	}
	elseif(file_exists(TH_CORE."/content-types/$class.php")) {
		include TH_CORE."/content-types/$class.php";
	}
	else {
		throw new Exception("$class could not be loaded because a suitable class could not be found.");
	}
}

function th_display_debug_info() {
	global $site;

	$const = get_defined_constants(true);
	var_dump(array(
		'Constants' => $const['user'],
		'$site' => $site,
		'GET' => $_GET,
		'POST' => $_POST
	));
}
