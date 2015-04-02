<?php

namespace lib;

/**
 * The Session Class
 */
class session
{
	/**
	 * The session object constructor
	 * @param boolean $nostart If set to false, the session will be started. If set to true, the session will not be started
	 */
	function __construct( $nostart = FALSE )
	{
		// Start the session

		if ( $nostart == FALSE ) session_start( );
	}

	/**
	 * Start the session
	 */
	function start( )
	{
		// Start the session

		session_start( );
	}

	/**
	 * Destroy the session
	 */
	function destroy( )
	{
		// Start the session

		session_destroy( );
	}

	/**
	 * Save and stop the session without destroying session data
	 */
	function save( )
	{
		// Save the session

		session_write_close( );
	}

	/**
	 * Get the value of a session variable
	 * @param string $var The name of the variable to get
	 * @return mixed Return the value of the variable
	 */
	function get( $var )
	{
		// If the variable exists, return it

		if ( array_key_exists( $var, $_SESSION ) ) return $_SESSION[$var];
	}

	/**
	 * Set session data based on an a variable name and a value
	 * @param string $var A string containing the name of the session variable
	 * @param mixed $var A mixed type variable containing the value to set for the session variable
	 */
	function set( $var, $val )
	{
		// Set the session variable

		$_SESSION[$var] = $val;
	}

	/**
	 * Set session data based on an array of data
	 * @param array $data An array containing the data to set. The array must be in the following format: Array( 'var' => 'val' )
	 */
	function setarr( $data )
	{
		// If the data is an array

		if ( is_array( $data ) )
		{
			// Run through the array and assign data to the _SESSION variable

			foreach ( $data as $var => $value )
			{
				$_SESSION[$var] = $value;
			}
		}
	}

	/**
	 * Remove a session variable
	 * @param string $var The name of the session variable to delete
	 * @return none
	 */
	function del( $var )
	{
		unset( $_SESSION[$var] );
	}
}

?>