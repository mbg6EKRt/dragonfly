<?php

	define('ErrorDesc', 'ErrorDesc');
	define('MEMORYLIMIT', '200M');
	define('TIMELIMIT', 3000);
	define('DEFAULT_SKIN', 'Hotmail_Style');
	define('SESSION_LANG', 'session_lang');
	define('MAILADMLOGIN', 'mailadm');
	define('WMVERSION', '4.1.17');
	
	define('ATTACHMENTDIR', 'attachtempdir');
	
	/**
	 * @return string
	 */
	function getGlobalError()
	{
		return isset($GLOBALS[ErrorDesc]) ? $GLOBALS[ErrorDesc] : '';
	}
	
	/**
	 * @param string $errorString
	 */
	function setGlobalError($errorString)
	{
		$GLOBALS[ErrorDesc]	= $errorString;
	}
