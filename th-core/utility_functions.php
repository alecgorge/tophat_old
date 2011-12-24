<?php

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
	else {
		throw new Exception("$class could not be loaded because a suitable class could not be found.");
	}
}


