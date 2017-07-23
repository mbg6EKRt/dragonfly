<?php

// Enable/disable debug mode

$config->debug = Array( 'enabled' => TRUE );

// Database config

$config->db = Array(
		'type' => 'mysql',
		'host' => 'localhost',
		'port' => '',
		'db' => 'dragonfly',
		'user' => 'root',
		'pass' => ''
		);

// Configure urls

$paths->set( '3rdpartyurl', '3rdparty', 'url' );
$paths->set( 'moduleurl', 'modules', 'url' );
$paths->set( 'themeurl', 'themes', 'url' );

// Configure paths

$paths->set( '3rdparty', '3rdparty', 'path' );
$paths->set( 'lib', 'libs', 'path' );
$paths->set( 'module', 'modules', 'path' );
$paths->set( 'theme', 'themes', 'path' );
$paths->set( 'files', 'files', 'path' );
$paths->set( 'sites', 'sites', 'path' );

// Template engine path config

$paths->set( 'templateengine', '3rdparty/smarty/Smarty.class.php', 'path' );
$paths->set( 'templateengine_compile_dir', 'files/smarty/compiled', 'path' );

// Core Javascripts

//$config->javascript['jquery'] = 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js';
$config->javascript['jquery'] = $paths->get('3rdpartyurl', 'jquery/jquery-1.11.1.min.js');
//$config->javascript['jqueryui'] = $paths->get( '3rdpartyurl', 'jquery/jquery-ui-1.8.18.custom/js/jquery-ui-1.8.18.custom.min.js' );
//$config->javascript['jqueryuicss'] = $paths->get( '3rdpartyurl', 'jquery/jquery-ui-1.8.18.custom/css/smoothness/jquery-ui-1.8.18.custom.css' );

// Over-ride sub-embed restriction
// Be careful with this as it is easy to create infinite loops
// For example: if you embed a URL that requires the user to login 
// 				on the login template, you will have created an 
//				infinite loop of requests to the web server and 
//				the page will never get loaded.

$config->views['embed']['allowSubEmbeds'] = FALSE;

?>