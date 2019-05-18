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
 * Debug a variable by displaying its contents
 * @param mixed $var Variable to display in the debug message
 * @param string $title Title of the debug message
 * @return none
 */
function debug($var, $title = '', $force = FALSE)
{
	global $config;

	// Determine whether we should show debug messages or not

	$showDebug = FALSE;
	if (isset($config->debug['enabled']))
	{
		if ($config->debug['enabled'] === TRUE || $force == TRUE) $showDebug = TRUE;
	}

	// If we are allowed to show debug messages, show them

	if ($showDebug === TRUE)
	{
		// Check if we are in cli mode or webserver/browser mode

		if (php_sapi_name() == "cli") $html = FALSE;
		else $html = TRUE;

		// Show html
		
		if (is_string($var)){
			$var = str_replace('<', '&lt;', $var);
			$var = str_replace('>', '&gt;', $var);
		}

		// Get some useful info/stats to display

		$memoryUsage = getFriendlySize(memory_get_usage());
		$memoryPeak = getFriendlySize(memory_get_peak_usage());
		$memoryLimit = ini_get('memory_limit');
		$time = date("H:i:s");

		$stacktrace = debug_backtrace();
		$calledFrom = "{$stacktrace[0]['file']} on line {$stacktrace[0]['line']}";

		// Display the debug message
		
		if ($html)
		{
			echo "<div style='text-align:left;background-color:#CCC;padding:15px;'>";
			if (!empty($title)) echo "<pre style='font-weight:bold;text-align:left;color:#000;margin:0;padding:0 0 15px 15px;'>{$title}</pre>";
			echo "<pre style='text-align:left;color:#000;background-color:#FFF;display:block;margin:0;padding:15px;'>";
		}
		echo "[{$memoryUsage}/{$memoryPeak}/{$memoryLimit}] {$time} - {$calledFrom}\n";
		print_r($var);	
		
		if ($html) echo "</pre></div>";
		else if (!is_array($var)) echo "\n";
	}
}

/**
 * Calculate human-readable file or memory sizes
 */
function getFriendlySize($value)
{
    $metric = Array('B', 'K', 'M', 'G', 'T', 'P');
    $currentMetric = 0;
    while (($value / 1024) > 1)
    {
        $value = $value / 1024;
        $currentMetric++;
    }
    $value = round($value, 2);
    return "{$value}{$metric[$currentMetric]}";
}
