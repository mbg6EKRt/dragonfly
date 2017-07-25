<?php

namespace mod\b65573df2fb6bd349278d490c1fd3749eea79f33;

/**
 * The Menu module
 */
class menu
{
/**
 * Initialise the module
 */
	function __construct( )
	{
		global $db;

		$this->path = 'menu';

		// Database table and columns

		$this->table = 'menu';
		$this->columns = Array(
			'id' => Array( 'field' => 'id', 'type' => 'int', 'length' => '12', 'key' => 'primary', 'null' => FALSE ),
			'parent' => Array( 'field' => 'parent', 'type' => 'int', 'length' => '12', 'null' => FALSE, 'default' => 0 ),
			'label' => Array( 'field' => 'label', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'icon' => Array( 'field' => 'icon', 'type' => 'int', 'length' => '12', 'null' => TRUE ),
			'site' => Array( 'field' => 'site', 'type' => 'int', 'length' => '12', 'null' => TRUE ),
			'task' => Array( 'field' => 'task', 'type' => 'int', 'length' => '12', 'null' => TRUE ),
			'link' => Array( 'field' => 'link', 'type' => 'text', 'null' => TRUE ),
			'created' => Array( 'field' => 'created', 'type' => 'varchar', 'length' => '10', 'null' => TRUE ),
			'modified' => Array( 'field' => 'modified', 'type' => 'varchar', 'length' => '10', 'null' => TRUE )
			);

		// Make sure the db table exists

		$db->createTable( $this->table, $this->columns );
	}

/**
 * The main entry point for the module
 */
	function start( $context )
	{
		global $task;

		// Set the context

		$this->context = $context;
		unset( $context );

		debug($this->context);

		// Check which task we are accessing

		switch ( $this->context->task['task'] )
		{
			// Display the menu

			case 'display':
				$req = explode('/', $this->context->request);
				$id = $req[count($req) - 1];
				$this->display($id);
			break;
		}
	}

/**
 * Display the menu
 * @param type $param Comment
 * @return Comment
 */
	function display( $id = 0 )
	{
		global $paths, $db;

		// Set the menu template

		$template = $paths->get( 'module', $this->path.'/html/menu.html' );

		//debug( $id );

		// Get menu details

		$menu = $db->exec( "SELECT * FROM `".$this->table."` WHERE `".$this->columns['id']['field']."`=".$id );
		//debug($menu);

		// Get menu items

		$items = $db->exec( "SELECT * FROM `".$this->table."` WHERE `".$this->columns['parent']['field']."`=".$id );
		//debug($tokens);

		// Get item hrefs

		foreach ( $items as $key => $item )
		{
			if ( !empty( $item['site'] ) )
			{
				$sql = "SELECT `name` FROM `site` WHERE `id`=".$item['site'];
				$site = $db->exec( $sql );
				$items[$key]['href'] = $paths->get( 'rooturl', $site[0]['name'] );
			}
			else if ( !empty( $item['task'] ) )
			{
				$sql = "SELECT `name` FROM `task` WHERE `id`=".$item['task'];
				$task = $db->exec( $sql );
				$items[$key]['href'] = $paths->get( 'rooturl', $task[0]['name'] );
			}
			else if ( !empty( $item['link'] ) )
			{
				$items[$key]['href'] = $item['link'];
			}
		}

		$tokens['items'] = $items;

		// Display the menu

		echo process( $template, $tokens );

		/*
		$sampleData = Array(
			'parent' => 58,
			'label' => 'Add Module',
			'task' => 22,
			'created' => mktime()
			);

		$db->save( $this->table, $sampleData );
		*/
	}
}

?>