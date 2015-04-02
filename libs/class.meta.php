<?php

namespace lib;

/**
 * The Meta Data Class
 */
class meta
{
/**
 * The table in the database where meta data is stored
 */
	var $table;

/**
 * The columns of the database table
 */
	var $columns;

/**
 * The site constructor
 */
	function __construct()
	{
		global $db;

		// Table name in the database

		$this->table = 'meta';

		// Columns for the meta table

		$this->columns = Array(
			'id' => Array( 'field' => 'id', 'type' => 'int', 'length' => '12', 'key' => 'primary', 'auto' => TRUE, 'null' => FALSE ),
			'title' => Array( 'field' => 'name', 'type' => 'text', 'null' => TRUE ),
			'description' => Array( 'field' => 'default', 'type' => 'text', 'null' => TRUE ),
			'keywords' => Array( 'field' => 'default_task', 'type' => 'text', 'null' => TRUE ),
			'author' => Array( 'field' => 'default_layout', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'copyright' => Array( 'field' => 'domain', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'indexed' => Array( 'field' => 'created', 'type' => 'tinyint', 'length' => '1', 'null' => TRUE ),
			'follow' => Array( 'field' => 'modified', 'type' => 'tinyint', 'length' => '1', 'null' => TRUE ),
			'cache' => Array( 'field' => 'modified', 'type' => 'tinyint', 'length' => '1', 'null' => TRUE )
			);
	}

/**
 * Get the meta data for an item based on the meta id
 * @return none
 */
	function get( $id )
	{
		global $db, $error;

		$sql = "SELECT * FROM `{$this->table}` WHERE `{$this->table}`.`id`={$id}";
		$meta = $db->exec( $sql );

		// Check for database errors

		if ( is_array( $meta ) && array_key_exists('_error', $meta) )
		{
			$err = Array(
				'_error' => TRUE,
				'_description' => 'There was a database error while retreiving meta data from the database.',
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			$err = $error->log( $err, $meta );
			//if ($config->debug['enabled'] == TRUE) debug($err);

			return $err;
		}

		// No database errors

		else
		{
			if ( !empty( $meta ) ) return $meta[0];
			else
			{
				$err = Array(
					'_error' => TRUE,
					'_description' => 'Meta data was not found based on the given ID',
					'_file' => __FILE__,
					'_function' => __FUNCTION__
					);
				return $err;
			}
		}
	}

/**
 * Save meta data
 * @param array $data The meta data to save
 * @return Return the result from the database query
 */
	function set( &$data )
	{
		global $db, $error;

		// Save the data

		$result = $db->save( $this->table, $data );

		// Check for database errors

		if ( is_array( $result ) && array_key_exists('_error', $result) )
		{
			$err = Array(
				'_error' => TRUE,
				'_description' => 'Unable to save meta data to the database.',
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			$err = $error->log( $err, $result );
			//if ($config->debug['enabled'] == TRUE) debug($err);

			return $err;
		}
		else
		{
			return $result;
		}
	}
}

?>