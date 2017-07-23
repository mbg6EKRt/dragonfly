<?php

// Load the base

require_once( 'base/base.php' );

// Load system config

require_once( $paths->get( 'rootpath', '../config/dragonfly/config.php' ) );

// Connect to the database

$db->connect( );

// Initialise required objects

//$session	= new \lib\session( );
//$user		= new \lib\user( );
$dbapi		= new \lib\dbapi( );

// Check if the user has permission to access the requested url

//$user->securerequest( );

// Get the db result

$dbapi->getrequest( );

?>