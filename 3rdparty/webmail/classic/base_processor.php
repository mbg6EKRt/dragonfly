<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/../'));
	
	require_once(WM_ROOTPATH.'common/inc_constants.php');
	require_once(WM_ROOTPATH.'class_settings.php');
	
	$settings =& Settings::CreateInstance();
	if (!$settings->IncludeLang())
	{
		header('Location: index.php?error=6');
		exit();	
	}

	require_once(WM_ROOTPATH.'classic/base_defines.php');
	require_once(WM_ROOTPATH.'class_mailprocessor.php');
	require_once(WM_ROOTPATH.'class_filesystem.php');
	
	class BaseProcessor
	{
		/**
		 * @var Account
		 */
		var $account = null;
		
		/**
		 * @var MailProcessor
		 */
		var $processor = null;
		
		/**
		 * @var Settings
		 */
		var $settings = null;
		
		/**
		 * @var string;
		 */
		var $error = '';
		
		/**
		 * @var Array
		 */
		var $sArray;
		
		/**
		 * @return BaseProcessor
		 */
		function BaseProcessor()
		{
			if (!Session::has(S_ACCT_ARRAY))
			{
				$this->SetError(1);
			}
			
			$this->account =& Account::CreateInstance();
			if (!$this->account) $this->SetError(1);

			$this->settings = &Settings::CreateInstance();
			
			if (!$this->settings || !$this->settings->isLoad) $this->SetError(3);
			$this->settings->ViewMode = VIEW_MODE_WITHOUT_PREVIEW_PANE;

			$this->sArray = Session::val(SARRAY, array());
			$this->processor = &new MailProcessor($this->account);
	
			$skins = &FileSystem::GetSkinsList();
			$hasDefSettingsSkin = false;
			$normalSkin = false;
			
			foreach ($skins as $skinName)
			{
				if ($skinName == $this->settings->DefaultSkin)
				{
					$hasDefSettingsSkin = true;
				}
				
				if ($skinName == $this->account->DefaultSkin)
				{
					$normalSkin = true;
					break;
				}
			}
			
			if (!$normalSkin)
			{
				$this->settings->DefaultSkin = ($hasDefSettingsSkin) 
						? $this->settings->DefaultSkin
						: $skins[0];
			}
			
			$_SESSION[ATTACH_DIR] = Session::val(ATTACH_DIR, md5(session_id()));
			
			$this->sArray[SCREEN] = (isset($this->sArray[SCREEN])) 
					? Get::val(SCREEN, $this->sArray[SCREEN])
					: Get::val(SCREEN, SCREEN_MAILBOX);
			
			$this->sArray[PAGE] = (isset($this->sArray[PAGE])) 
					? Get::val(PAGE, $this->sArray[PAGE]) : 1;
			
			$this->UpdateSession();
		}
		
		/**
		 * @param string $text
		 */
		function SetError($errorCode)
		{
			header('location: '.LOGINFILE.'?error='.$errorCode);
			exit();
		}
		
		function UpdateSession()
		{
			$_SESSION[SARRAY] = $this->sArray;
		}
	}
