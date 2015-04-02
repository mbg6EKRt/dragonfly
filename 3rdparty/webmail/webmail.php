<?php

if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));
require_once(WM_ROOTPATH.'class_account.php');

session_name('PHPWEBMAILSESSID');
@session_start();
if (!isset($_SESSION[S_ACCT_ARRAY]))
{
	@session_start();
}

if (!isset($_SESSION[S_ACCT_ARRAY]))
{
	header('Location: index.php?error=1');
	exit;
}

$start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
$to = isset($_REQUEST['to']) ? $_REQUEST['to'] : '';

require_once(WM_ROOTPATH.'class_settings.php');

require_once(WM_ROOTPATH.'class_filesystem.php');

$settings =& Settings::CreateInstance();
if (!$settings->isLoad)
{
	header('location: index.php?error=3');
	exit();
}
elseif (!$settings->IncludeLang())
{
	header('location: index.php?error=6');
	exit();
}

$account =& Account::CreateInstance();

if (!$account)
{
	header('location: index.php?error=2');
	exit();
}

define('defaultTitle', $settings->WindowTitle);
$skins = &FileSystem::GetSkinsList();

$hasDefSettingsSkin = false;
foreach ($skins as $skinName)
{
	if ($skinName == $settings->DefaultSkin)
	{
		$hasDefSettingsSkin = true;
	}
	
	if ($skinName == $account->DefaultSkin)
	{
		define('defaultSkin', $account->DefaultSkin);
		break;
	}
}

if (!defined('defaultSkin'))
{
	if ($hasDefSettingsSkin)
	{
		define('defaultSkin', $settings->DefaultSkin);
	}
	else
	{
		define('defaultSkin', $skins[0]);
	}
}

$expireTime = 31536000;
header('Content-type: text/html; charset=utf-8');
header('Content-script-type: text/javascript');
header('Pragma: cache');
header('Cache-control: public'); 
header('Expires: '.gmdate( "D, d M Y H:i:s", time()+$expireTime ).' GMT');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html id="html">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta http-equiv="Pragma" content="cache" />
	<meta http-equiv="Cache-Control" content="public" />
	<meta http-equiv="Expires" content="<?php echo gmdate( "D, d M Y H:i:s", time()+$expireTime ).' GMT'; ?>" />
	<title><?php echo defaultTitle; ?></title>
	<link rel="stylesheet" href="skins/<?php echo defaultSkin?>/styles.css" type="text/css" id="skin" />
	<script type="text/javascript">
		function ResizeBodyHandler() {}
	</script>
</head>

<body onresize="ResizeBodyHandler();" onload="Ready(INIT_BODY);">
	<table class="wm_information" id="info_cont">
		<tr>
			<td class="wm_info_message" id="info_message">
				<?php echo JS_LANG_InfoWebMailLoading;?>
			</td>
		</tr>
	</table>
	<div align="center" id="content" class="wm_hide">
		<div class="wm_logo" id="logo" tabindex="-1"></div>
	</div>
	<div class="wm_hide" id="copyright">
		<?php require('inc.footer.php'); ?>
	</div>
</body>
<script type="text/javascript">
	var LoginUrl = 'index.php';
	var WebMailUrl = 'webmail.php';
	var BaseWebMailUrl = 'basewebmail.php';
	var ActionUrl = 'processing.php';
	var EmptyHtmlUrl = 'empty.html';
	var UploadUrl = 'upload.php';
	var ImportUrl = 'import.php';
	var HistoryStorageUrl = 'history-storage.php';
	var LanguageUrl = '_language.js';
	var Title = '<?php echo ConvertUtils::ClearJavaScriptString(defaultTitle, '\''); ?>';
	var SkinName = '<?php echo ConvertUtils::ClearJavaScriptString(defaultSkin, '\''); ?>';
	var Start = <?php echo $start?>;
	var ToAddr = '<?php echo ConvertUtils::ClearJavaScriptString($to, '\''); ?>';
	var Browser;
	var WebMail, HistoryStorage;

	var INIT_DEFINES            = 0;
	var INIT_COMMON             = 1;
	var INIT_AJAX_COMMON        = 2;
	var INIT_FUNCTIONS          = 3;
	var INIT_FUNCTIONS_HANDLERS = 4;
	var INIT_WEBMAIL            = 5;
	var INIT_WEBMAIL_PARTS      = 6;
	var INIT_MAIL               = 7;
	var INIT_SCREENS_PARTS      = 8;
	var INIT_MESSAGES_LIST      = 9;
	var INIT_VIEW_MESSAGE       = 10;
	var INIT_MESSAGES_LIST_VIEW = 11;
	var INIT_NEW_MESSAGE        = 12;
	var INIT_BODY               = 13;

	var ReadyInit = Array();
	ReadyInit[INIT_DEFINES]            = false;
	ReadyInit[INIT_COMMON]             = false;
	ReadyInit[INIT_AJAX_COMMON]        = false;
	ReadyInit[INIT_FUNCTIONS]          = false;
	ReadyInit[INIT_FUNCTIONS_HANDLERS] = false;
	ReadyInit[INIT_WEBMAIL]            = false;
	ReadyInit[INIT_WEBMAIL_PARTS]      = false;
	ReadyInit[INIT_MAIL]               = false;
	ReadyInit[INIT_SCREENS_PARTS]      = false;
	ReadyInit[INIT_MESSAGES_LIST]      = false;
	ReadyInit[INIT_VIEW_MESSAGE]       = false;
	ReadyInit[INIT_MESSAGES_LIST_VIEW] = false;
	ReadyInit[INIT_NEW_MESSAGE]        = false;
	ReadyInit[INIT_BODY]        = false;

	function Ready(fileId)
	{
		ReadyInit[fileId] = true;
		var isReady = true;
		for (var i=0; i<=INIT_BODY; i++)
		{
			if (ReadyInit[i] == false)
			{
				isReady = false;
				break;
			}
		}
		if (isReady) Init();
	}
	
	function Init() {
		Browser = new CBrowser();
		var DataTypes = [
			new CDataType(TYPE_SETTINGS_LIST, false, 0, false, { }, 'settings_list' ),
			new CDataType(TYPE_MESSAGES_LIST, true, 5, false, { Page: 'page' }, 'messages' ),
			new CDataType(TYPE_MESSAGES_OPERATION, false, 0, false, { }, '' ),
			new CDataType(TYPE_MESSAGE, true, 10, true, { Charset: 'charset' }, 'message' ),
			new CDataType(TYPE_ACCOUNT_PROPERTIES, false, 0, false, { }, 'account' ),
		];
		WebMail = new CWebMail(Title, SkinName);
		WebMail.DataSource = new CDataSource( DataTypes, ActionUrl, ErrorHandler, InfoHandler, LoadHandler, TakeDataHandler, ShowLoadingInfoHandler );
		HistoryStorage = new CHistoryStorage(
				{
					Document: document,
					HistoryStorageObjectName: "HistoryStorage",
					PathToPageInIframe: HistoryStorageUrl,
					MaxLimitSteps: 50,
					Browser: Browser
				}
			);
		if (Start)
		{
			WebMail.SetStartScreen(Start);
		}
		WebMail.DataSource.Get(TYPE_SETTINGS_LIST, { }, [], '');
	}
</script>
<script type="text/javascript" src="_defines.js"></script>
<script type="text/javascript">
	<?php include('_language.js.php'); ?>
</script>
<script type="text/javascript" src="class.common.js"></script>
<script type="text/javascript" src="class.ajax-common.js"></script>
<script type="text/javascript" src="_functions.js"></script>
<script type="text/javascript" src="_functions_handlers.js"></script>
<script type="text/javascript" src="class.webmail.js"></script>
<script type="text/javascript" src="class.webmail-parts.js"></script>
<script type="text/javascript" src="class.mail.js"></script>
<script type="text/javascript" src="class.screens-parts.js"></script>
<script type="text/javascript" src="screen.messages-list.js"></script>
<script type="text/javascript" src="screen.view-message.js"></script>
<script type="text/javascript" src="screen.messages-list-view.js"></script>
<script type="text/javascript" src="screen.new-message.js"></script>
</html>