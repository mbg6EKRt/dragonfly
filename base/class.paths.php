<?php

namespace base;

/**
 * Get Paths like the root url or root directory.
 */

class paths
{
/**
 * The root url of the system
 */
	var $rooturl;
	
/**
 * The root directory of the system
 */
	var $rootpath;

/**
 * Custom paths
 */
	var $customPaths;

/**
 * System views allow us to handle different methods of output
 */
	var $views;

/**
 * The view of the current request
 */
	var $view;

/**
 * paths constructor - set internal variables
 * @return none
 */
	function __construct()
	{
		// Set root paths
		
		$this->rooturl = $this->getrooturl();
		$this->rootpath = $this->getrootpath();
		$this->domain = $this->getdomain();

		// Specify views to strip from the url when getting the current request string
		// This array should be ordered from most frequently used to least frequently used
		// See the .htaccess file for a list of active views

		$this->views = Array( 'embed', 'ajax', 'task', 'file', 'cli' );
		
		// Get the current request to set the view
		
		$this->getrequest( );
	}

/**
 * Get a path based on the defined name of the path
 * @param string $name This can be either the root url ($name = 'rooturl') or root directory ($name = 'rootpath') of the site or some custom defined path (see paths::set for more info on custom defined paths)
 * @return string Return the requested path
 * @example get('rootpath', 'libs') would return '/path/to/site/libs'; get('rooturl', 'news') would return 'http://www.mydomain.com/news';
 */
	function get( $name, $path = '', $view = '' )
	{
		// Check if a view was specified (examples include: ajax, file, download)

		if ( !empty( $view ) )
		{
			$view = '/'.$view.'/';
		}

		// Check if a path was specified

		if ( empty( $view ) && !empty( $path ) )
		{
			$path = '/'.$path;
		}

		// Determine which path get

		switch ( $name )
		{
			// Get the root URL of the current site

			case 'rooturl': return $this->rooturl.$view.$path; break;

			// Get the root path of the current site

			case 'rootpath' : return $this->rootpath.$path; break;

			// Get the domain of the current site

			case 'domain' : return $this->domain.$view; break;

			// Otherwise, if the path for $name exists, return it

			default:
				if ( array_key_exists( $name, $this->customPaths ) ) return $this->customPaths[$name].$view.$path;
			break;
		}
	}

/**
 * Set a custom path
 * @param string $name The internal name of the path for easy reference when getting a path
 * @param string $path The path to set
 * @param string $type The type of path. If type is URL or PATH, $path will be defined relative to the root url or root path of the site. If type is empty, the defined $path will not be modified in any way.
 * @example set('lib', 'libs', 'path') wouth set $this->customPaths['lib'] = '/path/to/site/libs/';
 */
	function set( $name, $path, $type = '' )
	{
		// In order to set a path, we must have a name and the path

		if ( !empty( $name ) && !empty( $path ) )
		{
			// If the path is a URL

			if ( strtoupper($type) === 'URL' ) $this->customPaths[$name] = $this->rooturl.'/'.$path;

			// If the path is a filesystem path

			else if ( strtoupper($type) === 'PATH' ) $this->customPaths[$name] = $this->rootpath.'/'.$path;

			// If the path is not specified as a URL or filsystem path, just add the raw path without adding the root URL or root path

			else if (empty($type)) $this->customPaths[$name] = $path;
		}
	}

/**
 * Determine the root url of the site
 * @return string Return the root url of the site, including sub directories
 */
	function getrooturl( )
	{
		// Get the hostname and port
		
		if (isset($_SERVER['HTTP_HOST']))
		{
			$host = $_SERVER['HTTP_HOST'];
			$port = $_SERVER['SERVER_PORT'];
		
			// Check if the request is a secure connection (https) or normal connection (http)

			if ( $port == '443' ) $root = 'https://' . $host;
			else $root = 'http://' . $host;

			// If the port is not 80 or 443, add the port to the URL

			if ( $port != '80' && $port != '443' ) $root .= ':' . $port;

			// Get the directory the system is in (eg: http://www.mydomain.com/path/to/my/site)

			$root .= dirname( $_SERVER['PHP_SELF'] );

			// Return the root url

			return $root;
		}
	}

/**
 * Determine the root directory of the site
 * @return string The root directory of the site
 */
	function getrootpath( )
	{
		return dirname($_SERVER['SCRIPT_FILENAME']);
	}

/**
 * Determine the domain of the site
 * @return string The root directory of the site
 */
	function getdomain( )
	{
		if ( isset( $_SERVER['HTTP_HOST'] ) ) return $_SERVER['HTTP_HOST'];
	}

/**
 * Get the requested url
 * @return The requested url
 */
	function getrequest( )
	{
		global $argv;
		
		// If the request came from an internet browser
		
		if ( isset( $_SERVER['REQUEST_URI'] ) )
		{
			// Get the current folder where the site is stored

			$folder = dirname( $_SERVER['PHP_SELF'] ).'/';
		
			// Get the request uri

			$request = str_replace( $folder, '', $_SERVER['REQUEST_URI'] );
			$request = urldecode( $request );
			$request = trim( $request, '/' );

			// Check if we must strip a view from the url

			$hasview = FALSE;
			
			foreach ( $this->views as $view )
			{
				if ( substr( $request, 0, ( strlen( $view ) + 1 ) ) == $view.'/' )
				{
					// Set the current view
					
					$this->view = $view;
					
					// Get everything after the view
					
					$request = substr( $request, ( strlen( $view ) + 1 ) );
					
					$hasview = TRUE;
					break;
				}
			}
			
			if (!$hasview)
			{
				$this->view = "url";
			}

			// Return the current request

			return $request;
		}
		
		// If the request was made in cli mode
		
		//else if ( isset( $argv[1] ) )
		else
		{
			$this->view = 'cli';
			if ( isset( $argv[1] ) ) return $argv[1];
		}
		
		// If all else fails, return an empty string
		
		return '';
	}

/**
 * Get the url parameters - the request less the site / module /task
 * @return string Return a string containing the url parameters
 */
	function getparams( $request = '' )
	{
		global $site, $module, $task;

		// Get the full request

		if ( empty( $request ) ) $request = explode( '/', $this->getrequest( ) );
		else if ( !is_array( $request ) ) $request = explode( '/', $request );
		
		$count = 0;

		// Check if a site was specified in the url

		if ( isset( $site->source ) && $site->source == 'url' && is_array( $request ) )
		{
			unset( $request[$count] );
			$count++;
		}

		// Check if a module was specified in the url

		if ( isset( $module->source ) && $module->source == 'url' && is_array( $request ) )
		{
			unset( $request[$count] );
			$count++;
		}

		// Check if a task was specified in the url

		if ( isset( $task->source ) && $task->source == 'url' && is_array( $request ) )
		{
			unset( $request[$count] );
			$count++;
		}

		// Return the request
		
		if ( is_array( $request ) )
		{
			$request = implode( '/', $request );
		}

		return $request;
	}
}

?>