<?php

namespace mod\d7fe1772f9d314b150786179a6c79ce6252800f2;

/**
 * The Modules module
 */
class modules
{
	const MOD_NAMESPACE = 'd7fe1772f9d314b150786179a6c79ce6252800f2';

/**
 * The main function controls which task we should execute
 */
	function start( $context = Array() )
	{
		// Set the module and task information
		
		$this->context = $context;
		unset( $context );
		
		// Check which task we are accessing

		switch ( $this->context->task['task'] )
		{
			// Display the admin list

			case 'AdminList':
				$this->adminList();
			break;

			// Add an item

			case 'add':
				$this->add();
			break;

			// Edit an item

			case 'edit':
				$this->edit();
			break;

			// Save an item

			case 'save':
				$this->save();
			break;

			// Delete an item

			case 'delete':
				$this->delete();
			break;
		}
	}

/**
 * Display the administrator list - allows an admin to add, edit, save and delete items
 */
	function adminList()
	{
		global $db, $module, $paths, $meta, $url;

		// List query

		$sql = "SELECT * FROM `{$module->table}`
				LEFT JOIN `{$url->table}` ON `{$module->table}`.`{$module->columns['id']['field']}`=`{$url->table}`.`{$url->columns['foreignid']['field']}`";
		if ( !empty( $_GET['search'] ) ) 
		{
			$sql .= " WHERE `{$module->table}`.`{$module->columns['name']['field']}` LIKE '%{$_GET['search']}%'";
		}
		$sql .= " ORDER BY {$module->columns['name']['field']} ASC";
		
		// If search param is set, don't show the search box
		
		if ( isset( $_GET['search'] ) ) 
		{
			$data['show_search'] = 'no';
		}
				
		// List templates
		
		$item_template = $paths->get( 'module', 'modules/html/adminlistrow.html' );

		// List Wrapper
		
		$list = new \lib\listwrapper();
		
		// Set list options
		
		$options = Array(
			'callback' => '\\'.__NAMESPACE__.'\\modules::__callback_adminList' // The callback function to use when processing data for display
		);

		$data['list'] = $list->get( $sql, $item_template, $options );
		
		// Add some data that we gonna use in the template
		
		$data['count'] = $list->count;
		$data['pagenum'] = $list->options['page'];
		$data['startnum'] = $list->options['startnum'];
		$data['endnum'] = $list->options['endnum'];
		$data['totalpagesnum'] = $list->options['totalpagesnum'];
		$data['realcount'] = $list->options['realcount'];

		$data['adminlist'] = $url->getsiteurl( modules::MOD_NAMESPACE, 'AdminList', '', $paths->view );

		$data['show_search'] = 1;
		
		// Render the page

		echo process( $paths->get( "module", "{$this->context->module['folder']}/html/adminlist.html" ), $data );
	}

/**
 * Admin list data callback function for the list wrapper
 * @param array $data A row of data from the database
 * @return array Return the processed array of data
 */
	function __callback_adminList( $data )
	{
		global $paths, $url;
		
		// Process existing data

		$data['created'] = date('Y-m-d', $data['created']);
		
		// Add some data that we going use in the row template
		
		$data['editajaxurl'] = $url->getsiteurl( modules::MOD_NAMESPACE, 'edit', $data['url'], $paths->view );
		$data['deleteajaxurl'] = $url->getsiteurl( modules::MOD_NAMESPACE, 'delete', $data['url'], $paths->view );
		$data['rooturl'] = $paths->get( 'rooturl' );
		
		// Return data

		return $data;
	}

/**
 * Display the add form
 */
	function add()
	{
		global $db, $site, $task, $theme, $paths, $user, $url;
		
		// Form title and url

		$data['formTitle'] = 'Add Module';
		$data['formurl'] = $url->getsiteurl( modules::MOD_NAMESPACE, 'save', '', $paths->view );

		$data['id'] = '';
		$data['meta_id'] = '';
		
		// Get modules and tasks

		$data['sites'] = $site->get( );
		$data['tasks'] = $task->get( );
		
		foreach ( $data['sites'] as $rowkey => $siterow )
		{
			$data['sites'][$rowkey]['selected'] = 0;
		}

		// Get themes and layouts

		$data['themes'] = $theme->getThemes( );
		$data['layouts'] = $theme->getLayouts( );
		
		// Get the permissions form
		
		$data['permissionsform'] = $user->permissionsform( 0, 0, 0, 0, 0, 0, '', '', FALSE );

		// Form html template

		$form = dirname( __FILE__ ).'/html/addeditmodule.html';

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

		$moduleid = $url->objectid( $params[0], $module->table, $module->columns['id']['field'] );
		
		// Get the site details

		$sql = "SELECT *, module.id as module_id FROM `{$module->table}`
				LEFT JOIN `{$meta->table}` ON `{$meta->table}`.`{$meta->columns['id']['field']}`=`{$module->table}`.`{$module->columns['meta']['field']}`
				INNER JOIN `{$url->table}` ON `{$url->table}`.`{$url->columns['foreignid']['field']}`=`{$module->table}`.`{$module->columns['id']['field']}`
				WHERE `{$module->table}`.`{$module->columns['id']['field']}`={$moduleid}";
		$data = $db->exec( $sql );
		$data = $data[0];
		$data['id'] = $data['module_id'];
		
		// Get selected modules

		$sql = "SELECT * FROM `site__module` WHERE `module_id`={$moduleid}";
		$tmp = $db->exec( $sql );

		$selectedSites = Array();

		foreach ( $tmp as $tmprow )
		{
			$selectedSites[] = $tmprow['site_id'];
		}

		// Form html template

		$form = dirname(__FILE__).'/html/addeditmodule.html';

		// Form title and url
		
		$data['formTitle'] = 'Edit Module: '.$data['name'];
		$data['formurl'] = $url->getsiteurl( modules::MOD_NAMESPACE, 'save', '', 'ajax' );
		
		// Get modules and tasks

		$data['sites'] = $site->get( );
		$data['tasks'] = $task->get( );
		
		// Set selected modules

		foreach ( $data['sites'] as $rowkey => $siterow )
		{
			if ( in_array( $siterow['id'], $selectedSites ) )
			{
				$data['sites'][$rowkey]['selected'] = 1;
			}
			else
			{
				$data['sites'][$rowkey]['selected'] = 0;
			}
		}

		// Get themes and layouts

		$data['themes'] = $theme->getThemes( );
		$data['layouts'] = $theme->getLayouts( );
		
		// Get the permissions form
		
		$data['permissionsform'] = $user->permissionsform( 0, $moduleid, 0, 0, 0, 0, '', $data['access'], FALSE );
		
		// Get the html
		
		echo process( $form, $data );
	}

/**
 * Save a module
 */
	function save( )
	{
		global $db, $url, $meta, $module, $user, $paths;
		
		require_once( dirname( __FILE__ ).'/lib/lib.moduleadmin.php' );
		$lib = '\\'.__NAMESPACE__.'\\modulesadmin';
		$adminlib = new $lib();
		
		//debug($_POST);die();
		
		// Save the meta data for the module
		
		$metadata = $_POST;
		
		if (!empty($metadata['meta_id'])) $metadata['id'] = $metadata['meta_id'];
		$meta->set($metadata);
		
		$_POST['meta_id'] = $metadata['id'];
		
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
		}
		
		// Save the module

		$_POST = $db->save( 'module', $_POST );
		
		// Get the module id
		
		$moduleid = $_POST['id'];
		
		// Save sites this module is enabled on
		
		$adminlib->savesites($moduleid, $_POST);
		
		// Set the response based on whether we are creating a new module or updating an existing one

		if ( $isNew == true ) $response = 'Saved';
		else $response = 'Updated';

		// Save the module url
		
		$url->set( $moduleid, $_POST['url'], $module->table, $module->columns['id']['field'] );
		
		// Save permissions for this module
		
		$user->savepermissions( 0, $moduleid, 0, 0, '', $_POST );

		// Response
		
		echo "<span>{$response} '{$_POST['name']}' module.</span><script type=\"text/javascript\"> 
			$(\"#id\").val({$moduleid});
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