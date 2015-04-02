<?php

namespace mod\b7a01bbc136a8b8c8ee85ae03743e61456513e66;

/**
 * The Site Admin Library
 */
class sitesadmin
{
/**
 * Save meta data for a site posted from the add/edit form
 * @param array $post $_POST data
 * @return integer Returns the id of the meta data
 */
	function savelogo( )
	{
		$basepath = 'modules/sites/files';
		
		$files = new \lib\files();
		$logo = $files->save( 'logo', $basepath );
		
		if ( $logo == FALSE ) return FALSE;
		else return $logo[0]['id'];
	}

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
 */
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
	}
	
/**
 * Delete a site directory
 * @param integer $siteid The ID of the site to save relationships for
 * @param array $post $_POST data
 * @return string Return the base directory of the site
 */
	function deleteSiteDir( $base = '' )
	{
		$files = new \lib\files();
		$files->delete( $base );
	}

/**
 * Save modules enabled for a site.
 * @param integer $siteid The ID of the site to save relationships for
 * @param array $post $_POST data
 * @return string Return the base directory of the site
 */
	function savemodules( $siteid = 0, $post = Array() )
	{
		global $db, $paths;
		
		// Save which modules are enabled on this site

		$enabledModules = $db->exec( "SELECT * FROM site__module WHERE site_id={$siteid}" );
		$existingModules = Array( );
		
		// Delete disabled modules and get modules that are already linked

		if ( empty( $post['module_id'] ) ) $post['module_id'] = Array();

		foreach ( $enabledModules as $enabledModule )
		{
			if ( !in_array( $enabledModule['module_id'], $post['module_id'] ) )
			{
				$deleted = $db->exec( "DELETE FROM site__module WHERE site_id={$siteid} AND module_id={$enabledModule['module_id']}" );
			}
			else
			{
				$existingModules[] = $enabledModule['module_id'];
			}
		}

		// Iterate through selected modules on the add/edit page

		foreach ( $post['module_id'] as $moduleid )
		{
			if ( !in_array( $moduleid, $existingModules ) )
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