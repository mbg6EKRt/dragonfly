<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>WebMail Lite - Administration</title>
	<link rel="stylesheet" href="<?php echo $skinPath;?>/styles.css" type="text/css" />
	<script>
<!--
var INIT_COMMON      = 1;
var INIT_FUNCTIONS   = 2;
function Ready(fileId) {}
//-->
	</script>
	<script type="text/javascript" src="class.common.js"></script>
	<script type="text/javascript" src="_functions.js"></script>
	<script type="text/javascript">
<!--
	Browser = new CBrowser();
	function writeDiv(text)
	{
		var messdiv = document.getElementById("messDiv");
		if (messdiv) 
		{
			messdiv.innerHTML = text;
		}
		else
		{
			alert(text);
		}
	}
	
	function SaveForm()
	{
		if (hasChanges)
		{
			return confirm('Do you want move to another page without Save? Select OK to continue.');
		}
		return true;
	}

	hasChanges = false;

	function change()
	{
		hasChanges = true;
	}
	
	function PopUpWindow(url)
	{
		var shown = window.open(url, 'Popup',
			'left=(screen.width-700)/2,top=(screen.height-400)/2,'+
			'toolbar=no,location=no,directories=no,status=yes,scrollbars=yes,resizable=yes,'+
			'copyhistory=no,width=700,height=400');
		shown.focus();
		return false;
	}
//-->
	</script>
</head>

<body>
<div align="center" class="wm_content">
<div class="wm_logo" id="logo" tabindex="-1"></div>

	<table class="wm_accountslist" id="accountslist">
	  <tr>
		<td>
			<span class="wm_accountslist_email">
				<a href="index.php" onclick="return SaveForm();">Return to mail login form</a>
			</span>
			<span class="wm_accountslist_logout">
				<a href="?mode=logout">Logout</a>
			</span>
			<span class="wm_accountslist_logout">
				&nbsp;<a href="help/default.htm" target="_blank">Help</a>
			</span>
		</td>
	  </tr>
	</table>