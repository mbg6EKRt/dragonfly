<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/../'));
	
	require_once(WM_ROOTPATH.'class_mailprocessor.php');
	
	require_once(WM_ROOTPATH.'classic/class_top.php');
	require_once(WM_ROOTPATH.'classic/class_toolbarpanel.php');
	require_once(WM_ROOTPATH.'classic/class_foot.php');
	
	class PageBuilder
	{

		/**
		 * @var BaseProcessor
		 */
		var $_proc;
		
		/**
		 * @var JavaScriptBuilder
		 */
		var $_js;
		
		/**
		 * @var TopPanel
		 */
		var $_top;
		
		/**
		 * @var ToolBar
		 */
		var $_toolbar;
		
		/**
		 * @var CenterPanel
		 */
		var $_center;
		
		/**
		 * @var FootPanel
		 */
		var $_foot;
		
		/**
		 * @var string
		 */
		var $_hideDivs;
		
		/**
		 * @param BaseProcessor
		 * @return PageBuilder
		 */
		function PageBuilder($Proc)
		{
			$this->_proc = &$Proc;
			$this->_js = &new JavaScriptBuilder();
			
			$this->_top = &new TopPanel($this);
			$this->_hideDivs = '';
			$this->_toolbar = &new ToolBarPanel($this);
			
			switch ($this->_proc->sArray[SCREEN])
			{
				case SCREEN_NEWOREDIT:
					require_once(WM_ROOTPATH.'classic/class_newmessage.php');
					$this->_center = &new CNewMessagePanel($this);
					break;	
				case SCREEN_FULLSCREEN:
					require_once(WM_ROOTPATH.'classic/class_fullscreen.php');
					$this->_center = &new FullScreenPanel($this);
					break;	
				default:
				case SCREEN_MAILBOX:
					require_once(WM_ROOTPATH.'classic/class_center-box.php');
					$this->_center = &new CenterPanel($this);
					break;
			}
			
			$this->_foot = &new FootPanel($this);
		}
		
		/**
		 * @param string $text
		 */
		function AddHideDiv($text)
		{
			$this->_hideDivs .= trim($text)."\r\n";
		}
		
		/**
		 * @param string $filename
		 */
		function AddJSFile($filename)
		{
			$this->_js->AddFile($filename);
		}
		
		/**
		 * @param string $filename
		 */
		function AddJSText($text)
		{
			$this->_js->AddText($text);
		}
		
		/**
		 * @param string $text
		 */
		function AddInitText($text)
		{
			$this->_js->AddInitText($text);
		}
		
		/**
		 * @return string
		 */
		function SkinName()
		{
			return $this->_proc->account->DefaultSkin;
		}
		
		/**
		 * @return string
		 */
		function Title()
		{
			$screenTitle = '';
			if($this->_proc->sArray && isset($this->_proc->sArray[SCREEN]))
			{
				switch ($this->_proc->sArray[SCREEN])
				{
					case SCREEN_MAILBOX:	$screenTitle = ' - '.JS_LANG_TitleMessagesList;		break;
					case SCREEN_FULLSCREEN:	$screenTitle = ' - '.JS_LANG_TitleViewMessage;		break;
					case SCREEN_NEWOREDIT:	$screenTitle = ' - '.JS_LANG_TitleNewMessage;		break;
					default:				$screenTitle = ' - '.$this->_proc->account->Email;	break;		
				}
			}
			
			return $this->_proc->settings->WindowTitle . $screenTitle;
		}
		
		function EchoHTML()
		{
			@ob_start();
			echo $this->_top->ToHTML().
			$this->_hideDivs.
			$this->_toolbar->ToHTML().
			$this->_center->ToHTML();
			@ob_end_flush();
			@ob_start();
			echo $this->_foot->ToHTML();
			@ob_end_flush();
		}
	}	
	
	class JavaScriptBuilder
	{
		/**
		 * @var array
		 */
		var $_jsFiles;
		
		/**
		 * @var array
		 */
		var $_jsText;
		
		/**
		 * @var array
		 */
		var $_jsIniFunctionText;
		
		/**
		 * @param PageSettings $settings
		 * @return JavaScriptBuilder
		 */
		function JavaScriptBuilder()
		{
			$this->_jsFiles = array();
			$this->_jsText = array();
			$this->_jsIniFunctionText = array();
			
			$this->AddFile('_defines.js');
			$this->AddFile('_functions.js');
			$this->AddFile('class.common.js');
			$this->AddFile('./classic/base.cinfo.js');
			$this->AddText('var FadeEffect, Report;');	
		}	
			
		/**
		 * @param string $filename
		 */
		function AddFile($filename)
		{
			$this->_jsFiles[] = $filename;
		}
		
		/**
		 * @param string $text
		 */
		function AddText($text)
		{
			$text = trim($text);
			if ($text) $this->_jsText[] = $text;
		}
		
		/**
		 * @param string $text
		 */
		function AddInitText($text)
		{
			$text = trim($text);
			if ($text) $this->_jsIniFunctionText[] = $text;
		}
		
		/**
		 * @return string;
		 */
		function _filesToHtml()
		{
			$output = '';
			$this->_jsFiles = array_unique($this->_jsFiles);
			foreach ($this->_jsFiles as $value)
			{
				$output .= '<script language="JavaScript" type="text/javascript" src="'.$value.'"></script>'."\r\n";
			}
			return $output;
		}
		
		/**
		 * @return string
		 */
		function _textToHtml()
		{
			$out = '<script language="JavaScript" type="text/javascript">
var WebMail = { _html: document.getElementById("html") }; var rVer = 140;
';
			
			for ($i = 0, $c = count($this->_jsText); $i < $c; $i++)
			{
				$out .= $this->_jsText[$i]."\r\n";
			}		
			
			$out .= "\r\n".'</script>'."\r\n";
			return $out;
		}
		
		/**
		 * @return string
		 */
		function _iniTextToHtml()
		{
			$out = '
<script language="JavaScript">
function Init()
{
	Browser = new CBrowser();
	PopupMenu = new CPopupMenus();
	';
			for ($i = 0, $c = count($this->_jsIniFunctionText); $i < $c; $i++)
			{
				$out .= $this->_jsIniFunctionText[$i]."\r\n";
			}
			
			$out .= '
	ResizeElements("all");
}
Ready(INIT_BODY);
</script>
';
			return $out;
		}
		
		/*
		 * @return string
		 */
		function ToHTML()
		{
			return "\r\n".$this->_filesToHtml().$this->_textToHtml();
		}		
	}