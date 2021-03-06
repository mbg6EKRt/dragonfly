<?php

	/**
	 * @package WebMailPro
	 * @subpackage Mime
	 */

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/../'));

	require_once(WM_ROOTPATH.'mime/inc_constants.php');
	require_once(WM_ROOTPATH.'mime/class_headercollection.php');
	require_once(WM_ROOTPATH.'mime/class_headerparametercollection.php');
	require_once(WM_ROOTPATH.'mime/class_mimepartcollection.php');
	require_once(WM_ROOTPATH.'common/class_convertutils.php');

	class MimePart
	{
		/**
		 * @var HeaderCollection
		 */
		var $Headers = null;

		/**
		 * @access private
		 * @var string
		 */
		var $_body = '';
		
		/**
		 * @access private
		 * @var MimePartCollection
		 */
		var $_subParts = null;
		
		/**
		 * @access private
		 * @var string
		 */
		var $_sourceCharset;
		
		/**
		 * @var string
		 */
		var $OriginalHeaders;
		
		/**
		 * @return string
		 */
		function GetBinaryBody()
		{
			$body = '';

			switch (strtolower($this->Headers->GetHeaderValueByName(MIMEConst_ContentTransferEncodingLower)))
			{
				case 'quoted-printable':
					$body = quoted_printable_decode($this->_body);
					break;
				case 'base64':
					$body = $this->_body;
					$pos1 = strpos($body, '*');
					$pos2 = @strpos($body, '*', $pos1+1);
					if ($pos2 !== false)
					{
						$body = @substr($body, $pos2+1);
					}
					$body = base64_decode($this->_body);
					break;
				case 'x-uue':
					$body = ConvertUtils::UuDecode($this->_body);
					break;
				default:
					$body = $this->_body;
			}
			return $body;
		}
		
		/**
		 * @return string
		 */
		function GetBody()
		{
			return ConvertUtils::ConvertEncoding($this->GetBinaryBody(), $this->_sourceCharset, $GLOBALS[MailOutputCharset]);
		}
		
		/**
		 * @return bool
		 */
		function IsMimePartAttachment()
		{
			if ($this->Headers != null)
			{
				$contentTypeHeader = &new HeaderParameterCollection($this->GetContentType());
				$contentDispositionHeader = &new HeaderParameterCollection($this->GetDisposition());
				$contentTypeHeaderValue = $this->GetContentType();
				$contentIDValue = $this->GetContentID();
				$contentDispositionHeaderValue = $this->GetDisposition();
				
				if ($contentTypeHeader != null)
				{
					if (strpos($contentTypeHeaderValue, 'ms-tnef') !== false)
					{
						return true;
					}
					
					$temp = $contentTypeHeader->GetByName(MIMEConst_NameLower);
					if ($temp != null && strlen($temp->Value) != 0)
					{
						return true;
					}
				}
				
				if ($contentDispositionHeader != null)
				{
					$temp = $contentDispositionHeader->GetByName(MIMEConst_FilenameLower);
					if ($temp != null && strlen($temp->Value) != 0)
					{
						return true;
					}
				}
				
				if ($contentTypeHeaderValue != null)
				{
					if (strpos(strtolower($contentTypeHeaderValue), MIMEConst_MessageLower) !== false)
					{
						return true;
					}	
				}
			
				if ($contentDispositionHeaderValue != null)
				{
					if (strpos(strtolower($contentDispositionHeaderValue), MIMEConst_AttachmentLower) !== false)
					{
						return true;
					}	
				}
				
				if (strpos(strtolower($contentTypeHeaderValue), 'image') !== false)
				{
					return true;
				}
				
				if (strlen($contentIDValue) > 3)
				{
					return true;
				}	

/*				if ($contentDispositionHeaderValue != null)
				{
					if (strpos(strtolower($contentDispositionHeaderValue), MIMEConst_InlineLower) !== false)
					{
						return true;
					}	
				}*/
			}
			return false;
		}
		
		/**
		 * @return bool
		 */
		function IsMimePartTextBody()
		{
			// TODO: DELETE LOG
			$log =& CLog::CreateInstance();
			if ($this->Headers == null || $this->Headers->Count() == 0)
			{
				$log->WriteLine('IsMimePartTextBody::return true;0 '.__FILE__.' ('.__LINE__.')');
				return true;
			}
			$log->WriteLine(ConvertUtils::PrintVarDump($this->Headers));
			
			$contType = strtolower($this->GetContentType());
			$contDist = $this->GetDisposition();
			
			if (!$contType)
			{
				$log->WriteLine('IsMimePartTextBody::return false;1 '.__FILE__.' ('.__LINE__.')');
				return false;
			}

			$contentTypeHeader =  new HeaderParameterCollection($contType);
			$contentDispositionHeader = ($contDist) ? new HeaderParameterCollection($contDist) : null;
		
			if ($contentDispositionHeader)
			{
				$attach = $contentDispositionHeader->GetByName(MIMEConst_AttachmentLower); 
				$filename = $contentDispositionHeader->GetByName(MIMEConst_FilenameLower); 
			} 
			else 
			{
				$attach = $filename = null;
			}

			$name = ($contentTypeHeader) ? $contentTypeHeader->GetByName(MIMEConst_NameLower) : null; 
			
			if ($attach != null || $filename != null || $name != null)
			{
				$log->WriteLine('IsMimePartTextBody::return false;2 '.__FILE__.' ('.__LINE__.')');
				return false;
			}
			
			$filenameVal = ($filename) ? $filename->Value : '';
			$nameVal = ($name) ? $name->Value : '';
			
			if (strlen($filenameVal) != 0 || strlen($nameVal) != 0)
			{
				$log->WriteLine('IsMimePartTextBody::return false;3 '.__FILE__.' ('.__LINE__.')');
				return false;
			}
			if (strpos($contType, MIMETypeConst_TextHtml) !== false || strpos($contType, MIMETypeConst_TextPlain) !== false)
			{
				$log->WriteLine('IsMimePartTextBody::return true;4 '.__FILE__.' ('.__LINE__.')');
				return true;
			}	
			$log->WriteLine('IsMimePartTextBody::return false;5 '.__FILE__.' ('.__LINE__.')');
			return false;
		}
		
		/**
		 * @return MimePartCollection
		 */
		function GetSubParts()
		{
			return $this->_subParts;
		}
		
		/**
		 * @return string
		 */
		function GetContentID()
		{
			return trim($this->Headers->GetHeaderValueByName(MIMEConst_ContentIDLower), '<>');
		}
		
		/**
		 * @return string
		 */
		function GetContentLocation()
		{
			return $this->Headers->GetHeaderValueByName(MIMEConst_ContentLocationLower);
		}
		
		/**
		 * @return string
		 */
		function GetContentType()
		{
			return $this->Headers->GetHeaderDecodedValueByName(MIMEConst_ContentTypeLower);
		}
		
		/**
		 * @return string
		 */
		function GetDescription()
		{
			return $this->Headers->GetHeaderValueByName(MIMEConst_ContentDescriptionLower);
		}
		
		/**
		 * @return string
		 */
		function GetDisposition()
		{
			return $this->Headers->GetHeaderDecodedValueByName(MIMEConst_ContentDispositionLower);
		}
		
		/**
		 * @return string
		 */
		function GetContentTransferEncoding()
		{
			$header = &$this->Headers->GetHeaderByName(MIMEConst_ContentTransferEncodingLower);
			return $header->Value;
		}
		
		/**
		 * @return string
		 */
		function GetContentTypeCharset()
		{
			$content = $this->GetContentType();
			$charset = new HeaderParameterCollection($content);
			$charset = $charset->GetByName(MIMEConst_CharsetLower);
			return ($charset) ? $charset->Value : '';
		}
		
		/**
		 * @return string
		 */
		function GetFilename()
		{
			$contentDispositionHeader = $this->Headers->GetHeaderDecodedValueByName(MIMEConst_ContentDispositionLower);
				
			if ($contentDispositionHeader)
			{
				$headerParameters = &new HeaderParameterCollection($contentDispositionHeader);
				$param = $headerParameters->GetByName(MIMEConst_FilenameLower);
				if ($param)
				{
					return $param->Value;
				}
			}
			return '';
		}
		
		/**
		 * @return string
		 */
		function GetContentTypeName()
		{
			$contentTypeHeader = $this->Headers->GetHeaderDecodedValueByName(MIMEConst_ContentTypeLower);
				
			if ($contentTypeHeader)
			{
				$headerParameters = &new HeaderParameterCollection($contentTypeHeader);
				$param = $headerParameters->GetByName(MIMEConst_NameLower);
				if ($param)
				{
					return $param->Value;
				}
			}
			return '';
		}
		
		/**
		 * @return string
		 */
		function GetSourceCharset()
		{
			return $this->_sourceCharset;
		}
		
		/**
		 * @param string $rawData optional
		 * @return MimePart
		 */
		function MimePart($rawData = null)
		{
			if ($rawData != null)
			{
				$this->Parse($rawData);
			}
			else
			{
				$this->Headers = &new HeaderCollection();
			}
		}
		
		function &MailExplode(&$rawData)
		{
			//$rawData = trim($rawData);
			if (strlen($rawData) > 0 && $rawData{0} = "\r")
			{
				$rawData = substr($rawData, 1);
			}
			
			if (strlen($rawData) > 0 && $rawData{0} = "\n")
			{
				$rawData = substr($rawData, 1);
			}
			
			$result = array();
			$headerEnding = $this->_indexOfHeadersSectionEnding($rawData);
			$result[0] = trim(substr($rawData, 0, $headerEnding));
			$body = trim(substr($rawData, $headerEnding, strlen($rawData)));
			if($body)
			{
				$result[1] = &$body;
			}
			return $result;
		}
		
		function _indexOfHeadersSectionEnding(&$rawData)
		{
			$len = strlen($rawData);
			$isHeader = false;
			$isLineEnd= false;
			
			for ($i = 0; $i < $len; $i++)
			{
				$char = $rawData{$i};
				if ($char == "\r")
				{
					if (isset($rawData{$i + 1}) && $rawData{$i + 1} == "\n") $i++;
					$isLineEnd = true;
				}
				elseif($char == "\n")
				{
					if (isset($rawData{$i + 1}) && $rawData{$i + 1} == "\r") $i++;					
					$isLineEnd = true;
				}
				else
				{
					$isHeader = true;
				}
				
				if ($isHeader && $isLineEnd)
				{
					$isHeader = false;
					$isLineEnd = false;
					continue;
				}
				
				if (!$isHeader && $isLineEnd)
				{
					return $i;
				}
			}
			return $len;
		}
		
		function Parse(&$rawData)
		{
			$parts = &$this->MailExplode($rawData);
			unset($rawData);
			
			$this->Headers = &new HeaderCollection($parts[0]);
			$this->OriginalHeaders = &$parts[0];
			
			// charset parsing
			$contentTypeHeader = &$this->Headers->GetHeaderByName(MIMEConst_ContentTypeLower);
				
			if ($contentTypeHeader != null)
			{
				$headerParameters = &new HeaderParameterCollection($contentTypeHeader->Value);
				$param = $headerParameters->GetByName(MIMEConst_CharsetLower);
				if ($param != null)
				{
					$this->_sourceCharset = $param->Value;
					if (!isset($GLOBALS[MailInputCharset]) || $GLOBALS[MailInputCharset] == '')
					{
						$GLOBALS[MailInputCharset] = $param->Value;
					}
				}
				else
				{
					$this->_sourceCharset = $GLOBALS[MailDefaultCharset];
				}
			}
			else 
			{
				$this->_sourceCharset = $GLOBALS[MailDefaultCharset];
			}

			if (isset($GLOBALS[MailInputCharset]) && $GLOBALS[MailInputCharset] != '')
			{
				$this->_sourceCharset = $GLOBALS[MailInputCharset];
			}
			
			if (count($parts) == 2)
			{
				$bound = $this->GetBoundary();
								
				if ($bound != '')
				{
					$mimePos = strpos($parts[1], '--'.$bound);
					
					$this->_body = substr($parts[1], 0, $mimePos);
					
					$parts[1] = explode('--'.$bound, substr($parts[1], $mimePos));
					
					if (count($parts[1]) > 2)
					{
						$this->_subParts = &new MimePartCollection($this);
						for ($i = 1, $c = count($parts[1]); $i < $c; $i++)
						{
							if ($parts[1][$i] == '--' || !$parts[1][$i]) continue;
							$this->_subParts->Add(new MimePart($parts[1][$i]));
						}
					}
				}
				else
				{
					$this->_body = &$parts[1];
				}
			}
		}
		
		/**
		 * @return string
		 */
		function GetBoundary()
		{
			$contentTypeHeader = &$this->Headers->GetHeaderByName(MIMEConst_ContentTypeLower);
				
			if ($contentTypeHeader != null)
			{
				$headerParameters = &new HeaderParameterCollection($contentTypeHeader->Value);
				$param = $headerParameters->GetByName(MIMEConst_BoundaryLower);
				if ($param != null)
				{
					return $param->Value;
				}
			}

			return '';
		}
		
		/**
		 * @return string
		 */
		function SetEncodedBodyFromText($body, $charset = '')
		{
			//if ($charset == '') $charset = $GLOBALS[MailDefaultCharset];
			if ($charset == '') $charset = $GLOBALS[MailInputCharset];

			$body = preg_replace('/(<meta\s.*)(charset\s?=)([^"\'>\s]*)/i', '$1$2'.$GLOBALS[MailOutputCharset], $body);	

			$body = ConvertUtils::ConvertEncoding($body, $charset, $GLOBALS[MailOutputCharset]);

			$ContentTransferEncoding = MIMEConst_QuotedPrintableLower;
			
			if ($ContentTransferEncoding == MIMEConst_QuotedPrintableLower)
			{
				$this->Headers->SetHeaderByName(MIMEConst_ContentTransferEncoding, MIMEConst_QuotedPrintable);
				$this->_body = ConvertUtils::quotedPrintableWithLinebreak($body);
			}
			elseif($ContentTransferEncoding == MIMEConst_Base64Lower)
			{
				$this->Headers->SetHeaderByName(MIMEConst_ContentTransferEncoding, MIMEConst_Base64);
				$this->_body = ConvertUtils::base64WithLinebreak($body);
			}
			else 
			{
				$this->_body = $body;
			}
		}
		
		/**
		 * @return string
		 */
		function ToString($withoutBcc = false)
		{
			$retval = $this->Headers->ToString($withoutBcc).CRLF;

			$retval .= $this->_body;
				
			if ($this->_subParts != null)
			{
				$retval .= $this->_subParts->ToString();
			}
			return $retval;
		}
	}
