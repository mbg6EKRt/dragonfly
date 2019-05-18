<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));
	
	require_once(WM_ROOTPATH.'class_settings.php');
	require_once(WM_ROOTPATH.'class_mailstorage.php');
	require_once(WM_ROOTPATH.'class_pop3storage.php');
	require_once(WM_ROOTPATH.'common/class_i18nstring.php');
	require_once(WM_ROOTPATH.'common/class_datetime.php');
	require_once(WM_ROOTPATH.'class_validate.php');
	
	define('VIEW_MODE_WITHOUT_PREVIEW_PANE', 2);
	define('VIEW_MODE_PREVIEW_PANE', 3);

	define('S_ACCT_ARRAY', 'account_array');
		define('S_ACCT_MAIL', 'a_mail');
		define('S_ACCT_LOGIN', 'a_login');
		define('S_ACCT_PASS', 'a_pass');
		define('S_ACCT_INC_HOST', 'a_inchost');
		define('S_ACCT_INC_PORT', 'a_incport');
		define('S_ACCT_OUT_HOST', 'a_outhost');
		define('S_ACCT_OUT_PORT', 'a_outport');
		define('S_ACCT_USE_SMTP_AUTH', 'a_usesmtpauth');
		
	define('DEMOACCOUNTEMAIL', 'xxxx@xxxxx.com');
	define('DEMOACCOUNTPASS', 'xxxxx');
	define('DEMOACCOUNTALLOW', 0);
	
	define('DEMOACCOUNTMSGCOUNT', 'demomsgcount');
	define('DEMOACCOUNTRECCOUNT', 'demoreccount');
	
	class Account
	{
		/**
		 * @var string
		 */
		var $Email;
    
		/**
		 * @var short
		 */
		var $MailProtocol = MAILPROTOCOL_POP3;

		/**
		 * @var string
		 */
    	var $MailIncHost;

		/**
		 * @var string
		 */
		var $MailIncLogin;

		/**
		 * @var string
		 */
		var $MailIncPassword;
    
		/**
		 * @var short
		 */
		var $MailIncPort = 110;
    
		/**
		 * @var string
		 */
		var $MailOutHost;

		/**
		 * @var string
		 */
		var $MailOutLogin = '';
    
		/**
		 * @var string
		 */
		var $MailOutPassword = '';

		/**
		 * @var short
		 */
		var $MailOutPort = 25;
    
		/**
		 * @var bool
		 */
		var $MailOutAuthentication = 1;

		/**
		 * @var short
		 */
		var $MailsPerPage;
    
		/**
		 * @var string
		 */
		var $DefaultSkin = DEFAULT_SKIN;

		/**
		 * @var string
		 */
		var $DefaultLanguage;

		/**
		 * @var string
		 */
		var $DefaultIncCharset = CPAGE_ISO8859_1;

		/**
		 * @var string
		 */
		var $DefaultOutCharset = CPAGE_ISO8859_1;

		/**
		 * @var short
		 */
		var $DefaultTimeZone;

		/**
		 * @var bool
		 */
		var $HideFolders;

		/**
		 * @var long
		 */
		var $MailboxLimit;

		/**
		 * @var string
		 */
		var $DbCharset = CPAGE_UTF8;
		
		/**
		 * @var short
		 */
		var $ViewMode = VIEW_MODE_PREVIEW_PANE;
		
		/**
		 * @static
		 * @return Account
		 */
		function &CreateInstance($IsNew = false)
		{
			static $instance;
			if ($IsNew)
			{
				$_SESSION[S_ACCT_ARRAY] = array();
				$instance = new Account(null);
				unset($_SESSION[S_ACCT_ARRAY]);
			}
			
    		if (!is_object($instance))
    		{
    			if (isset($_SESSION[S_ACCT_ARRAY]))
		    	{
					$instance = new Account(null);
		    	}
    		}
    		
    		return $instance;
		}
		
		/**
		 * @return Account
		 */
		function Account($param = true)
		{
		    if (!is_null($param))
		    {
		    	die(CANT_CALL_CONSTRUCTOR);
		    }			

		    $this->ReloadSettings();
		    $this->Load();		    	
		}
		
		function ReloadSettings()
		{
		    $settings =& Settings::CreateInstance();
			
			$this->MailsPerPage = ((int) $settings->MailsPerPage > 0) ? (int) $settings->MailsPerPage : 20;
			$this->DefaultSkin = $settings->DefaultSkin;
			$this->DefaultLanguage = $settings->DefaultLanguage;
			$this->DefaultTimeZone = $settings->DefaultTimeZone;
			$this->MailboxLimit = $settings->MailboxSizeLimit;
			
			$this->MailIncHost = $settings->IncomingMailServer;
			$this->MailIncPort = $settings->IncomingMailPort;
			$this->MailOutHost = $settings->OutgoingMailServer;
			$this->MailOutPort = $settings->OutgoingMailPort;
			
			$this->MailProtocol = $settings->IncomingMailProtocol;
			
			$this->DefaultIncCharset = $settings->DefaultUserCharset;
			$this->DefaultOutCharset = $settings->DefaultUserCharset;			
		}
		
		/**
		 * @return string
		 */
		function GetDefaultIncCharset()
		{
			if ($this->DefaultIncCharset == 'default')
			{
				return CPAGE_ISO8859_1;
			}
			return $this->DefaultIncCharset;
		}
		
		/**
		 * @return string
		 */
		function GetDefaultOutCharset()
		{
			if ($this->DefaultOutCharset == 'default')
			{
				return CPAGE_UTF8;
			}
			return $this->DefaultOutCharset;
		}

		/**
		 * @return string
		 */
		function GetUserCharset()
		{
			return CPAGE_UTF8;
		}
		
		/**
		 * @return bool
		 */
		function Update()
		{
			$sessArray = array();
			$sessArray[S_ACCT_MAIL] = $this->Email;
			$sessArray[S_ACCT_LOGIN] = $this->MailIncLogin;
			$sessArray[S_ACCT_PASS] = $this->MailIncPassword;
			
			$sessArray[S_ACCT_INC_HOST] = $this->MailIncHost;
			$sessArray[S_ACCT_INC_PORT] = $this->MailIncPort;
			
			$sessArray[S_ACCT_OUT_HOST] = $this->MailOutHost;
			$sessArray[S_ACCT_OUT_PORT] = $this->MailOutPort;
			
			$sessArray[S_ACCT_USE_SMTP_AUTH] = (string) (int) $this->MailOutAuthentication;
			
			$_SESSION[S_ACCT_ARRAY] = $sessArray;
			
			return true;
		}
		
		function Load()
		{
			if (isset($_SESSION[S_ACCT_ARRAY]))
			{
				$this->Email = isset($_SESSION[S_ACCT_ARRAY][S_ACCT_MAIL]) ? $_SESSION[S_ACCT_ARRAY][S_ACCT_MAIL] : $this->Email;
				$this->MailIncLogin = isset($_SESSION[S_ACCT_ARRAY][S_ACCT_LOGIN]) ? $_SESSION[S_ACCT_ARRAY][S_ACCT_LOGIN] : $this->MailIncLogin;
				$this->MailIncPassword = isset($_SESSION[S_ACCT_ARRAY][S_ACCT_PASS]) ? $_SESSION[S_ACCT_ARRAY][S_ACCT_PASS] : $this->MailIncPassword;
			
				$this->MailIncHost = isset($_SESSION[S_ACCT_ARRAY][S_ACCT_INC_HOST]) ? $_SESSION[S_ACCT_ARRAY][S_ACCT_INC_HOST] : $this->MailIncHost;
				$this->MailIncPort = isset($_SESSION[S_ACCT_ARRAY][S_ACCT_INC_PORT]) ? $_SESSION[S_ACCT_ARRAY][S_ACCT_INC_PORT] : $this->MailIncPort;

				$this->MailOutHost = isset($_SESSION[S_ACCT_ARRAY][S_ACCT_OUT_HOST]) ? $_SESSION[S_ACCT_ARRAY][S_ACCT_OUT_HOST] : $this->MailOutHost;
				$this->MailOutPort = isset($_SESSION[S_ACCT_ARRAY][S_ACCT_OUT_PORT]) ? $_SESSION[S_ACCT_ARRAY][S_ACCT_OUT_PORT] : $this->MailOutPort;
				
				$this->MailOutAuthentication = isset($_SESSION[S_ACCT_ARRAY][S_ACCT_USE_SMTP_AUTH]) ? (bool) $_SESSION[S_ACCT_ARRAY][S_ACCT_USE_SMTP_AUTH] : $this->MailOutPort;
			}
		}
		
		/**
		 * @return bool
		 */
		function Delete()
		{
			if (isset($_SESSION[S_ACCT_ARRAY])) unset($_SESSION[S_ACCT_ARRAY]);
			return true;
		}
		
		/**
		 * @return string/boot
		 */
		function ValidateData()
		{
			
			if (!ConvertUtils::CheckFileName($this->Email))
			{
				return JS_LANG_WarningCorrectEmail;
			}
			elseif(empty($this->Email))
			{
				return JS_LANG_WarningEmailFieldBlank;
			}
			elseif(!Validate::checkEmail($this->Email))
			{
				return JS_LANG_WarningCorrectEmail;
			}
			elseif(empty($this->MailIncLogin))
			{
				return WarningLoginFieldBlank;
			}
			elseif(!Validate::checkLogin($this->MailIncLogin))
			{
				return JS_LANG_WarningCorrectEmail;
			}
			elseif(empty($this->MailIncPassword))
			{
				return JS_LANG_WarningCorrectEmail;
			}
			elseif(empty($this->MailIncHost))
			{
				return JS_LANG_WarningIncServerBlank;
			}
			elseif(!Validate::checkServerName($this->MailIncHost))
			{
				return WarningCorrectIncServer;
			}
			elseif(empty($this->MailIncPort))
			{
				return JS_LANG_WarningIncPortBlank;
			}
			elseif(!Validate::checkPort($this->MailIncPort))
			{
				return JS_LANG_WarningIncPortNumber.' '.JS_LANG_DefaultIncPortNumber;
			}
			elseif(empty($this->MailOutHost))
			{
				return JS_LANG_WarningOutPortBlank;
			}
			elseif(!Validate::checkServerName($this->MailOutHost))
			{
				return WarningCorrectSMTPServer;
			}
			elseif(empty($this->MailOutPort))
			{
				return JS_LANG_WarningOutPortBlank;
			}
			elseif(!Validate::checkPort($this->MailOutPort))
			{
				return JS_LANG_WarningOutPortNumber.' '.JS_LANG_DefaultOutPortNumber;
			}				
			return true;	
		}
	
		/**
		 * @return short
		 */
		function GetDefaultTimeOffset($otherTimeZone = null)
		{
			$timeArray = localtime(time(), true);
			
			$daylightSaveMinutes = $timeArray['tm_isdst']*60;
			
			$timeOffset = 0;
			
			$varForSwitch = ($otherTimeZone !== null)  ? $otherTimeZone : $this->DefaultTimeZone;
			
			switch ($varForSwitch)
			{
				default:
				case 0:
					return (ConvertUtils::GmtMkTime()-mktime())/60;
					break;
				case 1:
					$timeOffset =  -12*60;
					break;
				case 2:
					$timeOffset =  -11*60;
					break;
				case 3:
					$timeOffset =  -10*60;
					break;
				case 4:
					$timeOffset =  -9*60;
					break;
				case 5:
					$timeOffset =  -8*60;
					break;
				case 6:
				case 7:
					$timeOffset =  -7*60;
					break;
				case 8:
				case 9:
				case 10:
				case 11:
					$timeOffset =  -6*60;
					break;
				case 12:
				case 13:
				case 14:
					$timeOffset =  -5*60;
					break;
				case 15:
				case 16:
				case 17:
					$timeOffset =  -4*60;
					break;
				case 18:
					$timeOffset =  -3.5*60;
					break;
				case 19:
				case 20:
				case 21:
					$timeOffset =  -3*60;
					break;
				case 22:
					$timeOffset =  -2*60;
					break;
				case 23:
				case 24:
					$timeOffset =  -60;
					break;
				case 25:
				case 26:
					$timeOffset =  0;
					break;
				case 27:
				case 28:
				case 29:
				case 30:
				case 31:
					$timeOffset =  60;
					break;
				case 32:
				case 33:
				case 34:
				case 35:
				case 36:
				case 37:
					$timeOffset =  2*60;
					break;
				case 38:
				case 39:
				case 40:
				case 41:
					$timeOffset =  3*60;
					break;
				case 42:
					$timeOffset =  3.5*60;
					break;
				case 43:
				case 44:
					$timeOffset =  4*60;
					break;
				case 45:
					$timeOffset =  4.5*60;
					break;
				case 46:
				case 47:
					$timeOffset =  5*60;
					break;
				case 48:
					$timeOffset =  5.5*60;
					break;
				case 49:
					$timeOffset =  5*60+45;
					break;
				case 50:
				case 51:
				case 52:
					$timeOffset =  6*60;
					break;
				case 53:
					$timeOffset =  6.5*60;
				case 54:
				case 55:
					$timeOffset =  7*60;
					break;
				case 56:
				case 57:
				case 58:
				case 59:
				case 60:
					$timeOffset =  8*60;
					break;
				case 61:
				case 62:
				case 63:
					$timeOffset =  9*60;
					break;
				case 64:
				case 65:
					$timeOffset =  9.5*60;
					break;
				case 66:
				case 67:
				case 68:
				case 69:
				case 70:
					$timeOffset =  10*60;
					break;
				case 71:
					$timeOffset =  11*60;
					break;
				case 72:
				case 73:
					$timeOffset =  12*60;
					break;
				case 74:
					$timeOffset =  13*60;
					break;
			}
			
			return $timeOffset + $daylightSaveMinutes;
		}
	}
