<?php

namespace mod\b80ec46a8d75653d6a1d5f563f0ba0132feaaaaa;

/**
 * The Tasks module
 */
class tasks
{
/**
 * The main function controls which task we should execute
 */
	function main()
	{
		global $task;

		// Check which task we are accessing

		switch ($task->task)
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
	function adminList(){}

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