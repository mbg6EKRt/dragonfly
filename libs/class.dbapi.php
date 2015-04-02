<?php

namespace lib;

/**
 * The Site Class
 */
class dbapi
{

/**
 * Get the result for the current request
 */
	function getrequest()
	{
		if ( isset( $_GET['qry'] )) $request = $_GET['qry'];
		else if ( isset( $_POST['qry'] )) $request = $_POST['qry'];
		
		if ( isset( $request ) )
		{
			global $db;
			
			if ( empty( $db ) ) $db = new \lib\db();
			
			$request = json_decode( base64_decode( $request ), TRUE );
			
			switch( $request['action'] )
			{
				case 'exec':
					$result = $db->exec( $request['query'] );
				break;
				
				case 'get':
					if ( !isset( $request['idcolumn'] ) ) $result = $db->get( $request['table'] );
					else $result = $db->get( $request['table'], $request['idcolumn'], $request['idvalue'] );
				break;
				
				case 'save':
					$result = $db->save( $request['table'], $request['data'] );
				break;
			}
			
			echo base64_encode( json_encode( $result ) );
		}
	}
}

?>