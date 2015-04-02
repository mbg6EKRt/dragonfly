<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));
	
	require_once(WM_ROOTPATH.'class_settings.php');
	require_once(WM_ROOTPATH.'class_mailprocessor.php');
	require_once(WM_ROOTPATH.'class_filesystem.php');

	@session_name('PHPWEBMAILSESSID');
	@session_start();
	$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : 'standard';
	if ($mode == 'logout')
	{
		@session_destroy();
		@session_name('PHPWEBMAILSESSID');
		@session_start();
	}
	
	$errorClass = 'wm_hide'; //if there is no error
	$errorDesc = '';
	$null = null;
	$error = isset($_REQUEST['error']) ? $_REQUEST['error'] : '';
	$isconfig = true;
	
	$settings =& Settings::CreateInstance();
	if (!$settings->isLoad) 
	{
		$isconfig = false;
	}
	elseif (!$settings->IncludeLang())
	{
		$isconfig = false;
		$error = '1';
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
	<div class="wm_login_error">WebMail probably not configured</div>
	<div class="wm_copyright" id="copyright">
		<?php
		@require('inc.footer.php');
		echo '</div></div>';
		exit();
	}	
	
	if ($error == '1') 
	{//session error
		$errorDesc = PROC_SESSION_ERROR;
		$errorClass = 'wm_login_error';
	}
	elseif ($error == '2') 
	{ // account error
		$errorDesc = PROC_CANT_LOAD_ACCT;
		$errorClass = 'wm_login_error';
	}
	elseif ($error == '3') 
	{ // settings error
		$errorDesc = PROC_CANT_GET_SETTINGS;
		$errorClass = 'wm_login_error';
	}
	elseif ($error == '6') 
	{ // connection error
		$errorDesc = 'Can\'t find required language file.';
		$errorClass = 'wm_login_error';
	}
	
	@header('Content-type: text/html; charset=utf-8');

	define('defaultTitle', $settings->WindowTitle);
	
	$skins =& FileSystem::GetSkinsList();
	
	foreach ($skins as $skinName)
	{
		if ($skinName == $settings->DefaultSkin)
		{
			define('defaultSkin', $settings->DefaultSkin);
			break;
		}
	}
	
	if (!defined('defaultSkin'))
	{
		define('defaultSkin', $skins[0]);
	}
	
	define('defaultIncServer', $settings->IncomingMailServer);
	define('defaultIncPort', $settings->IncomingMailPort);
	define('defaultOutServer', $settings->OutgoingMailServer);
	define('defaultOutPort', $settings->OutgoingMailPort);
	define('defaultUseSmtpAuth', $settings->ReqSmtpAuth);
	define('defaultIsAjax', $settings->AllowAjax ? 'true' : 'false');
	define('defaultAllowAdvancedLogin', $settings->AllowAdvancedLogin);
	define('defaultHideLoginMode', $settings->HideLoginMode);
	define('defaultDomainOptional', $settings->DefaultDomainOptional);

	$smtpAuthChecked = (defaultUseSmtpAuth) ? ' checked="checked"' : '';
	
	//for version without ajax
	$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : 'standard'; //mode = standard|advanced|submit
	if ($mode == 'submit' && 
		!isset($_REQUEST['email'], $_REQUEST['login'], $_REQUEST['password'], $_REQUEST['inc_server'], $_REQUEST['inc_port'], $_REQUEST['out_server'], $_REQUEST['out_port'], $_REQUEST['advanced_login']))
	{ 
		$mode = 'standard';
	} 
	
	switch ($mode)
	{
		case 'advanced':
			$switcherHref = '?mode=standard';
			$switcherText = JS_LANG_StandardLogin;
			$advancedClass = '';
			$advancedLogin = '1';
			break;
		case 'submit':
			$switcherHref = '?mode=advanced';
			$switcherText = JS_LANG_AdvancedLogin;
			$advancedClass = ' class="wm_hide"';
			$advancedLogin = '0';
			$globalEmail = $_REQUEST['email'];
			$globalLogin = $_REQUEST['login'];
			$globalPassword = $_REQUEST['password'];
			$globalIncServer = $_REQUEST['inc_server'];
			$globalIncPort = $_REQUEST['inc_port'];
			$globalOutServer = $_REQUEST['out_server'];
			$globalOutPort = $_REQUEST['out_port'];
			$globalUseSmtpAuth = isset($_REQUEST['smtp_auth']) ? $_REQUEST['smtp_auth'] : 0;
			$globalAdvancedLogin = $_REQUEST['advanced_login']; //0|1
			
			$sendSettingsList = false;
			
			if ($globalAdvancedLogin)
			{
				$email = $globalEmail;
				$login = $globalLogin;
			}
			else
			{
				switch ($settings->HideLoginMode)
				{
					case 0:
						$email = $globalEmail;
						$login = $globalLogin;
						break;
					
					case 10:
						
						$email = $globalEmail;
						
						$emailAddress = &new EmailAddress();
						$emailAddress->SetAsString($email);
	
						$login = $emailAddress->GetAccountName();
						break;
						
					case 11:
						$email = $globalEmail;
						$login = $globalEmail;
						break;
						
					case 20:
					case 21:
						$login = $globalLogin;
						$email = $login.'@'.$settings->DefaultDomainOptional;
						break;
						
					case 22:
					case 23:
						$login = $globalLogin.'@'.$settings->DefaultDomainOptional;
						$email = $login;
				}
			}			
			
			$account =& Account::CreateInstance(true);
			
			$account->Email = $email;
			$account->MailIncLogin = $login;
			$account->MailIncPassword = $globalPassword;
			
			if ($globalAdvancedLogin && $settings->AllowAdvancedLogin)
			{
				$account->MailIncPort = (int) $globalIncPort;
				$account->MailOutPort = (int) $globalOutPort;
				$account->MailOutAuthentication = (bool) $globalUseSmtpAuth;
				$account->MailIncHost = $globalIncServer;
				$account->MailOutHost = $globalOutServer;		
			}
			else 
			{
				$account->MailIncPort = (int) $settings->IncomingMailPort;
				$account->MailOutPort = (int) $settings->OutgoingMailPort;
				$account->MailOutAuthentication = (bool) $settings->ReqSmtpAuth;
				$account->MailIncHost = $settings->IncomingMailServer;
				$account->MailOutHost = $settings->OutgoingMailServer;				
			}
			
			if (DEMOACCOUNTALLOW && $email == DEMOACCOUNTEMAIL)
			{
				$account->MailIncPassword = DEMOACCOUNTPASS;
			}
			
			$validate = $account->ValidateData();
			if ($validate !== true)
			{
				$account->Delete();
				$errorDesc = $validate;
				$errorClass = 'wm_login_error';
			}
			else
			{
				$processor =& new MailProcessor($account);
				if ($processor->MailStorage->Connect())
				{
					if ($account->Update())
					{
						$sendSettingsList = true;
					}
				}
				else 
				{
					if ($settings->AutomaticCorrectLoginSettings)
					{
						if ($account->MailIncLogin != $account->Email)
						{
							$account->MailIncLogin = $account->Email;
							
							$validate = $account->ValidateData();
							if ($validate !== true)
							{
								$account->Delete();
								printErrorAndExit($validate, $xmlRes);
							}
							
							if ($processor->MailStorage->Connect())
							{
								if ($account->Update())
								{
									$sendSettingsList = true;
								}
							}
						}
						else 
						{
							$emailAddress = &new EmailAddress();
							$emailAddress->SetAsString($account->Email);
							$account->MailIncLogin = $emailAddress->GetAccountName();
							
							$validate = $account->ValidateData();
							if ($validate !== true)
							{
								$account->Delete();
								printErrorAndExit($validate, $xmlRes);
							}
							
							if ($processor->MailStorage->Connect())
							{
								if ($account->Update())
								{
									$sendSettingsList = true;
								}
							}
						}
					}
				}
				
				if ($sendSettingsList)
				{
					header('location: basewebmail.php');
					exit();
				}
				else 
				{
					$account->Delete();
					$errorDesc = getGlobalError();
					$errorClass = 'wm_login_error';		
				}	
			}		
			break;
			
		default:
			$switcherHref = '?mode=advanced';
			$switcherText = JS_LANG_AdvancedLogin;
			$advancedClass = ' class="wm_hide"';
			$advancedLogin = '0';
			
	}
	//end for version without ajax

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta http-equiv="Cache-Control" content="private,max-age=1209600" />
	<title><?php echo defaultTitle?></title>
	<link rel="stylesheet" href="skins/<?php echo defaultSkin?>/styles.css" type="text/css" id="skin" />
	<script type="text/javascript">
		var isAjax = <?php echo defaultIsAjax?>;
		var WebMailUrl = 'webmail.php';
		var LoginUrl = 'index.php';
		var ActionUrl = 'processing.php';
		var Title = '<?php echo ConvertUtils::ClearJavaScriptString(defaultTitle, '\''); ?>';
		var SkinName = '<?php echo ConvertUtils::ClearJavaScriptString(defaultSkin, '\''); ?>';
		var HideLoginMode = <?php echo defaultHideLoginMode; ?>;
		var DomainOptional = '<?php echo ConvertUtils::ClearJavaScriptString(defaultDomainOptional, '\''); ?>';
		var AllowAdvancedLogin = '<?php echo defaultAllowAdvancedLogin; ?>';
		var AdvancedLogin = '<?php echo $advancedLogin; ?>';
		var EmptyHtmlUrl = 'empty.html';

		var INIT_DEFINES     = 0;
		var INIT_COMMON      = 1;
		var INIT_AJAX_COMMON = 2;
		var INIT_FUNCTIONS   = 3;
		var INIT_LOGIN       = 4;
		var INIT_BODY        = 5;
		
		var ReadyInit = Array();
		ReadyInit[INIT_DEFINES]     = false;
		ReadyInit[INIT_COMMON]      = false;
		ReadyInit[INIT_AJAX_COMMON] = false;
		ReadyInit[INIT_FUNCTIONS]   = false;
		ReadyInit[INIT_LOGIN]       = false;
		ReadyInit[INIT_BODY]        = false;
	
		function Ready(fileId)
		{
			ReadyInit[fileId] = true;
			var isReady = true;
			for (var i=0; i<=INIT_BODY; i++)
			{
				if (ReadyInit[i] == false)
				{
					isReady = false;
					break;
				}
			}
			if (isReady) Init();
		}
	</script>
	<script type="text/javascript" src="_defines.js"></script>
	<script type="text/javascript">
		<?php include('_language.js.php'); ?>
	</script>
	<script type="text/javascript" src="class.common.js"></script>
	<script type="text/javascript" src="class.ajax-common.js"></script>
	<script type="text/javascript" src="_functions.js"></script>
	<script type="text/javascript" src="class.login.js"></script>
</head>

<body onload="Ready(INIT_BODY);">
<table class="wm_hide" id="info">
	<tr>
		<td class="wm_info_message" id="info_message"></td>
	</tr>
</table>
<div align="center" id="content" class="wm_content">
	<div class="wm_logo" id="logo" tabindex="-1"></div>
	<div id="login_screen">
		<div class="<?php echo $errorClass?>" id="login_error"><?php echo $errorDesc?></div>
		<form action="index.php?mode=submit" method="post" id="login_form" name="login_form">
			<input type="hidden" name="advanced_login" value="<?php echo $advancedLogin?>" />
		<table class="wm_login<?php if (defaultHideLoginMode != 21 && defaultHideLoginMode != 23) {?> wm_fixed<?php }?>" id="login_table" border="0" cellspacing="0" cellpadding="0">
			<col width="70"></col>
			<col width="88"></col>
			<col width="70"></col>
			<col width="33"></col>
			<col width="42"></col>
			<tr>
				<td class="wm_login_header" colspan="5"><?php echo LANG_LoginInfo?></td>
			</tr>
			<tr id="email_cont">
				<td class="wm_title"><?php echo LANG_Email?>:</td>
				<td colspan="4">
					<input class="wm_input" type="text" value="" id="email" name="email" maxlength="255" 
						onfocus="this.className = 'wm_input_focus';" onblur="this.className = 'wm_input';" />
				</td>
			</tr>
			<tr id="login_cont">
				<td class="wm_title"><?php echo LANG_Login?>:</td>
				<td colspan="4" id="login_parent">
					<input class="wm_input" type="text" value="" id="login" name="login" maxlength="255" 
						onfocus="this.className = 'wm_input_focus';" onblur="this.className = 'wm_input';" />
				</td>
			</tr>
			<tr>
				<td class="wm_title"><?php echo LANG_Password?>:</td>
				<td colspan="4">
					<input class="wm_input wm_password_input" type="password" value="" id="password" name="password" maxlength="255" 
						onfocus="this.className = 'wm_input_focus wm_password_input';" onblur="this.className = 'wm_input wm_password_input';" />
				</td>
			</tr>
			<tr id="incoming"<?php echo $advancedClass?>>
				<td class="wm_title"><?php echo LANG_IncServer?>:</td>
				<td colspan="2">
					<input class="wm_advanced_input" type="text" value="<?php echo defaultIncServer?>" id="inc_server" name="inc_server" maxlength="255"
						onfocus="this.className = 'wm_advanced_input_focus';" onblur="this.className = 'wm_advanced_input';" />
				</td>
				<td class="wm_title"><?php echo LANG_IncPort?>:</td>
				<td>
					<input class="wm_advanced_input" type="text" value="<?php echo defaultIncPort?>" id="inc_port" name="inc_port" maxlength="5"
						onfocus="this.className = 'wm_advanced_input_focus';" onblur="this.className = 'wm_advanced_input';" />
				</td>
			</tr>
			<tr id="outgoing"<?php echo $advancedClass?>>
				<td class="wm_title"><?php echo LANG_OutServer?>:</td>
				<td colspan="2">
					<input class="wm_advanced_input" type="text" value="<?php echo defaultOutServer?>" id="out_server" name="out_server" maxlength="255"
						onfocus="this.className = 'wm_advanced_input_focus';" onblur="this.className = 'wm_advanced_input';" />
				</td>
				<td class="wm_title"><?php echo LANG_OutPort?>:</td>
				<td>
					<input class="wm_advanced_input" type="text" value="<?php echo defaultOutPort?>" id="out_port" name="out_port" maxlength="5"
						onfocus="this.className = 'wm_advanced_input_focus';" onblur="this.className = 'wm_advanced_input';" />
				</td>
			</tr>
			<tr id="authentication"<?php echo $advancedClass?>>
				<td colspan="5">
					<input class="wm_checkbox" type="checkbox" value="1" id="smtp_auth" name="smtp_auth"<?php echo $smtpAuthChecked?>>
					<label for="smtp_auth"><?php echo LANG_UseSmtpAuth?></label>
				</td>
			</tr>
			<tr>
				<td colspan="5">
				<?php if (defaultAllowAdvancedLogin) { ?>
					<span class="wm_login_switcher">
						<a class="wm_reg" href="<?php echo $switcherHref?>" id="login_mode_switcher"><?php echo $switcherText?></a>
					</span>
				<?php } ?>
					<span class="wm_login_button">
						<input class="wm_button" type="submit" id="submit" name="submit" value="<?php echo LANG_Enter?>" />
					</span>
				</td>
			</tr>
		</table>
		</form>
	</div>
</div>
<div class="wm_copyright" id="copyright">
	<?php @require('inc.footer.php'); ?>
</div>
</body>
</html>