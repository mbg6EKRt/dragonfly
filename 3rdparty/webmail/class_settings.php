<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));
	
	if (!defined('IS_SETTINGS_REQUIRE'))
	{
		if (file_exists(WM_ROOTPATH.'inc_settings_path.php'))
		{
			require_once(WM_ROOTPATH.'inc_settings_path.php');
			define('IS_SETTINGS_REQUIRE', 1);
		}
		else 
		{
			exit('<font color="red">Can\'t find <b>inc_settings_path.php</b> file</font>');
		}
	}

	$dataPath = isset($dataPath) ? str_replace('\\', '/', rtrim(trim($dataPath), '/\\')) : '';
	if ($dataPath)
	{
		$dPath = str_replace('\\', '/', realpath($dataPath));
	}
	define('INI_DIR', isset($dPath) ? $dPath : $dataPath);
	
	require_once(WM_ROOTPATH.'common/class_xmldocument.php');
	require_once(WM_ROOTPATH.'common/class_convertutils.php');
	
	define('LOG_PATH', 'logs');
	
	define('DEFAULT_DATEFORMAT', 'default');
	
	define('MAILPROTOCOL_POP3', 0);
	define('MAILPROTOCOL_WMSERVER', 2);
	
		
	class Settings
	{
		/**
		 * @var string
		 */
		var $WindowTitle;

		/**
		 * @var string
		 */
		var $AdminPassword;
	
		/**
		 * @var int
		 */
		var $IncomingMailProtocol = MAILPROTOCOL_POP3;
		
		/**
		 * @var string
		 */
		var $IncomingMailServer;
	
		/**
		 * @var int
		 */
		var $IncomingMailPort;
	
		/**
		 * @var string
		 */
		var $OutgoingMailServer;
	
		/**
		 * @var int
		 */
		var $OutgoingMailPort;
	
		/**
		 * @var bool
		 */
		var $ReqSmtpAuth;
	
		/**
		 * @var bool
		 */
		var $AllowAdvancedLogin;
	
		/**
		 * @var int
		 */
		var $HideLoginMode;
	
		/**
		 * @var string
		 */
		var $DefaultDomainOptional;
	
		/**
		 * @var bool
		 */
		var $ShowTextLabels;
	
		/**
		 * @var bool
		 */
		var $AutomaticCorrectLoginSettings;
	
		/**
		 * @var bool
		 */
		var $EnableLogging;
	
		/**
		 * @var bool
		 */
		var $AllowAjax;
	
		/**
		 * @var int
		 */
		var $MailsPerPage;
		
		/**
		 * @var bool
		 */
		var $EnableAttachmentSizeLimit;
	
		/**
		 * @var long
		 */
		var $AttachmentSizeLimit;
	
		/**
		 * @var bool
		 */
		var $EnableMailboxSizeLimit;
		
		/**
		 * @var long
		 */
		var $MailboxSizeLimit;
	
		/**
		 * @var short
		 */
		var $DefaultTimeZone;
	
		/**
		 * @var string
		 */
		var $DefaultUserCharset;
	
		/**
		 * @var string
		 */
		var $DefaultSkin;
	
		/**
		 * @var string
		 */
		var $DefaultLanguage;
		
		/**
		 * @var int
		 */
		var $ViewMode;
	
		/**
		 * @var bool
		 */
		var $EnableWmServer = false;
		
		/**
		 * @var bool
		 */
		var $isLoad = false;
		
		/**
		 * @var bool
		 */
		var $_langIsInclude = false;
		
		/**
		 * @static
		 * @return Settings
		 */
		function &CreateInstance()
		{
			static $instance;
    		if (!is_object($instance))
    		{
				$instance = new Settings(null);
    		}
    		return $instance;
		}
		
		/**
		* @access private
		*/
		function Settings($param = true)
		{
		    if (!is_null($param))
		    {
		    	die(CANT_CALL_CONSTRUCTOR);
		    }
		    
		    $xmlDocument = &new XmlDocument();
		    if ($xmlDocument->LoadFromFile(INI_DIR . '/settings/settings.xml'))
		    {
		    	$this->isLoad = true;
		    	$this->_loadFromXML($xmlDocument->XmlRoot);
		    }
		}
		
		/**
		 * @return bool
		 */
		function IncludeLang()
		{
			if (!$this->isLoad)
			{
				return false;
			}
			
			if ($this->_langIsInclude)
			{
				return true;
			}
			
			if (file_exists(WM_ROOTPATH.'/lang/'.$this->DefaultLanguage.'.php'))
			{
				include_once(WM_ROOTPATH.'/lang/'.$this->DefaultLanguage.'.php');
				$this->_langIsInclude = true;
			}
			elseif (file_exists(WM_ROOTPATH.'/lang/English.php'))
			{
				include_once(WM_ROOTPATH.'/lang/English.php');
				$this->_langIsInclude = true;
			}
			
			return $this->_langIsInclude;
		}
		
		
		/**
		 * @access private
		 * @param XmlDomNode $xmlTree
		 */
		function _loadFromXML(&$xmlTree)
		{
			foreach ($xmlTree->Children as $node)
			{
				switch ($node->TagName)
				{
					case 'WindowTitle':
						$this->WindowTitle = ConvertUtils::WMBackHtmlSpecialChars($node->Value);
						break;
					case 'AdminPassword':
						$this->AdminPassword = ConvertUtils::WMBackHtmlSpecialChars($node->Value);
						break;
					case 'IncomingMailProtocol':
						$this->IncomingMailProtocol = (int) MAILPROTOCOL_POP3;
						break;
					case 'IncomingMailServer':
						$this->IncomingMailServer = ConvertUtils::WMBackHtmlSpecialChars($node->Value);
						break;
					case 'IncomingMailPort':
						$this->IncomingMailPort = (int) ConvertUtils::WMBackHtmlSpecialChars($node->Value);
						break;
					case 'OutgoingMailServer':
						$this->OutgoingMailServer = ConvertUtils::WMBackHtmlSpecialChars($node->Value);
						break;
					case 'OutgoingMailPort':
						$this->OutgoingMailPort = (int) ConvertUtils::WMBackHtmlSpecialChars($node->Value);
						break;
					case 'ReqSmtpAuth':
						$this->ReqSmtpAuth = (bool) $node->Value;
						break;
					case 'AllowAdvancedLogin':
						$this->AllowAdvancedLogin = (bool) $node->Value;
						break;
					case 'HideLoginMode':
						$this->HideLoginMode = (int) ConvertUtils::WMBackHtmlSpecialChars($node->Value);
						break;
					case 'DefaultDomainOptional':
						$this->DefaultDomainOptional = ConvertUtils::WMBackHtmlSpecialChars($node->Value);
						break;
					case 'ShowTextLabels':
						$this->ShowTextLabels = (bool) $node->Value;
						break;
					case 'AutomaticCorrectLoginSettings':
						$this->AutomaticCorrectLoginSettings = (bool) $node->Value;
						break;
					case 'EnableLogging':
						$this->EnableLogging = (bool) $node->Value;
						break;
					case 'AllowAjax':
						$this->AllowAjax = (bool) $node->Value;
						break;
					case 'MailsPerPage':
						$this->MailsPerPage = (int) ConvertUtils::WMBackHtmlSpecialChars($node->Value);
						break;
					case 'EnableAttachmentSizeLimit':
						$this->EnableAttachmentSizeLimit = (bool) $node->Value;
						break;						
					case 'AttachmentSizeLimit':
						$this->AttachmentSizeLimit = (int) ConvertUtils::WMBackHtmlSpecialChars($node->Value);
						break;
					case 'EnableMailboxSizeLimit':
						$this->EnableMailboxSizeLimit = (bool) $node->Value;
						break;
					case 'MailboxSizeLimit':
						$this->MailboxSizeLimit = (int) ConvertUtils::WMBackHtmlSpecialChars($node->Value);
						break;
					case 'DefaultTimeZone':
						$this->DefaultTimeZone = ConvertUtils::WMBackHtmlSpecialChars($node->Value);
						break;
					case 'DefaultUserCharset':
						$this->DefaultUserCharset = ConvertUtils::GetCodePageName($node->Value);
						break;
					case 'DefaultSkin':
						$this->DefaultSkin = ConvertUtils::WMBackHtmlSpecialChars($node->Value);
						break;
					case 'DefaultLanguage':
						$this->DefaultLanguage = ConvertUtils::WMBackHtmlSpecialChars($node->Value);
						break;
					case 'ViewMode':
						$this->ViewMode = (int) ConvertUtils::WMBackHtmlSpecialChars($node->Value);
						break;
					case 'EnableWmServer':
						$this->EnableWmServer = false;
						break;				
				}
			}
		}
		
		
		/**
		 * @return bool
		 */
		function SaveToXml()
		{
			$xmlDocument =& new XmlDocument();
			$xmlDocument->CreateElement('Settings');
			$xmlDocument->XmlRoot->AppendAttribute('xmlns:xsd', 'http://www.w3.org/2001/XMLSchema');
			$xmlDocument->XmlRoot->AppendAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('WindowTitle', ConvertUtils::WMHtmlSpecialChars($this->WindowTitle)));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('AdminPassword', ConvertUtils::WMHtmlSpecialChars($this->AdminPassword)));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('IncomingMailServer', ConvertUtils::WMHtmlSpecialChars($this->IncomingMailServer)));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('IncomingMailPort', (int) $this->IncomingMailPort));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('OutgoingMailServer', ConvertUtils::WMHtmlSpecialChars($this->OutgoingMailServer)));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('OutgoingMailPort', (int) $this->OutgoingMailPort));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('ReqSmtpAuth', (int) $this->ReqSmtpAuth));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('AllowAdvancedLogin', (int) $this->AllowAdvancedLogin));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('HideLoginMode', (int) $this->HideLoginMode));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('DefaultDomainOptional', ConvertUtils::WMHtmlSpecialChars($this->DefaultDomainOptional)));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('ShowTextLabels', (int)$this->ShowTextLabels));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('AutomaticCorrectLoginSettings', (int) $this->AutomaticCorrectLoginSettings));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('EnableLogging', (int) $this->EnableLogging));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('AllowAjax', (int) $this->AllowAjax));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('MailsPerPage', (int) $this->MailsPerPage));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('EnableAttachmentSizeLimit', (int) $this->EnableAttachmentSizeLimit));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('AttachmentSizeLimit', ConvertUtils::WMHtmlSpecialChars($this->AttachmentSizeLimit)));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('EnableMailboxSizeLimit', (int) $this->EnableMailboxSizeLimit));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('MailboxSizeLimit', ConvertUtils::WMHtmlSpecialChars($this->MailboxSizeLimit)));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('DefaultTimeZone', ConvertUtils::WMHtmlSpecialChars($this->DefaultTimeZone)));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('DefaultUserCharset', ConvertUtils::GetCodePageNumber($this->DefaultUserCharset)));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('DefaultSkin', ConvertUtils::WMHtmlSpecialChars($this->DefaultSkin)));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('DefaultLanguage', ConvertUtils::WMHtmlSpecialChars($this->DefaultLanguage)));
			$xmlDocument->XmlRoot->AppendChild(new XmlDomNode('ViewMode', (int) $this->ViewMode));
			
			return $xmlDocument->SaveToFile(INI_DIR . '/settings/settings.xml');
		}
	}

