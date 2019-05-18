<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));

	require_once(WM_ROOTPATH.'common/class_log.php');
	require_once(WM_ROOTPATH.'mime/inc_constants.php');
	
	define('ACCOUNT_HIERARCHY_DEPTH', 1);
	
	class FileSystem
	{
		/**
		 * @var string
		 */
		var $RootFolder;
		
		/**
		 * @var string
		 */
		var $AccountName;
		
		/**
		 * @param string $accountName
		 * @param string $rootFolder
		 * @return FileSystem
		 */
		function FileSystem($rootFolder, $accountName)
		{
			$this->AccountName = $accountName;
			$this->RootFolder = $rootFolder;
		}
		
		/**
		 * @param string $folderName
		 * @return bool
		 */
		function CreateFolder($folderName)
		{
			$path = rtrim($this->_createFolderFullPath($folderName), '/\\');
			if (is_dir($path))
			{
				return true;
			}
			
			return $this->_createRecursiveFolderPath($path);
		}
		
		/**
		 * @param string $folderName
		 * @return string
		 */
		function GetFolderFullPath($folderName)
		{
			return rtrim($this->_createFolderFullPath($folderName), '/\\');
		}
		

		/**
		 * @param string $string
		 * @return bool
		 */
		function CreateFolderFromString($string)
		{
			$path = rtrim($this->_createFolderFullPath($string), '/\\');
			if (is_dir($path))
			{
				return true;
			}
			
			return $this->_createRecursiveFolderPath($path);
		}

		/**
		 * @access private
		 * @param string $path
		 * @return bool
		 */
		function _createRecursiveFolderPath($path)
		{
			$result = true;
			$rootFolder = substr($path, 0, strrpos($path, '/'));
			if (!is_dir($rootFolder))
			{
				$result &= $this->_createRecursiveFolderPath($rootFolder);
			}

			$result &= @mkdir($path);
			return $result;
		}
		
		/**
		 * @access private
		 * @param string $folderName
		 * @return string
		 */
		function _createFolderFullPath($folderName)
		{
			$returnPath = $this->RootFolder.'/';

			for ($i = 0; $i <= ACCOUNT_HIERARCHY_DEPTH - 1; $i++)
			{
				$returnPath .= $this->AccountName{$i}.'/';
			}

			$returnPath .= $this->AccountName.'/'.$folderName;
			return $returnPath;
		}
		
		/**
		 * @static 
		 * @return Array
		 */
		function &GetSkinsList()
		{
			$dirList = array();
			$dir = WM_ROOTPATH.'skins';
			if (is_dir($dir))
			{
				if ($dh = opendir($dir))
				{
					while (($file = readdir($dh)) !== false)
					{
						if (is_dir(WM_ROOTPATH.'skins/'.$file) && $file{0} != '.')
						{
							$dirList[] = $file; 
						}
					}
					closedir($dh);
				}
			}
			return $dirList;
		}
		
		/**
		 * @static 
		 * @return Array
		 */
		function &GetLangList()
		{
			$langList = array();
			$dir = WM_ROOTPATH.'lang';
			if (is_dir($dir))
			{
				if ($dh = opendir($dir))
				{
					while (($file = readdir($dh)) !== false)
					{
						if (is_file(WM_ROOTPATH.'lang/'.$file) && strpos($file, '.php') != false)
						{
							$lang = strtolower(substr($file, 0, -4));
							if ($lang != 'index' && $lang != 'default')
							{
								$langList[] = substr($file, 0, -4);
							}
						}
					}
					closedir($dh);
				}
			}
			return $langList;
		}

		/**
		 * @param Attachment $attach
		 * @param string $tempname
		 * @return bool
		 */
		function SaveAttach(&$attach, $temppath, $tempname)
		{
			$path = $this->_createFolderFullPath($temppath);
			
			if ($this->CreateFolder($temppath))
			{
				return $attach->SaveToFile($path.'/'.$tempname);
			}
			
			return false;
		}
		
		/**
		 * @param string $folderName
		 * @param string $tempname
		 * @return string
		 */
		function LoadBinaryAttach($folderName, $tempname)
		{
			$data = '';
			$filename = $this->_createFolderFullPath($folderName).'/'.$tempname;

			$handle = @fopen($filename, 'rb');
			if ($handle)
			{
				while (!feof($handle))
				{
					$temp = @fread($handle, 8192);
					if (!$temp) break;
					$data .= $temp;
				}
				@fclose($handle);
				return $data;
			}

			return '';
		}
		
		/**
		 * @param string $folderName
		 */
		function ClearDir($folderName)
		{
			$path = $this->_createFolderFullPath($folderName);

			if (is_dir($path))
			{
				if ($dh = @opendir($path))
				{
					while (($file = @readdir($dh)) !== false)
					{
						if ($file != '.' && $file != '..')
						{ 
							@unlink($path.'/'.$file);
						} 
					}
					@closedir($dh);
				}
			}
		}
		
		/**
		 * @param string $folderName
		 */
		function DeleteDir($folderName)
		{
			$path = $this->_createFolderFullPath($folderName);
			$count = 0;
			
			if (is_dir($path))
			{
				if ($dh = @opendir($path))
				{
					while (($file = @readdir($dh)) !== false)
					{
						if ($file != '.' && $file != '..')
						{ 
							$count++;
						} 
					}
					@closedir($dh);
				}
				if ($count) $this->ClearDir($folderName);
				@rmdir($path);
			}
		}
		
		/**
		 * @param string $folderPath
		 * @return bool
		 */
		function IsFolderExist($folderPath)
		{
			$accountPath = rtrim($this->_createFolderFullPath(''), '/\\');
			
			return is_dir($accountPath.'/'.$folderPath);
		}
		
		/**
		 * @param string $string
		 * @return string
		 */
		function OneWay($string)
		{
			return str_replace('\\', '/', $string);
		}
	}
