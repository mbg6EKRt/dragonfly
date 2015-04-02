<?php

namespace lib;

/**
 * The Page Class
 */
class page
{
/**
 * Get a full page for the current request, including the template and all embedded urls and tasks
 */
	function get( )
	{
		global $paths, $theme;

		// Get the page header

		$data = $this->header( );

		// Set system variables to be used in the template

		$data['templateurl'] = $paths->get( 'themeurl', $theme->theme['folder'] );
		$data['defaultTemplate'] = $paths->get( 'themeurl', 'default' );

		// Set the content of the page

		$data['output'] = $this->content( );

		// Get the output

		$html = process( $theme->layout['file'], $data );

		// Display the output

		echo $html;
	}

/**
 * Get the page header
 * @return Return the meta data for the current request
 */
	function header( )
	{
		global $paths, $meta, $site, $config;

		// Get meta data from the database

		$data['meta'] = $meta->get( $site->site['meta_id'] );

		// Determine if the current page should be indexed by bots

		if ($data['meta']['indexed'] == 1) $data['meta']['indexed'] = 'INDEX';
		else $data['meta']['indexed'] = 'NOINDEX';

		// Determine if the links on the current page should be followed by bots

		if ($data['meta']['follow'] == 1) $data['meta']['follow'] = 'FOLLOW';
		else $data['meta']['follow'] = 'NOFOLLOW';

		// Determine if the current page should be cached by bots

		if ($data['meta']['cache'] == 1) $data['meta']['cache'] = 'CACHE';
		else $data['meta']['cache'] = 'NO-CACHE';

		// Add url's for core javascripts

		$data['scripts'] = $config->javascript;

		// Return the data for the header

		return $data;
	}

/**
 * Get the page content from the module output
 * @return string Return the output from the module
 */
	function content( )
	{
		global $paths, $site, $module, $task;
		
		// Set information we want to pass to the module
		
		unset( $context );
		$context = new \base\config( );
		
		$context->site = $site->site;
		$context->module = $module->module;
		$context->task = $task->info;
		$context->view = $paths->view;
		$context->request = $paths->getrequest( );

		// Get module output
		
		$html = $task->getoutput( $context );

		// Return the output received from the module

		return $html;
	}
}

?>