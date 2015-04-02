<?php

namespace lib;

/**
 * The Filesystem Class
 */
class files
{
/**
* The write permission to use when creating files and directories
*/
	const WRITE_PERMISSION = 0777;

/**
* An array containing a list of MIME types
*/
	var $mimetypes;
	
	
/**
* An array containing a list of media types
*/
	var $mediatypes;
	
/**
* An array containing a list of MIME types
*/
	var $table;
	
/**
* The files constructor
*/
	function __construct( )
	{
		// The table in the database where we store file information
		
		$this->table = 'file';

		// Set media types based on file extentions
		// This allows us to define display handlers for type of media

		$this->mediatypes = Array( 
			'JPG' => 'IMAGE', 'JPEG' => 'IMAGE', 'GIF' => 'IMAGE', 'PNG' => 'IMAGE', 'BMP' => 'IMAGE', 'TIF' => 'IMAGE', 'TIFF' => 'IMAGE',
			'MPG' => 'WINDOWS VIDEO', 'MPEG' => 'WINDOWS VIDEO', 'AVI' => 'WINDOWS VIDEO', 'WMV' => 'WINDOWS VIDEO',
			'MOV' => 'QUICKTIME VIDEO', 'QT' => 'QUICKTIME VIDEO',
			'MP3' => 'AUDIO', 'WMA' => 'AUDIO', 'WAV' => 'AUDIO', 'OGG' => 'AUDIO',
			'SWF' => 'FLASH', 'FLA' => 'FLASH',
			'HTM' => 'HTML', 'HTML' => 'HTML', 'PHP' => 'PHP3', 'PHP4' => 'HTML', 'INC' => 'HTML',
			'JS' => 'JAVASCRIPT',
			'EXE' => 'PROGRAM',
			'DOC' => 'WORD', 'DOCX' => 'WORD',
			'PDF' => 'PDF',
			'PPT' => 'POWERPOINT',
			'MDB' => 'ACCESS',
			'XLS' => 'EXCEL',
			'TXT' => 'TEXT',
			'RTF' => 'RICH TEXT',
			'ZIP' => 'ARCHIVE', 'GZ' => 'ARCHIVE', 'TGZ' => 'ARCHIVE', '7Z' => 'ARCHIVE', 'ACE' => 'ARCHIVE', 'RAR' => 'ARCHIVE'
			);
	}

/**
* Get information about a file specified by $id
*/
	function get( $id )
	{
		global $db, $paths;

		if ( !empty( $id ) )
		{
			// Get file details
			
			$file = $db->exec( "SELECT * FROM {$this->table} WHERE file_id={$id}" );
	
			if ( !empty( $file ) ) 
			{
				// Get file info from the db
				
				$file = $file[0];
	
				// Get the full path and url to the file
	
	            $file['file_fullpath'] = $paths->get( 'root', $file['file_path'].'/'.$file['file_id'].'/'.$file['file_file'] );
	            $file['file_fullurl'] = $paths->get( 'rooturl', $file['file_path'].'/'.$file['file_id'].'/'.$file['file_file'] );
	            
				// Get the size of the file
				
				if ( file_exists( $file['file_fullpath'] ) ) $file['file_size'] = $this->fsize( $file['file_fullpath'] );
				else $file['file_size'] = 0;
	
				// Get the media type
				
	            $file['file_mediatype'] = $this->mediatype( $file['file_file'] );
				
				// Check if the media type has an icon
				
	            if ( array_key_exists( $file['file_mediatype'], $this->icons ) ) $file['file_mediaicon'] = $this->icons[$file['file_mediatype']];
				else $file['file_mediaicon'] = '';
				
				// Return the file information
	
				return $file;
	        }
		}
		
		// If no file was found, return false
		
		return FALSE;
	}

/**
* Get the html to render a file in a browser (eg: an image handler creates an <img> html tag)
* @param integer $id The id the file to display
* @param string $handler Determine what to do with the file
* @param string $link A url to link the item to
* @param string $target The target of $link
* @param array $params Some parameters for the html tags to be created
*/	
	function display( $id, $handler = '', $link = '', $target = '', $params = Array() )
	{
		if (!empty($id)) {

			global $db, $paths;

			// Get details, determine handler, and display $Link

			$file = $this->get( $id );

			if ( empty( $handler ) ) { $handler = $file['file_mediatype']; }//if
			if (!empty($link)) { echo "<a href='".$link."' target='".$target."' style='border: 0px;'>"; }//if
			
			if (is_array($params)) {
				$PArr = $params;
				$params = '';
				foreach ($PArr as $PID => $Param) {
					if (is_numeric($PID)) $params = $params.' '.$Param;
					else $params = $params.' '.$PID.'="'.$Param.'"';
				}//foreach
			}//if
			else $params = ' '.$params;
			$params = trim( $params );

			// Return html

			switch ( $handler ) {

			  	// Link to file

				case 'HREF':
					?><a href='<?php echo $paths->get('rooturl', 'download/'.$id); ?>' title='<?php echo $file['file_description']; ?>'<?php echo $params; ?>><?php echo $file['file_name']; ?></a><?php
				break;

				// Images

				case 'IMAGE':
					?><img src='<?php echo $paths->get('rooturl', 'download/'.$id.'/inline'); ?>'<?php echo $params; ?>><?php
				break;

				// Flash

			  	case 'FLASH':
					?><embed src='<?php echo $paths->get('rooturl', 'download/'.$id.'/inline'); ?>'<?php echo $params; ?>></embed><?php
			  	break;

			  	// Html/PHP

			  	case 'HTML': include $paths->get('rootpath', $file['file_path'].'/'.$id.'/'.$file['file_file']); break;

			  	// Javascript

			  	case 'JAVASCRIPT':
			  		echo '<script language="javascript" type="text/javascript" src="'.$paths->get('rooturl', 'download/'.$id.'/inline').'"></script>';
			  	break;

			}

			// Close $Link tag

			if ( !empty( $Link ) ) { echo "</a>"; }

		}
		else return FALSE;
	}


/**
* Stream a file to the browser by providing a path to the file
* @param string $Filename The full path to the file
* @param string $Disposition Set whether the browser should download or display the file
*/
	function stream( $Filename, $Disposition = 'attachment' )
	{
		if ( file_exists( $Filename ) ) 
		{
			// Get details

			$MIMEType = $this->mimetype( $Filename );

			$Tmp = explode( "\\", $Filename );
			$File = count( $Tmp ) - 1;

			if ( $File == 0 ) 
			{
				$Tmp = explode( "/", $Filename );
				$File = count( $Tmp ) - 1;
			}

			$SaveAs = $Tmp[$File];
			$ContentLength = filesize( $Filename );

			// Set headers

			Header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
			Header( "Content-Disposition: ".$Disposition."; filename=".$SaveAs.";" );
			Header( "Content-Type: ".$MIMEType );
			Header( "Content-Length: ".$ContentLength );

			// Send file to browser

			$fh = fopen( ( $Filename ), 'r' );
			while( !feof( $fh ) ) { echo fread( $fh, 1024 ); }//while
			fclose( $fh );
		}
	}

/**
* Save uploaded files for a field and return an array of file information
* @param string $field The name of an html file input element - also supports multiple (eg: name="input-name[]")
* @param string $path The relative path to store the files
* @return array Return an array containing the files uploaded for an html file input element
*/
	function save( $field, $path )
	{
		global $paths, $db;
		
		// Get upload info

		$fileArr = $this->getuploadinfo( $field );
		
		if ( $fileArr == FALSE ) return FALSE;
		
		// Save files
		
		foreach ( $fileArr as $key => $file )
		{
			if ( file_exists( $path ) )
			{
				$destination = $paths->get( 'rootpath', $path.'/'.$file['name'] );
				move_uploaded_file( $file['tmp_name'], $destination );
				
				$saveData = Array(
					'name' => $file['name'],
					'description' => '',
					'file' => $file['name'],
					'path' => $path,
					'type' => $file['type'],
					'size' => $file['size'],
					'created' => time()
					);
				
				$fileArr[$key] = $db->save( $this->table, $saveData );
			}
		}
		
		return $fileArr;
	}

/**
* Get information about an html file input element
* @param string $field The name of html file field
*/
	function getuploadinfo( $field )
	{
		$fileArr = Array();
		
		if ( is_array( $_FILES ) && isset( $_FILES[$field] ) )
		{
			$html_field = $_FILES[$field];
			
			// Multiple files
			
			if ( is_array( $html_field ) && isset( $html_field['name'] ) && is_array( $html_field['name'] ) && isset( $html_field['name'][0] ) && !empty( $html_field['name'][0] ) )
			{
				foreach ( $html_field as $info => $data )
				{
					foreach ( $data as $key => $val )
					{
						if ( !empty( $val ) ) $fileArr[$key][$info] = $val;
					}
				}
			}
			
			// A single file
			
			else if ( isset( $_FILES[$field]['name'] ) && !empty( $_FILES[$field]['name'] ) ) $fileArr[0] = $_FILES[$field];
			
			// No files uploaded for the specified html input element
			
			else return FALSE;
			
			// If files were uploaded, return file info
			
			return $fileArr;
		}
		
		// If the file input element was not found, return false
		
		return FALSE;
	}

/**
* Format a file name to prevent invalid characters in the file name
*/
	function formatname($FileName)
	{
		// Make sure FileName is not empty

		if ( !empty( $FileName ) ) {

			$ReplaceChars = Array( ' ','`','~','!','@','#','$','%','^','&','*','+','=','(','{','[',':',';','"',"'",'<','>',',','/','\\','|','?', '-', '___', '__' );
			$StripChars = Array( ')','}',']' );

			// Check if the file is a path, or
			// a file returned from $this->GetUploadedFile()

			if ( is_string( $FileName ) ) {
				$Path = explode( '/', $FileName );
				if ( !empty( $Path ) ) {
					$FNi = count( $Path ) - 1;
					$FileName = $Path[$FNi];
				}//if
			}//if
			else if ( is_array( $FileName ) ) $FileName = $FileName['name'];

			// Remove unwanted characters

			foreach ( $ReplaceChars as $Char ) { $FileName = str_replace($Char, '_', $FileName); }//foreach
			foreach ( $StripChars as $Char ) { $FileName = str_replace($Char, '', $FileName); }//foreach

		}//if

		// Return file name

		return $FileName;
	}

/**
* Get the mime type of a file
*/
	function mimetype( $FileName )
	{
		if ( empty( $this->mimetypes ) ) $this->loadmimetypes();

		// Get filetype of current file

		$FileParts = explode( ".", $FileName );
		$NumParts = ( count( $FileParts ) - 1 );
		$Extention = '.'.strtolower( $FileParts[$NumParts] );

		if (!empty($FileName) and array_key_exists( $Extention, $this->mimetypes ) )
		{
			$MIMEType = $this->mimetypes[$Extention];
		}

		// Return MIME type

		return $MIMEType;
	}

/**
* Load the list of MIME types
*/
	function loadmimetypes( )
	{
		global $paths;

		$Types = Array();
		$TypesFile = $paths->get( 'files', 'mime.types' );
		$TypesContent = $this->read( $TypesFile );

		$Lines = explode( "\n", $TypesContent );

		foreach ( $Lines as $Line ) {

			$Type = Explode( "	", $Line );
			$Type[0] = trim( $Type[0] );
			$Type[1] = trim( $Type[1] );
			$Types[$Type[0]] = $Type[1];

		}//foreach

		$this->mimetypes = $Types;
	}

/**
* Get the media type (aka the handler) for a file type
*/
	function mediatype( $filename )
	{
		// Get filetype of current file

		$fileparts = explode( ".", $filename );
		$numparts = count( $fileparts ) - 1;
		$extention = strtoupper( $fileparts[$numparts] );

		// Return the media type

		if ( array_key_exists( $extention, $this->mediatypes ) ) return $this->mediatypes[$extention];
		else return 'HREF';
	}

/**
* Return 'human-readable' file size
*/
    function fsize( $file ) 
	{
        $a = array( "B", "KB", "MB", "GB", "TB", "PB" );
        $pos = 0;
        $size = filesize( $file );

        while ( $size >= 1024 )
		{
			$size /= 1024;
            $pos++;
        }//while

        return round($size,0)." ".$a[$pos];
    }

/**
* Read the contents of a path or url (if allow_url_fopen is on)
* @param string The full path to the file or url
* @return string Return the file or url contents
*/
	function read( $file )
	{
		if ( is_dir( $file ) ) return scandir( $file );
		else return file_get_contents( $file );
	}
	
/**
 * Delete a file or directory - this function is recursive and cannot be undone
 * @param integer $siteid The ID of the site to save relationships for
 * @param array $post $_POST data
 * @return string Return the base directory of the site
 */
	function delete( $base = '' )
	{
		// If the base node is a directory
		
		if ( is_dir( $base ) )
		{
			$nodes = scandir( $base );
		
			foreach ( $nodes as $node )
			{
				if ( $node != '.' && $node != '..' )
				{
					if ( is_dir( $base.'/'.$node ) )
					{
						$this->delete( $base.'/'.$node );
					}
					
					else unlink( $base.'/'.$node );
				}
			}
			
			rmdir($base);
		}
		
		// If the base node is a file
		
		else unlink( $base );
	}

//------------------------------------------------------------ [ Backup() ] ---
// Create a backup of all files on the system
//-----------------------------------------------------------------------------
	function backup()
	{
		global $Paths;

		// Max execution time 5 mins (600 secs)

		set_time_limit(600);

		// Get the directory we are backing up and set the archive file name

		$BackupFolder = $Paths->GetPath('Root'); // = dirname($_SERVER["SCRIPT_FILENAME"]);
		$Filename = $BackupFolder.'/backup/backup-'.date('Ymd-Hi', mktime()).'.tar.gz';
		$Output = Array();
		$Result = NULL;

		// Change to the root directory.
		// Should be unnecessary, as this function [Backup()] will be
		// called by index.php in the public_html directory.
		// The path returned from $Paths->GetPath('Root') = /usr/www/users/g4r34rhe

		chdir($BackupFolder);

		echo '<br />Current working directory:';
		echo getcwd().'<br />';

		// Create a gzipped tar archive. Exclude the backup directory.

		$Cmd = escapeshellcmd("tar --create --gzip --exclude='backup' --file='".$Filename."' .");
		exec($Cmd, $Output, $Result);

		// Dump the output and return status of the command.
		// Unless I add the --verbose option, no output is returned and
		// a status of zero (0) is returned.
		// As I understand it, if an error was outputted by the tar command,
		// we should see it here?

		var_dump($Output, $Result);
		echo '<br /><br />';

		// Return the filename

		return $Filename;

	}//Backup

}

?>