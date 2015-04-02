<?php
 
namespace mod\adc4b25ee284f0780e39bc7a63393381dcd6eea0;

/**
 * The Entity module
 */
class entity
{
    const MOD_NAMESPACE = 'adc4b25ee284f0780e39bc7a63393381dcd6eea0';

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
		
		// If search param is set, don't show the search box
		
		if ( isset( $_GET['search'] ) ) $data['show_search'] = 'no';
		else $data['show_search'] = 'yes';

		// List query

		$sql = "SELECT * FROM `ent`";
		if ( !empty( $_GET['search'] ) ) $sql .= " WHERE `name` LIKE '%{$_GET['search']}%'";
		$sql .= " ORDER BY name ASC";
				
		// List templates
		
		$item_template = $paths->get( 'module', "{$this->context->module['folder']}/html/adminlistrow.html" );
		
		// List Wrapper
		
		$list = new \lib\listwrapper();
		
		// Set list options
		
		$options = Array(
			'callback' => '\\'.__NAMESPACE__.'\\entity::__callback_adminList' // The callback function to use when processing data for display
		);

		$data['list'] = $list->get( $sql, $item_template, $options );
		
		// Add some data that we gonna use in the template
		
		$data['count'] = $list->count;
		$data['pagenum'] = $list->options['page'];
		$data['startnum'] = $list->options['startnum'];
		$data['endnum'] = $list->options['endnum'];
		$data['totalpagesnum'] = $list->options['totalpagesnum'];
		$data['realcount'] = $list->options['realcount'];

		$data['adminlist'] = $url->getsiteurl( entity::MOD_NAMESPACE, 'AdminList', '', $paths->view );

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

		$data['created'] = date('Y-m-d', $data['created']);
		
		// Add some data that we gonna use in the template
		
		$data['editajaxurl'] = $url->getsiteurl( entity::MOD_NAMESPACE, 'edit', $data['id'], $paths->view );
		$data['deleteajaxurl'] = $url->getsiteurl( entity::MOD_NAMESPACE, 'delete', $data['id'], $paths->view );
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

		$data['formTitle'] = 'Add Entity';
		$data['formurl'] = $url->getsiteurl( entity::MOD_NAMESPACE, 'save', '', $paths->view );
		$data['entity']['id'] = 0;
		$data['entity']['name'] = '';
		$data['entity']['description'] = '';
		$data['relationships'] = Array();

		// Form html template

		$form = dirname( __FILE__ ).'/html/addeditentity.html';

		// Get the html

		echo process( $form, $data );
	}

/**
 * Display the edit form
 */
	function edit()
	{
		global $paths, $url;

		$params = explode( '/', $paths->getparams( ) );

		// Get entity details

		$entityClient = new \lib\entity();

		$data['entity'] = $entityClient->get( $params[0] );
		$data['entity'] = $data['entity'][0];
		$data['relationships'] = $entityClient->getrel( $params[0] );
		$data['entities'] = $entityClient->get( );

		// Form html template

		$form = dirname(__FILE__).'/html/addeditentity.html';

		// Form title and url

		$data['formTitle'] = 'Edit Entity: '.$data['entity']['name'];
		$data['formurl'] = $url->getsiteurl( entity::MOD_NAMESPACE, 'save', '', 'ajax' );

		// Get the html

		echo process( $form, $data );
	}

/**
 * Save a site
 */
	function save( )
	{
		global $db;
		
		$post = $_POST;
		
		// Unset the id when adding an entity
		
		if ($post['id'] == 0)
		{
			unset($post['id']);
			$post['created'] = time();
			$response = "Saved";
		}
		
		// Set the modified time when updating an entity
		
		else
		{
			$post['modified'] = time();
			$response = "Updated";
		}

		// Save the entity

		$post = $db->save( 'ent', $post );

		// Send a response back

		echo "<span>{$response} '{$post['name']}'.</span><script type=\"text/javascript\"> $(\"#id\").val({$post['id']}); </script>";
	}

/**
 * Delete an item
 */
	function delete( )
	{
		global $db, $paths, $url, $site, $user;

		// Get the site id

		$params = explode( '/', $paths->getparams( ) );
		
		// Delete entity
		
		$entityClient = new \lib\entity();
		$entityClient->del($params[0]);
		
		// Result
		
		echo 'success';
	}
}

?>
