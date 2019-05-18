<?php

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
		header('Location: index.php?error=3');
		exit();	
	}
	elseif (!$settings->IncludeLang())
	{
		header('Location: index.php?error=6');
		exit();
	}
	
	require_once(WM_ROOTPATH.'classic/base_defines.php');
	require_once(WM_ROOTPATH.'class_mailprocessor.php');
	require_once(WM_ROOTPATH.'class_filesystem.php');
	require_once(WM_ROOTPATH.'class_smtp.php');
	require_once(WM_ROOTPATH.'class_validate.php');

	$ACTION = Get::val('action', 'none');
	$REQ = Get::val('req', 'none');
	$null = null;
	
	$Account = &Account::CreateInstance();
	$Processor = &new MailProcessor($Account);
	$sarray = Session::val(SARRAY);
	
	if (!isset($_SESSION[ATTACHMENTDIR])) $_SESSION[ATTACHMENTDIR] = md5(session_id());

	if (!$Account)
	{
		header('Location: '.BASEFILE.'?'.SCREEN.'='.SCREEN_MAILBOX);
		exit();
	}
	
	switch ($ACTION)
	{
		case 'groupoperation':
			switch ($REQ)
			{
				case 'delete_messages':

					if (!Post::has('d_messages')) SetError(PROC_CANT_DEL_MSGS);
					
					$uids = Post::val('d_messages', array());
					if (!$Processor->DeleteMessages($uids))
					{
							SetError(PROC_CANT_DEL_MSGS);
					}
					header('Location: '.BASEFILE.'?'.SCREEN.'='.SCREEN_MAILBOX);
					break;
				default:
				case 'none': header('Location: '.BASEFILE.'?'.SCREEN.'='.SCREEN_MAILBOX); break;
			}
			break;
			
		case 'delete':
			switch ($REQ)
			{
				case 'message':
					$messageIdUidSet = array(Post::val('messageUid', ''));
					if (!$Processor->DeleteMessages($messageIdUidSet))
					{
						SetError(PROC_CANT_DEL_MSGS, BASEFILE.'?'.SCREEN.'='.SCREEN_MAILBOX);
					}
					header('Location: '.BASEFILE.'?'.SCREEN.'='.SCREEN_MAILBOX);
					break;
					$folder = &new Folder($Account->Id, Get::val('f', -1), '123');

				default:			
				case 'none': header('Location: '.BASEFILE.'?'.SCREEN.'='.SCREEN_MAILBOX); break;
			}
			break;
			
		case 'send':
			switch ($REQ)
			{
				case 'message':
					$message = &CreateMessageFromPost($Account);
					//$message->TextBodies->AddTextBannerToBodyText('Thanks for purchase (WebMail Pro 4.1)');
					$message->OriginalMailMessage = $message->ToMailString(true);

					if (!CSmtp::SendMail($Account, $message, null, null))
					{
						SetError(PROC_CANT_SEND_MSG.' '.getGlobalError());
					}
					else 
					{
						$_SESSION[DEMOACCOUNTRECCOUNT] = isset($_SESSION[DEMOACCOUNTRECCOUNT]) ? $_SESSION[DEMOACCOUNTRECCOUNT] : 0;
						if ($_SESSION[DEMOACCOUNTRECCOUNT])
						{
							$_SESSION[DEMOACCOUNTRECCOUNT] = 0;
							SetReport('To prevent abuse, no more than 3 e-mail addresses per message is allowed in this demo. All addresses except the first 3 have been discarded.');
						}
						else 
						{
							SetReport(ReportMessageSent);
						}
					}
					
					$fs = &new FileSystem(INI_DIR.'/temp', $Account->Email);
					$fs->DeleteDir($_SESSION[ATTACHMENTDIR]);
					
					header('Location: '.BASEFILE.'?'.SCREEN.'='.SCREEN_MAILBOX);	
					break;
					
				default:			
				case 'none': header('Location: '.BASEFILE.'?'.SCREEN.'='.SCREEN_MAILBOX); break;
			}
			break;
	}
	
	/**
	 * @param Account $account
	 * @return WebMailMessage
	 */
	function &CreateMessageFromPost(&$account)
	{
		$message = &new WebMailMessage();
		$GLOBALS[MailDefaultCharset] = $account->GetUserCharset();
		$GLOBALS[MailInputCharset] = $account->GetUserCharset();
		$GLOBALS[MailOutputCharset] = $account->GetDefaultOutCharset();
		
		$message->Headers->SetHeaderByName(MIMEConst_MimeVersion, '1.0');
		$message->Headers->SetHeaderByName(MIMEConst_XMailer, 'MailBee WebMail Lite PHP');
		$message->Headers->SetHeaderByName(MIMEConst_XOriginatingIp, isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0');

		$message->SetPriority(Post::val('priority_input', 3));
		$message->DbPriority = Post::val('priority_input', 3);
		$message->Uid = Post::val('m_uid', '');

		$message->Headers->SetHeaderByName(MIMEConst_MessageID, 
					'<'.substr(session_id(), 0, 7).'.'.md5(time()).'@'.$_SERVER['SERVER_NAME'].'>');
		
		$temp = Post::val('from', '');
		if ($temp)
		{
			$message->SetFromAsString($temp);	
		}
		$temp = Post::val('toemail', '');
		if ($temp)
		{
			$message->SetToAsString($temp);
		}
		$temp = Post::val('toCC', '');
		if ($temp)
		{
			$message->SetCcAsString($temp);
		}
		$temp = Post::val('toBCC', '');
		if ($temp)
		{
			$message->SetBccAsString($temp);
		}
		$temp = Post::val('subject', '');
		if ($temp)
		{
			$message->SetSubject($temp);
		}
		$message->SetDate(new CDateTime(time()));
		
		$message->TextBodies->PlainTextBodyPart = ConvertUtils::BackImagesToHtmlBody(Post::val('message', ''));
		
		$attachments = Post::val('attachments');
		
		if ($attachments && is_array($attachments))
		{
			$fs = &new FileSystem(INI_DIR.'/temp', $account->Email);
			$attfolder = Session::val(ATTACHMENTDIR);
			
			foreach($attachments as $key => $value)
			{
				if (Session::val(ATTACHMENTDIR))
				{
					$attachCid = 'attach.php?tn='.$key;
					$replaceCid = md5(time().$value);
					
					$mime_type = ConvertUtils::GetContentTypeFromFileName($value);
					$message->Attachments->AddFromFile($fs->GetFolderFullPath(Session::val(ATTACHMENTDIR)).'/'.$key, 
										$value, $mime_type, false);
				}
			}
		}
		
		return $message;
	}
