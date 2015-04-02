<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));
	
	require_once(WM_ROOTPATH.'class_settings.php');
	require_once(WM_ROOTPATH.'common/class_log.php');
	
	define('ACTION_Remove', 0);
	define('ACTION_Set', 1);
	
	/**
	 * @abstract
	 */
	class MailStorage
	{

		/**
		 * @access protected
		 * @var Account
		 */
		var $Account;
	
		/**
		 * @access protected
		 * @var Settings
		 */
		var $_settings;
	
		/**
		 * @access protected
		 * @var CLog
		 */
		var $_log;
		
		/**
		 * @access protected
		 * @var resource
		 */
		var $_connectionHandle = null;
		
		/**
		 * @param Account $account
		 * @return MailStorage
		 */
		function MailStorage(&$account)
		{
			$this->_settings =& Settings::CreateInstance();
			$this->_log =& CLog::CreateInstance();
			$this->Account =& $account;
		}
	}
	
	/**
	 * @abstract
	 */
	class MailServerStorage extends MailStorage
	{
		/**
		 * @param Account $account
		 * @return MailServerStorage
		 */
		function MailServerStorage(&$account)
		{
			MailStorage::MailStorage($account);
		}
	}
