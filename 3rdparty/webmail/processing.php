<?php
	
	header('Content-type: text/xml; charset=utf-8');
	
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
	
	require_once(WM_ROOTPATH.'common/class_xmldocument.php');
	require_once(WM_ROOTPATH.'class_account.php');
	require_once(WM_ROOTPATH.'class_webmailmessages.php');
	require_once(WM_ROOTPATH.'class_mailprocessor.php');
	require_once(WM_ROOTPATH.'class_filesystem.php');
	require_once(WM_ROOTPATH.'common/class_i18nstring.php');
	require_once(WM_ROOTPATH.'common/class_convertutils.php');
	require_once(WM_ROOTPATH.'common/inc_constants.php');
	require_once(WM_ROOTPATH.'class_smtp.php');
	require_once(WM_ROOTPATH.'class_validate.php');
	
	define('DUMMYPASSWORD', '1111111111111111111111');

	$null = null;
	$log =& CLog::CreateInstance();
	
	$xmlRes = &new XmlDocument();
	$xmlRes->CreateElement('webmail');

	$xml = isset($_POST['xml']) ? $_POST['xml'] : '';

	$log->WriteLine("<<<[not_parsed_from_client]<<<\r\n".$xml);

	$xmlObj =& new XmlDocument();
	$xmlObj->ParseFromString($xml);
	
	$log->WriteLine("<<<[to_server]<<<\r\n".$xmlObj->ToString(true));
	
	$settings =& Settings::CreateInstance();
	if (!$settings->isLoad)
	{
		printErrorAndExit('', $xmlRes, 3);
	}
	
	@session_name('PHPWEBMAILSESSID');
	@session_start();
	
	if ($xmlObj->GetParamValueByName('action') != 'login' && !isset($_SESSION[S_ACCT_ARRAY]))
	{
		$xmlRes->XmlRoot->AppendChild(new XmlDomNode('session_error'));
		printXML($xmlRes);
	}
	
	if (!isset($_SESSION[ATTACHMENTDIR])) $_SESSION[ATTACHMENTDIR] = md5(session_id());
	
	if (!$settings->IncludeLang())
	{
		printErrorAndExit('', $xmlRes, 6);
	}

	$account =& Account::CreateInstance();

	switch ($xmlObj->GetParamValueByName('action'))
	{
		case 'login':

			$sendSettingsList = false;
			
			$xmlEmail = trim($xmlObj->GetParamTagValueByName('email'));
			$xmlLogin = trim($xmlObj->GetParamTagValueByName('mail_inc_login'));
			$xmlPass = $xmlObj->GetParamTagValueByName('mail_inc_pass');
			$xmlAdvancedLogin = (bool) $xmlObj->GetParamValueByName('advanced_login');
			
			if ($xmlAdvancedLogin && $settings->AllowAdvancedLogin)
			{
				$email = $xmlEmail;
				$login = $xmlLogin;
			}
			else
			{
				switch ($settings->HideLoginMode)
				{
					case 0:
						$email = $xmlEmail;
						$login = $xmlLogin;
						break;
					
					case 10:
						$email = $xmlEmail;
						
						$emailAddress = &new EmailAddress();
						$emailAddress->SetAsString($email);
	
						$login = $emailAddress->GetAccountName();
						break;
						
					case 11:
						$email = $xmlEmail;
						$login = $xmlEmail;
						break;
						
					case 20:
					case 21:
						$login = $xmlLogin;
						$email = $login.'@'.$settings->DefaultDomainOptional;
						break;
						
					case 22:
					case 23:
						$login = $xmlLogin.'@'.$settings->DefaultDomainOptional;
						$email = $login;
				}
			}

			$account =& Account::CreateInstance(true);
			
			$account->Email = $email;
			$account->MailIncLogin = $login;
			$account->MailIncPassword = $xmlObj->GetParamTagValueByName('mail_inc_pass');
			
			if ($xmlAdvancedLogin && $settings->AllowAdvancedLogin)
			{
				$account->MailIncPort = (int) $xmlObj->GetParamValueByName('mail_inc_port');
				$account->MailOutPort = (int) $xmlObj->GetParamValueByName('mail_out_port');
				$account->MailOutAuthentication = (bool) $xmlObj->GetParamValueByName('mail_out_auth');
				$account->MailIncHost = $xmlObj->GetParamTagValueByName('mail_inc_host');
				$account->MailOutHost = $xmlObj->GetParamTagValueByName('mail_out_host');			
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
				printErrorAndExit($validate, $xmlRes);
			}

			$processor = &new MailProcessor($account);

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
				$loginNode = &new XmlDomNode('login');
				$xmlRes->XmlRoot->AppendChild($loginNode);
			}
			else 
			{
				$account->Delete();
				printErrorAndExit(getGlobalError(), $xmlRes);
			}
			
			printXML($xmlRes);
			break;
			
		case 'get':
			switch ($xmlObj->GetParamValueByName('request'))
			{
					
				case 'account':
					
					if (!$account)
					{
						printErrorAndExit('', $xmlRes, 2);
					}
					
					$accountNode = &new XmlDomNode('account');
					$accountNode->AppendChild(new XmlDomNode('email', $account->Email, true));
					$xmlRes->XmlRoot->AppendChild($accountNode);
					
					break;
					
				case 'settings_list':
					
					if (!$settings)
					{
						printErrorAndExit('', $xmlRes, 3);
					}
					
					$settingsNode =& new XmlDomNode('settings_list');
					
					$settingsNode->AppendAttribute('show_text_labels', (int) $settings->ShowTextLabels);
					$settingsNode->AppendAttribute('msgs_per_page', (int) $settings->MailsPerPage);
					$settingsNode->AppendAttribute('mailbox_limit', (int) $settings->MailboxSizeLimit);
					$settingsNode->AppendAttribute('view_mode', (int) $settings->ViewMode);
					
					$skin = '';
					$skinsList = &FileSystem::GetSkinsList();
					$firstSkin = (count($skinsList) > 0) ? $skinsList[0] : '';
					if (empty($firstSkin))
					{
						printErrorAndExit('', $xmlRes, 3);
					}
					
					foreach ($skinsList as $skinName)
					{
						if (strtolower($skinName) == strtolower($settings->DefaultSkin))
						{
							$skin = $skinName;
						}
					}
					
					$skin = empty($skin) ? $firstSkin : $skin;
					$skinsNode =& new XmlDomNode('def_skin', $skin, true);
					
					$settingsNode->AppendChild($skinsNode);
					$xmlRes->XmlRoot->AppendChild($settingsNode);
					
					break;
										
				case 'messages':

					if (!$account)
					{
						printErrorAndExit('', $xmlRes, 2);
					}

					$processor =& new MailProcessor($account);
					$messagesCount = $processor->GetPop3InboxMessagesCount();
					$messagesSize = $processor->GetPop3InboxMessagesSize();
						
					if (ceil($messagesCount/$account->MailsPerPage) < (int) $xmlObj->GetParamValueByName('page'))
					{
						$page = $xmlObj->GetParamValueByName('page') - 1;
						$page = ($page < 1) ? 1 : $page;
					}
					else 
					{
						$page = $xmlObj->GetParamValueByName('page');
					}

					$messageCollection =& $processor->GetMessageHeaders($page);
				
					if ($messageCollection != null)
					{
						$msgsNode = &new XmlDomNode('messages');
						$msgsNode->AppendAttribute('page', $page);
						$msgsNode->AppendAttribute('count', $messagesCount);
						$msgsNode->AppendAttribute('mailbox_size', $messagesSize);
						
						for ($i = 0, $c = $messageCollection->Count(); $i < $c; $i++)
						{
							$msg =& $messageCollection->Get($i);
							$msgNode = &new XmlDomNode('message');
							$msgNode->AppendAttribute('has_attachments', (int) $msg->HasAttachments());
							$msgNode->AppendAttribute('priority', $msg->GetPriorityStatus());
							$msgNode->AppendAttribute('size', $msg->Size);
							
							
							$msgNode->AppendChild(new XmlDomNode('from', $msg->GetFromAsStringForSend(), true));
							$msgNode->AppendChild(new XmlDomNode('to', $msg->GetToAsStringForSend(), true));
							$msgNode->AppendChild(new XmlDomNode('reply_to', $msg->GetReplyToAsStringForSend(), true));
							$msgNode->AppendChild(new XmlDomNode('cc', $msg->GetCcAsStringForSend(), true));
							$msgNode->AppendChild(new XmlDomNode('bcc', $msg->GetBccAsStringForSend(), true));
							
							$msgNode->AppendChild(new XmlDomNode('subject', $msg->GetSubject(true), true));

							$date =& $msg->GetDate();
							$date->FormatString = DEFAULT_DATEFORMAT;
							$msgNode->AppendChild(new XmlDomNode('date', $date->GetFormattedDate($account->GetDefaultTimeOffset($settings->DefaultTimeZone)), true));
							$msgNode->AppendChild(new XmlDomNode('uid', $msg->Uid, true));
							
							$msgsNode->AppendChild($msgNode);
						}
						
						$xmlRes->XmlRoot->AppendChild($msgsNode);

					}
					else
					{
						printErrorAndExit(PROC_CANT_GET_MSG_LIST, $xmlRes);
					}

					break;
					
				case 'message':
				
					if (!$account)
					{
						printErrorAndExit('', $xmlRes, 2);
					}
					
					$processor = &new MailProcessor($account);
					
					$msgUid = $xmlObj->GetParamTagValueByName('uid');
					
					$charsetNum = $xmlObj->GetParamValueByName('charset');
					
					$account->DefaultIncCharset = ConvertUtils::GetCodePageName($charsetNum);
					
					if ($charsetNum > 0)
					{
						$GLOBALS[MailInputCharset] = $account->DefaultIncCharset;
					}
					
					$message =& $processor->GetMessage($msgUid); 
					
					if ($message != null)
					{
						$message->Uid = $msgUid;
						
						$fromObj = new EmailAddress();
						$fromObj->Parse($message->GetFromAsString(true));
						
						$mode = (int) $xmlObj->GetParamValueByName('mode');
						
						$messageNode = &new XmlDomNode('message');

						$messageClassType = $message->TextBodies->ClassType();
						
						$messageNode->AppendAttribute('html', (int) (($messageClassType & 2) == 2));
						$messageNode->AppendAttribute('plain', (int) (($messageClassType & 1) == 1));
						$messageNode->AppendAttribute('priority', $message->GetPriorityStatus());
						$messageNode->AppendAttribute('mode', $mode);
						$messageNode->AppendAttribute('charset', $charsetNum);
						$messageNode->AppendAttribute('has_charset', (int) $message->HasCharset);
						
						$messageNode->AppendChild(new XmlDomNode('uid', $msgUid, true));
						
						if (($mode & 1) == 1)
						{
							$headersNode = &new XmlDomNode('headers');
							$headersNode->AppendChild(new XmlDomNode('from', $message->GetFromAsString(true), true));
							$headersNode->AppendChild(new XmlDomNode('to', $message->GetToAsString(true), true));
							$headersNode->AppendChild(new XmlDomNode('cc', $message->GetCcAsString(true), true));
							$headersNode->AppendChild(new XmlDomNode('bcc', $message->GetBccAsString(true), true));
							$headersNode->AppendChild(new XmlDomNode('reply_to', $message->GetReplyToAsString(true), true));
 							$headersNode->AppendChild(new XmlDomNode('subject', $message->GetSubject(true), true));
							
							$date =& $message->GetDate();
							$date->FormatString = DEFAULT_DATEFORMAT;
							$headersNode->AppendChild(new XmlDomNode('date', $date->GetFormattedDate($account->GetDefaultTimeOffset($settings->DefaultTimeZone)), true));

							$messageNode->AppendChild($headersNode);
						}
						
						if (($mode & 2) == 2 && ($messageClassType & 2) == 2)
						{
							$messageNode->AppendChild(new XmlDomNode('html_part', ConvertUtils::ReplaceJSMethod($message->GetCensoredHtmlWithImageLinks(true)), true, true));
						}
			
						if (($mode & 4) == 4 || ($mode & 2) == 2 && ($messageClassType & 1) == 1)
						{
							$messageNode->AppendChild(new XmlDomNode('modified_plain_text', $message->GetCensoredTextBody(true), true, true));	
						}
						
						if (($mode & 16) == 16)
						{
							$messageNode->AppendChild(new XmlDomNode('reply_plain', $message->GetRelpyAsPlain(true), true, true));
						}

						if (($mode & 64) == 64)
						{
							$messageNode->AppendChild(new XmlDomNode('forward_plain', $message->GetRelpyAsPlain(true), true, true));
						}
						
						if (($mode & 128) == 128)
						{
							$messageNode->AppendChild(new XmlDomNode('full_headers',
									$message->ClearForSend(ConvertUtils::ConvertEncoding(
												$message->OriginalHeaders, $GLOBALS[MailInputCharset], $account->GetUserCharset())), true, true));
						}

						if (($mode & 256) == 256 || ($mode & 32) == 32 || ($mode & 8) == 8)
						{
							$attachments = &$message->Attachments;
							if ($attachments != null && $attachments->Count() > 0)
							{
								$attachmentsNode = &new XmlDomNode('attachments');
								
								foreach (array_keys($attachments->Instance()) as $key)
								{
									$attachment = &$attachments->Get($key);
									$tempname = ConvertUtils::ClearFileName($message->Uid.'-'.$key.'_'.$attachment->GetTempName());
									$filename = ConvertUtils::ClearFileName(ConvertUtils::ClearUtf8($attachment->GetFilenameFromMime(), $GLOBALS[MailInputCharset], $account->GetUserCharset()));
									
									$fs = &new FileSystem(INI_DIR.'/temp', $account->Email);
									if (!$fs->SaveAttach($attachment, $_SESSION[ATTACHMENTDIR], $tempname))
									{
										$log->WriteLine('Save temp Attachment error: '.getGlobalError());
									}
									
									$attachNode = &new XmlDomNode('attachment');
									$attachNode->AppendAttribute('size', strlen($attachment->MimePart->GetBinaryBody()));
									
									$attachNode->AppendChild(new XmlDomNode('filename', $filename, true));
									$attachNode->AppendChild(new XmlDomNode('view', 'view-image.php?tn='.urlencode($tempname), true));
									$attachNode->AppendChild(new XmlDomNode('download', 'attach.php?tn='.urlencode($tempname).'&filename='.urlencode($filename), true));
									
									$attachNode->AppendChild(new XmlDomNode('tempname', $tempname, true));
									$attachNode->AppendChild(new XmlDomNode('mime_type', ConvertUtils::GetContentTypeFromFileName($filename), true));
									
									$attachmentsNode->AppendChild($attachNode);
								}
								
								$messageNode->AppendChild($attachmentsNode);
							}
						}
						
						if (($mode & 512) == 512)
						{
							$messageNode->AppendChild(new XmlDomNode('unmodified_plain_text', $message->GetNotCensoredTextBody(true), true, true));
						}
						
						$messageNode->AppendChild(new XmlDomNode('save_link', 'attach.php?msg_uid='.urlencode($msgUid), true));
						$messageNode->AppendChild(new XmlDomNode('print_link', 'print.php?msg_uid='.urlencode($msgUid).'&charset='.$charsetNum, true));
						
						$xmlRes->XmlRoot->AppendChild($messageNode);
					}
					else
					{
						printErrorAndExit(getGlobalError(), $xmlRes);
					}

					break;
			}
			
			printXML($xmlRes);
			break;
			
		case 'operation_messages':

			if (!$account)
			{
				printErrorAndExit('', $xmlRes, 2);
			}
			
			$processor =& new MailProcessor($account);
			$messagesRequestNode =& $xmlObj->XmlRoot->GetChildNodeByTagName('messages');
			$operationNode =& new XmlDomNode('operation_messages');

			$messageUids = array();
			
			foreach (array_keys($messagesRequestNode->Children) as $nodeKey)
			{
				$messageNode =& $messagesRequestNode->Children[$nodeKey];
				
				if ($messageNode->TagName != 'message')
				{
					continue;
				}
				
				$messageUids[] = $messageNode->GetChildValueByTagName('uid', true);
			}
			
			$errorNode = null;

			switch ($xmlObj->GetParamValueByName('request'))
			{
				case 'delete':
					
					if ($processor->DeleteMessages($messageUids))
					{
						$operationNode->AppendAttribute('type', 'delete');
					}
					else
					{
						$errorNode = &new XmlDomNode('error', PROC_CANT_DEL_MSGS, true);
					}
					
					break;
			}
			
			if ($errorNode == null)
			{
				$xmlRes->XmlRoot->AppendChild($operationNode);
			}
			else
			{
				$xmlRes->XmlRoot->AppendChild($errorNode);
			}

			printXML($xmlRes);
			break;
			
		case 'send':
			switch ($xmlObj->GetParamValueByName('request'))
			{
				case 'message':

					if (!$account)
					{
						printErrorAndExit('', $xmlRes, 2);
					}
				
					$message = &CreateMessage($account, $xmlObj);
					
					$processor = &new MailProcessor($account);
					
					//$message->TextBodies->AddTextBannerToBodyText('Thanks for purchase (WebMail Lite Php)');

					$message->OriginalMailMessage = $message->ToMailString(true);
					$message->Flags |= MESSAGEFLAGS_Seen;
					
					$result = true;
					if (!CSmtp::SendMail($account, $message, null, null))
					{
						$result = false;
					}
							
					if ($result)
					{
						$updateNode = &new XmlDomNode('update');
						$_SESSION[DEMOACCOUNTRECCOUNT] = isset($_SESSION[DEMOACCOUNTRECCOUNT]) ? $_SESSION[DEMOACCOUNTRECCOUNT] : 0;
						if ($_SESSION[DEMOACCOUNTRECCOUNT])
						{
							$_SESSION[DEMOACCOUNTRECCOUNT] = 0;
							$updateNode->AppendAttribute('value', 'send_message_demo');
						}
						else 
						{
							$updateNode->AppendAttribute('value', 'send_message');
						}						
						$xmlRes->XmlRoot->AppendChild($updateNode);
					}
					else
					{
						printErrorAndExit(PROC_CANT_SEND_MSG, $xmlRes);
					}

					printXML($xmlRes);
					break;
			}
			break;

	}
	
	$log->WriteLine('EMPTY XML PACK');
	
	/**
	 * @param Account $account
	 * @param XmlDocument $xmlObj
	 * @return WebMailMessage
	 */
	function &CreateMessage(&$account, &$xmlObj)
	{
		$log =& CLog::CreateInstance();
		
		$messageNode = &$xmlObj->XmlRoot->GetChildNodeByTagName('message');
		$headersNode = &$messageNode->GetChildNodeByTagName('headers');
		
		$message = &new WebMailMessage();
		$GLOBALS[MailDefaultCharset] = $account->GetUserCharset();
		$GLOBALS[MailInputCharset] = $account->GetUserCharset();
		$GLOBALS[MailOutputCharset] = $account->GetDefaultOutCharset();
		
		$message->Headers->SetHeaderByName(MIMEConst_MimeVersion, '1.0');
		$message->Headers->SetHeaderByName(MIMEConst_XMailer, 'MailBee WebMail Lite PHP');
		$message->Headers->SetHeaderByName(MIMEConst_XOriginatingIp, isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0');
		
		$message->SetPriority($messageNode->GetAttribute('priority', 3));
		
		$serverAddr = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['SERVER_NAME'] : 'cantgetservername';
		$message->Headers->SetHeaderByName(MIMEConst_MessageID, 
					'<'.substr(session_id(), 0, 7).'.'.md5(time()).'@'. $serverAddr .'>');
		
		$temp = $headersNode->GetChildValueByTagName('from');
		if ($temp)
		{
			$message->SetFromAsString(ConvertUtils::WMBackHtmlSpecialChars($temp));	
		}
		$temp = $headersNode->GetChildValueByTagName('to');
		if ($temp)
		{
			$message->SetToAsString(ConvertUtils::WMBackHtmlSpecialChars($temp));
		}
		$temp = $headersNode->GetChildValueByTagName('cc');
		if ($temp)
		{
			$message->SetCcAsString(ConvertUtils::WMBackHtmlSpecialChars($temp));
		}
		$temp = $headersNode->GetChildValueByTagName('bcc');
		if ($temp)
		{
			$message->SetBccAsString(ConvertUtils::WMBackHtmlSpecialChars($temp));
		}
		$message->SetSubject(ConvertUtils::WMBackHtmlSpecialChars($headersNode->GetChildValueByTagName('subject')));

		$message->SetDate(new CDateTime(time()));
		
		$bodyNode =& $messageNode->GetChildNodeByTagName('body');
		$message->TextBodies->PlainTextBodyPart = 
				str_replace("\n", CRLF,
				str_replace("\r", '', ConvertUtils::WMBackHtmlNewCode($bodyNode->Value)));
		
		$attachmentsNode = &$messageNode->GetChildNodeByTagName('attachments');
		
		if ($attachmentsNode != null)
		{
			
			$fs =& new FileSystem(INI_DIR.'/temp', $account->Email);
						
			foreach(array_keys($attachmentsNode->Children) as $key)
			{
				$attachNode =& $attachmentsNode->Children[$key];
				
				$attachCid = 'attach.php?tn='.$attachNode->GetChildValueByTagName('temp_name');
				$replaceCid = md5(time().$attachNode->GetChildValueByTagName('name'));
				
				$mime_type = $attachNode->GetChildValueByTagName('mime_type');
				if ($mime_type == '') 
				{
					$mime_type = ConvertUtils::GetContentTypeFromFileName($attachNode->GetChildValueByTagName('name'));
				}

				if (!$message->Attachments->AddFromFile($fs->GetFolderFullPath($_SESSION[ATTACHMENTDIR]).'/'.$attachNode->GetChildValueByTagName('temp_name'), 
									$attachNode->GetChildValueByTagName('name'), $mime_type))
				{
					$log->WriteLine('Error Get tempfile for Attachment: '.getGlobalError());
				}
				
			}
		}

		return $message;
	}

	
	function printXML(&$xmlObj)
	{
		$log =& CLog::CreateInstance();
		$log->WriteLine(">>>[from_server]>>>\r\n".$xmlObj->ToString(true));
		print $xmlObj->ToString();
		exit();
	}
	
	function printErrorAndExit($errorString, &$xmlObj, $code = null)
	{
		$errorNote = new XmlDomNode('error', $errorString, true);
		if ($code !== null)
		{
			$errorNote->AppendAttribute('code', (int) $code);
		}
		$xmlObj->XmlRoot->AppendChild($errorNote);
		printXML($xmlObj);
	}
