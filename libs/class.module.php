<?php

namespace lib;

/**
 * The Module Class
 */
class module
{
/**
 * The table in the database where modules are stored
 */
	var $table;

/**
 * The columns of the database table
 */
	var $columns;

/**
 * Details of the current module we are viewing
 */
	var $module;

/**
 * Describes how we found the current module
 * Can be: default, url, task
 */
	var $source;

/**
 * The site constructor
 */
	function __construct()
	{
		global $db;

		// Table name in the database

		$this->table = 'module';

		// Columns for the module table

		$this->columns = Array(
			'id' => Array( 'field' => 'id', 'type' => 'int', 'length' => '12', 'key' => 'primary', 'null' => FALSE ),
			'name' => Array( 'field' => 'name', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'folder' => Array( 'field' => 'folder', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'file' => Array( 'field' => 'folder', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'namespace' => Array( 'field' => 'namespace', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'class' => Array( 'field' => 'class', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'meta' => Array( 'field' => 'meta_id', 'type' => 'int', 'length' => '12', 'null' => TRUE ),
			'access' => Array( 'field' => 'access', 'type' => 'varchar', 'length' => '11', 'null' => TRUE ),
			'created' => Array( 'field' => 'created', 'type' => 'varchar', 'length' => '11', 'null' => TRUE ),
			'modified' => Array( 'field' => 'modified', 'type' => 'varchar', 'length' => '6', 'null' => TRUE )
			);
	}

/**
 * Get a module or array of modules by id. If no id is specified, load all modules
 * @param integer|array $id The id of the module or modules to get
 * @param string $orderby The name of the column to order by
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

		if ( is_array( $result ) && array_key_exists( '_error', $result ) )
		{
			$err = Array(
				'_error' => TRUE,
				'_description' => 'Unable to load specified module.',
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			$err = $error->log( $err, $result );
			if ( $config->debug['enabled'] == TRUE ) debug( $err );
		}

		// No db errors

		else
		{
			return $result;
		}
	}

/**
 * Load the current module we are displaying.
 * This function is called from the task library when no module is specified in the url.
 */
	function load( $id = 0, $source = '' )
	{
		global $db, $error, $config, $paths, $site, $url;
		
		// Load a module specified by the parameters
		
		if ( !empty( $id ) && !empty( $source ) )
		{
			// Load the specified module
	
			//$sql = "SELECT * FROM `{$this->table}` WHERE `{$this->columns['id']['field']}`={$id}";
			//$module = $db->exec( $sql );
			
			$module = $this->get( $id );
	
			// Check for db errors
	
			if ( $error->iserror( $module ) )
			{
				$err = Array(
					'_error' => TRUE,
					'_description' => 'Unable to load specified module.',
					'_file' => __FILE__,
					'_function' => __FUNCTION__
					);
				//$err = $error->log( $err, $module );
				//if ( $config->debug['enabled'] == TRUE ) debug( $err );
				return $error->log( $err, $module );
			}
	
			// No db errors
	
			else
			{
				$this->module = $module[0];
	
				if ($source == 'default') $this->source = 'default';
				else if ($source == 'url') $this->source = 'task';
			}
		}
		
		// Load the module specified in the url
		
		else
		{
			// Get the current request
	
			$request = $paths->getrequest( );
	
			// Check if a module was specified in the url
	
			if ( !empty( $request ) )
			{
				// Get the request in an array
	
				$request = explode( '/', $request );
	
				// Check if the current site was specified in the url
	
				if ( $site->source == 'url' )
				{
					unset($request[0]);
					$request = array_values( $request );
				}
				
				// Check if the request is empty
				
				if ( !empty( $request ) )
				{
					// Get module details from the URL
		
					$details = $url->object( $request[0], $this->table, $this->columns['id']['field'] );
					
					// Check if there was an error
		
					if ( $error->iserror( $details ) )
					{
						if ( $details['_code'] == 2 ) return FALSE;
						else
						{
							$err = Array(
								'_error' => TRUE,
								'_description' => 'There was an error loading the module ID from the URL.',
								'_file' => __FILE__,
								'_function' => __FUNCTION__
								);
							//$err = $error->log( $err, $details );
							//if ( $config->debug['enabled'] == TRUE ) debug($err);
							//return FALSE;
							
							return $error->log( $err, $details );
						}
					}
		
					// No db errors
		
					else
					{
						if ( !empty( $details ) )
						{
							$this->module = $details;
							$this->source = 'url';
						}
					}
				}
				
				// If no module was specified, we get the current task and then load the module that the task belongs to.
				// See the Task library for more information.
			}
		}
	}
}

?>