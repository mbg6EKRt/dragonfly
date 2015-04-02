<?php
	
	define('BASEFILE', 'basewebmail.php');
	define('ACTIONFILE', 'actions.php');
	define('LOGINFILE', 'index.php');
	
	define('INFORMATION', 'information');
	define('ISINFOERROR', 'infoErr');
	
	define('REPORT', 'action_report');

	define('ATTACH_DIR', ATTACHMENTDIR);
	define('SARRAY', 'sarray');
	
	define('SCREEN', 'screen');
	define('PAGE', 'page');

	define('SCREEN_MAILBOX', 'mailbox');
	define('SCREEN_NEWOREDIT', 'new');
	define('SCREEN_SETTINGS', 'settings');
	define('SCREEN_FULLSCREEN', 'full');
	
	define('DUMMYPASSWORD', '1111111111111111111111');
	
	$CHARSETS = array(
		array('-1', JS_LANG_CharsetDefault),
		array('iso-8859-6', JS_LANG_CharsetArabicAlphabetISO),
		array('windows-1256', JS_LANG_CharsetArabicAlphabet),
		array('iso-8859-4', JS_LANG_CharsetBalticAlphabetISO),
		array('windows-1257', JS_LANG_CharsetBalticAlphabet),
		array('iso-8859-2', JS_LANG_CharsetCentralEuropeanAlphabetISO),
		array('windows-1250', JS_LANG_CharsetCentralEuropeanAlphabet),
		array('euc-cn', JS_LANG_CharsetChineseSimplifiedEUC), //'51936'
		array('gb2312', JS_LANG_CharsetChineseSimplifiedGB), // '936'		
		array('big5', JS_LANG_CharsetChineseTraditional),
		array('iso-8859-5', JS_LANG_CharsetCyrillicAlphabetISO),
		array('koi8-r', JS_LANG_CharsetCyrillicAlphabetKOI8R),
		array('windows-1251', JS_LANG_CharsetCyrillicAlphabet),
		array('iso-8859-7', JS_LANG_CharsetGreekAlphabetISO),
		array('windows-1253', JS_LANG_CharsetGreekAlphabet),
		array('iso-8859-8', JS_LANG_CharsetHebrewAlphabetISO),
		array('windows-1255', JS_LANG_CharsetHebrewAlphabet),
		array('iso-2022-jp', JS_LANG_CharsetJapanese),
		array('shift-jis', JS_LANG_CharsetJapaneseShiftJIS),
		array('euc-kr', JS_LANG_CharsetKoreanEUC),
		array('iso-2022-kr', JS_LANG_CharsetKoreanISO),
		array('iso-8859-3', JS_LANG_CharsetLatin3AlphabetISO),
		array('windows-1254', JS_LANG_CharsetTurkishAlphabet),
		array('utf-7', JS_LANG_CharsetUniversalAlphabetUTF7),
		array('utf-8', JS_LANG_CharsetUniversalAlphabetUTF8),
		array('windows-1258', JS_LANG_CharsetVietnameseAlphabet),
		array('iso-8859-1', JS_LANG_CharsetWesternAlphabetISO),
		array('windows-1252', JS_LANG_CharsetWesternAlphabet)
	);
	
	// static
	class Post
	{
		function has($key) { return isset($_POST[$key]); }
		function val($key, $default = null) { return Post::has($key) ? $_POST[$key] : $default;	}
	}
	
	// static
	class Get
	{
		function has($key) { return isset($_GET[$key]); }
		function val($key, $default = null)	{ return Get::has($key) ? $_GET[$key] : $default; }
	}
	
	// static
	class Session
	{
		function has($key) { return isset($_SESSION[$key]); }
		function val($key, $default = null)	{ return Session::has($key) ? $_SESSION[$key] : $default; }
	}
	
	function GetFriendlySize($byteSize)
	{
		$size = ceil($byteSize / 1024);
		$mbSize = $size / 1024;
		$size = ($mbSize > 1) ? (ceil($mbSize*10)/10).''.JS_LANG_Mb: $size.''.JS_LANG_Kb;
		return $size;
	}
	
	/**
	 * @param string $text
	 * @param string $url
	 */
	function SetError($text, $url = null)
	{
		$_SESSION[INFORMATION] = $text;
		$_SESSION[ISINFOERROR] = true;	

		if ($url)
		{
			header('Location: '.$url);
		}
		else 
		{
			header('Location: '.BASEFILE);
		}
		exit();
	}

	/**
	 * @param string $text
	 */
	function SetReport($text)
	{
		$_SESSION[REPORT] = $text;
	}
	
	/**
	 * @param string $text
	 */
	function SetOnlineError($text = null)
	{
		if ($text === null)
		{
			$_SESSION[INFORMATION] = getGlobalError();	
		}
		else {
			$_SESSION[INFORMATION] = $text;
			if (isset($GLOBALS[ErrorDesc])) 
			{
				$_SESSION[INFORMATION] .= "\r\n".getGlobalError();
			}
		}
		$_SESSION[ISINFOERROR] = true;	
	}

	/**
	 * @param string $str
	 * @param string $qoute
	 * @return string
	 */
	function dequote($str)
	{
		return str_replace('"', '&quot;', $str);
	}
	
	function GetAttachImg($filename)
	{		
		$filename = strtolower($filename);
		$pos = strrpos($filename,'.');
		$ex = @substr($filename, $pos+1, strlen($filename)-$pos+1);
		switch ($ex)
		{
			case 'asp':
			case 'asa':
			case 'inc':
				return 'application_asp.gif';
				break;
			case 'css':
				return 'application_css.gif';
				break;
			case 'doc':
				return 'application_doc.gif';
				break;
			case 'html':
			case 'shtml':
			case 'phtml':
			case 'htm':
				return 'application_html.gif';
				break;
			case 'pdf':
				return 'application_pdf.gif';
				break;
			case 'xls':
				return 'application_xls.gif';
				break;
			case 'bat':
			case 'exe':
			case 'com':
				return 'executable.gif';
				break;
			case 'bmp':
				return 'image_bmp.gif';
				break;
			case 'gif':
				return 'image_gif.gif';
				break;
			case 'jpg':
			case 'jpeg':
				return 'image_jpeg.gif';
				break;
			case 'tiff':
			case 'tif':
				return 'image_tiff.gif';
				break;
			case 'txt':
				return 'text_plain.gif';
				break;
			default:
				return 'attach.gif';
				break;
		}
	}