<?php

	@session_name('PHPWEBMAILSESSID');
	@session_start();

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));
	
	require_once(WM_ROOTPATH.'class_account.php');
	require_once(WM_ROOTPATH.'class_settings.php');
	require_once(WM_ROOTPATH.'class_mailprocessor.php');
	
	$settings =& Settings::CreateInstance();
	if (!$settings->IncludeLang())
	{
		die('Can\'t load lang file');
	}
		
	define('START_PAGE_IS_MAILBOX', 0);
	define('START_PAGE_IS_NEW_MESSAGE', 1);
	
class CIntegration
{

	/**
	 * @var string
	 */
	var $_webmailroot;
	
	/**
	 * @var string
	 */
	var $_errorMessage = '';
	
	/**
	 * @param string $webmailrootpath
	 * @return CIntegration
	 */
	function CIntegration($webmailrootpath = '')
	{
		$this->_webmailroot = (trim($webmailrootpath)) ? rtrim(trim($webmailrootpath), '/\\').'/' : '';
	}

	/**
	 * @param string $email
	 * @param string $login
	 * @param string $password
	 * @param string $incHost
	 * @param string $outHost
	 * @param int $incPort
	 * @param int $outPort
	 * @param bool $useAuth
	 * @param int $startPage
	 * @param string $toEmail
	 * @return bool
	 */
	function UserLogin($email, $login, $password, $incHost, $outHost, $startPage = START_PAGE_IS_MAILBOX, $incPort = 110, $outPort = 25, $useAuth = true, $toEmail = null)
	{
		$account =& Account::CreateInstance(true);
		$settings =& Settings::CreateInstance();
		
		$account->Email = $email;
		$account->MailIncLogin = $login;
		$account->MailIncPassword = $password;
		$account->MailIncHost = $incHost;
		$account->MailIncPort = $incPort;
		$account->MailOutHost = $outHost;
		$account->MailOutPort = $outPort;
		$account->MailOutAuthentication = $useAuth;
		
		$validate = $account->ValidateData();
		if ($validate === false)
		{
			$account->Delete();
			$this->SetError($validate);
			return false;			
		}
		
		$getTemp = '';
		switch ($startPage)
		{
			default:
				$getTemp = '?start='.START_PAGE_IS_MAILBOX; 
				break;
			case START_PAGE_IS_NEW_MESSAGE:
				if ($toEmail && strlen($toEmail) > 0)
				{
					$getTemp = '?start='.START_PAGE_IS_NEW_MESSAGE.'&to='.$toEmail; 
				}
				else
				{
					$getTemp = '?start='.START_PAGE_IS_NEW_MESSAGE;
				}
				break;
			case START_PAGE_IS_MAILBOX:
				$getTemp = '?start='.$startPage;
				break;
		}
		

		$mailprocessor =& new MailProcessor($account);
		if (!$mailprocessor->MailStorage)
		{
			$this->SetError(getGlobalError());
			return false;			
		}
		
		if ($mailprocessor->MailStorage->Connect())
		{
			$account->Update();
			if ($settings->AllowAjax)
			{
				header('Location: '.$this->_webmailroot.'webmail.php'.$getTemp);
			} 
			else 
			{
				header('Location: '.$this->_webmailroot.'basewebmail.php'.$getTemp);
			}
			return true;
		}
		else 
		{
			$this->SetError(getGlobalError());
			return false;
		}
		
		if ($this->_errorMessage == '') $this->SetError();
		return false;
	}
	
	/**
	 * @return string
	 */
	function GetErrorString()
	{
		return $this->_errorMessage;
	}
	
	function SetError($string = null)
	{
		$this->_errorMessage = ($string) ? $string : getGlobalError();
	}	
}
