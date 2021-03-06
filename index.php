<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load the base

require_once( 'base/base.php' );

// Load system config

require_once( $paths->get( 'rootpath', '../config/dragonfly/config.php' ) ); // store main config outside the repo (with sample config remaining in the root project folder)

// Connect to the database

$db->connect( );

// Initialise required objects

$session	= new \lib\session( );
$site 		= new \lib\site( );
$module 	= new \lib\module( );
$task 		= new \lib\task( );
$theme		= new \lib\theme( );
$page		= new \lib\page( );
$meta		= new \lib\meta( );
$user		= new \lib\user( );

// Load the current site

$site->load( );

// Load the current module

$module->load( );

// Load the current task

$task->load( );

// Load the theme

$theme->load( );

// Check if the user has permission to access the requested url

$user->securerequest( );

// Get the page

$page->get( );
