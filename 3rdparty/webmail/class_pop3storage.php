<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));
	
	require_once(WM_ROOTPATH.'libs/class_pop3.php');
	require_once(WM_ROOTPATH.'/class_webmailmessages.php');

	class Pop3Storage extends MailServerStorage
	{
		/**
		 * @access private
		 * @var POP3
		 */
		var $_pop3Mail;
		
		/**
		 * @access private
		 * @var array
		 */
		var $_pop3Uids = null;
		
		/**
		 * @access private
		 * @var array
		 */
		var $_pop3Sizes = null;
		
		/**
		 * @access private
		 * @var int
		 */
		var $_pop3Stat = null;
		
		/**
		 * @param Account $account
		 * @return Pop3Storage
		 */
		function Pop3Storage(&$account)
		{
			MailServerStorage::MailServerStorage($account);
			$this->_pop3Mail = &new CPOP3();
		}
		
		/**
		 * @return bool
		 */
		function Connect()
		{
			if ($this->_pop3Mail->socket != false)
			{
				return true;
			}
			
			register_shutdown_function(array(&$this, 'Disconnect'));

			if (!$this->_pop3Mail->connect($this->Account->MailIncHost, $this->Account->MailIncPort))
			{
				setGlobalError(ErrorPOP3Connect);
				return false;
			}
			
			if (!$this->_pop3Mail->login($this->Account->MailIncLogin, $this->Account->MailIncPassword))
			{
				$err = getGlobalError();
				if (strlen($err) > 5 && strtolower(substr($err, 0, 4)) == '-err')
				{
					setGlobalError(trim(substr($err, 4)));
				}
				//setGlobalError(ErrorPOP3IMAP4Auth);
				return false;				
			}
			
			return true;
		}
		
		/**
		 * @return bool
		 */
		function Disconnect()
		{
			if ($this->_pop3Mail->socket == false)
			{
				return true;
			}
			return $this->_pop3Mail->close();
		}
		
		/**
		 * @param string $messageIndex
		 * @param bool $indexAsUid
		 * @return WebMailMessage
		 */
		function &LoadMessage($messageIndex, $indexAsUid)
		{
			$message = null;
			$size = 0;

			if ($indexAsUid)
			{
				
				$uids = &$this->_getPop3Uids();
				$count = count($uids);
				$idx = $this->_getMessageIndexFromUid($uids, $messageIndex);
			}
			else
			{
				$idx = $messageIndex;
				$uids =& $this->_getPop3Uids($idx);
				$stat =& $this->_getPop3Stat();
				$count = (int) $stat['count_mails'];
			}
			
			$uid = isset($uids[$idx]) ? $uids[$idx] : -1;
			$sizes =& $this->_getPop3Sizes($idx);
			$size = isset($sizes[$idx]) ? $sizes[$idx] : 0;

			if ($idx < 0 || $idx > $count)
			{
				setGlobalError(PROC_MSG_HAS_DELETED);
				return $message;
			}
			
			$start = getmicrotime();
			$msgRawBody = $this->_pop3Mail->get_mail($idx);
			$log =& CLog::CreateInstance();
			$log->WriteLine('[POP3] GetMail TIME: '.(getmicrotime() - $start));
			if (!$msgRawBody)
			{
				return $message;
			}
			
			$message = &new WebMailMessage();
			$message->LoadMessageFromRawBody($msgRawBody, true);
			$message->IdMsg = $idx;
			$message->Uid = $uid;
			$message->Size = $size;
			
			return $message;
		}

		/**
		 * @param int $pageNumber
		 * @return WebMailMessageCollection
		 */
		function &LoadMessageHeaders($pageNumber)
		{
			$messageIndexSet = array();
			$stat =& $this->_getPop3Stat();
			$msgCount = (int) $stat['count_mails'];
			
	  		for ($i = $msgCount - ($pageNumber - 1) * $this->Account->MailsPerPage; $i > $msgCount - $pageNumber * $this->Account->MailsPerPage; $i--)
	  		{
	  			if ($i == 0) break;
	  			$messageIndexSet[] = $i;
	  		}
	  		$messageCollection = &$this->_loadMessageHeaders($messageIndexSet, false);
	  		return $messageCollection;
		}		

		/**
		 * @param array $messageIndexSet
		 * @param bool $indexAsUid
		 * @return bool
		 */
		function DeleteMessages(&$messageIndexSet, $indexAsUid)
		{
			$result = true;

			if ($indexAsUid)
			{
				$uids =& $this->_getPop3Uids();
				$msgCount = count($uids);
			}
			else 
			{
				$stat =& $this->_getPop3Stat();
				$msgCount = (int) $stat['count_mails'];				
			}
			
			foreach ($messageIndexSet as $index)
			{
				$idx = ($indexAsUid) ? $this->_getMessageIndexFromUid($uids, $index) : $index;

				if ($idx < 0 || $idx > $msgCount)
				{
					continue;
				}
				
				$result &= $this->_pop3Mail->delete_mail($idx);
				
			}
			return $result;
		}
		
		/**
		 * @access private
		 * @param array $messageIndexSet
		 * @param bool $indexAsUid
		 * @return WebMailMessageCollection
		 */
		function &_loadMessageHeaders(&$messageIndexSet, $indexAsUid)
		{
			$messageCollection = new WebMailMessageCollection();

			$uids =& $this->_getPop3Uids();
			$sizes =& $this->_getPop3Sizes();
			$msgCount = count($uids);
			
			foreach ($messageIndexSet as $index)
			{
				$idx = ($indexAsUid) ? $this->_getMessageIndexFromUid($uids, $index) : $index;

				if ($idx < 0 || $idx > $msgCount)
				{
					continue;
				}
				
				$msgRawBody = $this->_pop3Mail->get_top($idx);

				if (!$msgRawBody)
				{
					continue;
				}
				
				$message = &new WebMailMessage();
				$message->LoadMessageFromRawBody($msgRawBody);
				$message->IdMsg = $idx;
				$message->Uid = $uids[$idx];
				$message->Size = $sizes[$idx];
				$message->Flags |= MESSAGEFLAGS_Seen;

				$messageCollection->Add($message);
			}
			
			return $messageCollection;
		}

		/**
		 * @param string $messageIndex
		 * @param bool $indexAsUid
		 * @return WebMailMessage
		 */
		function &LoadMessageHeader($messageIndex, $indexAsUid)
		{
			$message = null;
			
			if ($indexAsUid)
			{
				$uids =& $this->_getPop3Uids();
				$msgCount = count($uids);
				$idx = $this->_getMessageIndexFromUid($uids, $messageIndex);
			}
			else
			{
				$idx = $messageIndex;
				$stat =& $this->_getPop3Stat();
				$msgCount = (int) $stat['count_mails'];	
				$uids =& $this->_getPop3Uids($idx);	
			}

			if ($idx < 0 || $idx > $msgCount)
			{
				return $message;
			}
			
			$msgRawBody = $this->_pop3Mail->get_top($idx);
			if (!$msgRawBody)
			{
				return $message;
			}
			
			$message = &new WebMailMessage();
			$message->LoadMessageFromRawBody($msgRawBody);
			$message->IdMsg = $idx;
			$message->Uid = $uids[$idx];
			$size =& $this->_getPop3Sizes($idx);
			$message->Size = $size[$idx];
			
			return $message;
		}
		
		/**
		 * @access private
		 * @return Array
		 */
		function &_getPop3Uids($indx = 0)
		{
			if ($this->_pop3Uids === null)
			{
				if ($indx > 0)
				{
					$uids = $this->_pop3Mail->uidl($indx);
				}
				else 
				{
					$uids = $this->_pop3Mail->uidl();
					$this->_pop3Uids =& $uids;
				}
			}
			else 
			{
				$uids =& $this->_pop3Uids;
			}
			return $uids;
		}
		
		/**
		 * @access private
		 * @return array
		 */
		function &_getPop3Sizes($indx = 0)
		{
			if (is_null($this->_pop3Sizes))
			{
				if ($indx > 0)
				{
					$size = $this->_pop3Mail->msglist($indx);
				}
				else 
				{
					$size = $this->_pop3Mail->msglist();
					$this->_pop3Sizes =& $size;
				}
			}
			else 
			{
				$size =& $this->_pop3Sizes;
			}
			return $size;
		}

		/**
		 * @access private
		 * @return Array
		 */
		function &_getPop3Stat()
		{
			if ($this->_pop3Stat == null)
			{
				$this->_pop3Stat = $this->_pop3Mail->_stats();
			}
			$stat =& $this->_pop3Stat;
			return $stat;
		}
		
		
		/**
		 * @access private
		 * @param Array $uidList
		 * @param string $uid
		 * @return int
		 */
		function _getMessageIndexFromUid(&$uidList, $uid)
		{
			if ($uidList != null)
			{				
				foreach ($uidList as $id => $strUid)
				{
					if ($strUid == $uid)
					{
						return $id;
					}
				}
			}
			
			return -1;
		}
		
	}

