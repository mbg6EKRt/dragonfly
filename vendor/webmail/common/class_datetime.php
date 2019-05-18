<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/../'));

	require_once(WM_ROOTPATH.'common/class_convertutils.php');

	define('DATEFORMAT_DEFAULT', 0);
	define('DATEFORMAT_DDMMYY', 1);
	define('DATEFORMAT_MMDDYY', 2);
	define('DATEFORMAT_DDMonth', 3);
	define('DATEFORMAT_Advanced', 4);


	class CDateTime
	{
		/**
		 * @var int
		 */
		var $TimeStamp;
		
		/**
		 * @var string
		 */
		var $FormatString = 'Default';
		
		/**
		 * @param int $timestamp optional
		 * @return CDateTime
		 */
		function CDateTime($timestamp = null)
		{
			if ($timestamp != null)
			{
				$this->TimeStamp = $timestamp;
			}
		}
		
		/**
		 * @static
		 * @param string $str
		 * @return CDateTime
		 */
		function &CreateFromStr($str)
		{
			$datetime = ($str) ? strtotime($str) : -1;
			
			$datetime = -1;
			
			if (phpversion() >= '5.1.0' && $datetime === false || $datetime == -1)
			{
				$return = &new CDateTime(ConvertUtils::GetTimeFromString($str));
				return $return;
			}
			
			$return = &new CDateTime(strtotime($str));
			return $return; 
		}
		
		/**
		 * @return string
		 */
		function GetAsStr()
		{
			return date('D, j M Y H:i:s O (T)', $this->TimeStamp);
		}
		
		/**
		 * $date should have YYYY-MM-DD HH:II:SS format 
		 * @param string $datetime
		 */
		function SetFromANSI($datetime)
		{
			$dt = explode(' ', $datetime);
			$date = explode('-', $dt[0]);
			$time = explode(':', $dt[1]);
			$this->TimeStamp = mktime($time[0], $time[1], $time[2], $date[1], $date[2], $date[0]);
		}
		
		/**
		 * return current timestamp in ANSI format
		 * @return string
		 */
		function ToANSI()
		{
			return date('Y-m-d H:i:s', $this->TimeStamp);
		}
		
		/**
		 * @param short $timeOffsetInMinutes
		 * @return string
		 */
		function GetFormattedDate($timeOffsetInMinutes)
		{
			$localTimeStamp = $this->TimeStamp + $timeOffsetInMinutes * 60;
			switch ($this->GetDateFormatTypeByString())
			{
				case DATEFORMAT_DEFAULT:
					return gmdate('m/d/y H:i', $localTimeStamp); //todo: server date default format here
					
				case DATEFORMAT_DDMMYY:
					return gmdate('d/m/y H:i', $localTimeStamp);
					
				case DATEFORMAT_MMDDYY:
					return gmdate('m/d/y H:i', $localTimeStamp);
					
				case DATEFORMAT_DDMonth:
					return gmdate('d M H:i', $localTimeStamp);
					
				case DATEFORMAT_Advanced:
					$outStr = $this->FormatString;
					$outStr = preg_replace('/month/i', gmdate('M', $localTimeStamp), $outStr);
					$outStr = preg_replace('/yyyy/i', gmdate('Y', $localTimeStamp), $outStr);
					$outStr = preg_replace('/yy/i', gmdate('y', $localTimeStamp), $outStr);
					$outStr = str_replace('y', gmdate('z', $localTimeStamp)+1, $outStr);
					$outStr = preg_replace('/dd/i', gmdate('d', $localTimeStamp), $outStr);
					$outStr = preg_replace('/mm/i', gmdate('m', $localTimeStamp), $outStr);
					$outStr = str_replace('q', floor((gmdate('n', $localTimeStamp)-1)/4)+1, $outStr);
					$outStr = str_replace('ww', gmdate('W', $localTimeStamp), $outStr);
					$outStr = str_replace('w', gmdate('w', $localTimeStamp)+1, $outStr);
					$outStr .= gmdate(' H:i', $localTimeStamp);

					return $outStr;
			}
		}
		
		/**
		 * @return short
		 */
		function GetDateFormatTypeByString()
		{
			switch (strtolower($this->FormatString))
			{
				case 'default':
					return DATEFORMAT_DEFAULT;
				case 'dd/mm/yy':
					return DATEFORMAT_DDMMYY;
				case 'mm/dd/yy':
					return DATEFORMAT_MMDDYY;
				case 'dd month':
					return DATEFORMAT_DDMonth;
				default:
					return DATEFORMAT_Advanced;
			}
		}
		
		
		/**
		 * @static 
		 * @return string
		 */
		function GetMySqlDateFormat($fieldName)
		{
			return 'DATE_FORMAT('.$fieldName.', "%Y-%m-%d %T")';
		}
		
		/**
		 * @static
		 * @param string $fieldName
		 * @return string
		 */
		function GetMsSqlDateFormat($fieldName)
		{
			return 'CONVERT(VARCHAR, '.$fieldName.', 120)';
		}

		/**
		 * @static 
		 * @return string
		 */
		function GetMsAccessDateFormat($fieldName)
		{
			return 'Format('.$fieldName.', \'yyyy-mm-dd hh:nn:ss\')';
		}
		
	}