<?php

namespace base;

/**
 * This class is for administration of URLs
 */
class url
{
/**
 * The name of the table to store URLs in
 */
	var $table;
	
/**
 * The column definitions for the url table
 */
	var $columns;
	
/**
 * Error code if a db error occured
 */
	const DB_ERROR = 1;

/**
 * Error code if no records were found while getting data
 */
	const NOT_FOUND_ERROR = 2;

/**
 * Constructor
 */
	function __construct( )
	{
		// Database table to store urls

		$this->table = 'url';

		// Columns for the url table

		$this->columns = Array(
			'id' => Array( 'field' => 'id', 'type' => 'int', 'length' => '12', 'key' => 'primary', 'auto' => TRUE, 'null' => FALSE ),
			'foreignid' => Array( 'field' => 'foreignid', 'type' => 'int', 'length' => '12', 'null' => FALSE ),
			'url' => Array( 'field' => 'url', 'type' => 'varchar', 'length' => '255', 'null' => FALSE ),
			'table' => Array( 'field' => 'table', 'type' => 'varchar', 'length' => '255', 'null' => FALSE ),
			'pk' => Array( 'field' => 'pk', 'type' => 'varchar', 'length' => '255', 'null' => FALSE )
			);
	}

/**
 * Generate a url for the current site based on the specified module, task, params and view
 * @param string $m The module to create a url for (identified by the module namespace)
 * @param string $t The task to create a url for
 * @param string $p The parameters to append to a url
 * @param string $v The representation to use (eg: html (the default), rpc, file, rss, mobile, )
 * @return string Return the URL
 */
	function getsiteurl( $m = '', $t = '', $p = '', $v = '' )
	{
		global $db, $site, $module, $task, $paths;

		$retStr = '';
		
		// Set site url
		
		if ( $site->source == 'url' )
		{
			$retStr .= '/'.$site->site['url'];
		}
		
		// Get the module id
		
		if ( is_numeric( $m ) )
		{
			$moduledetails[0]['id'] = $m;
		}
		else
		{
			// See if a module was specified by namespace

			$sql = "SELECT `{$module->table}`.`{$module->columns['id']['field']}` FROM `{$module->table}`
					WHERE `{$module->table}`.`{$module->columns['namespace']['field']}`='{$m}'";
						
			$moduledetails = $db->exec( $sql );
		}
		
		// See if a task was specified by task and module id

		$sql = "SELECT `{$this->table}`.`{$this->columns['url']['field']}` FROM `{$this->table}`
				INNER JOIN `{$task->table}` ON
					`{$this->table}`.`{$this->columns['foreignid']['field']}`=`{$task->table}`.`{$task->columns['id']['field']}` AND
					`{$task->table}`.`{$task->columns['task']['field']}`='{$t}' AND
					`{$task->table}`.`{$task->columns['module']['field']}`='{$moduledetails[0]['id']}'
				WHERE
					`{$this->table}`.`{$this->columns['table']['field']}`='{$task->table}'";
					
		$taskdetails = $db->exec( $sql );
		
		if ( !empty( $taskdetails ) ) $retStr .= '/'.$taskdetails[0]['url'];
		
		// Add the url parameters
		
		if ( !empty( $p ) ) $retStr .= '/'.$p;

		// Get the complete url by including the root url

		$retStr = $paths->get( 'rooturl', ltrim( $retStr, '/' ), $v );
		
		// Return the url

		return $retStr;
	}

/**
 * Get an object based on its url, table name and primary key column name
 * @param string $url The URL to look for
 * @param string $table The table name to look for
 * @param string $pk The name of the primary key column in the objects data table
 * @return integer Return the object id
 */
	function object( $url, $table, $pk )
	{
		global $db, $error, $config;

		// Get the id based on the url and table name

		$sql = "SELECT * FROM `{$this->table}`
				INNER JOIN `{$table}` ON `{$table}`.`{$pk}`=`{$this->table}`.`{$this->columns['foreignid']['field']}`
				WHERE `{$this->table}`.`{$this->columns['url']['field']}`='{$url}' AND `{$this->table}`.`{$this->columns['table']['field']}`='{$table}' AND `{$this->table}`.`{$this->columns['pk']['field']}`='{$pk}'";
		$object = $db->exec( $sql );

		// Check for db errors

		if ( $error->iserror( $object ) )
		{
			$err = Array(
				'_error' => TRUE,
				'_code' => self::DB_ERROR,
				'_description' => "There was a database error while retrieving an object. URL: {$url}; Table: {$table}; Primary Key: {$pk}",
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			return $error->log( $err, $object );
		}

		// No db errors

		else
		{
			// Make sure we have a result

			if ( !empty( $object ) )
			{
				return $object[0];
			}

			// No id was found

			else
			{
				$err = Array(
					'_error' => TRUE,
					'_code' => self::NOT_FOUND_ERROR,
					'_description' => "No object was found. URL: {$url}; Table: {$table}; Primary Key: {$pk}",
					'_file' => __FILE__,
					'_function' => __FUNCTION__
					);
				return $error->log( $err );
			}
		}
	}

/**
 * Get an object id based on its url, table name and primary key column name
 * @param string $url The URL to look for
 * @param string $table The table name to look for
 * @param string $pk The name of the primary key column in the objects data table
 * @return integer Return the object id
 */
	function objectid( $url, $table, $pk )
	{
		global $db, $error, $config;

		// Get the id based on the url and table name

		$sql = "SELECT `{$this->columns['foreignid']['field']}` FROM `{$this->table}`
				WHERE `{$this->table}`.`{$this->columns['url']['field']}`='{$url}' AND `{$this->table}`.`{$this->columns['table']['field']}`='{$table}' AND `{$this->table}`.`{$this->columns['pk']['field']}`='{$pk}'";
		$object = $db->exec( $sql );

		// Check for db errors

		if ( $error->iserror( $object ) )
		{
			$err = Array(
				'_error' => TRUE,
				'_code' => self::DB_ERROR,
				'_description' => "There was a database error while retrieving an object id. URL: {$url}; Table: {$table}; Primary Key: {$pk}",
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			return $error->log( $err, $object );
		}

		// No db errors

		else
		{
			// Make sure we have a result

			if ( !empty( $object ) )
			{
				return $object[0][$this->columns['foreignid']['field']];
			}

			// No id was found

			else
			{
				$err = Array(
					'_error' => TRUE,
					'_code' => self::NOT_FOUND_ERROR,
					'_description' => "No object was found. URL: {$url}; Table: {$table}; Primary Key: {$pk}",
					'_file' => __FILE__,
					'_function' => __FUNCTION__
					);
				return $error->log( $err );
			}
		}
	}

/**
 * Set the URL for an object
 * @param integer $id The ID of the object
 * @param string $title The title to base the url on
 * @param string $table The table where the object is stored
 * @param string $pk The name of the primary key column in the object's table
 * @return Comment
 */
	function set( $id, $title, $table, $pk )
	{
		global $db, $error, $paths;

		// Check if the id/table/pk combination already exists

		$sql = "SELECT * FROM `{$this->table}` WHERE `{$this->columns['foreignid']['field']}`={$id} AND `{$this->columns['table']['field']}`='{$table}' AND `{$this->columns['pk']['field']}`='{$pk}'";
		$exists = $db->exec( $sql );

		// Check for database errors

		if ( $error->iserror( $exists ) )
		{
			$err = Array(
				'_error' => TRUE,
				'_description' => 'There was a database error while looking for the URL for object {$id} in table {$table}.',
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			return $error->log( $err, $exists );
		}

		// No database errors

		else
		{			
			// Make sure the url is in the correct format

			$url = preg_replace( "/[^a-zA-Z0-9\ -]+/", "", $title );
			
			// System views are reserved URLs
			
			if ( !in_array( $url, $paths->views ) )
			{
				// If no entry exists for the current object, create one

				if ( empty( $exists ) )
				{
					// Save the url

					$saveData = Array(
						$this->columns['foreignid']['field'] => $id,
						$this->columns['url']['field'] => $url,
						$this->columns['table']['field'] => $table,
						$this->columns['pk']['field'] => $pk
						);
					$result = $db->save( $this->table, $saveData );
					
					if ( $error->iserror( $result ) )
					{
						$err = Array(
							'_error' => TRUE,
							'_description' => 'There was a database error while saving the URL for object {$id} in table {$table}.',
							'_file' => __FILE__,
							'_function' => __FUNCTION__
							);
						return $error->log( $err, $result );
					}
				}

				// The entry already exists

				else
				{
					// If the url has changed, update it

					if ( $exists[0][$this->columns['url']['field']] != $url )
					{
						$sql = "UPDATE `{$this->table}`
								SET `{$this->columns['url']['field']}`='{$url}'
								WHERE `{$this->columns['foreignid']['field']}`={$id} AND `{$this->columns['table']['field']}`='{$table}' AND `{$this->columns['pk']['field']}`='{$pk}'";
						$result = $db->exec( $sql );
						
						if ( $error->iserror( $result ) )
						{
							$err = Array(
								'_error' => TRUE,
								'_description' => 'There was a database error while looking for the URL for object {$id} in table {$table}.',
								'_file' => __FILE__,
								'_function' => __FUNCTION__
								);
							return $error->log( $err, $result );
						}
					}
				}
			}
		}
	}

/**
 * Delete a url based on the object id and table name
 * @param integer $id The id of the item to delete
 * @param string $table The table name of the item to delete
 * @return True if successful, or an error array on failure
 */
	function delete( $id, $table, $pk )
	{
		global $db, $config, $error;

		// Make sure we have an id and a table

		if ( !empty( $id ) && !empty( $table ) )
		{
			// Try delete the url

			$sql = "DELETE FROM `{$this->table}` WHERE `{$this->columns['foreignid']['field']}`={$id} AND `{$this->columns['table']['field']}`='{$table}' AND `{$this->columns['pk']['field']}`='{$pk}'";
			$result = $db->exec( $sql );

			// Check for database errors

			if ( $error->iserror( $result ) )
			{
				$err = Array(
					'_error' => TRUE,
					'_description' => "There was a database error while trying to delete a url. ID: {$id}, Table: {$table}",
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
	}
}

?>