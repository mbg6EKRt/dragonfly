<?php

namespace lib;

/**
 * The User Class
 */
class user
{
/**
 * Defines the three access levels
 */
	var $access = Array();

/**
 * The table where user data is stored
 */
	var $usertable;

/**
 * The fields in the user table
 */
	var $usercolumns;

/**
 * The table where groups data is stored
 */
	var $grouptable;

/**
 * The fields in the groups table
 */
	var $groupcolumns;

/**
 * The constructor
 * @return none
 */
	function __construct()
	{
		// User table and columns

		$this->usertable = 'user';

		$this->usercolumns = Array(
			'id' => Array( 'field' => 'id', 'type' => 'int', 'length' => '12', 'key' => 'primary', 'null' => FALSE ),
			'nick' => Array( 'field' => 'nick', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'email' => Array( 'field' => 'email', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'password' => Array( 'field' => 'password', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'lastlogin' => Array( 'field' => 'lastlogin', 'type' => 'int', 'length' => '12', 'null' => TRUE ),
			'created' => Array( 'field' => 'created', 'type' => 'varchar', 'length' => '11', 'null' => TRUE ),
			'modified' => Array( 'field' => 'modified', 'type' => 'varchar', 'length' => '11', 'null' => TRUE )
			);

		// Group table and columns

		$this->grouptable = 'user_group';

		$this->groupcolumns = Array(
			'id' => Array( 'field' => 'id', 'type' => 'int', 'length' => '12', 'key' => 'primary', 'null' => FALSE ),
			'name' => Array( 'field' => 'name', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'created' => Array( 'field' => 'created', 'type' => 'varchar', 'length' => '11', 'null' => TRUE ),
			'modified' => Array( 'field' => 'modified', 'type' => 'varchar', 'length' => '11', 'null' => TRUE )
			);

		// Permissions table and columns

		$this->permissionstable = 'permissions';

		$this->permissionscolumns = Array(
			'siteid' => Array( 'field' => 'site_id', 'type' => 'int', 'length' => '12', 'default' => 0 ),
			'moduleid' => Array( 'field' => 'module_id', 'type' => 'int', 'length' => '12', 'default' => 0 ),
			'taskid' => Array( 'field' => 'task_id', 'type' => 'int', 'length' => '12', 'default' => 0 ),
			'userid' => Array( 'field' => 'user_id', 'type' => 'int', 'length' => '12', 'default' => 0 ),
			'groupid' => Array( 'field' => 'user_group_id', 'type' => 'int', 'length' => '12', 'default' => 0 ),
			'objectid' => Array( 'field' => 'object_id', 'type' => 'int', 'length' => '12', 'default' => 0 ),
			'objecttable' => Array( 'field' => 'object_table', 'type' => 'varchar', 'length' => '255', 'default' => '' )
			);

		// Access levels
		// "Access Level" => "Form label to use"

		$this->access = Array(
			'public' => 'Public Access',
			'login' => 'Login Required',
			'rights' => 'Rights Required',
			'site' => 'Per site permissions'
			);

		$this->siteaccess = Array(
			'public' => 'Public Access',
			'login' => 'Login Required',
			'rights' => 'Rights Required'
			);
	}

/**
 * Log the user in
 * @param type $param Comment
 * @return none
 */
	function login( $username = '', $email = '', $password = '' )
	{
		global $db, $config, $error, $session;

		$username = '';
		$email = '';
		$password = '';
		
		// If login details have been specified, do not check for them
		
		if ( empty( $username ) && empty( $email ) )
		{
			// Get existing login information
			
			if ( isset( $_SESSION ) )
			{
				$user = $session->get( 'user' );
				
				$username = $user['nick'];
				$email = $user['email'];
				$password = $user['password'];
			}

			// Check for posted login details

			if ( ( !empty( $_POST['login_username'] ) || !empty( $_POST['login_email'] ) ) && !empty( $_POST['login_password'] ) )
			{
				$username = $_POST['login_username'];
				$email = $_POST['login_username'];
				$password = $_POST['login_password'];

				$password = sha1( $password );
			}

			// Check for login details in the url

			else if ( ( !empty( $_GET['login_username'] ) || !empty( $_GET['login_email'] ) ) && !empty( $_GET['login_password'] ) )
			{
				$username = $_GET['login_username'];
				$email = $_GET['login_username'];
				$password = $_GET['login_password'];

				$password = sha1( $password );
			}
		}

		// Make sure we have login details

		if ( ( !empty( $username ) || !empty( $email ) ) && !empty( $password ) )
		{
			// See if we have valid login information

			$sql = "SELECT * FROM `{$this->usertable}` WHERE (`{$this->usercolumns['nick']['field']}`='{$username}' OR `{$this->usercolumns['email']['field']}`='{$email}') AND `{$this->usercolumns['password']['field']}`='{$password}'";

			$user = $db->exec( $sql );

			// Check for database errors

			if ( is_array( $user ) && array_key_exists( '_error', $user ) )
			{
				$err = Array(
					'_error' => TRUE,
					'_description' => 'There was a database error while logging the user in.',
					'_file' => __FILE__,
					'_function' => __FUNCTION__
					);
				$err = $error->log( $err, $user );

				if ($config->debug['enabled'] == TRUE) debug($err);
			}

			// No db errors

			else
			{
				// Make sure we have some user details

				if ( !empty( $user ) )
				{
					// Get the user details

					$user = $user[0];

					// Set the session data

					$session->set( 'user', $user );

					// Set the last login date

					$sql = "UPDATE `{$this->usertable}`
							SET `{$this->usercolumns['lastlogin']['field']}`=".time( )."
							WHERE `{$this->usercolumns['id']['field']}`=".$user['id'];
					$db->exec( $sql );
				}

				// If the login information was incorrect, unset the user session data

				else
				{
					$session->del( 'user' );
				}
			}
		}
	}

/**
 * Log the user out
 * @return none
 */
	function logout()
	{
		global $session;

		$session->destroy( );
	}

/**
 * Check if the user has the required permissions
 * @param int $siteid The site id to set permissions for
 * @param int $moduleid The module id to set permissions for
 * @param int $taskid The task id to set permissions for
 * @param int $userid The user id of the user who has access to the site/module/task combination
 * @param int $groupid The group id of the group that has access to the site/module/task combination
 * @param int $objectid The object id of the object that the user/group has access to for the site/module/task combination
 * @param string $objecttable The object table where the object is stored in the database
 * @return If we have an entry for the corresponding permission, return TRUE, otherwise return FALSE
 */
	function hasaccess($siteid = 0, $moduleid = 0, $taskid = 0, $userid = 0, $groupid = 0, $objectid = 0, $objecttable = '')
	{
		global $db, $error, $config;

		// Get the SQL query

		$sql = "SELECT * FROM `".$this->permissionstable."` WHERE
				`".$this->permissionscolumns['siteid']['field']."`=".$siteid."
				AND `".$this->permissionscolumns['moduleid']['field']."`=".$moduleid."
				AND `".$this->permissionscolumns['taskid']['field']."`=".$taskid."
				AND `".$this->permissionscolumns['userid']['field']."`=".$userid."
				AND `".$this->permissionscolumns['groupid']['field']."`=".$groupid."
				AND `".$this->permissionscolumns['objectid']['field']."`=".$objectid."
				AND `".$this->permissionscolumns['objecttable']['field']."`='".$objecttable."'";

		// Execute the query

		$result = $db->exec( $sql );

		// Check for database errors

		if ( is_array( $result ) && array_key_exists( '_error', $result ) )
		{
			$err = Array(
				'_error' => TRUE,
				'_description' => 'Unable to get permissions.',
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			$err = $error->log( $err, $result );

			if ( $config->debug['enabled'] == TRUE ) debug( $err );
		}

		// No db errors

		else
		{
			// If we have an entry for the corresponding permission, return TRUE, otherwise return FALSE

			if ( !empty( $result ) ) return TRUE;
			else return FALSE;
		}
	}

/**
 * Get a list of permissions that have been set for an object
 * @param int $siteid The site id to set permissions for
 * @param int $moduleid The module id to set permissions for
 * @param int $taskid The task id to set permissions for
 * @param int $userid The user id of the user who has access to the site/module/task combination
 * @param int $groupid The group id of the group that has access to the site/module/task combination
 * @param int $objectid The object id of the object that the user/group has access to for the site/module/task combination
 * @param string $objecttable The object table where the object is stored in the database
 * @return If we have an entry for the corresponding permission, return TRUE, otherwise return FALSE
 */
	function getaccess($siteid = 0, $moduleid = 0, $taskid = 0, $userid = 0, $groupid = 0, $objectid = 0, $objecttable = '')
	{
		global $db, $error, $config;
		
		$first = TRUE;

		// Get the SQL query

		$sql = "SELECT * FROM `".$this->permissionstable."` WHERE";

		if ( !empty( $siteid ) )
		{
			if ($first == TRUE) $first = FALSE;
			else $sql .= " AND";

			$sql .= " `".$this->permissionscolumns['siteid']['field']."`=".$siteid;
		}

		if ( !empty( $moduleid ) )
		{
			if ($first == TRUE) $first = FALSE;
			else $sql .= " AND";

			$sql .= " `".$this->permissionscolumns['moduleid']['field']."`=".$moduleid;
		}

		if ( !empty( $taskid ) )
		{
			if ($first == TRUE) $first = FALSE;
			else $sql .= " AND";

			$sql .= " `".$this->permissionscolumns['taskid']['field']."`=".$taskid;
		}

		if ( !empty( $userid ) )
		{
			if ($first == TRUE) $first = FALSE;
			else $sql .= " AND";

			$sql .= " `".$this->permissionscolumns['userid']['field']."`=".$userid;
		}

		if ( !empty( $groupid ) )
		{
			if ($first == TRUE) $first = FALSE;
			else $sql .= " AND";

			$sql .= " `".$this->permissionscolumns['groupid']['field']."`=".$groupid;
		}

		if ( !empty( $objectid ) )
		{
			if ($first == TRUE) $first = FALSE;
			else $sql .= " AND";

			$sql .= " `".$this->permissionscolumns['objectid']['field']."`=".$objectid;
		}

		if ( !empty( $objecttable ) )
		{
			if ($first == TRUE) $first = FALSE;
			else $sql .= " AND";

			$sql .= " `".$this->permissionscolumns['objecttable']['field']."`='".$objecttable."'";
		}

		// If we have something to check, execute the query

		if ( $first == FALSE )
		{
			// Execute the query

			$result = $db->exec( $sql );
		}

		// Otherwise, return an empty array

		else return Array();

		// Check for database errors

		if ( is_array( $result ) && array_key_exists( '_error', $result ) )
		{
			$err = Array(
				'_error' => TRUE,
				'_description' => 'Unable to get permissions.',
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			$err = $error->log( $err, $result );

			if ( $config->debug['enabled'] == TRUE ) debug( $err );

			return $err;
		}

		// No db errors

		else
		{
			// Return the permissions

			return $result;
		}
	}

/**
 * Set permissions
 * @param int $siteid The site id to set permissions for
 * @param int $moduleid The module id to set permissions for
 * @param int $taskid The task id to set permissions for
 * @param int $userid The user id of the user who has access to the site/module/task combination
 * @param int $groupid The group id of the group that has access to the site/module/task combination
 * @param int $objectid The object id of the object that the user/group has access to for the site/module/task combination
 * @param string $objecttable The object table where the object is stored in the database
 * @return Return the permissions that were just set
 */
	function setaccess($siteid = 0, $moduleid = 0, $taskid = 0, $userid = 0, $groupid = 0, $objectid = 0, $objecttable = '')
	{
		global $db, $error, $config;

		// Set the save data

		$savedata = Array(
			$this->permissionscolumns['siteid']['field'] => $siteid,
			$this->permissionscolumns['moduleid']['field'] => $moduleid,
			$this->permissionscolumns['taskid']['field'] => $taskid,
			$this->permissionscolumns['userid']['field'] => $userid,
			$this->permissionscolumns['groupid']['field'] => $groupid,
			$this->permissionscolumns['objectid']['field'] => $objectid,
			$this->permissionscolumns['objecttable']['field'] => $objecttable
		);

		// Execute the query

		$result = $db->save( $this->permissionstable, $savedata );

		// Check for database errors

		if ( is_array( $result ) && array_key_exists('_error', $result) )
		{
			$err = Array(
				'_error' => TRUE,
				'_description' => 'Unable to set permissions.',
				'_file' => __FILE__,
				'_function' => __FUNCTION__
				);
			$err = $error->log( $err, $result );

			if ($config->debug['enabled'] == TRUE) debug($err);
		}

		// No db errors

		else
		{
			// Return the data from saving the permissions

			return $result;
		}
	}

/**
 * Delete permissions for a specific combination of items
 * @param int $siteid The site id to remove permissions for
 * @param int $moduleid The module id to remove permissions for
 * @param int $taskid The task id to remove permissions for
 * @param int $userid The id of the user
 * @param int $groupid The id of the group
 * @param int $objectid The id of the object
 * @param string $objecttable The object table where the object is stored in the database
 * @return Return the result of the database query when successful, otherwise return a standard error array
 */
	function revokeaccess($siteid = 0, $moduleid = 0, $taskid = 0, $userid = 0, $groupid = 0, $objectid = 0, $objecttable = '')
	{
		global $db, $error, $config;

		$first = TRUE;

		// Get the SQL query

		$sql = "DELETE FROM `".$this->permissionstable."` WHERE";

		if ( !empty( $siteid ) )
		{
			if ($first == TRUE) $first = FALSE;
			else $sql .= " AND";

			$sql .= " `".$this->permissionscolumns['siteid']['field']."`=".$siteid;
		}

		if ( !empty( $moduleid ) )
		{
			if ($first == TRUE) $first = FALSE;
			else $sql .= " AND";

			$sql .= " `".$this->permissionscolumns['moduleid']['field']."`=".$moduleid;
		}

		if ( !empty( $taskid ) )
		{
			if ($first == TRUE) $first = FALSE;
			else $sql .= " AND";

			$sql .= " `".$this->permissionscolumns['taskid']['field']."`=".$taskid;
		}

		if ( !empty( $userid ) )
		{
			if ($first == TRUE) $first = FALSE;
			else $sql .= " AND";

			$sql .= " `".$this->permissionscolumns['userid']['field']."`=".$userid;
		}

		if ( !empty( $groupid ) )
		{
			if ($first == TRUE) $first = FALSE;
			else $sql .= " AND";

			$sql .= " `".$this->permissionscolumns['groupid']['field']."`=".$groupid;
		}

		if ( !empty( $objectid ) )
		{
			if ($first == TRUE) $first = FALSE;
			else $sql .= " AND";

			$sql .= " `".$this->permissionscolumns['objectid']['field']."`=".$objectid;
		}

		if ( !empty( $objecttable ) )
		{
			if ($first == TRUE) $first = FALSE;
			else $sql .= " AND";

			$sql .= " `".$this->permissionscolumns['objecttable']['field']."`='".$objecttable."'";
		}

		// Make sure we have at least one object, so we cannot delete all permissions at once

		if ( $first == FALSE )
		{
			// Execute the query

			$result = $db->exec( $sql );

			// Check for database errors

			if ( is_array( $result ) && array_key_exists( '_error', $result ) )
			{
				$err = Array(
					'_error' => TRUE,
					'_description' => 'Unable to revoke permissions.',
					'_file' => __FILE__,
					'_function' => __FUNCTION__
					);
				$err = $error->log( $err, $result );

				if ( $config->debug['enabled'] == TRUE ) debug( $err );

				return $err;
			}

			// No db errors

			else
			{
				// Return the result of the query

				return $result;
			}
		}
	}

/**
 * Get a list of groups
 * @param integer $userid If specified, we should get a list of groups for the specified user
 * @return Returns the list of groups in an array
 */
	function groups( $userid = 0 )
	{
		global $db;

		// Check if we are getting the list of all groups or only groups for a specific user

		if ( empty( $userid ) )
		{
			// Only query the database if the groups have not been loaded yet

			if ( !isset( $this->groups ) )
			{
				$sql = "SELECT * FROM `{$this->grouptable}` ORDER BY `{$this->groupcolumns['name']['field']}` ASC";
				$this->groups = $db->exec($sql);
			}

			// Return the list of groups

			return $this->groups;
		}
		else
		{
			// Get the list of groups for a specific user

			$sql = "SELECT * FROM `{$this->grouptable}`
					INNER JOIN `user__user_group` ON
						`user__user_group`.`user_group_id`=`{$this->grouptable}`.`{$this->groupcolumns['id']['field']}` AND
						`user__user_group`.`user_id`={$userid}
					ORDER BY `{$this->groupcolumns['name']['field']}` ASC";

			return $db->exec($sql);
		}
	}

/**
 * Check if the user has permission to access the current request. If not, the login screen is displayed
 * @return none
 */
	function securerequest( )
	{
		global $site, $module, $task, $page, $session;
		
		$objects = Array(
			'site',
			'module',
			'task'
		);
		
		$infoVar = Array(
			'site' => 'site',
			'module' => 'module',
			'task' => 'info'
		);
		
		$accessCol = Array(
			'site' => 'access',
			'module' => 'access',
			'task' => 'access'
		);
		
		$idCol = Array(
			'site' => 'id',
			'module' => 'id',
			'task' => 'id'
		);

		// Make sure the user is logged in

		$this->login( );
		
		if ( isset( $_SESSION ) ) $user = $session->get( 'user' );
		else $user = '';
		
		// Run through objects to check
		
		foreach ( $objects as $object )
		{
			$var = $infoVar[$object];
			$col = $accessCol[$object];
			$id = $idCol[$object];
			$info = $$object->$var;
			
			if ( $info[$col] == 'public' )
			{
				// Do nothing
			}
			else if ( $info[$col] == 'login' )
			{
				// Check if the user is logged in
	
				if ( empty( $user ) )
				{
					$this->loginscreen( );
				}
			}
			else if ( $info[$col] == 'rights' )
			{
				// Check if the user has access
	
				if ( !empty( $user ) )
				{
					switch ( $object )
					{
						case 'site':
						
							if ( !$this->hasaccess( $info[$id], 0, 0, $user['id'] ) )
							{
								// If no user access, load the users groups
	
								$groups = $this->groups( $user['id'] );
								$access = FALSE;
			
								// Check for error loading the users groups
			
								if ( is_array( $groups ) && array_key_exists( '_error', $groups ) )
								{
									$err = Array(
										'_error' => TRUE,
										'_description' => 'Unable to get the users groups.',
										'_file' => __FILE__,
										'_function' => __FUNCTION__
										);
									$err = $error->log( $err, $groups );
			
									if ($config->debug['enabled'] == TRUE) debug($err);
								}
			
								// No loading error
			
								else
								{
									// Make sure we have groups
			
									if ( !empty( $groups ) )
									{
										// Run through the list of groups and check if one of them has access
			
										foreach ( $groups as $group )
										{
											if ( $this->hasaccess( $info[$id], 0, 0, 0, $group['user_group_id'] ) )
											{
												$access = TRUE;
											}
										}
									}
								}
			
								// If no access, show the login screen
			
								if ( $access == FALSE ) $this->loginscreen( );
							}
							
						break;
						
						case 'module':
						
							if ( !$this->hasaccess( 0, $info[$id], 0, $user['id'] ) )
							{
								// If no user access, load the users groups
	
								$groups = $this->groups( $user['id'] );
								$access = FALSE;
			
								// Check for error loading the users groups
			
								if ( is_array( $groups ) && array_key_exists( '_error', $groups ) )
								{
									$err = Array(
										'_error' => TRUE,
										'_description' => 'Unable to get the users groups.',
										'_file' => __FILE__,
										'_function' => __FUNCTION__
										);
									$err = $error->log( $err, $groups );
			
									if ($config->debug['enabled'] == TRUE) debug($err);
								}
			
								// No loading error
			
								else
								{
									// Make sure we have groups
			
									if ( !empty( $groups ) )
									{
										// Run through the list of groups and check if one of them has access
			
										foreach ( $groups as $group )
										{
											if ( $this->hasaccess( 0, $info[$id], 0, 0, $group['user_group_id'] ) )
											{
												$access = TRUE;
											}
										}
									}
								}
			
								// If no access, show the login screen
			
								if ( $access == FALSE ) $this->loginscreen( );
							}
							
						break;
						
						case 'task':
						
							if ( !$this->hasaccess( 0, 0, $info[$id], $user['id'] ) )
							{
								// If no user access, load the users groups
	
								$groups = $this->groups( $user['id'] );
								$access = FALSE;
			
								// Check for error loading the users groups
			
								if ( is_array( $groups ) && array_key_exists( '_error', $groups ) )
								{
									$err = Array(
										'_error' => TRUE,
										'_description' => 'Unable to get the users groups.',
										'_file' => __FILE__,
										'_function' => __FUNCTION__
										);
									$err = $error->log( $err, $groups );
			
									if ($config->debug['enabled'] == TRUE) debug($err);
								}
			
								// No loading error
			
								else
								{
									// Make sure we have groups
			
									if ( !empty( $groups ) )
									{
										// Run through the list of groups and check if one of them has access
			
										foreach ( $groups as $group )
										{
											if ( $this->hasaccess( 0, 0, $info[$id], 0, $group['user_group_id'] ) )
											{
												$access = TRUE;
											}
										}
									}
								}
			
								// If no access, show the login screen
			
								if ( $access == FALSE ) $this->loginscreen( );
							}
							
						break;
					}
				}
				
				// If the user is not logged in, show the login screen
				
				else $this->loginscreen();
			}
			
			// Site specific permissions
			
			else if ( $info[$col] == 'site' )
			{
				
			}
		}
	}

/**
 * Display the login screen and halt script execution
 * @return The html for the login screen
 */
	function loginscreen( )
	{
		global $paths, $theme, $page;
		
		// If the current request is embedded
		
		if ( $paths->view == 'embed' )
		{
			// Exit with no output
			
			exit;
		}
		else if ( $paths->view == 'ajax' )
		{
			// Exit with login form
			
			exit( file_get_contents( $paths->get( 'lib', 'html/user/login.html' ) ) );
		}
		else if ( $paths->view == 'cli' )
		{
			// Exit with login form
			
			exit( 'Access denied.' );
		}
		else
		{
			// Set the layout to use for the page

			$template = $paths->get( 'theme', $theme->theme['folder'].'/layouts/login.html' );

			if ( !file_exists( $template ) )
			{
				$template = $paths->get( 'theme', 'default/layouts/login.html' );
			}

			// Get the page header - including meta data and core javascripts

			$data = $page->header( );

			// Get the login form

			$data['output'] = file_get_contents( $paths->get( 'lib', 'html/user/login.html' ) );

			// Set variables to be used in the template

			$data['templateurl'] = $paths->get( 'themeurl', $theme->theme['folder'] );
			$data['defaultTemplate'] = $paths->get( 'themeurl', 'default' );

			// Get final output

			$html = process( $template, $data );

			// Display the login screen and halt script execution

			exit( $html );
		}
	}

/**
 * Display the permissions form
 * @return string The html for the permissions form
 */
	function permissionsform( $sid = 0, $mid = 0, $tid = 0, $uid = 0, $gid = 0, $oid = 0, $otable = '', $access = '', $per_site_permissions_enabled = TRUE )
	{
		global $paths, $theme, $page, $db, $site;
		
		$data['access'] = $access;

		// Get access levels

		$data['accesslevels'] = $this->access;

		// Get user groups

		$data['usergroups'] = $this->groups( );
			
		// Set 'per site permissions' display option
		
		$data['per_site_permissions_enabled'] = $per_site_permissions_enabled;
		
		// Check if per site permissions are enabled
		
		if ( $per_site_permissions_enabled == TRUE )
		{
			// Get sites
			
			$data['sites'] = $site->get( );
		}
		else
		{
			// Unset 'per site permissions' option in access levels dropdown
			
			unset( $data['accesslevels']['site'] );
		}

		// Get selected groups

		if ( !empty( $sid ) || !empty( $mid ) || !empty( $tid ) || !empty( $uid ) ||
			 !empty( $gid ) || !empty( $oid ) || !empty( $otable ) )
		{
			$perms = $this->getaccess( $sid, $mid, $tid, $uid, $gid, $oid, $otable );
			$selectedGroups = Array();
			foreach( $perms as $perm ) 
			{
				if ( !empty( $perm['user_group_id'] ) && !in_array( $perm['user_group_id'], $selectedGroups ) )
				{
					$selectedGroups[] = $perm['user_group_id'];
				}
			}

			foreach( $data['usergroups'] as $key => $usergroup )
			{
				if ( in_array( $usergroup['id'], $selectedGroups ) ) $data['usergroups'][$key]['selected'] = 1;
				else $data['usergroups'][$key]['selected'] = 0;
			}
		}
		else
		{
			foreach( $data['usergroups'] as $key => $usergroup )
			{
				$data['usergroups'][$key]['selected'] = 0;
			}
		}
		
		// Set the template to use for the permissions form

		$template = $paths->get( 'lib', '/html/user/permissions_form.html' );

		// Process the template and return the permissions form

		return process( $template, $data );
	}

/**
 * Save user group permissions for a site/module/task/object.
 * @param integer $sid The ID of the site to save relationships for
 * @param integer $mid The ID of the module to save relationships for
 * @param integer $tid The ID of the task to save relationships for
 * @param integer $oid The ID of the object to save relationships for
 * @param integer $otable The table name of the object to save relationships for
 * @param array $post $_POST data
 */
	function savepermissions( $sid = 0, $mid = 0, $tid = 0, $oid = 0, $otable = '', $post = Array( ) )
	{
		// Save groups that have permission to access this site

		$existingGroups = Array( );
		$enabledGroups = $this->getaccess( $sid, $mid, $tid, 0, 0, $oid, $otable );

		// Delete groups that no longer have permission

		if ( empty( $post[$this->permissionscolumns['groupid']['field']] ) ) $post[$this->permissionscolumns['groupid']['field']] = Array( );

		// Iterate through permissions for the current site, module, task or object
		
		foreach ( $enabledGroups as $enabledGroup )
		{
			// Track whether the current permission in $enabledGroup is a valid permission for the current site, module, task or object

			$isvalid = FALSE;

			// Check if we are saving a site permission
			
			if ( !empty( $sid ) )
			{
				if ( $this->savepermissions__is_site_group_permission( $enabledGroup ) ) $isvalid = TRUE;
			}
			
			// Check if we are saving a module permission
			
			else if ( !empty( $mid ) )
			{
				if ( $this->savepermissions__is_module_group_permission( $enabledGroup ) ) $isvalid = TRUE;
			}
			
			// Check if we are saving a task permission
			
			else if ( !empty( $tid ) )
			{
				if ( $this->savepermissions__is_task_group_permission( $enabledGroup ) ) $isvalid = TRUE;
			}
			
			// Check if we are saving an object permission
			
			else if ( !empty( $oid ) && !empty( $otable ) )
			{
				if ( $this->savepermissions__is_object_group_permission( $enabledGroup ) ) $isvalid = TRUE;
			}
			
			// If the current permission is valid for the specific site, module, task or object and user group
			
			if ( $isvalid == TRUE )
			{
				// Check if the current permission in $enabledGroup was selected on the permissions form
			
				if ( !in_array( $enabledGroup[$this->permissionscolumns['groupid']['field']], $post[$this->permissionscolumns['groupid']['field']] ) )
				{
					// If the current valid permission was not selected, revoke it
					
					$deleted = $this->revokeaccess( $sid, $mid, $tid, 0, $enabledGroup[$this->permissionscolumns['groupid']['field']], $oid, $otable );
				}
				else
				{
					// If the current valid permission was selected, then it already exists in the db and should not be added or deleted
					
					$existingGroups[] = $enabledGroup[$this->permissionscolumns['groupid']['field']];
				}
			}
		}

		// Iterate through selected groups from the permissions form

		if ( !empty( $post['group_id'] ) )
		{
			foreach ( $post['group_id'] as $groupid )
			{
				// If the selected group permission does not exist, add the permission to the database
				
				if ( !in_array( $groupid, $existingGroups ) ) $this->setaccess( $sid, $mid, $tid, 0, $groupid, $oid, $otable );
			}
		}
	}
	
/**
 * Is the permission in $permission for a specific site and user group
 * @param array $permission Contains an array populated with a row from the permissions table in the database
 * @return boolean Return true if the permission is for a specific site and user group, otherwise return false
 */
	function savepermissions__is_site_group_permission( $permission )
	{
		if ( !empty( $permission[$this->permissionscolumns['siteid']['field']] )
			 and empty( $permission[$this->permissionscolumns['moduleid']['field']] )
			 and empty( $permission[$this->permissionscolumns['taskid']['field']] )
			 and empty( $permission[$this->permissionscolumns['userid']['field']] )
			 and !empty( $permission[$this->permissionscolumns['groupid']['field']] )
			 and empty( $permission[$this->permissionscolumns['objectid']['field']] )
			 and empty( $permission[$this->permissionscolumns['objecttable']['field']] ) )
		{
			return TRUE;
		}
		
		return FALSE;
	}

/**
 * Is the permission in $permission for a specific module and user group
 * @param array $permission Contains an array populated with a row from the permissions table in the database
 * @return boolean Return true if the permission is for a specific module and user group, otherwise return false
 */
	function savepermissions__is_module_group_permission( $permission )
	{
		if ( empty( $permission[$this->permissionscolumns['siteid']['field']] )
			 and !empty( $permission[$this->permissionscolumns['moduleid']['field']] )
			 and empty( $permission[$this->permissionscolumns['taskid']['field']] )
			 and empty( $permission[$this->permissionscolumns['userid']['field']] )
			 and !empty( $permission[$this->permissionscolumns['groupid']['field']] )
			 and empty( $permission[$this->permissionscolumns['objectid']['field']] )
			 and empty( $permission[$this->permissionscolumns['objecttable']['field']] ) )
		{
			return TRUE;
		}
		
		return FALSE;
	}

/**
 * Is the permission in $permission for a specific task and user group
 * @param array $permission Contains an array populated with a row from the permissions table in the database
 * @return boolean Return true if the permission is for a specific task and user group, otherwise return false
 */
	function savepermissions__is_task_group_permission( $permission )
	{
		if ( empty( $permission[$this->permissionscolumns['siteid']['field']] )
			 and empty( $permission[$this->permissionscolumns['moduleid']['field']] )
			 and !empty( $permission[$this->permissionscolumns['taskid']['field']] )
			 and empty( $permission[$this->permissionscolumns['userid']['field']] )
			 and !empty( $permission[$this->permissionscolumns['groupid']['field']] )
			 and empty( $permission[$this->permissionscolumns['objectid']['field']] )
			 and empty( $permission[$this->permissionscolumns['objecttable']['field']] ) )
		{
			return TRUE;
		}
		
		return FALSE;
	}

/**
 * Is the permission in $permission for a specific object and user group
 * @param array $permission Contains an array populated with a row from the permissions table in the database
 * @return boolean Return true if the permission is for a specific object and user group, otherwise return false
 */
	function savepermissions__is_object_group_permission( $permission )
	{
		if ( empty( $permission[$this->permissionscolumns['siteid']['field']] )
			 and empty( $permission[$this->permissionscolumns['moduleid']['field']] )
			 and empty( $permission[$this->permissionscolumns['taskid']['field']] )
			 and empty( $permission[$this->permissionscolumns['userid']['field']] )
			 and !empty( $permission[$this->permissionscolumns['groupid']['field']] )
			 and !empty( $permission[$this->permissionscolumns['objectid']['field']] )
			 and !empty( $permission[$this->permissionscolumns['objecttable']['field']] ) )
		{
			return TRUE;
		}
		
		return FALSE;
	}
}

?>