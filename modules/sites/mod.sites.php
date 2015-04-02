<?php

namespace mod\b7a01bbc136a8b8c8ee85ae03743e61456513e66;

/**
 * The Sites module
 */
class sites
{
	const MOD_NAMESPACE = 'b7a01bbc136a8b8c8ee85ae03743e61456513e66';

/**
 * The main function controls which task we should execute
 * @param array $taskinfo An array containing module and task information
 */
	function start( $context )
	{
		// Set the module and task information
		
		$this->context = $context;
		unset( $context );

		// Check which task we are executing

		switch ($this->context->task['task'])
		{
			// Display the admin list

			case 'AdminList':
				$this->adminlist( );
			break;

			// Add an item

			case 'add':
				$this->add( );
			break;

			// Edit an item

			case 'edit':
				$this->edit( );
			break;

			// Save an item

			case 'save':
				$this->save( );
			break;

			// Delete an item

			case 'delete':
				$this->delete( );
			break;
		}
	}

/**
 * Display the administrator list - allows an admin to view, edit and delete items
 */
	function adminlist()
	{
		global $db, $site, $paths, $meta, $url;

		// List query

		$sql = "SELECT * FROM `{$site->table}`
				LEFT JOIN `{$meta->table}` ON `{$site->table}`.`{$site->columns['meta']['field']}`=`{$meta->table}`.`{$meta->columns['id']['field']}`
				LEFT JOIN `{$url->table}` ON `{$site->table}`.`{$site->columns['id']['field']}`=`{$url->table}`.`{$url->columns['foreignid']['field']}`";
		if ( !empty( $_GET['search'] ) ) 
		{
			$sql .= " WHERE `{$site->table}`.`{$site->columns['name']['field']}` LIKE '%{$_GET['search']}%'";
		}
		$sql .= " ORDER BY {$site->columns['name']['field']} ASC";
		
		// If search param is set, don't show the search box
		
		if ( isset( $_GET['search'] ) ) $data['show_search'] = 'no';
		else $data['show_search'] = 'yes';
				
		// List templates
		
		$item_template = $paths->get( 'module', 'sites/html/adminlistrow.html' );
		
		// List Wrapper
		
		$list = new \lib\listwrapper();
		
		// Set list options
		
		$options = Array(
			'callback' => '\\'.__NAMESPACE__.'\\sites::__callback_adminList' // The callback function to use when processing data for display
		);

		$data['list'] = $list->get( $sql, $item_template, $options );
		
		// Add some data that we gonna use in the template
		
		$data['count'] = $list->count;
		$data['pagenum'] = $list->options['page'];
		$data['startnum'] = $list->options['startnum'];
		$data['endnum'] = $list->options['endnum'];
		$data['totalpagesnum'] = $list->options['totalpagesnum'];
		$data['realcount'] = $list->options['realcount'];

		$data['adminlist'] = $url->getsiteurl( sites::MOD_NAMESPACE, 'AdminList', '', $paths->view );

		// Render the page

		echo process( $paths->get( "module", "{$this->context->module['folder']}/html/adminlist.html" ), $data );
	}

/**
 * Admin list data callback function for the list wrapper
 * @param array $data A row of data from the database
 * @return array Return the processed array of data
 */
	public static function __callback_adminList( $data )
	{
		global $paths, $url;

		// Process existing data

		if ( $data['default'] == 1 ) $data['default'] = 'Yes';
		$data['created'] = date('Y-m-d', $data['created']);
		if ( empty( $data['domain'] ) ) $data['domain'] = 'No domain';
		
		// Add some data that we gonna use in the template
		
		$data['editajaxurl'] = $url->getsiteurl( sites::MOD_NAMESPACE, 'edit', $data['url'], $paths->view );
		$data['deleteajaxurl'] = $url->getsiteurl( sites::MOD_NAMESPACE, 'delete', $data['url'], $paths->view );
		$data['rooturl'] = $paths->get( 'rooturl' );

		// Return row

		return $data;
	}

/**
 * Display the add form
 */
	function add()
	{
		global $db, $module, $task, $theme, $paths, $user, $url;

		// Form title and url

		$data['formTitle'] = 'Add Site';
		$data['formurl'] = $url->getsiteurl( sites::MOD_NAMESPACE, 'save', '', $paths->view );

		// Get modules and tasks

		$data['modules'] = $module->get( );
		$data['tasks'] = $task->get( );

		// Get themes and layouts

		$data['themes'] = $theme->getThemes( );
		$data['layouts'] = $theme->getLayouts( );
		
		// Get the permissions form
		
		$data['permissionsform'] = $user->permissionsform( 0, 0, 0, 0, 0, 0, '', '', FALSE );

		// Form html template

		$form = dirname( __FILE__ ).'/html/addeditsite.html';

		// Get the html

		echo process( $form, $data );
	}

/**
 * Display the edit form
 */
	function edit()
	{
		global $db, $site, $module, $task, $theme, $paths, $url, $meta, $user, $error;

		// Get the site id

		$params = explode( '/', $paths->getparams( ) );
		
		$siteid = $url->objectid( $params[0], $site->table, $site->columns['id']['field'] );
		
		// Get the site details

		$sql = "SELECT *, site.id as site_id FROM `{$site->table}`
				INNER JOIN `{$meta->table}` ON `{$meta->table}`.`{$meta->columns['id']['field']}`=`{$site->table}`.`{$site->columns['meta']['field']}`
				INNER JOIN `{$url->table}` ON `{$url->table}`.`{$url->columns['foreignid']['field']}`=`{$site->table}`.`{$site->columns['id']['field']}`
				WHERE `{$site->table}`.`{$site->columns['id']['field']}`={$siteid}";
		$data = $db->exec( $sql );
		$data = $data[0];
		$data['id'] = $data['site_id'];
		
		// Get selected modules

		$sql = "SELECT * FROM `site__module` WHERE `site_id`={$siteid}";
		$tmp = $db->exec( $sql );

		$selectedModules = Array();

		foreach ( $tmp as $tmprow )
		{
			$selectedModules[] = $tmprow['module_id'];
		}

		// Form html template

		$form = dirname(__FILE__).'/html/addeditsite.html';

		// Form title and url

		$data['formTitle'] = 'Edit Site: '.$data['name'];
		$data['formurl'] = $url->getsiteurl( sites::MOD_NAMESPACE, 'save', '', 'ajax' );

		// Get modules and tasks

		$data['modules'] = $module->get( );
		$data['tasks'] = $task->get( );

		// Set selected modules

		foreach ( $data['modules'] as $rowkey => $modrow )
		{
			if ( in_array( $modrow['id'], $selectedModules ) )
			{
				$data['modules'][$rowkey]['selected'] = 1;
			}
			else
			{
				$data['modules'][$rowkey]['selected'] = 0;
			}
		}

		// Get themes and layouts

		$data['themes'] = $theme->getThemes( );
		$data['layouts'] = $theme->getLayouts( );
		
		// Get the permissions form
		
		$data['permissionsform'] = $user->permissionsform( $siteid, 0, 0, 0, 0, 0, '', $data['access'], FALSE );

		// Get the html
		
		echo process( $form, $data );
	}

/**
 * Save a site
 */
	function save( )
	{
		global $db, $url, $meta, $site, $user, $paths;
		
		// Load the site admin library
		
		require_once( dirname( __FILE__ ).'/lib/lib.siteadmin.php' );
		$lib = '\\'.__NAMESPACE__.'\\sitesadmin';
		$adminlib = new $lib();
		
		// Save the site logo
		/*
		$_POST['logo_file_id'] = $adminlib->savelogo( );
		if ( $_POST['logo_file_id'] == FALSE ) unset( $_POST['logo_file_id'] );
		*/
		
		// Save the meta data for the site
		
		$_POST['meta_id'] = $adminlib->savemeta( $_POST );
		
		$isNew = true;
		
		// Set the id and dates in the _POST array

		if ( isset( $_POST['id'] ) && !empty( $_POST['id'] ) )
		{
			$isNew = false;
			$_POST['modified'] = time( );
		}
		else
		{
			$isNew = true;
			$_POST['created'] = time( );
			$_POST['folder'] = $adminlib->initSiteDir( );
		}
		
		// Save the site

		$_POST = $db->save( 'site', $_POST );
		
		// Get the site id
		
		$siteid = $_POST['id'];
		
		// Set the response based on whether we are creating a new site or updating an existing one

		if ( $isNew == true ) $response = 'Saved';
		else $response = 'Updated';

		// Check if the site is set to be the default site

		if ( array_key_exists( 'default', $_POST ) && ( $_POST['default'] == 1 ) )
		{
			// Unset all other sites as default

			$db->exec( "UPDATE `{$site->table}` SET `default`=NULL WHERE `id`!={$siteid}" );
		}

		// Save the site url
		
		$_POST['table'] = $site->table;
		$url->set( $_POST['id'], $_POST['url'], $site->table, $site->columns['id']['field'] );
		
		// Save which modules are enabled on this site
		
		$adminlib->savemodules( $siteid, $_POST );
		
		// Save permissions for this site
		
		$user->savepermissions( $siteid, 0, 0, 0, '', $_POST );

		// Response
		
		echo "<span>{$response} '{$_POST['name']}' site.</span><script type=\"text/javascript\"> 
			$(\"#id\").val({$siteid});
			//saved('Thank-you. I'll be here all week.');
			</script>";
	}

/**
 * Delete an item
 */
	function delete( )
	{
		global $db, $paths, $url, $site, $user;
		
		// Load the site admin library
		
		require_once( dirname( __FILE__ ).'/lib/lib.siteadmin.php' );
		$lib = '\\'.__NAMESPACE__.'\\sitesadmin';
		$adminlib = new $lib();

		// Get the site id

		$params = explode( '/', $paths->getparams( ) );
		$siteid = $url->objectid( $params[0], $site->table, $site->columns['id']['field'] );
		
		// Get site details
		
		$details = $db->exec("SELECT * FROM ".$site->table." WHERE `{$site->columns['id']['field']}`=".$siteid);
		$details = $details[0];

		// Delete the site

		$result = $db->delete( $site->table, $site->columns['id']['field'],  $siteid ); 

		// Check for db errors

		if ( is_array( $result ) && array_key_exists('_error', $result) )
		{
			$err = Array(
				'_error' => TRUE,
				'_description' => "There was a database error while deleting the site with id: {$siteid}",
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			$err = $error->log( $err, $result );

			if ($config->debug['enabled'] == TRUE) debug($result);
			
			echo 'error';
		}

		// No db errors

		else
		{
			// Delete the url

			$url->delete( $siteid, $site->table, $site->columns['id']['field'] );

			// Delete module relationships

			$db->exec( "DELETE FROM `site__module` WHERE `site_id`={$siteid}" );

			// Delete site permissions

			$user->revokeaccess( $siteid );
			
			// Delete site directory
			
			$sitedir = $paths->get( 'rootpath', 'sites/'.$details['folder'] );
			$adminlib->deleteSiteDir( $sitedir );
			
			echo 'success';
		}
	}
}

?>