<?php

namespace mod\b6e652365a32f6a8b58c8c967e06b122da3b185c;

/**
 * The Themes module
 */
class themes
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

		switch ($this->context->task['task'])
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
		echo 'hello';
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
}

?>