<?php

namespace lib;

/**
 * The Task Class. Used for getting task information from the database and determining which task to execute based on the current request.
 */
class task
{
/**
 * The table in the database where tasks are stored
 */
	var $table;

/**
 * The columns of the database table
 */
	var $columns;

/**
 * Name of the current task we are viewing
 */
	var $task;

/**
 * Details of the current task we are viewing
 */
	var $info;

/**
 * Describes how we found the current task
 * Can be: default, url
 */
	var $source;

/**
 * The task constructor
 */
	function __construct()
	{
		global $db;

		// Table name in the database

		$this->table = 'task';

		// Columns for the tasks table

		$this->columns = Array(
			'id' => Array( 'field' => 'id', 'type' => 'int', 'length' => '12', 'key' => 'primary', 'null' => FALSE ),
			'module' => Array( 'field' => 'module_id', 'type' => 'int', 'length' => '12', 'null' => TRUE ),
			'name' => Array( 'field' => 'name', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'task' => Array( 'field' => 'task', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'created' => Array( 'field' => 'created', 'type' => 'varchar', 'length' => '11', 'null' => TRUE ),
			'modified' => Array( 'field' => 'modified', 'type' => 'varchar', 'length' => '11', 'null' => TRUE )
			);
	}

/**
 * Get a task or array of tasks by id. If no id is specified, load all tasks
 * @param integer|array $id The id of the module or modules to get
 * @param string $orderby The name of the column to order by - eg: global $task; $task->columns['name']['field'];
 * @param string $orderdir The direction to order by - can be: ASC or DESC
 * @return array Return an array containing the requested module information
 */
	function get( $id = 0, $orderby = 'name', $orderdir = 'ASC' )
	{
		global $db, $meta, $error;
		
		$orderby = $this->columns[$orderby]['field'];

		// If no id was specified, get all modules and their meta data

		if ( empty( $id ) )
		{
			$sql = "SELECT * FROM `{$this->table}` ORDER BY `{$this->table}`.`{$orderby}` {$orderdir}";
		}
		
		// If $id is an array, get all modules specified in the array
		
		else if ( is_array( $id ) )
		{
			$id = implode( ',', $id );
			$sql = "SELECT * FROM `{$this->table}` WHERE `{$this->table}`.`{$this->columns['id']['field']}` IN ({$id}) ORDER BY `{$this->table}`.`{$orderby}` {$orderdir}";
		}
		
		// If $id is numeric, load the modules specified by $id
		
		else if ( is_numeric( $id ) )
		{
			$sql = "SELECT * FROM `{$this->table}` WHERE `{$this->table}`.`{$this->columns['id']['field']}`={$id} ORDER BY `{$this->table}`.`{$orderby}` {$orderdir}";
		}
		
		$result = $db->exec( $sql );

		// Check for db errors

		if ( $error->iserror( $result ) )
		{
			$err = Array(
				'_error' => TRUE,
				'_description' => 'Unable to get specified task: '.$id,
				'_query' => $sql,
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			return $error->log( $err, $result );
		}

		// No db errors

		else
		{
			return $result;
		}
	}

/**
 * Load the task for the current request
 */
	function load()
	{
		global $paths, $db, $error, $config, $site, $module, $url;

		// Should we load the module from here?

		$loadModule = FALSE;

		$taskColumn = $this->columns['task']['field'];

		// Get the current request

		$request = $paths->getrequest( );

		// Check if a task was specified in the url

		if ( !empty( $request ) )
		{
			// Get the request in an array

			$request = explode( '/', $request );

			// Check if the current site was specified in the url

			if ( $site->source == 'url' )
			{
				unset( $request[0] );
				$request = array_values( $request );
			}

			// Check if the current module was specified in the url

			if ( $module->source == 'url' )
			{
				unset( $request[0] );
				$request = array_values( $request );
			}
			else $loadModule = TRUE;

			// Make sure we still have a request value

			if ( !empty( $request ) )
			{
				// Load task details from url

				$details = $url->object( $request[0], $this->table, $this->columns['id']['field'] );
				
				// Check if there was an error
				
				if ( $error->iserror( $details ) )
				{
					if ( $details['_code'] == 2 )
					{
						// Get the default task
						
						$this->loaddefault( );
					}
				}
				
				// No errors
				
				else
				{
					// If we have a task, set it
	
					if ( !empty( $details ) )
					{
						$task = $details;
						$this->task = $task[$taskColumn];
						$this->info = $task;
						$this->source = 'url';
					}

					// No task was specified in the url, get the default task for the current site

					else
					{
						$this->loaddefault( );
					}
				}
			}
			else
			{
				// Check if the current module was specified in the url

				if ( $module->source != 'url' )
				{
					$loadModule = TRUE;
				}

				// Get the default task for the current site

				$this->loaddefault( );
			}
		}

		// If no task was specified in the url, get the default task

		else
		{
			// Check if the current module was specified in the url

			if ( $module->source != 'url' )
			{
				$loadModule = TRUE;
			}

			// Get the default task for the current site

			$this->loaddefault( );
		}

		// Check if we need to load the module from here

		if ($loadModule == TRUE)
		{
			$module->load( $this->info['module_id'], $this->source );
		}
	}

/**
 * Load the default task
 */
	function loaddefault( )
	{
		global $db, $site, $error;
		
		// Get the database column that holds the task id

		$taskColumn = $this->columns['task']['field'];

		// Get the default task

		$task = $site->site['default_task'];
		$sql = "SELECT * FROM `".$this->table."` WHERE `".$this->columns['id']['field']."`=".$task;
		$task = $db->exec( $sql );

		// Check for db errors

		if ( is_array( $task ) && array_key_exists('_error', $task) )
		{
			$err = Array(
				'_error' => TRUE,
				'_description' => 'Unable to load the default task.',
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			$err = $error->log( $err, $task );
			if ($config->debug['enabled'] == TRUE) debug($err);
		}

		// No db errors

		else
		{
			$task = $task[0];
			$this->task = $task[$taskColumn];
			$this->info = $task;
			$this->source = 'default';
		}
	}
	
/**
 * Get the output from a task
 * @param array $context An array containing the site, module, task and request info
 * @return string Return the output from the module
 */
	function getoutput( $context )
	{
		global $paths, $error;

		// Load the module

		$file = $paths->get( 'module', $context->module['folder'].'/'.$context->module['file'] );

		// Make sure the file exists before including it

		if ( file_exists( $file ) ) require_once( $file );

		// The file does not exist, return an error

		else
		{
			$err = Array(
				'_error' => TRUE,
				'_description' => "Error loading module. The file does not exist: {$file}",
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			$err = $error->log( $err );

			//if ( $config->debug['enabled'] == TRUE ) debug( $err );
			return $err;
		}

		// Instantiate the module object

		$identifier = '\\mod\\'.$context->module['namespace'].'\\'.$context->module['class'];
		$page = new $identifier();

		// Get the output from the module

		ob_start( );
		$page->start( $context );
		$output = ob_get_contents( );
		ob_end_clean( );

		// Return the output from the module

		return $output;
	}
}

?>