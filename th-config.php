<?php

define('TH_ROOT', dirname(__FILE__));
define('TH_CONTENT', TH_ROOT.'/content');
define('TH_CORE', TH_ROOT.'/th-core');
define('TH_LIB', TH_CORE.'/lib');

require(TH_LIB.'/flourish/fDatabase.php');
/**
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