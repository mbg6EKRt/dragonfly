<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));

	define('START_PAGE_IS_MAILBOX', 0);
	define('START_PAGE_IS_NEW_MESSAGE', 1);
	
	header('Content-Type: text/html; charset=utf-8');

	@session_name('PHPWEBMAILSESSID');
	@session_start();
	
	if (isset($_GET['start']))
	{
		$getTemp = '';
		$start = isset($_GET['start']) ? $_GET['start'] : START_PAGE_IS_MAILBOX;
		$to = isset($_GET['to']) ? '&to='.trim($_GET['to']) : '';
		switch ($start)
		{
			default:
			case START_PAGE_IS_MAILBOX:		$getTemp = '?screen=mailbox';	break;
			case START_PAGE_IS_NEW_MESSAGE:	$getTemp = '?screen=new'.$to;	break;
		}
		header('Location: basewebmail.php'.$getTemp);
		exit();
	}

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
			$_REQUEST = fixed_array_map_stripslashes($_REQUEST);
			$_POST = fixed_array_map_stripslashes($_POST);
		}
	}
	
	@disable_magic_quotes_gpc();
	
	require_once(WM_ROOTPATH.'classic/base_processor.php');
	require_once(WM_ROOTPATH.'classic/class_pagebuilder.php');

	$Proc = new BaseProcessor();
	
	$Page = new PageBuilder($Proc);
	
	$Page->EchoHTML();
	