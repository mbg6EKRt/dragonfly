<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));

	function fixed_array_map_stripslashes($array)
	{
		if (is_array($array))
		{
			foreach ($array as $key => $value)
			{
				$array[$key] = (is_array($value))
						? @fixed_array_map_stripslashes($value)
						: @stripslashes($value);
			}
		}
		return $array;
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
	
	require_once(WM_ROOTPATH.'common/inc_constants.php');
	require_once(WM_ROOTPATH.'class_settings.php');
	
	$settings =& Settings::CreateInstance();
	if (!$settings->isLoad || !$settings->IncludeLang())
	{
		exit();
	}
	
	require_once(WM_ROOTPATH.'class_account.php');
	require_once(WM_ROOTPATH.'class_filesystem.php');
	require_once(WM_ROOTPATH.'class_mailprocessor.php');
	require_once(WM_ROOTPATH.'class_webmailmessages.php');
	
	@session_name('PHPWEBMAILSESSID');
	@session_start();
	
	if (!isset($_SESSION[ATTACHMENTDIR])) $_SESSION[ATTACHMENTDIR] = md5(session_id());
	
	function setContentLength($data) 
	{
		header('Content-Length: '.strlen($data));
		return $data;
	}
	
	@ob_start('setContentLength');

	$account =& Account::CreateInstance();
	if (!$account)
	{
		exit();
	}
	
	if (isset($_GET['msg_uid']))
	{
		$processor = &new MailProcessor($account);
		
		$message =& $processor->GetMessage($_GET['msg_uid']);
		
		if (!$message)
		{
			exit(getGlobalError());
		}
		
		$data = $message->TryToGetOriginalMailMessage();
		$fileNameToSave = ConvertUtils::ClearFileName(trim($message->GetSubject()));
		if (empty($fileNameToSave))
		{
			$fileNameToSave = 'message';
		}
		
		// IE
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		
		header('Content-type: application/octet-stream; charset=utf-8');
		header('Accept-Ranges: bytes');
		header('Content-Disposition: attachment; filename="'.$fileNameToSave.'.eml"');
		header('Content-Transfer-Encoding: binary');
		
	}
	elseif (isset($_GET['tn']))
	{
		$fs =& new FileSystem(INI_DIR.'/temp', $account->Email);
		$tempname = ConvertUtils::ClearFileName($_GET['tn']);
		$data = $fs->LoadBinaryAttach($_SESSION[ATTACHMENTDIR], $tempname);

		if (isset($_GET['filename']))
		{
			$filename = ConvertUtils::ClearFileName($_GET['filename']);
			$filename = (!empty($filename)) ? $filename : 'attachment';
			
			// IE
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');

			header('Content-Type: application/octet-stream; charset=utf-8');
			header('Accept-Ranges: bytes');
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header('Content-Transfer-Encoding: binary');
		}
		else 
		{
			header('Content-Type: '.ConvertUtils::GetContentTypeFromFileName($tempname));
		}
	}
	else
	{
		exit();
	}

	echo $data;
