<?php

namespace base;

/**
 * Makes the database specified in the config file available.
 */

class db
{
	/**
	 * The type of connection. Can be: mysql, mssql, odbc, or any other type supported by PDO
	 */
	public $type;

	/**
	 * The name of the database
	 */
	public $db;

	/**
	 * The hostname of the server
	 */
	public $host;

	/**
	 * The port we're connected on
	 */
	public $port;

	/**
	 * The username we're connecting with
	 */
	public $user;

	/**
	 * The password we're connecting with
	 */
	public $pass;

	/**
	 * Store the current connection
	 */
	private $con;

	/**
	 * The list of tables in the database
	 */
	protected $tables = Array();

/**
 * db Constructor - initializes internal variables
 */
	function __construct()
	{
		// Data types

		$this->numericTypes = Array('tinyint', 'smallint', 'mediumint', 'int', 'bigint', 'float', 'double', 'real', 'decimal');
		$this->stringTypes = Array('char', 'varchar', 'tinytext', 'text', 'mediumtext', 'longtext', 'datetime', 'date', 'timestamp', 'time', 'year', 'enum');
	}

/**
 * Connect to a database
 * @param array $dbconfig If specified, use this configuration, otherwise use the default configuration specified in the config.php
 * @return none
 */
	function connect( $dbconfig = Array() )
	{
		global $error, $config;

		// Make sure we have connection details

		if ( empty( $dbconfig ) ) $dbconfig = $config->db;

		// Set internal variables

		$this->type = $dbconfig['type'];
		$this->db = $dbconfig['db'];
		$this->host = $dbconfig['host'];
		$this->port = $dbconfig['port'];
		$this->user = $dbconfig['user'];
		$this->pass = $dbconfig['pass'];

		// Try connect to the database

		try
		{
			// Connection string

			$dsn = $dbconfig['type'].':dbname='.$dbconfig['db'].';host='.$dbconfig['host'];

			// Create the connection

			$this->con = new \PDO($dsn, $dbconfig['user'], $dbconfig['pass']);

			// Get the list of tables in the database

			$this->getTables();
		}

		// If we cannot connect, log the error and see if we must display the error

		catch ( PDOException $e )
		{
			$pdoerror = $e->getMessage( );

			$arr = explode( ']', $pdoerror );
			$sql = $dbconfig[type].":dbname=*****;host=*****";

			$pdoerror = Array(
					'_error' => substr(trim($arr[1]),1),
					'_description' => trim($arr[2]),
					'_query' => $sql,
					'_file' => __FILE__,
					'_function' => __FUNCTION__
					);
			$pdoerror = $error->log( $pdoerror );

			if ( $config->debug['enabled'] == TRUE ) debug( $pdoerror );
		}
	}

/**
 * Execute a query and return the result
 * @param string $sql The sql statement to execute
 * @return array Return the result if successful, otherwise return an error array on failure
 */
	function exec( $sql )
	{
		global $error, $config;

		// Execute the query

		$result = $this->con->query( $sql );
		$this->pdostatement = $result;

		// Check for errors

		if ( ( $result === false ) || ( $this->con->errorCode( ) > 0 ) )
		{
			$err = $this->con->errorInfo( );

			$pdoerror = Array(
					'_error' => TRUE,
					'_description' => 'Unable to execute query.',
					'_query' => $sql,
					'_file' => __FILE__,
					'_function' => __FUNCTION__
					);
			$pdoerror = $error->log( $pdoerror, $err );

			return $pdoerror;
		}
		
		// No database errors, return the result
		
		else 
		{
			if ( mb_strtoupper( substr( $sql, 0, 6 ) ) == 'SELECT' || 
				 mb_strtoupper( substr( $sql, 0, 4 ) ) == 'SHOW' || 
				 mb_strtoupper( substr( $sql, 0, 8 ) ) == 'DESCRIBE' )
			{
				return $result->fetchAll( \PDO::FETCH_ASSOC );
			}
			else return $result;
		}
	}
	
/**
 * Get table rows
 * @param string $tbl The table to get data from
 * @param string $idcolumn Optional id column to restrict rows to return
 * @param string $idvalue Optional value column to restrict rows to return
 * @return array Return the data if successful, otherwise return an error array on failure
 */
	function get( $tbl, $idcolumn = '', $idvalue = '' )
	{
		// Initialise the query
		
		if ( !empty( $idcolumn ) ) $qry = "SELECT * FROM `{$tbl}` WHERE `{$idcolumn}`='{$idvalue}'";
		else $qry = "SELECT * FROM `{$tbl}`";
		
		// Get the result
		
		$result = $this->exec( $qry );
		
		// Return the result
		
		return $result;
	}

/**
 * Save an array of data to a table
 * @param string $tbl The table to save data to
 * @param array &$data The data to save to the table. The format should be: Array( 'column_name_1' => 'column_value_1', 'column_name_2' => 'column_value_2', ... )
 * @return array Return the data (with updated primary key value on insert) if successful, otherwise return an error array on failure
 */
	function save( $tbl, &$data )
	{
		global $error;

		// Make sure the table is enclosed in `` and check if a database was specified

		$tableParts = explode( ".", $tbl );
		if ( count( $tableParts ) > 1 ) $table = '`'.$tableParts[0].'`.`'.$tableParts[1].'`';
		else $table = '`'.$this->db.'`.`'.$tbl.'`';

		// Get column information for the specified table
		
		$columns = $this->describe( $tbl );
		
		if ( $error->iserror( $columns ) )
		{
			$pdoerror = Array(
				"_error" => TRUE,
				"_description" => "Unable to get columns for table: ".$tbl,
				"_file" => __FILE__,
				"_function" => __FUNCTION__
				);
			return $error->log( $pdoerror, $columns );
		}

		// Get primary key and check if if we should update or insert

		$upd = FALSE;
		$pk = Array();
		$ai = Array();

		foreach ($columns as $column)
		{
			// Look for primary keys

			if ( $column['Key'] == 'PRI' )
			{
				$pk[] = $column['Field'];
				if ( isset( $data[$column['Field']] ) && !empty( $data[$column['Field']] ) ) $upd = TRUE;
			}

			// Look for auto increment columns

			if ( $column['Extra'] == 'auto_increment' )
			{
				$ai[] = $column['Field'];
			}
		}

		// Check if we should insert or update and initialise relevant variables

		if ($upd === FALSE)
		{
			$fields = '';
			$values = '';
		}
		else
		{
			$values = '';
			$where = '';
		}

		// Run through columns and set values

		$first = TRUE;
		$firstWhere = TRUE;

		foreach ( $columns as $column)
		{
			// If the current column is a primary key

			if ( in_array( $column['Field'], $pk ) )
			{				
				// If we are inserting a new row and auto-increment is not enabled for the current column, we need to get the id of the column
				
				if ( ( $upd === FALSE ) && ( !in_array( $column['Field'], $ai ) ) )
				{
					// Check if we need to add commas to field names and values
					
					if ($first === FALSE)
					{
						$fields .= ',';
						$values .= ',';
					}
					else $first = FALSE;
					
					// Get the id for the next row
					
					$sql = "SELECT MAX({$column['Field']} AS id FROM {$tbl}";
					$id = $this->get( $sql );
					$id = $id[0]['id'] + 1;
					
					// Set field name and value

					$fields .= '`'.$column['Field'].'`';
					$values .= $id;
					
					// Set the column value in the dataset
					
					$data[$column['Field']] = $id;
				}

				// If we are updating a row, set the where clause for the primary key of the row to update

				if ( $upd === TRUE )
				{
					if ( $firstWhere === FALSE )
					{
						$where .= ' AND ';
					}
					else $firstWhere = FALSE;

					$where .= '`'.$column['Field'].'`='.$this->getSaveValue( $column, $data[$column['Field']] );
				}
			}

			// If the current column is not a primary key

			else if ( array_key_exists( $column['Field'], $data ) && !in_array( $column['Field'], $pk ) )
			{
				// If $upd === false then we are inserting a new row
				
				if ( $upd === FALSE )
				{
					if ($first === FALSE)
					{
						$fields .= ',';
						$values .= ',';
					}
					else $first = FALSE;

					$fields .= '`'.$column['Field'].'`';
					$values .= $this->getSaveValue( $column, $data[$column['Field']] );
				}
				
				// If $upd equals true then we are updating an existing row
				
				else
				{
					if ($first === FALSE)
					{
						$values .= ',';
					}
					else $first = FALSE;

					$values .= '`'.$column['Field'].'`='.$this->getSaveValue( $column, $data[$column['Field']] );
				}
			}
		}

		// Finish off sql query

		if ( $upd === FALSE ) $sql = "INSERT INTO {$table} ({$fields}) VALUES ({$values})";
		else $sql = "UPDATE {$table} SET {$values} WHERE {$where}";

		// Execute the query

		$result = $this->exec( $sql );
		
		// Check for errors

		if ( $error->iserror( $result ) )
		{
			$pdoerror = Array(
				"_error" => TRUE,
				"_description" => "Unable to save data to table: ".$table,
				"_query" => $sql,
				"_file" => __FILE__,
				"_function" => __FUNCTION__
				);
			return $error->log( $pdoerror, $result );
		}
		
		// No database errors
		
		else
		{
			// Check for an auto increment value

			if ( !empty( $ai ) && $upd === FALSE )
			{
				foreach ( $ai as $aiColumn )
				{
					$data[$aiColumn] = $this->con->lastInsertId( );
				}
			}
			
			// Return result

			return $data;
		}
	}

/**
 * Get the save value
 * @param array $column An array containing column information as per the DESCRIBE table_name query
 * @param array $data Contains the value of the column
 * @return mixed Return a value we can use in a sql statement. For example, add slashes to string data.
 */
	private function getSaveValue( $column, $data )
	{
		// Get the data type

		$typeArr = explode( "(", $column['Type'] );
		$type = $typeArr[0];

		$value = NULL;

		// Check if we have data for this column

		if ( !empty( $data ) )
		{
			if ( in_array( $type, $this->numericTypes ) ) $value = $data;
			else if ( in_array( $type, $this->stringTypes ) ) $value = "'".addslashes( $data )."'";
		}

		// If we have no data, check default and null values

		else
		{
			// Check if we have a default value

			if ( !empty( $column['Default'] ) )
			{
				if ( in_array( $type, $this->numericTypes ) ) $value = $column['Default'];
				else if ( in_array( $type, $this->stringTypes ) ) $value = "'".addslashes( $column['Default'] )."'";
			}

			// Check if the column cannot be null

			else if ( empty( $column['Default'] ) && $column['Null'] == 'NO' )
			{
				if ( in_array( $type, $this->numericTypes ) ) $value = 0;
				else if ( in_array( $type, $this->stringTypes ) ) $value = "''";
			}

			// If null is allowed, set value to null

			else if ( $column['Null'] == 'YES' ) $value = 'NULL';
		}

		// Return value

		return $value;
	}

/**
 * Delete an item based on a table name, primary key column and primary key value
 * @param string $tbl The name of the table to delete from
 * @param string $pk The name of the primary key column in the table
 * @param integer $pkval The value of the primary key column in the table. $pkval is expected to be an integer id.
 * @return mixed Return the result of the query
 */
	function delete( $tbl, $pk, $pkval )
	{
		global $error;
		
		// Enclose the table name and primary key in `` and check if a database was specified

		$tableParts = explode(".", $tbl);
		if ( count( $tableParts ) > 1 ) $tbl = '`'.$tableParts[0].'`.`'.$tableParts[1].'`';
		else $tbl = '`'.$tbl.'`';
		
		$pk = '`'.$pk.'`';
		
		if ( is_array( $pkval ) )
		{
			$pkval = implode( ',', $pkval );
			$sql = "DELETE FROM {$tbl} WHERE {$pk} IN ({$pkval})";
		}
		else
		{
			$sql = "DELETE FROM {$tbl} WHERE {$pk}={$pkval}";
		}
		
		// Delete the row
		
		$result = $this->exec( $sql );
		
		if ( $error->iserror( $result ) )
		{
			$pdoerror = Array(
				"_error" => TRUE,
				"_description" => "Unable to delete row ({$pk}): {$pkval} from '{$tbl}'",
				'_query' => $sql,
				"_file" => __FILE__,
				"_function" => __FUNCTION__
				);
			return $error->log( $pdoerror, $result );
		}
		else
		{
			// Return the result
			
			return $result;
		}
	}

/**
 * Create a new table in the database
 * @param string $tbl The name of the table to create
 * @param array $fields An array containg the column definitions
 * @param boolean $force Should we force table creation - this option will drop any existing table with the specified table name
 * @return mixed Return TRUE if table was created successfully or if table already exists, otherwise return an error array on failure
 */
	function createTable( $tbl, $fields, $force = FALSE )
	{
		global $error;

		// If the table already exists, return true

		if ( in_array( $tbl, $this->tables ) && $force == FALSE )
			return TRUE;

		// Check if database has been specified in the table name

		$dbparts = explode( '.', $tbl );
		if ( count( $dbparts ) > 1 )
		{
			$table = '`'.$dbparts[0].'`.`'.$dbparts[1].'`';
		}
		else $table = '`'.$this->db.'`.`'.$tbl.'`';

		// If we must force creating the new table, drop the existing table first

		if ( $force === TRUE )
		{
			$sql = "DROP TABLE ".$table;
			$result = $this->exec( $sql );

			// Check for errors

			if ( $error->iserror( $result ) )
			{
				$pdoerror = Array(
					"_error" => TRUE,
					"_description" => "Unable to drop database table ('".$table."').",
					'_query' => $sql,
					"_file" => __FILE__,
					"_function" => __FUNCTION__
					);
				$result = $error->log( $pdoerror, $result );
			}
		}

		if ( !in_array( $tbl, $this->tables ) || ( $force === TRUE ) )
		{

			$first = TRUE;

			// Create table statement

			$sql = "CREATE TABLE ".$table." (";

			// Add fields to the query

			foreach ( $fields as $field )
			{
				if ( $first == FALSE ) $sql .= ",";
				else $first = FALSE;

				// Add field to sql statement

				$sql .= "`".$field['field']."` ".strtoupper($field['type']);

				// Check if length is specified

				if ( array_key_exists( 'length', $field ) ) $sql .= "(".$field['length'].")";

				// Check if field must be null or not null

				if ( array_key_exists( 'null', $field ) && ( $field['null'] === TRUE ) ) $sql .= " NULL";
				else if ( array_key_exists( 'null', $field ) && ( $field['null'] === FALSE ) ) $sql .= " NOT NULL";

				// Check for default value

				if ( array_key_exists( 'default', $field ) )
				{
					if ( in_array( $field['type'], $this->numericTypes ) ) $sql .= " DEFAULT ".$field['default'];
					else if ( in_array( $field['type'], $this->stringTypes ) ) $sql .= " DEFAULT '".$field['default']."'";
				}

				// Check for auto increment value

				if ( array_key_exists( 'auto', $field ) && ( $field['auto'] === TRUE ) ) $sql .= " AUTO_INCREMENT";

				// Check for primary key

				if ( array_key_exists( 'key', $field ) && ( $field['key'] === 'primary' ) ) $sql .= " PRIMARY KEY";
			}

			$sql .= ");";

			// Execute the create table statement

			$result = $this->exec( $sql );

			// Check for errors

			if ( $error->iserror( $result ) )
			{
				$pdoerror = Array(
					"_error" => TRUE,
					"_description" => "Unable to create database table ('".$table."').",
					'_query' => $sql,
					"_file" => __FILE__,
					"_function" => __FUNCTION__
					);
				$result = $error->log( $pdoerror, $result );
			}
		}

		// The table already exists

		else $result = TRUE;

		// Return the result

		return $result;
	}

/**
 * Get a list of tables in the database - the list of tables is stored in $this->tables
 * @return none
 */
	function getTables( )
	{
		global $error, $config;

		$tables = $this->exec( "SHOW TABLES" );

		if ( $error->iserror( $tables ) )
		{
			$pdoerror = Array(
				'_error' => TRUE,
				'_description' => 'Unable to retrieve the list database tables.',
				'_query' => $tables,
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			$pdoerror = $error->log( $pdoerror, $tables );

			//if ($config->debug['enabled'] == TRUE) debug($pdoerror);
			
			return $pdoerror;
		}
		else
		{
			foreach ($tables as $row)
			{
				foreach ($row as $table) $this->tables[] = $table;
			}
		}
	}

/**
 * Describe the columns of a table
 * @param string $tbl The table to describe
 * @return array Return the column information for the requested table
 */
	function describe( $tbl )
	{
		global $error;

		// Make sure the table is enclosed in `` and check if a database was specified

		$tableParts = explode( ".", $tbl );
		if ( count( $tableParts ) > 1 ) $table = '`'.$tableParts[0].'`.`'.$tableParts[1].'`';
		else $table = '`'.$this->db.'`.`'.$tbl.'`';

		// Get column information for the specified table

		$columns = $this->exec( "DESCRIBE ".$table );
		
		if ( $error->iserror( $columns ) )
		{
			$pdoerror = Array(
				'_error' => TRUE,
				'_description' => 'Unable to retrieve the list of table columns for: '.$tbl,
				'_query' => $columns,
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			$pdoerror = $error->log( $pdoerror, $columns );

			// if ($config->debug['enabled'] == TRUE) debug($pdoerror);
			
			return $pdoerror;
		}
		else
		{
			return $columns;
		}
	}	

/**
 * Get the number of rows returned by the last query
 * @return string Return the the number of rows
 */
	function getNumRows( )
	{
		return $this->pdostatement->rowCount();
	}

//------------------------------------------------------------ [ dumpDB() ] ---
// Create a sql dump of the database
//-----------------------------------------------------------------------------
	function dump()
	{
		global $Paths;
		global $DBConfig;

		// Max execution time: 5 mins (600 secs)

		set_time_limit(600);

		// Generate file name

		$Filename = $DBConfig->DBName.'-'.date('Ymd-Hi', mktime()).'.sql';
		$SQLFile = $Paths->GetPath('Root', 'db/'.$Filename);
		$lineEnd = "\n";
		$Stats['TableCount'] = 0;
		$Stats['RowCount'] = 0;

		// Max buffer size: 50,000 Bytes (or whatever $this->MaxQryLength is set to)
		// Allows for overrun but must be written if size exceeds this limit.

		$MB = 50000;

		// Open dump file for writing

		$fp = @fopen($SQLFile,"w");
		if(!is_resource($fp)) return false;

		// Generate file header

		@fwrite($fp, "# MySql Dump".$lineEnd);
		@fwrite($fp, "# Host:".$DBConfig->DBHost.$lineEnd);
		@fwrite($fp, "# -------------------------------------------------".$lineEnd);

		$sql = "SELECT VERSION()";
		$handle = $this->query($sql);
		$row = mysqli_fetch_array($handle,MYSQL_NUM);
		@fwrite($fp, "# Server version ".$row[0].$lineEnd.$lineEnd);
		@fwrite($fp, "/*!40101 SET NAMES '".$this->CharsetName."' COLLATE '".$this->CollationName."' */;".$lineEnd.$lineEnd);

		// Run through tables in the database

		$Tables = Array();

		$sql = "SHOW Tables";
		$handle = $this->query($sql);

		while ($row = mysqli_fetch_array($handle,MYSQL_NUM)) $Tables[]="`".$row[0]."`";
		$Stats['TableCount'] = count($Tables);

		for ($j = 0; $j < count($Tables); $j++)
		{
			// Table structure

			$sql = "SHOW CREATE TABLE ".$Tables[$j];
			$handle = $this->query($sql);
			$row = mysqli_fetch_array($handle,MYSQLI_NUM);

			@fwrite($fp, "#".$lineEnd);
			@fwrite($fp, "# Table structure for table ".$Tables[$j].$lineEnd);
			@fwrite($fp, "#".$lineEnd.$lineEnd);

			@fwrite($fp, "DROP TABLE IF EXISTS ".$Tables[$j].";".$lineEnd);
			@fwrite($fp, $row[1].";".$lineEnd.$lineEnd.$lineEnd);

			// Table data

			@fwrite($fp, "#".$lineEnd);
			@fwrite($fp, "# Dumping data for table ".$Tables[$j].$lineEnd);
			@fwrite($fp, "#".$lineEnd.$lineEnd);

			$temp_sql = "INSERT INTO ".$Tables[$j];

			// Get column names

			$sql = "SHOW COLUMNS FROM ".$Tables[$j];
			$handle = $this->query($sql);

			$fields = array();
			$fieldInfo = array();
			$fi = 0;

			while($row = mysqli_fetch_array($handle,MYSQLI_NUM)) {
				$fields[] = '`'.$row[0].'`';
				$fieldInfo[$fi] = $row;
				$fi = $fi+1;
			}//while

			$temp_sql.=' ('.@implode(',',$fields).') VALUES '.$lineEnd;
			$insert_sql = $temp_sql;

			// Add actual data

			$sql = "SELECT * FROM ".$Tables[$j];
			$handle = $this->query($sql);

			$FirstRow = TRUE;

			while($row = mysqli_fetch_array($handle,MYSQLI_NUM)) {

				if ($FirstRow === TRUE) {
					$temp_sql = $temp_sql."(";
					$FirstRow = FALSE;
				}//if
				else $temp_sql = $temp_sql.",".$lineEnd."(";

				$FirstCol = TRUE;

				foreach($row as $key => $value) {

					$value = stripcslashes(stripcslashes($value));
					$value = trim($value);
					$row[$key] = mysqli_real_escape_string($this->Link, $value);

					if (substr($fieldInfo[$key][1],0,3)=='int') {
						if (empty($row[$key])) $row[$key] = (string) '0';
					}
					else $row[$key] = "'".$row[$key]."'";

					if ($FirstCol === TRUE) {
						$temp_sql = $temp_sql.$row[$key];
						$FirstCol = FALSE;
					}//if
					else {
						$temp_sql = $temp_sql.",".$row[$key];
					}//else

				}//foreach

				$temp_sql = $temp_sql.")";

				// When the buffer gets full, write the content and start a new INSERT query

				if (strlen($temp_sql) > $MB) {
					@fwrite($fp, $temp_sql.';'.$lineEnd);
					$temp_sql = $insert_sql;
					$FirstRow = TRUE;
				}

				$Stats['RowCount'] = $Stats['RowCount'] + 1;

			}//while

			@fwrite($fp, $temp_sql.';'.$lineEnd.$lineEnd);

		}//for

		@fclose($fp);

		return $Stats;

	}//dump
	
}

/* -------------------------------------------------------------------------
 * Notes
 *
 * When creating tables, use the following format for the fields array:

	$fields = Array(
		'id' => Array( 'field' => 'id_field', 'type' => 'int', 'length' => '12', 'key' => 'primary', 'null' => FALSE, 'auto' => TRUE ),
		'column' => Array( 'field' => 'field_name', 'type' => 'varchar', 'length' => '100', 'null' => FALSE, 'default' => 'default value' )
		);

 * ------------------------------------------------------------------------- */

?>