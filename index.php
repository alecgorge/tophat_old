<?php

require_once 'th-config.php';

$site = new TopHat($db);

// branch off early for the Admin page to reduce load for the regular page
if($site->urlHandler()->matches('admin')) {
	var_dump('am admin');
}
else {
	$res = new PublicResponse($site);
	$res->serve();
}

//th_display_debug_info();

