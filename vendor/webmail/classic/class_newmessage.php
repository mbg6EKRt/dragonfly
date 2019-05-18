<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/../'));
	
	require_once(WM_ROOTPATH.'classic/class_getmessagebase.php');

	class CNewMessagePanel
	{
		/**
		 * @var PageBuilder
		 */
		var $_pagebuilder;
		
		/**
		 * @var BaseProcessor
		 */
		var $_proc;
		
		/**
		 * @var string
		 */
		var $From = '';
		var $To = '';
		var $CC = '';
		var $BCC = '';
		var $Subject = '';
		var $Body = '';
		var $Type;
		var $attacmentsHtml = '';
		
		/**
		 * @var string
		 */
		var $inputs;
				
		function _getFromEmail()
		{
			$this->From = $this->_proc->account->Email;
			return $this->From;
		}
		
		/**
		 * @param PageBuilder $pageBuilder
		 * @return ContactsPanel
		 */
		function CNewMessagePanel(&$pagebuilder)
		{
			$this->Type = Post::val('mtype','mes');
			$this->To = '';
			
			$this->_pagebuilder = &$pagebuilder;
			$this->_proc = &$pagebuilder->_proc;
			$this->From = $this->_getFromEmail();
			$this->_pagebuilder->_top->AddOnResize('ResizeElements(\'all\');');
			
			if (Post::has('mailto'))
			{
				$this->To = Post::val('mailto', '');
			}
			
			if (Get::has('to'))
			{
				$this->To = (string) trim(Get::val('to', ''));
			}
			
			$message = null;
			$this->attacmentsHtml = '';

			$this->_pagebuilder->AddJSText('
			
var bcc, bcc_mode, bcc_mode_switcher;

var plainEditor = null;
var EditAreaUrl = "edit-area.php";
var prevWidth = 0;
var prevHeight = 0;
var rowIndex = 0;

function ResizeElements(mode) 
{
	var width = GetWidth();
	if (width < 740) width = 740;
	
	document.body.style.width = width + "px";
	
	ewidth = width - 40;
	var eheight = Math.ceil(ewidth/3);
	
	if (plainEditor != null) {
		plainEditor.style.height = eheight + "px";
		plainEditor.style.width = ewidth + "px";
	}
}

function LoadAttachmentHandler(attachObj)
{
	var attachtable = document.getElementById("attachmentTable");
	if (attachObj)
	{
		var imageLink = GetFileParams(attachObj.FileName);
		var tr = attachtable.insertRow(rowIndex++);
		tr.id = "tr_" + attachObj.TempName;
		var td = tr.insertCell(0);
		td.className = "wm_attachment";
		var innerHtml = \'<img src="./images/icons/\' + imageLink.image + \'" />\';
		innerHtml += \'<input type="hidden" name="attachments[\' + attachObj.TempName + \']" value="\' + attachObj.FileName + \'">\';
		innerHtml += HtmlEncode(attachObj.FileName) + \' (\' + BaseFriendlySize(attachObj.Size) + \') <a href="#" id="\' + attachObj.TempName + \'" onclick="return  DeleteAttach(this.id);">'.JS_LANG_Delete.'</a>\';
		td.innerHTML = innerHtml;
	}
}

function BaseFriendlySize(byteSize)
{
	var size = Math.ceil(byteSize / 1024);
	var mbSize = size / 1024;
	if (mbSize > 1){
		size = Math.ceil(mbSize*10)/10 + "'.ConvertUtils::ClearJavaScriptString(JS_LANG_Mb, '"').'";
	} else {
		size = size + "'.ConvertUtils::ClearJavaScriptString(JS_LANG_Kb, '"').'";
	}
	return size;
}


function ChangeBCCMode()
{
	if (bcc_mode == "hide") {
		bcc_mode = "show";
		bcc.className = "";
		bcc_mode_switcher.innerHTML = "'.ConvertUtils::ClearJavaScriptString(JS_LANG_HideBCC, '"').'";
	} else {
		bcc_mode = "hide";
		bcc.className = "wm_hide";
		bcc_mode_switcher.innerHTML = "'.ConvertUtils::ClearJavaScriptString(JS_LANG_ShowBCC, '"').'";
	}
	return false;
}

function DoSendButton()
{
	var toemail = document.getElementById("toemail");
	var ccemail = document.getElementById("toCC");
	var bccemail = document.getElementById("toBCC");
	var subject = document.getElementById("subject");
	var mailIsCorrect = false;
	
	if ((toemail && toemail.value.length > 0) || (ccemail && ccemail.value.length > 0) || (bccemail && bccemail.value.length > 0))
	{ 
		mailIsCorrect = true;
	}
	
	if (mailIsCorrect)
	{
		if (subject && subject.value.length < 1)
		{
			if (!confirm("'.ConvertUtils::ClearJavaScriptString(JS_LANG_ConfirmEmptySubject, '"').'")) return false;
		}
		
		var form = document.getElementById("messageForm");
		form.action = "'.ACTIONFILE.'?action=send&req=message";
		if (submitSaveMessage())
		{
			form.submit();
		}
	}
	else
	{
		alert("'.ConvertUtils::ClearJavaScriptString(JS_LANG_WarningToBlank, '"').'");
	}
}

function DeleteAttach(idline)
{
	var trtable = document.getElementById("tr_" + idline);
	if (trtable)
	{
		trtable.className = "wm_hide";
		CleanNode(trtable);
	}
	return false;
}

');
			$this->_pagebuilder->AddInitText('

bcc_mode = "hide";
bcc = document.getElementById("bcc");
bcc_mode_switcher = document.getElementById("bcc_mode_switcher");

plainEditor = document.getElementById("editor_area");
			');
			
			if (Post::has('m_uid'))
			{
				$mes_uid = Post::val('m_uid');
				$mes_charset = Post::val('charset', -1);
			
				$message = &new GetMessageBase(	$this->_proc->account,
												$mes_uid,
												$mes_charset);
												
				$this->inputs = '<input type="hidden" name="m_uid" value="'.ConvertUtils::ArgumentQuot($mes_uid).'">';

			}
			
			if ($message)
			{
				$this->_pagebuilder->AddInitText('SetPriority('.$message->msg->GetPriorityStatus().');');
				
				switch ($this->Type)
				{
					default:
						$this->Subject = $message->PrintSubject(true);
						$this->To = $message->PrintTo(true);
						$this->CC = $message->PrintCC(true);						
						break;
					case 'forward': 
						$this->Subject = JS_LANG_Fwd.': '.$message->PrintSubject(true); 
						break;
					case 'reply':
						$replyto = trim($message->PrintReplyTo(true));
						$this->To = (strlen($replyto) > 0) ? $replyto : $message->PrintFrom(true);
						$this->Subject = JS_LANG_Re.': '.$message->PrintSubject(true); 
						break;
					case 'replytoall':
						$emailCollection =& $message->msg->GetAllRecipients(false, true);
						$temp = '';
						if ($emailCollection)
						{
							$collection =& $emailCollection->Instance();
							foreach ($collection as $value)
							{
								if ($value->Email != $this->_proc->account->Email)
								{
									$temp .= $value->Email.', ';
								}
							}
						}
						
						$this->To = trim($temp, ', ');
						$this->Subject = JS_LANG_Re.': '.$message->PrintSubject(true); 
						break;
				}

				switch ($this->Type)
				{
					case 'forward':
					case 'reply':
					case 'replytoall':
						$this->Body = $message->msg->GetRelpyAsPlain(true);
						break;
					default:
						$this->Body = $message->msg->GetNotCensoredTextBody(true);
						break;
				}
				
				if ($message->HasAttachments() && $this->Type != 'reply' && $this->Type != 'replytoall')
				{
					$attachments = &$message->msg->Attachments;
					if ($attachments != null && $attachments->Count() > 0)
					{
						foreach (array_keys($attachments->Instance()) as $key)
						{
							$attachment = &$attachments->Get($key);
							$tempname = ConvertUtils::ClearFileName($message->msg->Uid.'-'.$key.'_'.$attachment->GetTempName());
							$filename = ConvertUtils::WMHtmlSpecialChars($attachment->GetFilenameFromMime());
							$filesize = GetFriendlySize(strlen($attachment->MimePart->GetBinaryBody()));
												
							$fs = &new FileSystem(INI_DIR.'/temp', $message->account->Email);
							$fs->SaveAttach($attachment, $_SESSION[ATTACHMENTDIR], $tempname);
									
							$this->attacmentsHtml .= '
<tr id="tr_'.ConvertUtils::ArgumentQuot($tempname).'"><td class="wm_attachment"><img src="./images/icons/'.GetAttachImg($filename).'" />
<input type="hidden" name="attachments['.ConvertUtils::ArgumentQuot($tempname).']" value="'.ConvertUtils::ArgumentQuot($filename).'"> '.$filename.'
 ('.$filesize.') 						
<a href="#" id="'.ConvertUtils::ArgumentQuot($tempname).'" onClick="return DeleteAttach(this.id);">'.JS_LANG_Delete.'</a></td></tr>';							
							
						}
					}		
				}
			}
			else 
			{
				$this->_pagebuilder->AddInitText('SetPriority(3);');
			}
			
			$this->_pagebuilder->AddJSText('
		function submitSaveMessage()
		{
			var hiddenkey = document.getElementById("ishtml");
			hiddenkey.value = "0";
			if (bcc_mode == "hide")
			{
				document.getElementById("toBCC").value = "";
			}
			return true;
		}
				');
			
			$this->_pagebuilder->AddInitText('if (plainEditor) plainEditor.value = "'.ConvertUtils::ReBuildStringToJavaScript($this->Body, '"').'";');
		}
		
		function ToHTML()
		{
			return '
<form action="" method="POST" id="messageForm">
<table class="wm_new_message">
		<tr>
			<td class="wm_new_message_title">'.JS_LANG_From.': </td>
			<td>
				<input class="wm_input" tabindex="1" type="text" size="93" name="from" value="'.ConvertUtils::ArgumentQuot($this->From).'" />
				<input type="hidden" name="priority_input" id="priority_input" value="" />
				<input type="hidden" name="ishtml" id="ishtml" value="">
				'.$this->inputs.'
			</td>
		</tr>
		<tr>
			<td class="wm_new_message_title">'.JS_LANG_To.': </td>
			<td>
				<input class="wm_input" autocomplete="on" tabindex="2" type="text" size="93" id="toemail" name="toemail" value="'.ConvertUtils::ArgumentQuot($this->To).'" />
			</td>
		</tr>
		<tr>
			<td class="wm_new_message_title">'.JS_LANG_CC.': </td>
			<td><nobr>
				<input class="wm_input" tabindex="3" type="text" size="93" id="toCC" name="toCC" value="'.ConvertUtils::ArgumentQuot($this->CC).'" /><span>&nbsp;</span>
				<a href="#" onClick="ChangeBCCMode(); return false;" id="bcc_mode_switcher">'.JS_LANG_ShowBCC.'</a><nobr>
			</td>
		</tr>
		<tr class="wm_hide" id="bcc">
			<td class="wm_new_message_title">'.JS_LANG_BCC.': </td>
			<td>
				<input class="wm_input" tabindex="4" type="text" size="93" name="toBCC" id="toBCC" value="" />
			</td>
		</tr>
		<tr>
			<td class="wm_new_message_title">'.JS_LANG_Subject.': </td>
			<td>
				<input class="wm_input" tabindex="5" type="text" size="93" name="subject" id="subject" value="'.ConvertUtils::ArgumentQuot($this->Subject).'" />
			</td>
		</tr>
		<tr id="plain_mess">
			<td colspan="2">
					<textarea id="editor_area" class="wm_input" name="message" tabindex="6"></textarea>
			</td>
		</tr>
	</table>
	<table class="wm_new_message" id="attachmentTable">
	'.$this->attacmentsHtml.'
	</table>
	</form>
<table class="wm_new_message">
		<tr>
			<td colspan="2" class="wm_attach">
			<iframe class="wm_hide" src="" id="uploadIframe" name="uploadIframe"></iframe>
			<form action="upload.php" target="uploadIframe" method="POST" enctype="multipart/form-data">
				'.JS_LANG_AttachFile.': 
				<input class="wm_file" type="file" name="fileupload" />
				<input class="wm_button" type="submit" name="attachbtn" value="'.ConvertUtils::ArgumentQuot(JS_LANG_Attach).'" />
			</form>
			</td>
		</tr>
  	</table>
';
		}
		
	}