<?php

namespace lib;

/**
 * The Theme Class
 */
class theme
{
/**
 * Description
 * @param type $param Comment
 * @return Comment
 */
	function  __construct( )
	{
		global $db;

		$this->table = 'theme';
		$this->layoutTable = 'theme_layout';

		// Columns for the tasks table

		$this->columns = Array(
			'id' => Array( 'field' => 'id', 'type' => 'int', 'length' => '12', 'key' => 'primary', 'null' => FALSE ),
			'name' => Array( 'field' => 'name', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'folder' => Array( 'field' => 'folder', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'created' => Array( 'field' => 'created', 'type' => 'varchar', 'length' => '10', 'null' => TRUE ),
			'modified' => Array( 'field' => 'modified', 'type' => 'varchar', 'length' => '10', 'null' => TRUE )
			);

		$this->layoutColumns = Array(
			'id' => Array( 'field' => 'id', 'type' => 'int', 'length' => '12', 'key' => 'primary', 'null' => FALSE ),
			'name' => Array( 'field' => 'name', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'file' => Array( 'field' => 'folder', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'created' => Array( 'field' => 'created', 'type' => 'varchar', 'length' => '10', 'null' => TRUE ),
			'modified' => Array( 'field' => 'modified', 'type' => 'varchar', 'length' => '10', 'null' => TRUE ),
			'theme_id' => Array( 'field' => 'theme_id', 'type' => 'varchar', 'length' => '12', 'null' => TRUE )
			);
	}

/**
 * Load the theme for the current request
 */
	function load()
	{
		global $task, $module, $site, $error, $config, $db, $paths;

		$layout = 0;

		// Get the default theme for the site

		if ( isset( $task->info['layout'] ) && !empty( $task->info['layout'] ) ) $layout = $task->info['layout'];
		else if ( isset( $module->module['layout'] ) && !empty( $module->module['layout'] ) ) $layout = $module->module['layout'];
		else if ( isset( $site->site['default_layout'] ) && !empty( $site->site['default_layout'] ) ) $layout = $site->site['default_layout'];

		// No theme is set, return an error

		else
		{
			$err = Array(
				'_error' => TRUE,
				'_description' => 'No layout found for the current page.',
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			$err = $error->log( $err, $val );

			if ($config->debug['enabled'] == TRUE) debug($err);
		}

		// Get the theme details

		if (!empty($layout))
		{
			// Get the current layout

			$sql = "SELECT * FROM `".$this->layoutTable."`
					WHERE `".$this->layoutTable."`.`".$this->layoutColumns['id']['field']."`=".$layout;
			$layout = $db->exec( $sql );

			// Check for db errors

			if ( is_array( $layout ) && array_key_exists('_error', $layout) )
			{
				$err = Array(
					'_error' => TRUE,
					'_description' => 'Unable to load specified layout.',
					'_file' => __FILE__,
					'_function' => __FUNCTION__
					);
				$err = $error->log( $err, $layout );

				if ($config->debug['enabled'] == TRUE) debug($err);
			}

			// No errors, load theme

			else
			{
				$this->layout = $layout[0];

				// Get the current theme

				$sql = "SELECT * FROM `".$this->table."`
						WHERE `".$this->table."`.`".$this->columns['id']['field']."`=".$this->layout['theme_id'];
				$theme = $db->exec( $sql );

				// Check for db errors

				if ( is_array( $theme ) && array_key_exists( '_error', $theme ) )
				{
					$err = Array(
						'_error' => TRUE,
						'_description' => 'There was a database error while loading the theme from the database.',
						'_file' => __FILE__,
						'_function' => __FUNCTION__
						);
					$err = $error->log( $err, $theme );

					if ( $config->debug['enabled'] == TRUE ) debug( $err );
				}

				// No db errors, set the theme and layout file

				else
				{
					$this->theme = $theme[0];

					// Set the layout file

					$this->layout['file'] = $paths->get( 'theme', $this->theme['folder'].'/layouts/'.$this->layout['file'] );
				}
			}
		}
	}

/**
 * Get the list of themes in an array
 * @return array Returns an array containing the themes
 */
	function getThemes( )
	{
		global $db;

		$sql = "SELECT * FROM `".$this->table."` ORDER BY `".$this->columns['name']['field']."` ASC";
		$themes = $db->exec( $sql );

		return $themes;
	}

/**
 * Get the list of layouts in an array
 * @return array Returns an array containing the layouts
 */
	function getLayouts( )
	{
		global $db;

		$sql = "SELECT * FROM `".$this->layoutTable."` ORDER BY `".$this->layoutColumns['name']['field']."` ASC";
		$layouts = $db->exec( $sql );

		return $layouts;
	}
}

?>