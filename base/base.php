<?php

// Initialise base namespace

require_once( 'base.namespace.php' );

// Load base classes

loadbase( );

/**
 * Load base classes from the base directory
 */
function loadbase( )
{
	// Set the path to the base directory and set the name of the current file
	
	$path = dirname( __FILE__ );
	$thisFile = basename( __FILE__ );
	$namespaceFile = 'base.namespace.php';

	// Get a list of files in the base directory
	
	$files = scandir( $path );
	
	// Iterate through files

	foreach ( $files as $file )
	{
		if ( ( $file !== '.' ) && ( $file !== '..' ) && ( $file !==  $thisFile) && ( $file !==  $namespaceFile) && ( is_dir($file) === FALSE ) )
		{
			// Include the file

			require_once( $path.'/'.$file );

			// Instantiate the object

			$contents = file_get_contents( $path.'/'.$file );
			$parts = explode( "class ", $contents );
			unset( $parts[0] );

			foreach ( $parts as $part )
			{
				$classParts = explode( "{", $part );
				
				// Get the class name
				
				$className = trim( $classParts[0] );
				
				// We are done with the classParts variable, destroy it
				
				unset( $classParts );
				
				// Get the name of the variable to create
				
				$varName = strtolower( $className );
				
				// Check if the class exists
				
				$identifier = '\\base\\'.$className;
				$classExists = \base\class_exists( $identifier );

				// If the class exists
				
				if ( $classExists == TRUE )
				{
					// Instantiate a new global variable based on the class name
					
					global $$varName;
					
					// Instantiate a new object
					
					$$varName = new $identifier();
				}
			}
		}
	}
}

/**
 * Autoload classes from the lib directory
 * @param string $className The name of the class to load
 */
function autoload($className)
{
	global $paths;

	// Set valid locations to find a class file

	$locations = Array('lib');

	foreach ( $locations as $location )
	{
		// Set the full path to the file

		$filename = ltrim( str_replace( 'lib', '', strtolower( $className ) ), '\\' );
		$file = $paths->get( $location, 'class.'.$filename.'.php' );

		// If the file exists, include it

		if ( file_exists( $file ) )
		{
			require_once( $file );
		}
	}
}
spl_autoload_register( 'autoload' );

/**
 * Process a template - althought in the global scope, this function should never be used by core components
 * @param string $file The path to the template
 * @param array $data The variables to assign to the template
 * @param string $source Can be: file or string (file = the path to the template, string = a string of the template)
 * @return string The processed template
 */
function process( $file, $data, $source = 'file' )
{
	global $paths, $theme, $config, $url, $site, $module, $task;

	// Get the template engine settings

	$engine = $paths->get( 'templateengine' );
	$compileDir = $paths->get( 'templateengine_compile_dir' );
	
	// Load the page layout
	
	if ( $source == 'file' ) $layout = file_get_contents( $file );
	else $layout = $file;
	
	unset( $file );
	
	// Check if there are any URLs in the layout
		
	$urls = array( );
	preg_match_all( "/{embed:.*?}/", $layout, $urls );
	$urls = $urls[0];
	
	// If so, get the contents of the url and replace it in the layout
	
	foreach ( $urls as $urlname )
	{
		// Get the token and url
		
		$token = $urlname;
		$urlname = str_replace( '{embed:', '', $urlname );
		$urlname = str_replace( '}', '', $urlname );
		if ( !stristr( $urlname, 'http://' ) ) $urlname = $paths->get( 'rooturl', $urlname, 'embed' );
		
		// If the current view was not embedded, embed the url
		
		if ( $paths->view != 'embed' || $config->views['embed']['allowSubEmbeds'] === TRUE )
		{
			$content = file_get_contents( $urlname );
			$layout = str_replace( $token, $content, $layout );
		}
		
		// If root request was embedded into another page, replace the token with nothing
		
		else
		{
			$layout = str_replace( $token, '', $layout );
		}
	}
	
	// Check if there are any tasks in the layout
		
	$tasks = array( );
	preg_match_all( "/{task:.*?}/", $layout, $tasks );
	$tasks = $tasks[0];
	
	// If so, get the output from the task and replace it in the layout
	
	foreach ( $tasks as $taskname )
	{
		// Get the token and url
		
		$token = $taskname;
		$taskname = str_replace( '{task:', '', $taskname );
		$taskname = str_replace( '}', '', $taskname );
		
		// Get task and params
		
		$taskurl = explode( '/', $taskname );
		
		// Set the context for the module
		
		unset( $context );
		$context = new \base\config();
		
		$context->view = 'task';
		
		// Tasks embedded in a template will always inherit the site from the root request
		
		$context->site = $site->site;
		
		$context->task = $url->object( $taskurl[0], $task->table, $task->columns['id']['field'] );
		$context->module = $module->get( $context->task['module_id'] );
		$context->module = $context->module[0];
		
		$context->request = $taskname;
		
		// Get task output
		
		$content = $task->getoutput( $context );
		
		// Replace the token with the content
		
		$layout = str_replace( $token, $content, $layout );
	}

	// Load the template engine

	require_once( $engine );
	$engine = new Smarty();
	$engine->__set( 'compile_dir', $compileDir );

	// Assign the variables provided in $data

	foreach ( $data as $variable => $value )
	{
		$engine->assign( $variable, $value );
	}

	try
	{
		// Get the processed template
		
		ob_start( );
		$engine->display('string:'.$layout);
		$output = ob_get_contents( );
		ob_end_clean( );

		// Return the output
	
		return $output;
	}
	catch ( Exception $e )
	{
		debug($e, 'Template Engine Exception:');
	}
}

/**
 * Debug an object or variable - output the contents of a variable using print_r()
 * @param mixed $var The object or variable to dump to the screen
 * @param string $title Give the debug message a title
 */
function debug( $var, $title = '' )
{
	global $config;

	if ( !empty( $config ) && ( $config->debug['enabled'] == TRUE ) )
	{
		if ( is_string( $var ) )
		{
			// Replace special characters in output (special chars are { } as these are reserved by the template engine)
		
			$specialchars = Array( '<' => '&lt;', '>' => '&gt;', '{' => '&#123;', '}' => '&#125;' );
			
			foreach ( $specialchars as $char => $html_entity )
			{
				$var = str_replace( $char, $html_entity, $var );
			}
		}
		
		echo '<table cellpadding="10" cellspacing="0" style="background: #EAEAEA;">';

		if ( !empty( $title ) ) echo '<tr><td style="padding-bottom: 0; font: bold 14px Arial; color: #000000;">'.$title.'</td></tr>';

		echo '<tr><td><pre style="margin: 0; padding: 10px; color: #000000; background: #FFFFFF; display: block; border-top: 1px solid #AAAAAA;">';
		print_r( $var );
		echo '</pre></td></tr></table>';
	}
}

?>