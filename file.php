<?php

// Load the base

require_once( 'base/base.php' );

// Load system config

require_once( $paths->get( 'rootpath', '../config/dragonfly/config.php' ) );

// Get the file name

$file = $paths->get( 'rootpath', $_GET['file'] );
$file = realpath( $file );
$file = str_replace( '\\', '/', $file );

// Get root path

$rooturl = $paths->get( 'rootpath' );
$rooturl = str_replace( '\\', '/', $rooturl );

// Make sure the file exists and the root path is in the file path

if ( file_exists( $file ) && stristr( $file, $paths->get( 'rootpath' ) ) )
{
	// Stream the file to the browser

	$files = new \lib\files( );
	$files->stream( $file );
}

?>