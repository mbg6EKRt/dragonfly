<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/../'));
	
	require_once(WM_ROOTPATH.'class_webmailmessages.php');
	require_once(WM_ROOTPATH.'class_mailprocessor.php');
	require_once(WM_ROOTPATH.'class_filesystem.php');
	require_once(WM_ROOTPATH.'common/class_i18nstring.php');
	require_once(WM_ROOTPATH.'common/class_convertutils.php');
	require_once(WM_ROOTPATH.'common/inc_constants.php');
	require_once(WM_ROOTPATH.'class_smtp.php');
	require_once(WM_ROOTPATH.'classic/base_defines.php');
	
class GetMessageBase
{
	/**
	 * @var string
	 */
	var $messUid;
	
	/**
	 * @var Account
	 */
	var $account;
	
	/**
	 * @var MailProcessor
	 */
	var $processor;
	
	/**
	 * @var WebMailMessage
	 */
	var $msg;
	
	/**
	 * @var string
	 */
	var $charset;
	
	/**
	 * @param int $messId
	 * @param string $messUid
	 * @param int $folderId
	 * @param string $folderFullName
	 * @return GetMessageBase
	 */
	function GetMessageBase($account, $messUid, $charset)
	{
		$this->messUid = $messUid;
		$this->charset = $charset;
		
		if (!isset($_SESSION[ATTACHMENTDIR])) $_SESSION[ATTACHMENTDIR] = md5(session_id());
		
		$this->account = &$account;
		
		$this->processor = &new MailProcessor($this->account);

		if ($charset != -1)
		{
			$GLOBALS[MailInputCharset] = $charset;
			$charsetNum = ConvertUtils::GetCodePageNumber($charset);
		}
		else 
		{
			$charsetNum = -1;
		}
		
		$this->msg = &$this->processor->GetMessage($messUid); 
		
		if (!$this->msg) return false;
	}
	
	/**
	 * @return int
	 */
	function GetTypeOfMessage()
	{
		return $this->msg->TextBodies->ClassType();
	}
	
	/**
	 * @return bool
	 */
	function HasAttachments()
	{
		return ($this->msg->Attachments != null && $this->msg->Attachments->Count() > 0);
	}
	
	/**
	 * @param bool $isEncode
	 * @return string
	 */
	function PrintFrom($isEncode = true)
	{
		return $this->msg->GetFromAsString($isEncode);
	}
	
	/**
	 * @param bool $isEncode
	 * @return string
	 */
	function PrintFriendlyFrom($isEncode = true)
	{
		return $this->msg->GetFromAsStringForSend($isEncode);
	}
	
	/**
	 * @param bool $isEncode
	 * @return string
	 */
	function PrintTo($isEncode = true)
	{
		return $this->msg->GetToAsString($isEncode);
	}
	
	/**
	 * @param bool $isEncode
	 * @return string
	 */
	function PrintCc($isEncode = true)
	{
		return $this->msg->GetCcAsString($isEncode);
	}
	
	/**
	 * @param bool $isEncode
	 * @return string
	 */
	function PrintBcc($isEncode = true)
	{
		return $this->msg->GetBccAsString($isEncode);
	}
	
	/**
	 * @param bool $isEncode
	 * @return string
	 */
	function PrintReplyTo($isEncode = true)
	{
		return $this->msg->GetReplyToAsString($isEncode);
	}
	
	/**
	 * @param bool $isEncode
	 * @return string
	 */
	function PrintSubject($isEncode = true)
	{
		return $this->msg->GetSubject($isEncode);
	}
	
	/**
	 * @return string
	 */
	function PrintDate()
	{
		$date = &$this->msg->GetDate();
		return $date->GetFormattedDate($this->account->GetDefaultTimeOffset());
	}

	/**
	 * @param bool $isEncode
	 * @return string
	 */
	function PrintPlainBody($isEncode = true)
	{
		return $this->msg->GetCensoredTextBody($isEncode);
	}
	
	/**
	 * @param bool $isEncode
	 * @return string
	 */
	function PrintHtmlBody($isEncode = true, $isFromSave = false)
	{
		return $this->msg->GetCensoredHtmlWithImageLinks($isEncode);
	}
}
