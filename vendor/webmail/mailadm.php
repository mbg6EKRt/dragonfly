<?php

	header('Content-type: text/html; charset=utf-8');
	
	define('MES_SAVESUCCESSFUL', '<font color=green><b>Save successful!</b></font>');
	define('MES_SAVESUCCESSFULBUT', '<font color=green><b>Save successful, but not change Admin password!</b></font>');
	define('MES_SAVESUCCESSFULBUT2', '<font color=green><b>Save successful, but not change Mail Server Integration Admin password!</b></font>');
	define('MES_ERROR', '<font color=red><b>Error</b></font>');
	define('MES_LOGCLEARSUCCESSFUL', '<font color=green><b>Log clear successful!</b></font>');
	
	@session_start();	
	
	$divMessage = '';
	if (isset($_SESSION['divmess']) && strlen($_SESSION['divmess']) > 0)
	{
		$divMessage = $_SESSION['divmess'];
		unset($_SESSION['divmess']);
	}
	
	function GetFriendlySize($byteSize)
	{
		$size = ceil($byteSize / 1024);
		$mbSize = $size / 1024;
		$size = ($mbSize > 1) ? (ceil($mbSize*10)/10).'MB' : $size.'KB';
		return $size;
	}
		
	function disable_magic_quotes_gpc()
	{
		if (@get_magic_quotes_gpc() == 1)
		{
			$_REQUEST = array_map ('stripslashes' , $_REQUEST);
			$_POST = array_map ('stripslashes' , $_POST);
		}
	}
	
	@disable_magic_quotes_gpc();
	
	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));
	
	$isconfig = true;
	if (file_exists(WM_ROOTPATH.'lang/English.php'))
	{
		require_once(WM_ROOTPATH.'lang/English.php');
		require_once(WM_ROOTPATH.'class_filesystem.php');
		require_once(WM_ROOTPATH.'class_account.php');
	}
	else 
	{
		$isconfig = false;
	}
	
	$mode = isset($_GET['mode']) ? $_GET['mode'] : 'login';
	$null = null;
	$navId = 3;
	$isCorrect = false;
	
	if ($isconfig)
	{
		$settings = &Settings::CreateInstance();
		if (!$settings->isLoad)
		{
			$isconfig = false;
		}
	}
	
	if (!$isconfig)
	{
		?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta http-equiv="Cache-Control" content="private,max-age=1209600" />
	<title>WebMail probably not configured</title>
	<link rel="stylesheet" href="skins/Hotmail_Style/styles.css" type="text/css" />
</head>
<body>
<div align="center" id="content" class="wm_content">
	<div class="wm_logo" id="logo" tabindex="-1"></div>
	<div class="wm_login_error">The web-server has no permission to write into the settings file<br/>or<br/>settings file not exists<br/><?php echo INI_DIR ?>/settings/settings.xml<br/>
	
	or<br/>Language file (English.php) not exists<br/>
	<br/>To learn how to grant the appropriate permission, please refer to WebMail documentation:<br/><br/><a href='help/installation_instructions_win.html'>Installation Instructions for Windows</a><br/>
	<a href='help/installation_instructions_unix.html'>Installation Instructions for Unix</a></div>
		<div class="wm_copyright" id="copyright">
		<?php
		@require('inc.footer.php');
		echo '</div></div>';
		die();
	}
	
	$skins = &FileSystem::GetSkinsList();
	$deff = '';
	
	foreach ($skins as $skinName)
	{
		if ($skinName == $settings->DefaultSkin)
		{
			$deff = $settings->DefaultSkin;
			break;
		}
	}
	if ($deff == '')
	{
		$deff = (count($skins) > 0) ? $skins[0] : 'Hotmail_Style';
	}
	
	$skinPath = './skins/'.$deff;
	$ref = '';
	
	if ($mode == 'enter')
	{
		if (isset($_POST['login']) && isset($_POST['password']) &&
					strtolower($_POST['login']) == MAILADMLOGIN &&
					$_POST['password'] == $settings->AdminPassword)
		{
			$_SESSION['passwordIsCorrect'] = 15;	
			$isCorrect = true;
			$mode = 'wm_settings';
		}
		else 
		{
			$mode = 'login';
			$_GET['error'] = 3;
		}
	} 
		
	$isCorrect = (isset($_SESSION['passwordIsCorrect']) && (int) $_SESSION['passwordIsCorrect'] == 15);
	
	if ($isCorrect)
	{
		if ($mode == 'clearlog')
		{
			$ph = @fopen(INI_DIR.'/'.LOG_PATH.'/'.LOG_FILENAME, 'w');
			if ($ph) 
			{
				@fwrite($ph, '');
				@fclose($ph);
				$_SESSION['divmess'] = MES_LOGCLEARSUCCESSFUL;
			}
			else 
			{
				$_SESSION['divmess'] = MES_ERROR;
			}
		
			$ref = 'mailadm.php?mode=wm_debug';
		}
		
		if ($mode == 'save')
		{
			$ref_mode = '';
			$form_id = isset($_POST['form_id']) ? $_POST['form_id'] : 'error';
			switch ($form_id)
			{
				case 'error' : 
					$mode = 'login';
					break;
					
				case 'settings' :
					$settings->WindowTitle = isset($_POST['txtSiteName']) ? $_POST['txtSiteName'] : $settings->WindowTitle;
					$settings->IncomingMailServer = isset($_POST['txtIncomingMail']) ? $_POST['txtIncomingMail'] : $settings->IncomingMailServer;
					$settings->IncomingMailPort = isset($_POST['intIncomingMailPort']) ? $_POST['intIncomingMailPort'] : $settings->IncomingMailPort;
					$settings->OutgoingMailServer = isset($_POST['txtOutgoingMail']) ? $_POST['txtOutgoingMail'] : $settings->OutgoingMailServer;
					$settings->OutgoingMailPort = isset($_POST['intOutgoingMailPort']) ? $_POST['intOutgoingMailPort'] : $settings->OutgoingMailPort;
					
					$settings->ReqSmtpAuth = (isset($_POST['intReqSmtpAuthentication']) && (int) $_POST['intReqSmtpAuthentication'] == 1);
	
					$settings->AttachmentSizeLimit = isset($_POST['intAttachmentSizeLimit']) ? abs((int) $_POST['intAttachmentSizeLimit']) : $settings->AttachmentSizeLimit;
					$settings->MailboxSizeLimit = isset($_POST['intMailboxSizeLimit']) ? abs((int) $_POST['intMailboxSizeLimit']) : $settings->MailboxSizeLimit;

					$settings->EnableAttachmentSizeLimit = (isset($_POST['intEnableAttachSizeLimit']) && $_POST['intEnableAttachSizeLimit'] == '1');
					$settings->EnableMailboxSizeLimit = (isset($_POST['intEnableMailboxSizeLimit']) && $_POST['intEnableMailboxSizeLimit'] == '1');
					
					$settings->DefaultUserCharset = isset($_POST['txtDefaultUserCharset']) ? $_POST['txtDefaultUserCharset'] : $settings->DefaultUserCharset;
					
					$settings->DefaultTimeZone = isset($_POST['txtDefaultTimeZone']) ? (int) $_POST['txtDefaultTimeZone'] : $settings->DefaultTimeZone;
					
					$temp = MES_SAVESUCCESSFUL;
					if (isset($_POST['txtPassword1']) && isset($_POST['txtPassword2']) && $_POST['txtPassword1'] != '***') 
					{
						if ($_POST['txtPassword1'] === $_POST['txtPassword2'])
						{
							$settings->AdminPassword = $_POST['txtPassword1'];	
						}
						else 
						{
							$temp = MES_SAVESUCCESSFULBUT;
						}
					}				
					
					$_SESSION['divmess'] = ($settings->SaveToXml()) ? $temp : MES_ERROR.getError();
					$ref = 'mailadm.php?mode=wm_settings';
					break;
					
				case 'interface' :
					$settings->MailsPerPage = isset($_POST['intMailsPerPage']) ? (int) $_POST['intMailsPerPage'] : $settings->MailsPerPage;
					if ($settings->MailsPerPage < 1) $settings->MailsPerPage = 1;
					$settings->DefaultSkin = isset($_POST['txtDefaultSkin']) ? $_POST['txtDefaultSkin'] : $settings->DefaultSkin;
					$settings->DefaultLanguage = isset($_POST['txtDefaultLanguage']) ? $_POST['txtDefaultLanguage'] : $settings->DefaultLanguage;
					
					$settings->ShowTextLabels = (isset($_POST['intShowTextLabels']) && (int) $_POST['intShowTextLabels'] == 1);
					$settings->AllowAjax = (isset($_POST['intAllowAjaxVeersion']) && (int) $_POST['intAllowAjaxVeersion'] == 1);				
					$settings->ViewMode = (isset($_POST['intViewMode']) && (int) $_POST['intViewMode'] == 1) ? VIEW_MODE_PREVIEW_PANE : VIEW_MODE_WITHOUT_PREVIEW_PANE;				
					
					$_SESSION['divmess'] = ($settings->SaveToXml()) ? MES_SAVESUCCESSFUL : MES_ERROR.getError();
					$ref = 'mailadm.php?mode=wm_interface';
					break;
					
				case 'debug' :
					$settings->EnableLogging = (isset($_POST['intEnableLogging']) && (int) $_POST['intEnableLogging'] == 1);
					
					$_SESSION['divmess'] = ($settings->SaveToXml()) ? MES_SAVESUCCESSFUL : MES_ERROR.getError();
					$ref = 'mailadm.php?mode=wm_debug';
					break;
				
				case 'login' :
					$settings->AllowAdvancedLogin = (isset($_POST['intAllowAdvancedLogin']) && (int) $_POST['intAllowAdvancedLogin'] == 1);
					$settings->AutomaticCorrectLoginSettings = (isset($_POST['intAutomaticHideLogin']) && (int) $_POST['intAutomaticHideLogin'] == 1);
					
					$settings->DefaultDomainOptional = isset($_POST['txtUseDomain']) ? $_POST['txtUseDomain'] : $settings->DefaultDomainOptional;
					$hideLoginMode = 0;
	
					if (isset($_POST['hideLoginRadionButton']))
					{
						switch ($_POST['hideLoginRadionButton'])
						{
							case '0': break;
							case '1':
								$hideLoginMode = 10;
								if (isset($_POST['hideLoginSelect']) && $_POST['hideLoginSelect'] == '1') $hideLoginMode++;
								break;
							case '2':
								$hideLoginMode = 20;
								if (isset($_POST['intDisplayDomainAfterLoginField']) && (int) $_POST['intDisplayDomainAfterLoginField'] == 1) $hideLoginMode++;
								if (isset($_POST['intLoginAsConcatination']) && (int) $_POST['intLoginAsConcatination'] == 1) $hideLoginMode = $hideLoginMode + 2;
								break;
						}
					}
				
					$settings->HideLoginMode = $hideLoginMode;
					
					$_SESSION['divmess'] = ($settings->SaveToXml()) ? MES_SAVESUCCESSFUL : MES_ERROR.getError();
					$ref = 'mailadm.php?mode=wm_domain';
					break;
			}
		}
		
		if (isset($ref) && strlen($ref) > 0)
		{
			header('Location: '.$ref);
			exit();
		}
			
		switch ($mode)
		{
			case 'showlog':
				header('Content-Type: text/plain');
				$minisize = 50000;
				$size = @filesize(INI_DIR.'/'.LOG_PATH.'/'.LOG_FILENAME);
								
				if ($size && $size > 0)
				{
					$fh = @fopen(INI_DIR.'/'.LOG_PATH.'/'.LOG_FILENAME, 'rb');
					if ($fh)
					{
						if (isset($_GET['t']) && $_GET['t'] == '1')
						{
							if ($size > $minisize)
							{
								@fseek($fh, $size - $minisize);
								$text = @fread($fh, $minisize);
							}
							else 
							{
								$text = @fread($fh, $size);
							}
						}
						else 
						{
							$text = @fread($fh, $size);
						}
					}
					else 
					{
						$text = 'Log File is empty or can\'t be read';
					}
				}	
				else 
				{
					$text = 'Log File is empty or can\'t be read';
				}
				
				echo ($text) ? $text : 'Log File is empty';
				break;
				
			case 'info':		
				echo '<center><b>MailBee WebMail PHP Lite '.WMVERSION.'</b><br />'.INI_DIR.'<br />'.__FILE__.'<br /><br /><br /></center>';
				phpinfo();
				exit();
				break;
				
			case 'wm_debug':
				$navId = 6;
				require_once(WM_ROOTPATH.'admin/main-top.php');
				require_once(WM_ROOTPATH.'admin/main-left.php');
				require_once(WM_ROOTPATH.'admin/main-center-debug.php');
				require_once(WM_ROOTPATH.'admin/main-foot.php');
				break;
				
			case 'wm_interface':
				$navId = 4;
				require_once(WM_ROOTPATH.'admin/main-top.php');
				require_once(WM_ROOTPATH.'admin/main-left.php');
				require_once(WM_ROOTPATH.'admin/main-center-interface.php');
				require_once(WM_ROOTPATH.'admin/main-foot.php');
				break;
				
			case 'wm_domain':
				$navId = 5;
				$checkmass = array();
				
				$settings->HideLoginMode = $settings->HideLoginMode.'';
				
				if (strlen($settings->HideLoginMode) > 0)
				{
					$checkmass[$settings->HideLoginMode{0}] = 'checked="checked"';
				}
				
				if (strlen($settings->HideLoginMode) > 1 && $settings->HideLoginMode{0} == '1')
				{
					switch ($settings->HideLoginMode{1})
					{
						case '0': $checkmass[3] = 'selected="selected"'; break;
						case '1': $checkmass[4] = 'selected="selected"'; break;
					}
				}
				elseif($settings->HideLoginMode == 0)
				{
					$checkmass[0] = 'checked="checked"';	
				}
				
				if (strlen($settings->HideLoginMode) > 1 && $settings->HideLoginMode{0} == '2')
				{
					switch ($settings->HideLoginMode{1})
					{
						case '1': $checkmass[5] = 'checked="checked"'; break;
						case '2': $checkmass[6] = 'checked="checked"'; break;
						case '3':
							$checkmass[5] = 'checked="checked"';
							$checkmass[6] = 'checked="checked"';
							break;
					}
				}
				
				require_once(WM_ROOTPATH.'admin/main-top.php');
				require_once(WM_ROOTPATH.'admin/main-left.php');
				require_once(WM_ROOTPATH.'admin/main-center-login.php');
				require_once(WM_ROOTPATH.'admin/main-foot.php');
				break;			
				
			case 'wm_settings':
				$navId = 3;
				require_once(WM_ROOTPATH.'admin/main-top.php');
				require_once(WM_ROOTPATH.'admin/main-left.php');
				require_once(WM_ROOTPATH.'admin/main-center-settings.php');
				require_once(WM_ROOTPATH.'admin/main-foot.php');
				break;
				
			case 'logout':
			case 'login':
				$mode = 'login';
				break;
			default:
				$_GET['error'] = 2;
				$mode = 'login';
				break;
		}
	}
	else 
	{
		if (strlen($mode) > 0 && $mode != 'login') 
		{
			$_GET['error'] = (isset($_SESSION['passwordIsCorrect'])) ? 2 : 1;
		}
		$mode = 'login';
	}
		
	if ($mode == 'login')
	{
		if (session_id()) session_destroy();
		
		$errorCode = isset($_GET['error']) ? (int) $_GET['error'] : -1;
		switch ($errorCode)
		{
			default:	$errorText = ''; break;
			case 1:	$errorText = 'The previous session was terminated due to a timeout.'; break;
			case 2:	$errorText = 'An attempt of unauthorized access.'; break;
			case 3:	$errorText = 'Wrong login and/or password. Authentication failed.'; break;
		}
		
		$errorDiv = (strlen($errorText) > 0) ? '<div class="wm_login_error" id="login_error">'.$errorText.'</div>' : '';
		require_once(WM_ROOTPATH.'admin/login.php');
	}
	
	/**
	 * @return string
	 */
	function getError()
	{
		return isset($GLOBALS[ErrorDesc]) ? '<br /><font color="red">'.ConvertUtils::WMHtmlSpecialChars(getGlobalError()).'</font>' : '';
	}
	
	/**
	 * @param string $str
	 * @param string $qoute
	 * @return string
	 */
	function dequote($str)
	{
		return str_replace('"', '&quot;', $str);
	}
