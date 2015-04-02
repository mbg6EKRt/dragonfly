<?php
	
	define('BUTTONTYPE_NEWMESSAGE', 1);
	define('BUTTONTYPE_REFRESH', 2);
	define('BUTTONTYPE_FORWARD', 3);
	define('BUTTONTYPE_DELETE', 4);
	define('BUTTONTYPE_SAVE', 5);
	define('BUTTONTYPE_PRINT', 6);
	define('BUTTONTYPE_SEND', 12);
	
	define('BUTTONTYPE_RELOADFOLDER', 10);
	define('BUTTONTYPE_EMPTYTRASH', 11);
	define('BUTTONTYPE_TEST', 99);
	
	define('BUTTONTYPE_NEWGROUP', 7);
	define('BUTTONTYPE_NEWCONTACT', 8);
	define('BUTTONTYPE_IMPORTCONTACTS', 9);

	class ToolbarPanel
	{
		/**
		 * @var PageBuilder
		 */
		var $_pagebuilder;
			
		/**
		 * @var AccounSelectDiv
		 */
		var $_accountSelect;
		
		/**
		 * @var ButtonToolBar
		 */
		var $_buttontoolbar = null;
		
		/**
		 * @param PageBuilder $pageBuilder
		 * @return ToolbarPanel
		 */
		function ToolbarPanel(&$pagebuilder)
		{
			$this->_pagebuilder =& $pagebuilder;
			$this->_accountSelect =& new AccountSelectDiv($pagebuilder);
			$this->_buttontoolbar =& new ButtonToolBar($pagebuilder);
		}
		
		function ToHTML()
		{
			return '
		<table class="wm_accountslist" id="accountslist">
		  <tr>
			<td>
			'
			.
			$this->_accountSelect->doTitle()
			.
			'	<span class="wm_accountslist_logout">
					<a href="'.LOGINFILE.'?mode=logout">'.JS_LANG_Logout.'</a>
				</span>
			</td>
		  </tr>
		</table>'. $this->_buttontoolbar->ToHTML();
			
		}
	}

	class AccountSelectDiv
	{
		/**
		 * @var PageBuilder
		 */
		var $_pagebuilder;
		
		/**
		 * @param PageBuilder $pageBuilder
		 * @return AccounSelectDiv
		 */
		function AccountSelectDiv(&$pagebuilder)
		{
			$this->_pagebuilder = &$pagebuilder;
		}
		

		function doTitle()
		{
			return '
				<span class="wm_accountslist_email" id="popup_replace_1">
					<a href="'.BASEFILE.'?'.SCREEN.'='.SCREEN_MAILBOX.'">'.ConvertUtils::WMHtmlSpecialChars($this->_pagebuilder->_proc->account->Email).'</a>
				</span>			
				<span class="wm_accountslist_selection"></span>	';
		}
	}

	class ButtonToolBar
	{
		
		/**
		 * @var PageBuilder
		 */
		var $_pagebuilder;
		
		/**
		 * @var array
		 */
		var $_buttons;
	
		/**
		 * @param PageBuilder $pagebuilder
		 * @return ButtonToolBar
		 */
		function ButtonToolBar(&$pagebuilder)
		{
			$this->_pagebuilder = &$pagebuilder; 
			$screen = $this->_pagebuilder->_proc->sArray[SCREEN];
			
			if (!$this->_pagebuilder->_proc->settings->ShowTextLabels)
			{
				$this->_pagebuilder->AddInitText('
var ImgKey = document.getElementById("checkImgId");
var isDisplay;
if(ImgKey)
{
	if (isDisplay = ReadStyle(ImgKey, "display"))
	{
		if (isDisplay && isDisplay == "none")
		{
			var toolbartable = document.getElementById("toolbar");
			if (toolbartable)
			{
				var spans = toolbartable.getElementsByTagName("span");
				var i, c;
				if (spans)
				{
					for (i = 0, c = spans.length; i < c; i++)
					{
						spans[i].className = "";
					}
				}
			}
		}
	}
}
				');
			}
			
			switch ($screen)
			{
				default:
				case SCREEN_MAILBOX:
					$this->AddSimpleButton(BUTTONTYPE_NEWMESSAGE);
					$this->AddSimpleButton(BUTTONTYPE_REFRESH);
					$this->AddSimpleButton(BUTTONTYPE_DELETE);
					break;
					
				case SCREEN_FULLSCREEN:
					$this->AddSimpleButton(BUTTONTYPE_NEWMESSAGE);

					$this->_buttons[] = &new ReplyButton($pagebuilder); 
					$this->AddSimpleButton(BUTTONTYPE_FORWARD);
					
					$this->AddSimpleButton(BUTTONTYPE_PRINT);
					$this->AddSimpleButton(BUTTONTYPE_SAVE);
					$this->AddSimpleButton(BUTTONTYPE_DELETE);
					break;
				case SCREEN_NEWOREDIT:
					$this->AddSimpleButton(BUTTONTYPE_SEND);
					$this->_buttons[] = &new PriorityButton($pagebuilder); 
					break;
			}
			
		}
		
		/**
		 * @param int $type
		 */
		function AddSimpleButton($type)
		{
			$this->_buttons[] = &new ToolbarButton($this->_pagebuilder, $type);
		}
		
		/**
		* @return string
		*/
		function ButtonsToHtml()
		{
			$out = '';
		
			for ($i = 0, $c = count($this->_buttons); $i < $c; $i++)
			{
				$button = &$this->_buttons[$i];
				$out .= $button->ToHTML();
			}
		
			return $out;
		} 
		
		function ToHTML()
		{
			return '
<table class="wm_toolbar" id="toolbar">
  <tr>
	<td>'
		.
		$this->ButtonsToHtml()
		.
		'
	</td>
  </tr>
</table>
'; 
		}
		
	}

class ToolbarButton
{
	
	/**
	 * @var string
	 */
	var $_skinName;
	
	/**
	 * @var string
	 */
	var $_imgfile;
	
	/**
	 * @var string
	 */
	var $_onclick;
	
	/**
	 * @var string
	 */
	var $_title;
	
	/**
	 * @var string
	 */
	var $_class = '';
	
	/**
	 * @var bool
	 */
	var $_withText = true;
	
	var $_buttonType;
	
	/**
	 * @param PageBuilder $pagebuilder
	 * @param int $buttonType
	 * @return ToolbarButton
	 */
	function ToolbarButton(&$pagebuilder, $buttonType)
	{
		$this->_skinName = $pagebuilder->SkinName();
		$this->_withText = $pagebuilder->_proc->settings->ShowTextLabels;
		$this->_buttonType = $buttonType;
		
		switch ($buttonType)
		{
			default:
			case BUTTONTYPE_NEWMESSAGE:
				$this->_imgfile = 'new_message.gif';
				$this->_onclick = 'DoNewMessageButton();';
				$this->_title = JS_LANG_NewMessage;
				$this->_class = 'wm_menu_new_message_img';
				break;
			case BUTTONTYPE_REFRESH:
				$this->_imgfile = 'refresh.gif';
				$this->_onclick = 'DoRefresh();';
				$this->_title = JS_LANG_Refresh;
				$this->_class = 'wm_menu_check_mail_img';
				break;
			case BUTTONTYPE_FORWARD:
				$this->_imgfile = 'forward.gif';
				$this->_onclick = 'DoForwardButton();';
				$this->_title = JS_LANG_Forward;
				$this->_class = 'wm_menu_forward_img';
				break;
			case BUTTONTYPE_DELETE:
				$this->_imgfile = 'delete.gif';
				$this->_onclick = 'DoDeleteButton();';
				$this->_title = JS_LANG_Delete;
				$this->_class = 'wm_menu_delete_img';
				break;
			
			case BUTTONTYPE_SAVE:
				$this->_imgfile = 'save.gif';
				$this->_onclick = 'DoSaveButton();';
				$this->_title = JS_LANG_SaveMessage;
				$this->_class = 'wm_menu_save_message_img';
				break;
			case BUTTONTYPE_SEND:
				$this->_imgfile = 'send.gif';
				$this->_onclick = 'DoSendButton();';
				$this->_title = JS_LANG_SendMessage;
				$this->_class = 'wm_menu_send_message_img';
				break;	
			case BUTTONTYPE_PRINT:
				$this->_imgfile = 'print.gif';
				$this->_onclick = 'DoPrintButton();';
				$this->_title = JS_LANG_Print;
				$this->_class = 'wm_menu_print_message_img';
				break;

			case BUTTONTYPE_TEST:
				$this->_imgfile = 'delete.gif';
				$this->_onclick = 'DoTestButton();';
				$this->_title = 'Test Button';
				$this->_class = 'wm_menu_delete_img';
				break;
		}
	}
	
	/**
	 * @return string
	 */
	function ToHTML()
	{
		$idForCheck = ($this->_buttonType == BUTTONTYPE_SEND || $this->_buttonType == BUTTONTYPE_NEWMESSAGE) 
			? 'id="checkImgId"' : '';
		$textClass = ($this->_withText) ? '' : 'wm_hide';
		return '
<div class="wm_toolbar_item" 
	onmouseover="this.className=\'wm_toolbar_item_over\'" 
	onmouseout="this.className=\'wm_toolbar_item\'"
	onclick="'.$this->_onclick.'">
		<img '.$idForCheck.' class="'.$this->_class.'" src="skins/'.$this->_skinName.'/menu/'
		.$this->_imgfile.'" title="'.$this->_title.'" /><span class="'.$textClass.'">'.$this->_title.'</span></div>';
	}
	
}

class ReplyButton
{
	/**
	 * @var PageBuilder
	 */
	var $_pagebuilder;
	
	/**
	 * @param PageBuilder $pagebuilder
	 * @return ReplyButton
	 */
	function ReplyButton(&$pagebuilder)
	{
		$this->_pagebuilder = &$pagebuilder;
		$this->_pagebuilder->AddInitText('PopupMenu.addItem(document.getElementById("popup_menu_4"), document.getElementById("popup_control_4"), "wm_popup_menu", document.getElementById("popup_replace_4"), document.getElementById("popup_title_4"), "wm_tb", "wm_tb_press", "wm_toolbar_item", "wm_toolbar_item_over");');
	}
	
	function ToHTML()
	{
		$textClass = ($this->_pagebuilder->_proc->settings->ShowTextLabels) ? '' : 'wm_hide';
		return '
<div id="popup_replace_4" class="wm_tb">
	<div class="wm_toolbar_item" id="popup_title_4" onclick="DoReplyButton();">
		<img class="wm_menu_reply_img" src="skins/'.$this->_pagebuilder->SkinName().'/menu/reply.gif" title="'.JS_LANG_Reply.'" />&nbsp;
		<span class="'.$textClass.'">'.JS_LANG_Reply.'</span>
	</div>
	<div class="wm_toolbar_item" id="popup_control_4">
		<img class="wm_menu_control_img" src="skins/'.$this->_pagebuilder->SkinName().'/menu/popup_menu_arrow.gif" />
	</div>
</div>
<div class="wm_hide" id="popup_menu_4">
	<div onclick="DoReplyAllButton();" class="wm_menu_item" onmouseover="this.className=\'wm_menu_item_over\';" onmouseout="this.className=\'wm_menu_item\';">
		<img class="wm_menu_replyall_img" src="skins/'.$this->_pagebuilder->SkinName().'/menu/replyall.gif" title="'.JS_LANG_ReplyAll.'" />
		<span class="'.$textClass.'">'.JS_LANG_ReplyAll.'</span>
	</div>
</div>
		';
	}	
} 

class PriorityButton
{
	/**
	 * @var PageBuilder
	 */
	var $_pagebuilder;
	
	/**
	 * @param PageBuilder $pagebuilder
	 * @return PriorityButton
	 */
	function PriorityButton(&$pagebuilder)
	{
		$this->_pagebuilder = &$pagebuilder;
		
		$this->_pagebuilder->AddInitText('
PriorityImg = document.getElementById("priority_img");
PriorityText = document.getElementById("priority_text");
PriorityInput = document.getElementById("priority_input");
		');
		
		$this->_pagebuilder->AddJSText('
var PriorityImg, PriorityText, PriorityInput;

function SetPriority(value)
{
	switch (value) {
		case 5:
			PriorityInput.value = 5;
			PriorityImg.src = "skins/'.$this->_pagebuilder->SkinName().'/menu/priority_low.gif";
			PriorityText.innerHTML = "'.JS_LANG_Low.'";
		break;
		default:
		case 3:
			PriorityInput.value = 3;
			PriorityImg.src = "skins/'.$this->_pagebuilder->SkinName().'/menu/priority_normal.gif";
			PriorityText.innerHTML = "'.JS_LANG_Normal.'";
		break;
		case 1:
			PriorityInput.value = 1;
			PriorityImg.src = "skins/'.$this->_pagebuilder->SkinName().'/menu/priority_high.gif";
			PriorityText.innerHTML = "'.JS_LANG_High.'";
		break;
	}
}

function ChangePriority()
{
	switch (PriorityInput.value) {
		case "5":
			SetPriority(3);
		break;
		case "3":
			SetPriority(1);
		break;
		case "1":
			SetPriority(5);
		break;
	}
}
		');
	}
	
	function ToHTML()
	{
		$textClass = ($this->_pagebuilder->_proc->settings->ShowTextLabels) ? '' : 'wm_hide';
		return '
<div onclick="ChangePriority();" class="wm_toolbar_item" onmouseover="this.className=\'wm_toolbar_item_over\';" onmouseout="this.className=\'wm_toolbar_item\';">
	<img id="priority_img" class="wm_menu_priority_img" src="skins/'.$this->_pagebuilder->SkinName().'/menu/priority_normal.gif" title="'.JS_LANG_Importance.'" />
	<span id="priority_text" class="'.$textClass.'">'.JS_LANG_Normal.'</span>
</div>
		';
	}	
}