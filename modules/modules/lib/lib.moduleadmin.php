<?php

namespace mod\d7fe1772f9d314b150786179a6c79ce6252800f2;

/**
 * The Modules Admin Library
 */
class modulesadmin
{
/**
 * Save meta data for a site posted from the add/edit form
 * @param array $post $_POST data
 * @return integer Returns the id of the meta data
 */
	function savemeta( $post )
	{
		global $meta;

		// Unset site id
		
		unset( $post['id'] );
		
		// Set the meta id if there is one

		if ( !empty( $post['meta_id'] ) ) $post['id'] = $post['meta_id'];

		// Run through meta data checkboxes on the form and set the values

		$checkboxes = Array( 'indexed', 'follow', 'cache' );
		foreach ( $checkboxes as $checkbox )
		{
			if ( !array_key_exists( $checkbox, $post ) )
			{
				$post[$checkbox] = 0;
			}
		}

		// Save the meta data

		$meta->set( $post );
		
		// Return the meta id
		
		return $post['id'];
	}

/**
 * Initialise the site directory
 * @return string Return the base directory of the site
 *//*
	function initSiteDir( )
	{
		global $paths;
		
		// This is a new site, create a directory for it
			
		$letters = 'abcdefghijklmnopqrstuvwxyz1234567890';
		$wordlen = rand( 12, 20 );
		$dir = '';
		for ( $i = 0; $i < $wordlen; $i++ )
		{
			// Make sure directory name always starts with a letter
			
			if ( $i != 0 ) $letter = rand( 0, 36 );
			else $letter = rand( 0, 26 );
			$dir .= $letters{$letter};
		}
		
		// Get real directory
		
		$path = $paths->get( 'sites', $dir );
		
		// Create the site directory
		
		if ( mkdir( $path, \lib\files::WRITE_PERMISSION, true ) )
		{
			// Create site sub-directories
		
			$dirs = Array(
				'lib' => 'lib',
				'media' => 'media',
				'modules' => 'modules',
				'themes' => 'themes',
				'files' => 'files',
				'files_smarty' => 'files/smarty',
				'files_smarty_compiled' => 'files/smarty/compiled',
				);
				
			foreach ( $dirs as $sub )
			{
				$path = $paths->get( 'sites', $dir.'/'.$sub );
				mkdir( $path, \lib\files::WRITE_PERMISSION, true );
			}
		}
		
		// Return the base directory
		
		return $dir;
	}*/
	
/**
 * Delete a site directory
 * @param integer $siteid The ID of the site to save relationships for
 * @param array $post $_POST data
 * @return string Return the base directory of the site
 *//*
	function deleteSiteDir( $base = '' )
	{
		$files = new \lib\files();
		$files->delete( $base );
	}*/

/**
 * Save sites enabled for a module.
 * @param integer $siteid The ID of the site to save relationships for
 * @param array $post $_POST data
 * @return string Return the base directory of the site
 */
	function savesites( $moduleid = 0, $post = Array() )
	{
		global $db, $paths;
		
		// Save which sites this module is enabled on

		$enabledSites = $db->exec( "SELECT * FROM site__module WHERE module_id={$moduleid}" );
		$existingSites = Array( );
		
		// Delete disabled modules and get modules that are already linked

		if ( empty( $post['site_id'] ) ) $post['site_id'] = Array();

		foreach ( $enabledSites as $enabledSite )
		{
			if ( !in_array( $enabledSite['site_id'], $post['site_id'] ) )
			{
				$deleted = $db->exec( "DELETE FROM `site__module` WHERE `site_id`={$enabledSite['site_id']} AND `module_id`={$moduleid}" );
			}
			else
			{
				$existingSites[] = $enabledSite['site_id'];
			}
		}

		// Iterate through selected sites on the add/edit page

		foreach ( $post['site_id'] as $siteid )
		{
			if ( !in_array( $siteid, $existingSites ) )
			{
				$saveData = Array(
					'site_id' => $siteid,
					'module_id' => $moduleid
					);
				$db->save( 'site__module', $saveData );
			}
		}
	}
}

?>