<?php

namespace mod\a1e56b1719819be07494b142bdac61ecc1b8685b;

/**
 * The Pages module
 */
class pages
{
/**
 * The main function controls which task we should execute
 */
	function start( $context )
	{
		// Set the module and task information
		
		$this->context = $context;
		unset( $context );

		// Check which task we are executing

		switch ( $this->context->task['task'] )
		{
			// Display the admin list

			case 'AdminList':
				$this->adminList( );
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

			// Display an item

			case 'display':
				$this->display( );
			break;
		}
	}

/**
 * Display the administrator list - allows an admin to add, edit, save and delete items
 */
	function adminList( )
	{
		$this->display( );
	}

/**
 * Display the add form
 */
	function add(){}

/**
 * Display the edit form
 */
	function edit(){}

/**
 * Save an item
 */
	function save(){}

/**
 * Delete an item
 */
	function delete(){}

/**
 * Display an item
 */
	function display()
	{
		global $paths, $site, $module, $task, $url;

		if ( $this->context->view == "url" )
		{
			// Do some stuff

			debug( $this->context, '$context' );

			echo "<b>Displaying a page ...</b><br /><br />\n\n";
			echo '<b>Site:</b> '.$this->context->site['name']." ({$site->source})<br />\n";
			echo '<b>Module:</b> '.$this->context->module['name']." ({$module->source})<br />\n";
			echo '<b>Task:</b> '.$this->context->task['name']." ({$task->source})<br />\n";
			echo '<b>Request:</b> '.$this->context->request."<br />\n";
			
			// Getting the url paramters
			
			$params = $paths->getparams( $this->context->request );
			
			if ( !empty( $params ) )
			{
				echo '<b>Request params:</b> '.$params."<br />\n";
			}
			else echo "<b>No params here!</b><br />\n";
			
			// Generating a url with using the url
			
			$testurl = $url->getsiteurl( $this->context->module['namespace'], 'display', 'some/params', $paths->view );
			echo '<b>Test url by namespace:</b> '.$testurl."<br />\n";
			
			$testurl = $url->getsiteurl( $this->context->module['id'], 'display', 'other/some/params' );
			echo '<b>Test url by id:</b> '.$testurl."<br />\n";
		}

		// Display something based on view

		if ( $this->context->view == "url" )
		{
			echo "full version of a page";
		}
		else if ( $this->context->view == "embed" )
		{
			echo "Embedded version of a page";
		}
		else if ( $this->context->view == "task" )
		{
			echo "task version of a page";
		}
		else if ($this->context->view == 'cli')
		{
			echo "Displaying a page ...\n\n";
			echo 'Site: '.$this->context->site['name']." ({$site->source})\n";
			echo 'Module: '.$this->context->module['name']." ({$module->source})\n";
			echo 'Task: '.$this->context->task['name']." ({$task->source})\n";
			echo 'Request: '.$this->context->request."\n";
			echo "\n\n----------------------------------\nHello Cli!\n----------------------------------\n\n\n";
		}
	}
}

?>
