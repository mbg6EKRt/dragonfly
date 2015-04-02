<?php
	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));

	require_once(WM_ROOTPATH.'class_account.php');

	class MailProcessor
	{
		/**
		 * @var Pop3Storage
		 */
		var $MailStorage = null;
		
		/**
		 * @access private
		 * @var Account
		 */
		var $_account;
		
		/**
		 * @param Account $account
		 * @return MailProcessor
		 */
		function MailProcessor(&$account)
		{
			$this->_account =& $account;
			switch ($account->MailProtocol)
			{
				default:
				case MAILPROTOCOL_POP3:
					require_once(WM_ROOTPATH.'class_pop3storage.php');
					$this->MailStorage = &new Pop3Storage($account);
					break;
			}			
		}
		
		/**
		 * @param WebMailMessage $message
		 * @param string $from optional
		 * @param string $to optional
		 * @return bool
		 */
		function SendMail(&$message, $from = null, $to = null)
		{
			return CSmtp::SendMail($this->_account, $message, $from, $to);
		}
		
		/**
		 * @param string $messageIndex
		 * @param bool $indexAsUid
		 * @return WebMailMessage
		 */
		function &GetMessageHeader($messageIndex, $indexAsUid)
		{
			$webMailMessage = null;
			if ($this->MailStorage->Connect())
			{
				$GLOBALS[MailDefaultCharset] = $this->_account->GetDefaultIncCharset();
				$GLOBALS[MailOutputCharset] = $this->_account->GetUserCharset();
				
				@ini_set('memory_limit', MEMORYLIMIT);
				@set_time_limit(TIMELIMIT);		
				
				$webMailMessage =& $this->MailStorage->LoadMessageHeader($messageIndex, $indexAsUid);
			}
			
			return $webMailMessage;
		}
		
		/**
		 * @param int $pageNumber
		 * @return WebMailMessageCollection
		 */
		function &GetMessageHeaders($pageNumber)
		{
			$messageHeaders = null;
			
			if ($this->MailStorage->Connect())
			{
				$GLOBALS[MailDefaultCharset] = $this->_account->GetDefaultIncCharset();
				$GLOBALS[MailOutputCharset] = $this->_account->GetUserCharset();
				
				@ini_set('memory_limit', MEMORYLIMIT);
				@set_time_limit(TIMELIMIT);				
				$log = &CLog::CreateInstance();
				$start = getmicrotime();
				$messageHeaders =& $this->MailStorage->LoadMessageHeaders($pageNumber);
				$log->WriteLine('LoadMessageHeaders time: '.(getmicrotime() - $start));
			}

			return $messageHeaders;
		}
		
		/**
		 * @param string $messageUid
		 * @return WebMailMessage
		 */
		function &GetMessage($messageUid)
		{
			$webMailMessage = null;
			if ($this->MailStorage->Connect())
			{	
				$GLOBALS[MailDefaultCharset] = $this->_account->GetDefaultIncCharset();
				$GLOBALS[MailOutputCharset] = $this->_account->GetUserCharset();
	
				@ini_set('memory_limit', MEMORYLIMIT);
				@set_time_limit(TIMELIMIT);				
				
				$webMailMessage =& $this->MailStorage->LoadMessage($messageUid, true);
			}
		
			return $webMailMessage;
		}
		
		/**
		 * @return int
		 */
		function GetPop3InboxMessagesCount()
		{
			$messagesCount = 0;
			if ($this->MailStorage->Connect())
			{
				switch ($this->_account->MailProtocol)
				{
					default:						
					case MAILPROTOCOL_POP3:		
						$out =& $this->MailStorage->_getPop3Stat();
						$messagesCount = (int) (isset($out['count_mails'])) ? $out['count_mails'] : $messagesCount;
						break;
				}
			}	
			
			return $messagesCount;	
		}

		/**
		 * @return int
		 */
		function GetPop3InboxMessagesSize()
		{
			$messagesSize = 0;
			if ($this->MailStorage->Connect())
			{
				switch ($this->_account->MailProtocol)
				{
					default:						
					case MAILPROTOCOL_POP3:		
						$out =& $this->MailStorage->_getPop3Stat();
						$messagesSize = (int) (isset($out['octets'])) ? $out['octets'] : $messagesSize;
						break;
				}
			}	
			
			return $messagesSize;	
		}
		
		/**
		 * @param array $messageIdUidSet
		 * @return bool
		 */
		function DeleteMessages(&$messageUid)
		{
			if (!is_array($messageUid))
			{
				return false;
			}
			
			switch ($this->_account->MailProtocol)
			{
				default:
				case MAILPROTOCOL_POP3:
					return $this->MailStorage->Connect() && $this->MailStorage->DeleteMessages($messageUid, true);
					break;
			}
			
			return false;
		}
		
	}
