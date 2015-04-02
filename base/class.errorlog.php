<?php

namespace base;

/**
 * Error Handling Class
 */
class error
{
/**
 * Should we log all errors or only the last error
 */
	var $logAll = FALSE;

/**
 * An array of all errors
 */
	var $errors = Array();
	
/**
 * The last error passed to the class
 */
	var $lastError = Array();
	
/**
 * Show all PHP errors
 */
	var $showAllPHPErrors = FALSE;
	
/**
 * Initialise error reporting
 */
	function __construct( )
	{
		// Report all PHP errors
		
		if ( $this->showAllPHPErrors === TRUE ) error_reporting(-1);
	}

/**
 * Log an error.
 * $error = Array ( '_error' => 'Error description', '_function' => __FUNCTION__, '_file' => __FILE__ )
 * @param array $error The error that was generated.
 * @param array $stack An array stack containing previous errors. The stack is appended to the end of the error array.
 * @return array Return the error array with the stack in the '_stack' key of the error array.
 */
	function log ( $error, $stack = Array() )
	{
		// Log the error to the internal array

		if ( $this->logAll === TRUE ) $this->errors[] = $error;
		
		// TODO: Add support for logging to file or database

		// Add the stack to the current error

		if ( !empty( $stack ) ) $error['_stack'] = $stack;

		// Set the 'last error' array

		$this->lastError = $error;

		// Return the error

		return $error;
	}

/**
 * Check if an object is an error
 * $error = Array ( '_error' => 'Error description', '_function' => __FUNCTION__, '_file' => __FILE__ )
 * @param array $error The error that was generated.
 * @return boolean Return true if object is an error, return false if not an error.
 */
	function iserror( $error = Array() )
	{
		// Check if supplied object is an array and has an '_error' array key and $error['_error'] is TRUE
		
		if ( is_array( $error ) && array_key_exists ( '_error', $error ) && ( $error['_error'] === TRUE ) )
		{
			// Return TRUE because object is an error
			
			return TRUE;
		}
		
		// Object is not an error, return FALSE
		
		return FALSE;
	}

/**
 * Handle an error
 * $error = Array ( '_error' => 'Error description', '_function' => __FUNCTION__, '_file' => __FILE__ )
 * @param array $error The error that was generated.
 * @return boolean Return true if object is an error, return false if not an error.
 */
	function handle( $error = Array() )
	{
		// Check if supplied object is an array and has an '_error' array key and $error['_error'] is TRUE
		
		if ( $this->iserror( $error ) )
		{
			// Display a debug message (debug mode must be enabled)
			
			// debug( $error );
			
			debug ( $this->tostring( $error ), "Error (see the stack below):" );
			
			// Return TRUE because object is an error
			
			return TRUE;
		}
		
		// Object is not an error, return FALSE
		
		return FALSE;
	}

/**
 * Convert an error to a string
 * $error = Array ( '_error' => 'Error description', '_function' => __FUNCTION__, '_file' => __FILE__ )
 * @param array $error The error that was generated.
 * @return boolean Return true if object is an error, return false if not an error.
 */
	function tostring( $error = Array(), $first = TRUE )
	{
		if ( $this->iserror( $error ) )
		{
			$errorstring = "";
			
			if ( $first == TRUE )
				$first = FALSE;
			else
				$errorstring .= "\n";
			
			$errorstring .= "'".$error['_description']."' in '".$error['_file']."': ".$error['_function']."()";
			
			foreach ( $error as $key => $message )
			{
				if ( $key != "_file" && $key != "_function" && $key != "_description" && $key !="_stack" && $key != "_error" ) $errorstring .= "\n    ".$key.": ".$message;
			}
			
			if ( !empty( $error['_stack'] ) )
			{
				$stack = $this->tostring( $error['_stack'], FALSE );
				return $errorstring.$stack;
			}
			else
			{
				return $errorstring;
			}
		}
		else
		{
			foreach( $error as $key => $message )
			{
				if ( !is_numeric ( $key ) )
					$errorstring .= "\n        ".$key.": ".$message;
				else
					$errorstring .= "\n        ".$message;
			}
		
			return $errorstring;
		}
	}
}

/**
 *  An example of what an error array should look like:
 *
 * $sampleError = Array(
 * 	'_error' => TRUE,
 * 	'_description' => 'Error description',
 * 	'_file' => __FILE__,
 * 	'_function' => __FUNCTION__
 * 	);
 */

?>