<?php

// Load the base

require_once( 'base/base.php' );

// Load system config

require_once( $paths->get( 'rootpath', '../config/dragonfly/config.php' ) );

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

// Check if user has permission to access the request

$user->securerequest( );

// Raw task output (no theme) - could be html, xml, rss, atom, any output from the task

echo $page->content( );
