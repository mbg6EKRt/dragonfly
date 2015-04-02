<?php

/*
Modified code:
*/

//----------------------------------------------------------- [ GetRoot() ] ---
// Get the root path or url of this site
// $What can be 'path' or 'url'
//-----------------------------------------------------------------------------
function GetRoot($What = 'path')
{
	$What = strtoupper($What);

	switch ($What) {

		// Get root path

		case 'PATH': return dirname($_SERVER["SCRIPT_FILENAME"]); break;

		case 'URL':
			$Server = $_SERVER["SERVER_NAME"];
			$Folder = dirname($_SERVER["SCRIPT_NAME"]);
			$Url = rtrim('http://'.$Server.$Folder, '/');
			return $Url;
		break;

	}//switch

}//GetRoot

$dataPath = GetRoot();

if (!ereg('3rdparty', $dataPath)) { $dataPath = $dataPath.'/3rdparty/Webmail/data'; }//if
else { $dataPath = $dataPath.'/data'; }//else

/*
Original code:
*/

//$dataPath = 'c:/wamp/www/ePropertyManager/3rdparty/Webmail/data';

?>