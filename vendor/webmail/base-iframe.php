<?php

	@ob_start();
	
	header('Content-Type: text/html; charset=utf-8');
	
	@session_name('PHPWEBMAILSESSID');
	@session_start();
	
 	function fixed_array_map_stripslashes($array)
	{
		$return = array();
		if (is_array($array))
		{
			foreach ($array as $key => $value)
			{
				$return[stripslashes($key)] = (is_array($value))
						? @fixed_array_map_stripslashes($value)
						: @stripslashes($value);
			}
		}
		else 
		{
			return $array;
		}
		return $return;
	}
	
	function disable_magic_quotes_gpc()
	{
		if (@get_magic_quotes_gpc() == 1)
		{
			$_GET = fixed_array_map_stripslashes($_GET);
			$_POST = fixed_array_map_stripslashes($_POST);
		}
	}
	
	@disable_magic_quotes_gpc();
	
	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));

	require_once(WM_ROOTPATH.'common/inc_constants.php');
	require_once(WM_ROOTPATH.'class_settings.php');
	
	$settings =& Settings::CreateInstance();
	if (!$settings->isLoad)
	{
		die('Settings Load Error');
	}
	elseif (!$settings->IncludeLang())
	{
		die('Lang Error');
	}
	
	require_once(WM_ROOTPATH.'common/class_log.php');
	require_once(WM_ROOTPATH.'class_account.php');
	require_once(WM_ROOTPATH.'classic/base_defines.php');
	
	$log =& CLog::CreateInstance();
	
	if (!Session::has(S_ACCT_ARRAY))
	{
		echo '<script>parent.changeLocation("'.LOGINFILE.'?error=1");</script>';
		exit();
	}	
	
	$_SESSION[ATTACHMENTDIR] = Session::val(ATTACHMENTDIR, md5(session_id()));
	$account = &Account::CreateInstance();
	
	if (!$account)
	{
		echo '<script>parent.changeLocation("'.LOGINFILE.'?error=2");</script>';
		exit();
	}
	
	$isNull = false;
	$isError = false;
	
	$mes_uid = Post::val('m_uid');
	$mes_charset = Post::val('charset', -1);
			
			
if (isset($_POST['m_uid']))
{
	
	require_once(WM_ROOTPATH.'classic/class_getmessagebase.php');
	
	$error = '';
	$message = &new GetMessageBase(	$account,
									$mes_uid,
									$mes_charset);
			
	if (!$message->msg) 
	{
		$isNull = true;
		$isError = true;
		exit();
	}
	
	$fromObj = new EmailAddress();
	$fromObj->Parse($message->msg->GetFromAsString(true));
	
	$isHtml = $message->msg->HasHtmlText();
	if ($message->GetTypeOfMessage() > 2)
	{
		$isHtml = (isset($_POST['plain']) && ($_POST['plain'] == -1 || $_POST['plain'] == 3));
	}

	$fullBodyText = ($isHtml) 
		? ConvertUtils::ReplaceJSMethod($message->PrintHtmlBody(true))
		: nl2br($message->PrintPlainBody());
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>iframe</title>
	<link rel="stylesheet" href="./skins/<?php echo $message->account->DefaultSkin;?>/styles.css" type="text/css" />
<script>	
var INIT_DEFINES     = 0;
var INIT_COMMON      = 1;
var INIT_FUNCTIONS   = 2;
var INIT_BODY        = 3;

var ReadyInit = Array();
ReadyInit[INIT_DEFINES]     = false;
ReadyInit[INIT_COMMON]      = false;
ReadyInit[INIT_FUNCTIONS]   = false;
ReadyInit[INIT_BODY]   		= false;
			
function Ready(fileId)
{
	ReadyInit[fileId] = true;
	var isReady = true;
	var c = ReadyInit.length;
	for (var i = 0; i < c; i++)
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
	<script language="JavaScript" type="text/javascript" src="_defines.js"></script>
	<script language="JavaScript" type="text/javascript" src="_functions.js"></script>
	<script language="JavaScript" type="text/javascript" src="class.common.js"></script>
	<script language="JavaScript" type="text/javascript" src="./classic/base.message.js"></script>
	<script language="JavaScript">
	
	var WebMail = { _html: document.getElementById('html') };
	
	Browser = new CBrowser();
	
	parent.InfoPanel.Hide();
	
	function PrevImg(href)
	{
		var shown = window.open(href, 'Popup', 'toolbar=yes,status=no,scrollbars=yes,resizable=yes,width=760,height=480');
		shown.focus();
	}
		
	function ResizeElements(mode)
	{		
		document.body.scroll = 'no';
		document.body.style.overflow = 'hidden';
		
		var width = GetWidth();
		var height = GetHeight();
		
		if (mode == 'all')
		{

		<?php
		
		if ($message->msg->Attachments != null && $message->msg->Attachments->Count() > 0)
		{
			$temp = ($message->GetTypeOfMessage() > 2) ? 'Attachments.height = Attachments.height - document.getElementById("lowtoolbar").offsetHeight' : '';
			echo '

			Headers.width = width;
			VResizer.width = 1;
			Message.width = width - Attachments.width - VResizer.width - 16 ;
			
			Attachments.height = height - Headers.height;
			'.$temp.'
			Message.height = Attachments.height - 16;
			VResizer.height = Attachments.height;
			

			Headers.updateSize();
			Message.updateSize();
			
			Attachments.updateSize();
			VResizer.updateSize();
		}
		
		if (mode == \'height\')
		{
			var width = GetWidth();
			Attachments.width = VResizer.x;
			Message.width = width - Attachments.width - VResizer.width - 16;
			Attachments.updateSize();
			Message.updateSize();
		}
			';
		}
		else 
		{
			$temp = ($message->GetTypeOfMessage() > 2) ? 'Message.height = Message.height - document.getElementById("lowtoolbar").offsetHeight' : '';
			echo '
			Headers.width = width;
			Message.width = width - 16;
			
			//Headers.height = 60;
			Message.height = height - Headers.height - 16;
			'.$temp.'
						
			Headers.updateSize();
			Message.updateSize();
		}
			';
		}
		?>
	}
	
	function DoPost()
	{
		parent.ChangeCharset(document.getElementById('strCharset').value);
		parent.BaseForm.Form.submit();
		return false;
	}

	function ChangeBody(type)
	{
		parent.BaseForm.Plain.value = type;
		parent.BaseForm.Form.submit();
		return false;
	}	
	
	</script>
	</head>
	<body onresize="ResizeElements('all');" style="background: #E9F2F8;" scroll="no" style="overflow: hidden;">
	<div class="wm_hide" id="headersCont">
		<div id="headersDiv" class="wm_message_rfc822"><pre><?php
		echo ConvertUtils::WMHtmlSpecialChars(
				$message->msg->ClearForSend(
					ConvertUtils::ConvertEncoding(
						$message->msg->OriginalHeaders, $GLOBALS[MailInputCharset], $account->GetUserCharset())));
		?></pre>
		</div>
		<div class="wm_hide_headers"><a href="#" onclick="return FullHeaders.Hide();"><?php echo JS_LANG_Close; ?></a></div>
	</div>
	<table class="wm_mail_container" id="wm_mail_container" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="3" id="td_message_headers">
				<table class="wm_view_message" id="message_headers">
					<tr>
						<td class="wm_view_message_title"><?php echo JS_LANG_From; ?>:</td>
						<td>
							<span id="fromSpan"><?php 
							$pFrom = $message->PrintFrom(true);
							echo ConvertUtils::WMHtmlSpecialChars($pFrom); ?></span>
						</td>
						<td class="wm_headers_switcher">
							<nobr><a href="#" id="fullheadersControl" onclick="return FullHeaders.Show();"><?php echo JS_LANG_ShowFullHeaders; ?></a></nobr>
						</td>
					</tr>
					<tr>
						<td class="wm_view_message_title"><?php echo JS_LANG_To; ?>:</td>
						<td colspan="2"><?php echo ConvertUtils::WMHtmlSpecialChars($message->PrintTo(true)); ?></td>
					</tr>
					<tr>
						<td class="wm_view_message_title"><?php echo JS_LANG_Date; ?>:</td>
						<td colspan="2"><?php echo ConvertUtils::WMHtmlSpecialChars($message->PrintDate());	?></td>
					</tr>
<?php
					$cc = $message->PrintCc(true);
					if ($cc && strlen($cc) > 0)
					{
						echo '
					<tr>
						<td class="wm_view_message_title">'.JS_LANG_CC.':</td>
						<td colspan="2">
						'.
							ConvertUtils::WMHtmlSpecialChars($cc)
						.'
						</td>
					</tr>';
					}

					$bcc = $message->PrintBcc(true);
					if ($bcc && strlen($bcc) > 0)
					{
						echo '
					<tr>
						<td class="wm_view_message_title">'.JS_LANG_BCC.':</td>
						<td colspan="2">
						'.
							ConvertUtils::WMHtmlSpecialChars($bcc)
						.'
						</td>
					</tr>';
					}
					
					$replyto = $message->PrintReplyTo(true);
					if ($replyto && strlen($replyto) > 0 && $replyto != $pFrom)
					{
						echo '
					<tr>
						<td class="wm_view_message_title">'.JS_LANG_ReplyTo.':</td>
						<td colspan="2">
						'.
							ConvertUtils::WMHtmlSpecialChars($replyto)
						.'
						</td>
					</tr>';
					}
?>														
					<tr>
						<td class="wm_view_message_title"><?php echo JS_LANG_Subject; ?>:</td>
						<td><?php 
							$priority = $message->msg->GetPriorityStatus();
							if ($priority == MESSAGEPRIORITY_High)
							{
								echo '<img class="wm_importance_img" src="skins/'.$message->account->DefaultSkin.'/menu/priority_high.gif">';
							}
							echo ConvertUtils::WMHtmlSpecialChars($message->PrintSubject(true)); 
												
							$isHideCharset = ($message->msg->HasCharset) ? ' class="wm_hide"' : '';
							if (Post::val('charset') != '-1') $isHideCharset = '';
						?></td>
					</tr>
					<tr<?php echo $isHideCharset; ?>>
						<td class="wm_view_message_title"><?php echo JS_LANG_Charset; ?>:</td>
						<td>
							<select name="str_charset" id="strCharset" onchange="DoPost();" class="wm_view_message_select">
											<?php
											
												foreach ($CHARSETS as $value)
												{
													echo (Post::val('charset', '-1') == $value[0]) ?
														'<option value="'.$value[0].'" selected="selected" > '.$value[1].'</option>'."\r\n" :
														'<option value="'.$value[0].'" > '.$value[1].'</option>'."\r\n";
												}
											?>
							</select>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td id="td_attachments">
		<?php	
		
		$JSfilenameTrim = '';
		if ($message->msg->Attachments != null && $message->msg->Attachments->Count() > 0)
		{
			$JSfilenameTrim = '
			var attDiv = document.getElementById("attachments");
			if (attDiv) {
				spansArray = attDiv.getElementsByTagName("span");
				if (spansArray && spansArray.length > 0) {
					var oneSpan;
					var c = spansArray.length;
					for(var i = 0; i < c; i++) {
						oneSpan = spansArray[i];
						if (oneSpan && oneSpan.innerHTML.length > 16) {
							oneSpan.innerHTML = oneSpan.innerHTML.substring(0, 15) + \'&#8230;\';
						}
					}
				}
			}';
			
			echo '<div id="attachments" class="wm_message_attachments">';
			
			$attachments = &$message->msg->Attachments;
			if ($attachments != null && $attachments->Count() > 0)
			{
				foreach (array_keys($attachments->Instance()) as $key)
				{
					$attachment = &$attachments->Get($key);
					$tempname = ConvertUtils::ClearFileName($message->msg->Uid.'-'.$key.'_'.$attachment->GetTempName());
					$filename = ConvertUtils::ClearFileName($attachment->GetFilenameFromMime());
					$filesize = GetFriendlySize(strlen($attachment->MimePart->GetBinaryBody()));
										
					$fs = &new FileSystem(INI_DIR.'/temp', $message->account->Email);
					if (!$fs->SaveAttach($attachment, $_SESSION[ATTACHMENTDIR], $tempname))
					{
						$log->WriteLine('Save temp Attachment error: '.getGlobalError());
					}
							
					$ContentType = ConvertUtils::GetContentTypeFromFileName($filename);
			
					echo '
					<div style="float: left;"><a href="attach.php?tn='.urlencode($tempname).'&filename='.urlencode($filename).'" class="wm_attach_download_a">
							<img src="./images/icons/'.GetAttachImg($filename).'" title="Click to download '.$filename.' ('.$filesize.')" /></a><br />
							<span id="at_'.$key.'" title="Click to download '.$filename.' ('.$filesize.')">'.$filename.'</span><br />';

					if (strpos($ContentType, 'image') !== false)
					{
						echo '<a href="#" class="wm_attach_view_a" onclick=\'PrevImg("view-image.php?tn='.urlencode($tempname).'")\'>'.JS_LANG_View.'</a>';
					}
					
					echo '</div>';
				}
				
			}
									
			echo '</div>
			</td>
			<td rowspan="3" id="td_vert_resizer"><div id="vert_resizer"></div></td>';
		}
		else 
		{
			echo '</td><td></td>';
		}
		?>
			
			<td id="td_message">
			<div id="message" class="wm_message"></div>
			</td>		
		</tr>
		<?php
		if ($message->GetTypeOfMessage() > 2)
		{
			echo '<tr class="wm_lowtoolbar" id="lowtoolbar"><td colspan="3"><span class="wm_lowtoolbar_plain_html">';
			echo ($isHtml) 
					? '<span id="message_switcher"><a href="#" onclick="ChangeBody(2); return false;">'.JS_LANG_SwitchToPlain.'</a></span>'
					: '<span id="message_switcher"><a href="#" onclick="ChangeBody(3); return false;">'.JS_LANG_SwitchToHTML.'</a></span>';
			echo '</span></td></tr>';
		}
		?>
	</table>
	<script language="JavaScript">	
	function Init()
	{
		Headers = new CHeaders();
		Message = new CMessage();
		FullHeaders = new CFullHeadersViewer("<?php echo ConvertUtils::ClearJavaScriptString(JS_LANG_ShowFullHeaders, '"'); ?>", "<?php echo ConvertUtils::ClearJavaScriptString(JS_LANG_HideFullHeaders, '"'); ?>");

		<?php
		if ($message->msg->Attachments != null && $message->msg->Attachments->Count() > 0)
		{
			echo '
			Attachments = new CAttachments(parent.rVer);
			VResizer = new CVResizer();';
		}
		?>
		
		var MessageDiv = document.getElementById("message");
		if (MessageDiv) 
		{
			MessageDiv.innerHTML = "<?php echo ConvertUtils::ClearJavaScriptString($fullBodyText, '"'); ?>";
		}
		
		ResizeElements("all");
	}
	Ready(INIT_BODY);
	<?php
	echo $JSfilenameTrim;
	?>
	</script>

	</body>
	</html>	
	
<?php
} else $isNull = true;
			
	if ($isNull)
	{
		
		$err = ($isError && isset($GLOBALS[ErrorDesc])) ? $GLOBALS[ErrorDesc] : '';
		$err = ConvertUtils::ClearJavaScriptString($err);
		$temp = ($isError) ? 'parent.InfoPanel._isError = true; parent.InfoPanel.SetInfo("'.$err.'"); parent.InfoPanel.Show();': '';
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html>
<head>
	<title>iframe</title>
	<link rel="stylesheet" href="./skins/'.$account->DefaultSkin.'/styles.css" type="text/css" />
<script>	
var INIT_FUNCTIONS   = 0;
var INIT_BODY        = 1;

var ReadyInit = Array();
ReadyInit[INIT_FUNCTIONS]   = false;
ReadyInit[INIT_BODY]   		= false;
			
function Ready(fileId)
{
	ReadyInit[fileId] = true;
	var isReady = true;
	var c = ReadyInit.length;
	for (var i=0; i < c; i++)
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
	<script language="JavaScript" type="text/javascript" src="./classic/base.message.js"></script>
	<script language="JavaScript" type="text/javascript" src="_functions.js"></script>
	<script language="JavaScript">
	
	var WebMail = { _html: document.getElementById(\'html\') };
	
	'.$temp.'
	
	function ResizeElements()
	{		
		document.body.scroll = "no";
		document.body.style.overflow = "hidden";

		var width = GetWidth();
		var height = GetHeight();
		
		Headers.width = width;
		Message.width = width;
		
		Headers.height = 54;
		Message.height = height - Headers.height;

		Headers.updateSize();
		Message.updateSize();
	}
	
	</script></head>
	<body onresize="ResizeElements();" style="background: #E9F2F8;" scroll="no" style="overflow: hidden;">
	<table class="wm_mail_container" id="wm_mail_container" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="3" id="td_message_headers">
				<div  class="wm_message_headers" id="message_headers"></div>	
			</td>
		</tr>
		<tr>
			<td id="td_message">
				<div id="message" class="wm_message"></div>
			</td>		
		</tr>
	</table>
	<script language="JavaScript">	
	
	function Init()
	{
		Headers = new CHeaders();
		Message = new CMessage();
		ResizeElements();
	}
	Ready(INIT_BODY);
	</script>
	</body>
</html>';
	}
	
	@ob_end_flush();
