<?php

namespace lib;

/**
 * The Site Class
 */
class site
{
/**
 * The table in the database where sites are stored
 */
	var $table;

/**
 * The columns of the database table
 */
	var $columns;

/**
 * Details of the current site we are viewing
 */
	var $site;

/**
 * Describes how we found the current site
 * Can be: default, url, domain
 */
	var $source;

/**
 * The site constructor
 */
	function __construct()
	{
		global $db;

		// Table name in the database

		$this->table = 'site';

		// Columns for the site table

		$this->columns = Array(
			'id' => Array( 'field' => 'id', 'type' => 'int', 'length' => '12', 'key' => 'primary', 'null' => FALSE ),	// ID of the site
			'name' => Array( 'field' => 'name', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),				// The name of the site
			'default' => Array( 'field' => 'default', 'type' => 'tinyint', 'length' => '1', 'null' => TRUE ),			// Is this the default site
			'task' => Array( 'field' => 'default_task', 'type' => 'int', 'length' => '12', 'null' => TRUE ),			// The default task for a site
			'layout' => Array( 'field' => 'default_layout', 'type' => 'int', 'length' => '12', 'null' => TRUE ),		// The default layout for a site
			'domain' => Array( 'field' => 'domain', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),			// The domain associated with a site
			'meta' => Array( 'field' => 'meta_id', 'type' => 'int', 'length' => '12', 'null' => TRUE ),			// The domain associated with a site
			'created' => Array( 'field' => 'created', 'type' => 'varchar', 'length' => '11', 'null' => TRUE ),			// When the site was created
			'modified' => Array( 'field' => 'modified', 'type' => 'varchar', 'length' => '11', 'null' => TRUE )			// When the site details were last modified
			);
	}

/**
 * Get a site or array of sites. If $id is empty, get all sites.
 * @param integer|array $id The id or array of ids of sites to get
 * @param string $orderby The name of the column to order by as per $this->columns
 * @param string $orderdir The direction to order by - can be: ASC or DESC
 * @return array An array of site details
 */
	function get( $id = 0, $orderby = 'name', $orderdir = 'ASC' )
	{
		global $db, $meta, $error;
		
		$orderby = $this->columns[$orderby]['field'];

		// If no id was specified, get all sites and their meta data

		if ( empty( $id ) )
		{
			$sql = "SELECT *, `site`.`id` AS `site_id` FROM `{$this->table}` INNER JOIN `{$meta->table}` ON `{$this->table}`.`{$this->columns['meta']['field']}`=`{$meta->table}`.`{$meta->columns['id']['field']}` ORDER BY `{$this->table}`.`{$orderby}` {$orderdir}";
		}
		
		// If $id is an array, get all sites specified in the array
		
		else if ( is_array( $id ) )
		{
			$id = implode( ',', $id );
			$sql = "SELECT *, `site`.`id` AS `site_id` FROM `{$this->table}`
					INNER JOIN `{$meta->table}` ON `{$this->table}`.`{$this->columns['meta']['field']}`=`{$meta->table}`.`{$meta->columns['id']['field']}`
					WHERE `{$this->table}`.`{$this->columns['id']['field']}` IN ({$id})
					ORDER BY `{$this->table}`.`{$orderby}` {$orderdir}";
		}
		
		// If $id is numeric, load the site specified by $id
		
		else if ( is_numeric( $id ) )
		{
			$sql = "SELECT *, `site`.`id` AS `site_id` FROM `{$this->table}`
					INNER JOIN `{$meta->table}` ON `{$this->table}`.`{$this->columns['meta']['field']}`=`{$meta->table}`.`{$meta->columns['id']['field']}`
					WHERE `{$this->table}`.`{$this->columns['id']['field']}`={$id}
					ORDER BY `{$this->table}`.`{$orderby}` {$orderdir}";
		}

		// Get the data

		$result = $db->exec( $sql );

		// Check for database error

		if ( $error->iserror( $result ) )
		{
			$err = Array(
				'_error' => TRUE,
				'_description' => 'Error retrieving site with id: '.$id,
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			return $error->log( $err, $result );
		}
		
		// No database error
		
		else
		{
			foreach ($result as $key => $theresult)
			{
				$result[$key]['id'] = $theresult['site_id'];
			}
			
			return $result;
		}
	}
	
/**
 * Load the site for the current request
 */
	function load( )
	{
		// See if the site was specified in the url

		$loaded = $this->loadurl( );

		// If the site was not specified in the URL, try get the site by domain name

		if ( $loaded == FALSE )
		{
			// Try get the site by domain name

			$loaded = $this->loaddomain( );

			// If no sites are linked to the current domain

			if ( $loaded == FALSE )
			{
				// Load the default site

				$loaded = $this->loaddefault( );

				// If no site could be loaded, log and display an error and exit

				if ( $loaded == FALSE )
				{
					$err = Array(
						'_error' => TRUE,
						'_description' => 'Could not load site details from id, domain, url or default.',
						'_file' => __FILE__,
						'_function' => __FUNCTION__
						);
					$err = $error->log( $err, $val );

					if ($config->debug['enabled'] == TRUE) debug($err);
					die();
				}
			}
		}
	}

/**
 * Load site details based on the URL
 * @return boolean Return true if successful, false on failure
 */
	function loadurl( )
	{
		global $paths, $url, $error, $config, $db;

		// Get the current request

		$request = $paths->getrequest( );

		// Check if the first element is a site

		if ( !empty( $request ) )
		{
			// Get the request in an array

			$request = explode( '/', $request );

			$details = $url->object( $request[0], $this->table, $this->columns['id']['field'] );

			if ( is_array( $details ) && array_key_exists( '_error', $details ) )
			{
				if ( $details['_code'] == 2 ) return FALSE;
				else
				{
					$err = Array(
						'_error' => TRUE,
						'_description' => 'There was an error while retrieving the site id.',
						'_file' => __FILE__,
						'_function' => __FUNCTION__
						);
					$err = $error->log( $err, $details );

					if ( $config->debug['enabled'] == TRUE ) debug( $err );

					return FALSE;
				}
			}

			// No db errors

			else
			{
				// If we have a site, set it

				if ( !empty( $details ) )
				{
					$this->site = $details;
					//$this->site['url'] = $request[0];
					$this->source = 'url';

					return TRUE;
				}

				// If the site was not found, return FALSE

				else
				{
					return FALSE;
				}
			}
		}

		// No request was specified in the URL

		else
		{
			return FALSE;
		}
	}

/**
 * Look for a site linked to the current domain
 * @return boolean Return true if successful, otherwise return false
 */
	function loaddomain( )
	{
		global $paths, $db, $error, $config, $url;

		// See if we have a site by domain name

		$domain = $paths->get( 'domain' );

		$sql = "SELECT * FROM `{$this->table}` 
				INNER JOIN `{$url->table}` ON `{$this->table}`.`{$this->columns['id']['field']}`=`{$url->table}`.`{$url->columns['id']['field']}` AND `{$url->table}`.`{$url->columns['table']['field']}`='{$this->table}'
				WHERE `{$this->columns['domain']['field']}`='{$domain}'";
		$site = $db->exec( $sql );

		// Check for db errors

		if ( is_array( $site ) && array_key_exists( '_error', $site ) )
		{
			$err = Array(
				'_error' => TRUE,
				'_description' => 'There was a database error while looking for the site by domain name: '.$domain,
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			$err = $error->log( $err, $site );
			if ( $config->debug['enabled'] == TRUE ) debug( $err );
			return FALSE;
		}

		// No db errors

		else
		{
			// If we have a site, set it as the current site

			if ( !empty( $site ) )
			{
				$this->site = $site[0];
				$this->source = 'domain';

				return TRUE;
			}

			// No site was found by domain name, return false

			else
			{
				return FALSE;
			}
		}
	}

/**
 * Load the default site
 * @return boolean Return true on success, return false on failure
 */
	function loaddefault( )
	{
		global $db, $error, $config, $url;

		// Get the default site

		$sql = "SELECT * FROM `{$this->table}` 
				INNER JOIN `{$url->table}` ON `{$this->table}`.`{$this->columns['id']['field']}`=`{$url->table}`.`{$url->columns['foreignid']['field']}` AND `{$url->table}`.`{$url->columns['table']['field']}`='{$this->table}'
				WHERE `{$this->columns['default']['field']}`=1";
		$site = $db->exec( $sql );
		
		//debug($site);

		// Check for db errors

		if ( is_array( $site ) && array_key_exists('_error', $site) )
		{
			$err = Array(
				'_error' => TRUE,
				'_description' => 'There was a database error while loading the default site.',
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			$err = $error->log( $err, $site );
			if ( $config->debug['enabled'] == TRUE ) debug( $err );
			return FALSE;
		}

		// No db errors

		else
		{
			// If we have a site, set it as the current site

			if ( !empty( $site ) )
			{
				$this->site = $site[0];
				$this->source = 'default';

				return TRUE;
			}

			// No default site has been set in the db

			else
			{
				$err = Array(
					'_error' => TRUE,
					'_description' => 'No site was specified, no site could be matched by domain name and no default site has been set.',
					'_file' => __FILE__,
					'_function' => __FUNCTION__
					);
				$err = $error->log( $err );
				if ( $config->debug['enabled'] == TRUE ) debug( $err );
				return FALSE;
			}
		}
	}
}

?>