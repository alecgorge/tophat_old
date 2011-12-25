<?php

// you probably don't need to change the next 4 lines
define('TH_ROOT', dirname(__FILE__));
define('TH_CONTENT', TH_ROOT.'/content');
define('TH_CORE', TH_ROOT.'/th-core');
define('TH_LIB', TH_CORE.'/lib');
define('TH_TIMEZONE', 'America/New_York');
define('TH_DB_TABLE_PREFIX', '');

// don't change this next line
require_once TH_CORE.'/utility_functions.php';

/*
 * Pick you favorite way to connect.
 */

// Connecting to a MSSQL database on localhost running on the default port
// $db = new fDatabase('mssql', 'my_database', 'username', 'password');
 
// Connecting to a MySQL database on the server example.com
// $db = new fDatabase('mysql', 'my_database', 'username', 'password', 'example.com');
 
// Connecting to an Oracle database on localhost
// $db = new fDatabase('oracle', 'my_database', 'username', 'password');
 
// Connecting to a PostgreSQL database on the current server using a non-standard port
// $db = new fDatabase('postgresql', 'my_database', 'username', 'password', 'localhost', 1234);
 
// Connection to an SQLite database
$db = new fDatabase('sqlite', TH_CONTENT.'/database.sqlite');
 
// Connecting to a remote DB2 server
// $db = new fDatabase('db2', 'my_database', 'username', 'password', 'remote.host.com', 60000);
 
// Connect on the default port with a timeout of 1 second
// $db = new fDatabase('postgresql', 'my_database', 'username', 'password', 'localhost', NULL, 1);

// Don't edit anything below here

define('TH_PUB_ROOT', '/' . fFilesystem::translateToWebPath(dirname(__FILE__)));

define("TH_TABLE_NODES", TH_DB_TABLE_PREFIX."nodes");
define("TH_TABLE_SETTINGS", TH_DB_TABLE_PREFIX."settings");
define("TH_TABLE_USERS", TH_DB_TABLE_PREFIX."users");
define("TH_TABLE_GROUPS", TH_DB_TABLE_PREFIX."groups");

fAuthorization::setLoginPage(TH_PUB_ROOT.'/admin/');
date_default_timezone_set(TH_TIMEZONE);
fTimestamp::setDefaultTimezone(TH_TIMEZONE);
