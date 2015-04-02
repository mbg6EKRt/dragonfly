<?php

namespace lib;

/**
 * The List Wrapper Class
 */
class listwrapper
{
/**
 * Contains the data for the list
 */
	var $data;
	
/**
 * Contains the path to the item template
 */
	var $item_template;
	
/**
 * Contains list options
 */
	var $options;
	
/**
 * The total number of rows in the list
 */
	var $count;

/**
* The list wrapper constructor
*/
	function __construct( )
	{
		// Set default options
		
		$this->options = Array
		(
			'mode' => 'list', // Can be 'list' or 'thumbs'
			
			'numperpage' => 20, // The number of items per page
			'numpercolumn' => 4, // The number of columns per row (only active when in 'thumbs' mode)
			'page' => 1, // The default page to show
			
			'css_container' => 'listwrapper_container', // The CSS class to use for the table containing the list
			'css_item' => 'listwrapper_item', // The CSS class to use
			'css_item_alt' => 'listwrapper_item_alt', // The CSS class to use for alternating rows/columns
			'css_item_hover' => 'listwrapper_item_hover', // The CSS class to use when the user hovers over a row/column
			
			'callback' => '', // The callback function to use when processing data for display (can be: '$object->$function' or 'class::function' or 'function')
		);
		
		// Set the current page number
		
		if ( isset( $_GET['page'] ) )
		{
			$this->options['page'] = $_GET['page'];
		}
		
		// Make sure the page number is not below 1
		
		if ( $this->options['page'] < 1 ) $this->options['page'] = 1;
		
		// Set the page number to use for database queries
		
		$this->options['realpage'] = $this->options['page'] - 1;
	}
	
/**
* Wrap the data using the row and list layouts
* @param string|array $data The data to be wrapped (string=sql|array=dataset)
* @param string $item_template The path to the item template
* @param string $list_template The path to the list template
* @param array $options Specify custom list options here
*/
	public function get( $data, $item_template, $options = Array( ) )
	{
		// Set layout
		
		$this->item_template = file_get_contents( $item_template );
		unset( $item_template );
		
		// Set options
		
		if ( !empty( $options ) ) $this->options = array_merge( $this->options, $options );
		unset( $options );
		
		// Set data
		
		if ( is_string( $data ) )
		{
			$this->data = $this->get_sql( $data );
		}
		else if ( is_array( $data ) )
		{
			$this->data = $data;
			$this->count = count( $data );
		}
		
		unset( $data );
		
		// Get the list
		
		return $this->get_list( );
	}
	
/**
* Get the data from a sql query
* @param string $data The SQL query to execute
*/
	private function get_sql( $sql )
	{
		global $db;
		
		// Get the row count
		
		$this->count = $this->get_count( $sql );
			
		// Get the start limit for the db query
		
		$start = $this->options['realpage'] * $this->options['numperpage'];
		$this->options['startnum'] = $start + 1;
		$this->options['endnum'] = $start + $this->options['numperpage'];
		$this->options['totalpagesnum'] = ceil( $this->count / $this->options['numperpage'] );
		
		// Set the limit for the db query
		
		$sql = $sql." LIMIT ".$start.",".$this->options['numperpage'];
		
		// Get the data
		
		$returnArr = $db->exec( $sql );
		
		$this->options['realcount'] = $db->getNumRows();
		
		if ( $this->options['realcount'] < $this->options['numperpage'] )
		{
			$this->options['endnum'] = $start + $this->options['realcount'];
		}
		
		return $returnArr;
	}
	
/**
* Get the total number of rows from a sql query
* @param string $sql The SQL query to execute
*/
	private function get_count( $sql )
	{
		global $db;
		
		// Get the select part and the rest of the query separately
		
		$parts = explode( ' FROM ', $sql );
		
		// Get the select part
		
		$parts_0 = explode( 'SELECT ', $parts[0] );
		$parts_1 = explode( ' ', $parts[1] );
		$select = $parts_0[1];
		
		// Get the rest of the query
		
		$table = $parts[1];
		
		// Add COUNT(*) to the select part of the query and get the count
		
		$sql = 'SELECT '.$select.', COUNT(*) AS count FROM '.$table.' LIMIT 0,1';
		$count = $db->exec( $sql );
		
		return $count[0]['count'];
	}
	
/**
* Build the list
*/
	private function get_list( )
	{
		$count = 1;
		$rowcss = $this->options['css_item'];

		// Open the list container

		$retStr = '<div';

		if ( !empty( $this->options['css_container'] ) ) $retStr .= ' class="'.$this->options['css_container'].'"';

		$retStr .= '>';

		// Run through rows of data

		foreach ( $this->data as $rownum => $row )
		{
			// Execute the callback function on the row

			if ( !empty( $this->options['callback'] ) ) $row = $this->get_callback( $row );

			// Create a new list item

			$retStr .= '<div';

			// Get the css class to use

			if (!empty($rowcss))
			{
				$retStr .= ' class="'.$rowcss.'"';
				$rowcss = $this->get_rowcss( $rowcss );
			}

			$retStr .= '>';
			
			// Get the html for the current list item
			
			$retStr .= $this->get_template( $row );
			$retStr .= '</div>';
			
			if ( $count == $this->options['numperpage'] ) break;
			$count++;
		}

		// Close the container

		$retStr .= '</div>';

		// Return the list

		return $retStr;
	}

/**
 * Replace columns in the template with the corresponding column in the data array
 * @param array $data The array of columns and values
 * @return string Return the final template with columns replaced by data values
 */
	private function get_template( $data, $source = 'item_template' )
	{
		global $paths;

		$tpl = $this->$source;
		foreach ( $data as $column => $value ) $tpl = str_replace('{{'.$column.'}}', $value, $tpl);

		return $tpl;
	}

/**
 * Execute a callback function on a row of data before rendering the row or column
 * @param array $data The data to send to the callback function - all data is serialized
 * @return array Returns the data returned from the callback function
 */
	private function get_callback( $data )
	{
		// Make sure a callback function was specified. If not, return unmodified $data
		
		if ( empty( $this->options['callback'] ) ) return $data;
		
		// Check if we are calling a function in an instantiated object
		
		if ( stristr( $this->options['callback'], '->' ) )
		{
			$parts = explode( '->', $this->options['callback'] );
			
			$object = $parts[0];
			$function = $parts[1];
			
			global $$object;
			
			return $$object->$function( $data );
		}
		
		// Check if we are calling a function in a class
		
		else if ( stristr( $this->options['callback'], '::' ) )
		{
			$parts = explode( '::', $this->options['callback'] );
			
			$object = $parts[0];
			$function = $parts[1];
			
			// global $$object;
			
			return $object::$function( $data );
		}
		
		// We are executing a normal function
		
		else
		{
			$function = $this->options['callback'];

			return $function( $data );
		}
	}

/**
 * Toggle between alternate css classes (for alternating rows)
 * @param string $curcss The current css class
 * @return string Return the CSS class based on the values of $this->rowcss and $this->altrowcss and $curcss
 */
	private function get_rowcss( $curcss = '' )
	{
		if ( !empty( $this->options['css_item'] ) )
		{
			if ( empty( $this->options['css_item_alt'] ) ) return $this->options['css_item'];
			else
			{
				if ( $curcss == $this->options['css_item'] ) return $this->options['css_item_alt'];
				else return $this->options['css_item'];
			}
		}
	}
}

?>
