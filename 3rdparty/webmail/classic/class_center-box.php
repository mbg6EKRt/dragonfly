<?php

class CenterPanel
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
	 * @var MessageListTable
	 */
	var $_messages_part;
	
	
	/**
	 * @param PageBuilder $pageBuilder
	 * @return CenterPanel
	 */
	function CenterPanel(&$pagebuilder)
	{
		$this->_pagebuilder =& $pagebuilder;
		$this->_proc =& $pagebuilder->_proc;
		
		$this->_pagebuilder->AddJSFile('./classic/base.common.js');
		
		$this->_pagebuilder->AddJSText('	
	var MovableHorizontalDiv, MainContainer, MessList, InboxLines;
	var vResizer, hResizer;
	var sep = "-----";
	var EmptyHtmlUrl = "empty.html";
	var hiddenform, hiddeniframe; 
	var isF = true;
	
	function GroupOperation(form)
	{
		var messagesArray = InboxLines.GetCheckedLinesObj();
		for (var i = 0; i < messagesArray.length; i++)
		{
			CreateChildWithAttrs(form, "input", [
					["type", "hidden"],
					["name", "d_messages[]"],
					["value", messagesArray[i].MsgUid]
					]);
		}
		
		if (messagesArray.length > 0)
		{
			form.submit();
		}
		else
		{
			alert("'.ConvertUtils::ClearJavaScriptString(JS_LANG_WarningMarkListItem, '"').'");
		}
	}
	
	function DoNewMessageButton()
	{
		document.location = "'.BASEFILE.'?'.SCREEN.'='.SCREEN_NEWOREDIT.'";
	}
	
	function DoDeleteButton()
	{
		if (confirm("'.ConvertUtils::ClearJavaScriptString(JS_LANG_ConfirmAreYouSure, '"').'")) {
			if (hiddenform)
			{
				hiddenform.action = "'.ACTIONFILE.'?action=groupoperation&req=delete_messages";
				hiddenform.target = "_self";
			}
			else hiddenform = CreateChildWithAttrs(document.body, "form", [["action", "'.ACTIONFILE.'?action=groupoperation&req=delete_messages"], ["method", "POST"]]);
			CleanNode(hiddenform);
			GroupOperation(hiddenform);
		}
	}
	
	function DoRefresh()
	{
		document.location = "'.BASEFILE.'?'.SCREEN.'='.SCREEN_MAILBOX.'";
	}
	
	function GetSelectMessages()
	{
		var obj = InboxLines.GetCheckedLinesObj();
		var messagesArray = Array();
		
		for (var i = 0; i < obj.IdArray.length; i++)
		{
			var temp = ParseLineId(obj.IdArray);
			if (temp) messagesArray.push(temp);
		}
		return messagesArray;
	}
	
	function ResizeElements(mode)
	{
		ResizeScreen(mode);
		if (isF) {
			isF = false;
			ResizeScreen(mode);
		}
	}

	function ResizeScreen(mode)
	{
		var isAuto = false;
		var height = GetHeight();
		var innerHeight = height - MainContainer.getExternalHeight();
		
		if (innerHeight < 300)
		{
			innerHeight = 300;
			isAuto = true;
		}
		
		MainContainer.inner_height = innerHeight;
		
		var width = GetWidth();

		if (mode != "height")
		{
			var ipWidth = width;
			if (ipWidth < 550) ipWidth = 550;
			
			document.body.style.width = ipWidth + "px";
		
			MessList.resizeElementsWidth(ipWidth);
		}
				
		PageSwitcher.Replace(MessList.parent_table);
		SetBodyAutoOverflow(true);
	} 
	
	');
		
		$this->_pagebuilder->_top->AddOnResize('ResizeElements(\'all\');');
		
		$this->_pagebuilder->AddInitText('
PageSwitcher = new CPageSwitcher("'.$this->_pagebuilder->SkinName().'"); PageSwitcher.Build();
MainContainer = new CMainContainer();
MessList = new CMessageList();
InboxLines = new CSelection("'.$this->_pagebuilder->SkinName().'"); InboxLines.Fill();');
		
		$this->_messages_part = &new MessageListTable($pagebuilder);
	}
	
	/**
	 * @return string
	 */
	function ToHTML()
	{
		$msgCount = (isset($this->_messages_part->messCount)) ?	(int) $this->_messages_part->messCount : '0';
		$msgsSize = (isset($this->_messages_part->messSize)) ?	(int) $this->_messages_part->messSize : '0';
		if (!$msgCount) $msgCount = '0';

		$lowtoolbarText = '<span class="wm_lowtoolbar_messages">'. $msgCount.'&nbsp;'.JS_LANG_MessagesInInbox.'</span>';
		
		$boxPercentage = (int) ceil(($msgsSize/$this->_proc->account->MailboxLimit)*100);
		$boxPercentage = ($boxPercentage) ? $boxPercentage : 0;
		$boxPercentage = ($boxPercentage > 100) ? 100 : $boxPercentage;
		
		$progressBarClass = ($this->_proc->settings->EnableMailboxSizeLimit) ? 'wm_lowtoolbar_space_info' : 'wm_hide';
		
		$spaceTitle = JS_LANG_YouUsing.' '.$boxPercentage.'% '.JS_LANG_OfYour.' '.GetFriendlySize($this->_proc->account->MailboxLimit);
		
		return '
<div class="wm_background" id="divbackground">
	<table class="wm_mail_container" id="main_container">
		<tr>
			<td id="inbox_part">
				<div class="wm_inbox" id="inbox_div">
				'
.
$this->_messages_part->MessageTableHeaders()
.
'
					<div class="wm_inbox_lines" id="list_container">
'
.
$this->_messages_part->ToHTML()
.
'
					</div>
				</div>
			</td>
		</tr>
		<tr>
		
			<td class="wm_lowtoolbar" colspan="3" id="lowtoolbar">
			'.$lowtoolbarText.'

				<span class="'.$progressBarClass.'" title="'.$spaceTitle.'">
					<div class="wm_progressbar">
						<div class="wm_progressbar_used" style="width: '.$boxPercentage.'px;"></div>
					</div>
				</span>

			</td>
		</tr>
	</table>
</div>
		';

	}

}

class MessageListTable
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
	 * @var int
	 */
	var $messCount = 0;
	
	/**
	 * @var int
	 */	
	var $messSize = 0;
	
	/**
	 * @var int
	 */
	var $page = 1;
	
	/**
	 * @var WebMailMessageCollection
	 */
	var $messageCollection;
	
	/**
	 * @param PageBuilder $pageBuilder
	 * @return MessageListTable
	 */	
	function MessageListTable($pagebuilder)
	{
		$this->_pagebuilder = &$pagebuilder;
		$this->_proc = &$pagebuilder->_proc;

		$this->page = $this->_proc->sArray[PAGE];
		
		$this->messCount = (int) $this->_proc->processor->GetPop3InboxMessagesCount();
		$this->messSize = (int) $this->_proc->processor->GetPop3InboxMessagesSize();
		
		if ($this->_proc->account->MailsPerPage*($this->page - 1) >= $this->messCount)
		{
			$this->page = (int) ceil($this->messCount/$this->_proc->account->MailsPerPage);
		}
		$this->page = ($this->page < 1) ? $this->page = 1 : $this->page;
		$this->messageCollection = &$this->_proc->processor->GetMessageHeaders($this->page);
		
		if ($this->messageCollection === null)
		{
				$this->messCount = 0;
				$this->page = 1;
				$this->messageCollection = &new WebMailMessageCollection();		
				SetOnlineError(PROC_CANT_GET_MSG_LIST);	
		}
		
		$jsTempString = 'BaseForm.Form.action = "'.BASEFILE.'?'.SCREEN.'='.SCREEN_FULLSCREEN.'";';
			
		$this->_pagebuilder->AddJSText('
var tempReq = "";

function CheckThisLine(e, trobj)
{
	var id = trobj.id;

	e = e ? e : window.event;

	if (Browser.Mozilla) {var elem = e.target;}
	else {var elem = e.srcElement;}
			
	if (e.ctrlKey)
	{
		InboxLines.CheckCtrlLine(id);
	} 
	else if (e.shiftKey) 
	{
		InboxLines.CheckShiftLine(id);
	} 
	else
	{
		if (elem && elem.tagName.toLowerCase() == "a") {
			LoadMessageFull(id);
		} else if (elem && elem.tagName.toLowerCase() == "input") {
			InboxLines.CheckCBox(id);
		}
	}
}		
	
function CheckThisLineDb(e, trobj)
{
	var id = trobj.id;

	e = e ? e : window.event;

	if (Browser.Mozilla) {var elem = e.target;}
	else {var elem = e.srcElement;}
	
	if (!elem || id == "" || elem.id == "none" || elem.tagName.toLowerCase() == "input") 
	{
		return false;
	}
	LoadMessageFull(id);
}
	
function LoadMessage(lineid)
{
	if (tempReq != lineid)
	{
		ShowLoad();
		
		tempReq = lineid;
		var parseObj = ParseLineId(lineid);
		var obj = InboxLines.GetLinesById(lineid);
		
		BaseForm.MessUid.value = obj.MsgUid;
		BaseForm.Charset.value = parseObj.charset;
		BaseForm.Plain.value = "-1";
		BaseForm.Form.submit();
	}
}

function LoadMessageFull(lineid)
{
	var parseObj = ParseLineId(lineid);
	var obj = InboxLines.GetLinesById(lineid);

	'.$jsTempString.'
	BaseForm.Form.target = "_self";
	BaseForm.MessUid.value = obj.MsgUid;
	BaseForm.Charset.value = parseObj.charset;
	BaseForm.Plain.value = "-1";
	BaseForm.Form.submit();
}

function ChangeCharset(newCharset)
{
	var idline = BaseForm.MessUid.value + sep + BaseForm.Charset.value + sep;
	var newidline = BaseForm.MessUid.value + sep + newCharset + sep;
	BaseForm.Charset.value = newCharset;
	
	for (var i=0; i<InboxLines.length; i++)
	{
		if (InboxLines.lines[i].Id == idline)
		{
			InboxLines.lines[i].Id = newidline;
			InboxLines.lines[i]._tr.id = newidline;
		}
	}
} 

function ParseLineId(lineid)
{
	var IdArray = lineid.split(sep);
	if (IdArray.length > 1)
	{
		var objcharset = (IdArray[1]) ? IdArray[1] : -1;
		return {uid: IdArray[0], charset: objcharset}
	}
	return null;
}


function ShowLoad()
{
	if(InfoPanel)
	{
		InfoPanel._isError = false;
		InfoPanel.SetInfo("'.ConvertUtils::ClearJavaScriptString(JS_LANG_Loading, '"').'");
		InfoPanel.Show();
	}
}
	');
		
		$this->_pagebuilder->AddInitText('	
PageSwitcher.Show('. $this->page .', '. $this->_proc->account->MailsPerPage .', '. $this->messCount .', "ShowLoad(); document.location.replace(\'?page=", "\');");

function CBaseForm()
{
	this.Form = document.getElementById("messform");
	this.MessUid = document.getElementById("m_uid");
	this.Charset = document.getElementById("charset");
	this.Plain = document.getElementById("plain");
	this.Type = document.getElementById("mtype");
}
BaseForm = new CBaseForm();
');
	}
		
	/**
	 * @return string
	 */
	function MessageTableHeaders()
	{
		$hasSort = false;
		$orderImg = '';
		
		$out = '<div class="wm_inbox_headers" id="inbox_headers">';
		$out .= '<div style="left: 0px; width: 24px; text-align: center;"><input type="checkbox" id="allcheck" onclick="InboxLines.CheckAllbox(this)" /></div>';
		$out .= '<div style="left: 23px; width: 3px;" class="wm_inbox_headers_separate"><div></div></div>';
		
		$out .= '<div style="left: 27px; width: 17px;"><img src="./skins/'.$this->_pagebuilder->SkinName().'/menu/attachment.gif" /></div>';
		$out .= '<div style="left: 45px; width: 3px;" class="wm_inbox_headers_separate"><div></div></div>';
		
		$out .= '<div style="left:49px; width:143px;" class="wm_inbox_headers_from_subject">'.JS_LANG_From.'</div>';
		$out .= '<div style="left:193px; width: 3px;" class="wm_inbox_headers_separate"><div></div></div>';

		$out .= '<div style="left:197px; width:137px;">'.JS_LANG_Date.'</div>';
		$out .= '<div style="left:335px; width: 3px;" class="wm_inbox_headers_separate"><div></div></div>';

		$out .= '<div style="left:339px; width:47px;" >'.JS_LANG_Size.'</div>';
		$out .= '<div style="left:388px; width: 3px;" class="wm_inbox_headers_separate"><div></div></div>';

		$out .= '<div style="left:391px; width:147px;" class="wm_inbox_headers_from_subject">'.JS_LANG_Subject.'</div>';
		$out .= '</div>';
		
		return $out;
		
	}

	/**
	 * @return string
	 */
	function MessageListTr()
	{
		$out = '';
		if (!$this->messageCollection) return '';
		$c = $this->messageCollection->Count();

		$stylewidth = array(
			array('', ' style="width: 24px; text-align: center;"'),
			array('', ' style="width: 22px;"'),
			array('', ' style="width: 148px;"'),
			array('', ' style="width: 142px;"'),
			array('', ' style="width: 54px;"'),
			array('', ' style="width: 150px;"')
		);
			
		for ($i = 0;  $i < $c; $i++)
		{
			$msg = &$this->messageCollection->Get($i);

			if (!$msg) continue;

			$isRead = 'true';
			$isFlagged = 'false';

			$isForwarded = (($msg->Flags & MESSAGEFLAGS_Forwarded) == MESSAGEFLAGS_Forwarded) ? 'true' : 'false';
			$isDeleted = (($msg->Flags & MESSAGEFLAGS_Deleted) == MESSAGEFLAGS_Deleted) ? 'true' : 'false';
			$isGrey = (($msg->Flags & MESSAGEFLAGS_Grayed) == MESSAGEFLAGS_Grayed) ? 'true' : 'false';
			$isReplied = 'false';
			
			$date = &$msg->GetDate();
			$date->FormatString = DEFAULT_DATEFORMAT;
			
			$msg->IdFolder = 777;
			
			$sep = '-----';
			$char = ($msg->Charset > -1) ? ConvertUtils::GetCodePageName($msg->Charset) : -1;
			$idString =	$msg->Uid . $sep . $char . $sep;
			
			$from = ConvertUtils::WMHtmlSpecialChars($msg->GetFromAsStringForSend());
			$to = ConvertUtils::WMHtmlSpecialChars($msg->GetAllRecipientsEmailsAsString(true));
			$subject = ConvertUtils::WMHtmlSpecialChars($msg->GetSubject(true));
			
			$inputCheck = '<input type="checkbox" />';
			$atemp_1 = '<a href="#">';
			$atemp_2 = '</a>';
			
			$subjectId = ($i == 0) ? 'id="subject"' : '';
			
			$out .= '
			<tr onclick="CheckThisLine(event, this);" ondblclick="CheckThisLineDb(event, this);" id="'.ConvertUtils::ArgumentQuot($idString).'">
			<td'.$stylewidth[0][(int) ($i == 0)].' id="none">'.$inputCheck.'</td>
			<td'.$stylewidth[1][(int) ($i == 0)].'>';
			$out .= ((int) $msg->HasAttachments() == 1) ? '<img src="skins/'.$this->_pagebuilder->SkinName().'/menu/attachment.gif" />' : '';
			$out .= '</td>
			<td'.$stylewidth[2][(int) ($i == 0)].' class="wm_inbox_from_subject"><nobr>'.$atemp_1.$from.$atemp_2.'</nobr></td>
			<td'.$stylewidth[3][(int) ($i == 0)].'><nobr>'.
			$date->GetFormattedDate($this->_proc->account->GetDefaultTimeOffset())
			.'</nobr></td>
			<td'.$stylewidth[4][(int) ($i == 0)].'><nobr>'.GetFriendlySize($msg->Size).'</nobr></td>
			<td'.$stylewidth[5][(int) ($i == 0)].' '.$subjectId.' class="wm_inbox_from_subject"><nobr>'.$atemp_1.$subject.$atemp_2.'</nobr></td>
			</tr>';
		}
		
		if ($c == 0)
		{
				$out = '<tr><td colspan="6" style="width: 404px;"></td>';
				$out .= '<td style="width: 150px;" id="subject"></td></tr>
				<tr><td colspan="7"><div class="wm_inbox_info_message">'.JS_LANG_InfoEmptyInbox.'</div></td></tr>';
		}
		
		return $out;
		
	}

	/**
	 * @return string
	 */
	function ToHTML()
	{
		return 
		'<table id="list">'
		.
		$this->MessageListTr()
		.
		'</table>
<form name="messform" id="messform" action="base-iframe.php?mode=full" target="_self" method="POST">
<input type="hidden" name="m_uid" id="m_uid" value="" />
<input type="hidden" name="charset" id="charset" value="" />
<input type="hidden" name="plain" id="plain" value="-1" />
<input type="hidden" name="mtype" id="mtype" value="msg" />
</form>
';
	}
	
}