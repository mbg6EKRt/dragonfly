<?php

namespace mod\cc3bd702dd8950297dcb450b56c47710c05ddd38;

/**
 * The Dashboard module
 */
class dashboard
{
/**
 * The main entry point for the module
 * @param array $context An array containing module and task information
 */
	function start( $context )
	{
		// Set the module and task information
		
		$this->context = $context;
		unset( $context );
		
		//debug($this->context, 'Dashboard $this->context');

		// Check which task we are executing

		switch ($this->context->task['task'])
		{
			// Display the site admin dashboard

			case 'dashboard':
				$this->dashboard();
			break;
		}
	}

/**
 * Display the admin dashboard - this function can only be executed from within this module
 * @return none
 */
	function dashboard()
	{
		global $paths, $module, $theme, $db, $error;

		$layout = $paths->get( 'module', $module->module['folder'].'/html/dashboard.html' );
		$data = Array
		(
			'rooturl' => $paths->get( 'rooturl' ),
			'imagesurl' => $paths->get( 'rooturl', 'modules/dashboard/img/icons/', 'file' ),

			'templateurl' => $paths->get( 'themeurl', $theme->theme['folder'] ),
			'isotope' => $paths->get( 'vendorurl', 'jquery/isotope/jquery.isotope.min.js' )
		);
		
		echo process($layout, $data);
	}
}

?>