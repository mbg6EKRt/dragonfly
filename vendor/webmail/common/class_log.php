<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/../'));
	
	require_once(WM_ROOTPATH.'class_settings.php');

	// Use default formatting.
	define ('LOG_FORMAT_OPTIONS_NONE', 0);
	// Include the current date in the timestamp.
	define ('LOG_FORMAT_OPTIONS_ADD_DATE', 1);
	define('LOG_FILENAME', 'log_'.date('Y-m-d').'.txt');
	
	class CLog
	{
		/**
		 * @var bool
		 */
		var $Enabled;
		
		/**
		 * LOG_FORMAT_OPTIONS_NONE or LOG_FORMAT_OPTIONS_ADD_DATE
		 * @var short
		 */
		var $Format = LOG_FORMAT_OPTIONS_ADD_DATE;
		
		/**
		 * @var string
		 */
		var $LogFilePath;
		
		/**
		 * @return CLog
		 */
		function CLog($param = true)
		{
		    if (!is_null($param))
		    {
		    	die(CANT_CALL_CONSTRUCTOR);
		    }		
			
			$settings =& Settings::CreateInstance();
			$this->Enabled = $settings->EnableLogging;

			$this->LogFilePath = INI_DIR.'/'.LOG_PATH.'/'.LOG_FILENAME;
			if (!is_dir(INI_DIR.'/'.LOG_PATH))
			{
				@mkdir(INI_DIR.'/'.LOG_PATH);
			}
		}
		
		/**
		 * @static
		 * @return CLog
		 */
		function &CreateInstance()
		{
			static $instance;
    		if (!is_object($instance))
    		{
				$instance = new CLog(null);
    		}
    		return $instance;
		}
		
		/**
		 * @param string $errorDesc
		 * @param int $line
		 */
		function WriteLine($errorDesc, $line = '')
		{
			if (!$this->Enabled) return;
			
			$date = date('H:i:s');
			if (($this->Format & LOG_FORMAT_OPTIONS_ADD_DATE) == LOG_FORMAT_OPTIONS_ADD_DATE)
			{
				$date = date('m/d/Y H:i:s');
			}
			
			$line = (strlen($line) > 0) ? '[line: '.$line.']' : '';
			@error_log('['.$date.']'.$line.' '.$errorDesc ."\r\n", 3, $this->LogFilePath);
		}
	}
