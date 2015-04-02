<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));

	require_once(WM_ROOTPATH.'common/inc_constants.php');
	require_once(WM_ROOTPATH.'class_account.php');
	require_once(WM_ROOTPATH.'class_webmailmessages.php');
	require_once(WM_ROOTPATH.'common/class_log.php');

	/**
	 * @static 
	 */
	class CSmtp
	{
		/**
		 * @param Account $account
		 * @param WebMailMessage $message
		 * @param string $from
		 * @param string $to
		 * @return bool
		 */
		function SendMail(&$account, &$message, $from, $to)
		{
			if(DEMOACCOUNTALLOW && $account->Email == DEMOACCOUNTEMAIL)
			{
				$_SESSION[DEMOACCOUNTMSGCOUNT] = isset($_SESSION[DEMOACCOUNTMSGCOUNT]) ? $_SESSION[DEMOACCOUNTMSGCOUNT] : 0;
				if ($_SESSION[DEMOACCOUNTMSGCOUNT] > 3)
				{
					setGlobalError("To prevent abuse, no more than 3 e-mails per session is allowed in this demo. To send more e-mails, start another session.");
					return false;
				}
				else 
				{
					$_SESSION[DEMOACCOUNTMSGCOUNT]++;
				}
			}
			
			$link = null;
			$log =& CLog::CreateInstance();
			$result = CSmtp::Connect($link, $account, $log);
			
			if ($result)
			{
				if ($from == null)
				{
					$fromAddr = $message->GetFrom();
					$from = $fromAddr->Email;
				}

				if ($to == null)
				{
					$to = $message->GetAllRecipientsEmailsAsString(false, (DEMOACCOUNTALLOW && $account->Email == DEMOACCOUNTEMAIL));
				}

				$result = CSmtp::Send($link, $account, $message, $from, $to, $log);
				if ($result)
				{
					$result = CSmtp::Disconnect($link, $log);
				}
			}
			else 
			{
				setGlobalError(ErrorSMTPConnect);
			}
			
			return $result;
		}
		
		
		/**
		 * @access private
		 * @param resource $link
		 * @param Account $account
		 * @param CLog $log
		 * @return bool
		 */
		function Connect(&$link, &$account, &$log)
		{
			$outHost = (strlen($account->MailOutHost) > 0) ? $account->MailOutHost : $account->MailIncHost;
			$errno = $errstr = null;
			
			$log->WriteLine('[SMTP] Connecting to server '. $outHost.' on port '.$account->MailOutPort);
			$link = @fsockopen($outHost, $account->MailOutPort, $errno, $errstr);
			if(!$link)
			{
				setGlobalError('[SMTP] Error: '.$errstr);
				$log->WriteLine(getGlobalError());
				return false;
			} 
			else
			{
				return CSmtp::IsSuccess($link, $log);
			}
		}
		
		/**
		 * @access private
		 * @param resource $link
		 * @param CLog $log
		 * @return bool
		 */
		function Disconnect(&$link, &$log)
		{
			return CSmtp::ExecuteCommand($link, 'QUIT', $log);
		}
		
		/**
		 * @access private
		 * @param resource $link
		 * @param Account $account
		 * @param WebMailMessage $message
		 * @param string $from
		 * @param string $to
		 * @param CLog $log
		 * @return bool
		 */
		function Send(&$link, &$account, &$message, $from, $to, &$log)
		{
			$result = CSmtp::ExecuteCommand($link, 'EHLO ' . $account->MailOutHost, $log);
			if (!$result) 
			{
				$result = CSmtp::ExecuteCommand($link, 'RSET '. $account->MailOutHost, $log);

				if ($result)
				{
					$result = CSmtp::ExecuteCommand($link, 'HELO '. $account->MailOutHost, $log);
				}
			}
			
			if ($result && $account->MailOutAuthentication)
			{
				$result = CSmtp::ExecuteCommand($link, 'AUTH LOGIN', $log);
				
				$mailOutLogin = ($account->MailOutLogin) ?
						$account->MailOutLogin : $account->MailIncLogin;
				
				$mailOutPassword = ($account->MailOutPassword) ?
						$account->MailOutPassword : $account->MailIncPassword;

				if ($result)
				{
					$log->WriteLine('[SMTP] Sending encoded login');
					$result = CSmtp::ExecuteCommand($link, base64_encode($mailOutLogin), $log);
				}

				if ($result)
				{
					$log->WriteLine('[SMTP] Sending encoded password');
					$result = CSmtp::ExecuteCommand($link, base64_encode($mailOutPassword), $log);
				}
			}
			
			if ($result)
			{
				$result = CSmtp::ExecuteCommand($link, 'MAIL FROM:<'.$from.'>', $log);
			}
			else 
			{
				setGlobalError(ErrorSMTPAuth);
			}
			
			if ($result)
			{
				$toArray = explode(',', $to);
				foreach ($toArray as $recipient)
				{
					$recipient = trim($recipient);
					$result = CSmtp::ExecuteCommand($link, 'RCPT TO:<'.$recipient.'>', $log);
					if (!$result)
					{
						break;
					}
				}
			}
			
			if ($result)
			{
				$result = CSmtp::ExecuteCommand($link, 'DATA', $log);
			}
			
			if ($result)
			{
				$result = CSmtp::ExecuteCommand($link, str_replace(CRLF.'.', CRLF.'..', $message->TryToGetOriginalMailMessage()).CRLF.'.', $log);
			}
			
			return $result;
		}

		/**
		 * @access private
		 * @param resource $link
		 * @param string $command
		 * @param CLog $log
		 * @return bool
		 */
		function ExecuteCommand(&$link, $command, &$log)
		{
			$log->WriteLine('SMTP >>: '.$command);
			@fputs($link, $command.CRLF);
			return CSmtp::IsSuccess($link, $log);
		}
		
		/**
		 * @access private
		 * @param resource $link
		 * @param CLog $log
		 * @return bool
		 */
		function IsSuccess(&$link, &$log)
		{
			$result = true;
			do
			{
				$line = @fgets($link, 1024);
				if ($line === false)
				{
					$result = false;
					setGlobalError('SMTP IsSuccess fgets error');
					break;
				}
				else
				{
					$line = str_replace("\r", '', str_replace("\n", '', str_replace(CRLF, '', $line)));
					if (substr($line, 0, 1) != '2' && substr($line, 0, 1) != '3')
					{
						$result = false;
						setGlobalError('SMTP Error <<: ' . $line);
					}
				}
			  
			} while(substr($line, 3, 1) == '-');
			
			if (!$result)
			{
				$log->WriteLine(getGlobalError());
			}
			
			return $result;
		}
		
		
	}
