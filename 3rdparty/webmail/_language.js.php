<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));
	
	require_once(WM_ROOTPATH.'common/inc_constants.php');
	require_once(WM_ROOTPATH.'class_settings.php');
	require_once(WM_ROOTPATH.'common/class_log.php');

	$settings =& Settings::CreateInstance();
	if (!$settings->isLoad || !$settings->IncludeLang())
	{
		$log =& CLog::CreateInstance();
		$log->WriteLine('::: JS Lang file Error');
		exit();		
	}
	
	/**
	 * @param string $str
	 * @return string
	 */
	function quot($str)
	{
		return ConvertUtils::ClearJavaScriptString($str, '\'');
	}
	
?>var Lang = {
	TitleLogin: '<?php echo quot(JS_LANG_TitleLogin);?>',
	TitleMessagesListView: '<?php echo quot(JS_LANG_TitleMessagesListView);?>',
	TitleMessagesList: '<?php echo quot(JS_LANG_TitleMessagesList);?>',
	TitleViewMessage: '<?php echo quot(JS_LANG_TitleViewMessage);?>',
	TitleNewMessage: '<?php echo quot(JS_LANG_TitleNewMessage);?>',
	StandardLogin: '<?php echo quot(JS_LANG_StandardLogin);?>',
	AdvancedLogin: '<?php echo quot(JS_LANG_AdvancedLogin);?>',
	InfoWebMailLoading: '<?php echo quot(JS_LANG_InfoWebMailLoading);?>',
	InfoEmptyInbox: '<?php echo quot(JS_LANG_InfoEmptyInbox);?>',
	Loading: '<?php echo quot(JS_LANG_Loading);?>',
	InfoMessagesLoad: '<?php echo quot(JS_LANG_InfoMessagesLoad);?>',
	InfoSendMessage: '<?php echo quot(JS_LANG_InfoSendMessage);?>',
	ConfirmAreYouSure: '<?php echo quot(JS_LANG_ConfirmAreYouSure);?>',
	ConfirmEmptySubject: '<?php echo quot(JS_LANG_ConfirmEmptySubject);?>',
	WarningEmailBlank: '<?php echo quot(JS_LANG_WarningEmailBlank);?>',
	WarningLoginBlank: '<?php echo quot(JS_LANG_WarningLoginBlank);?>',
	WarningToBlank: '<?php echo quot(JS_LANG_WarningToBlank);?>',
	WarningServerPortBlank: '<?php echo quot(JS_LANG_WarningServerPortBlank);?>',
	WarningMarkListItem: '<?php echo quot(JS_LANG_WarningMarkListItem);?>',
	WarningEmailFieldBlank: '<?php echo quot(JS_LANG_WarningEmailFieldBlank);?>',
	WarningIncServerBlank: '<?php echo quot(JS_LANG_WarningIncServerBlank);?>',
	WarningIncPortBlank: '<?php echo quot(JS_LANG_WarningIncPortBlank);?>',
	WarningIncLoginBlank: '<?php echo quot(JS_LANG_WarningIncLoginBlank);?>',
	WarningIncPortNumber: '<?php echo quot(JS_LANG_WarningIncPortNumber);?>',
	DefaultIncPortNumber: '<?php echo quot(JS_LANG_DefaultIncPortNumber);?>',
	WarningIncPassBlank: '<?php echo quot(JS_LANG_WarningIncPassBlank);?>',
	WarningOutPortBlank: '<?php echo quot(JS_LANG_WarningOutPortBlank);?>',
	WarningOutPortNumber: '<?php echo quot(JS_LANG_WarningOutPortNumber);?>',
	DefaultOutPortNumber: '<?php echo quot(JS_LANG_DefaultOutPortNumber);?>',
	WarningCorrectEmail: '<?php echo quot(JS_LANG_WarningCorrectEmail);?>',
	ErrorConnectionFailed: '<?php echo quot(JS_LANG_ErrorConnectionFailed);?>',
	ErrorRequestFailed: '<?php echo quot(JS_LANG_ErrorRequestFailed);?>',
	ErrorAbsentXMLHttpRequest: '<?php echo quot(JS_LANG_ErrorAbsentXMLHttpRequest);?>',
	ErrorWithoutDesc: '<?php echo quot(JS_LANG_ErrorWithoutDesc);?>',
	ErrorParsing: '<?php echo quot(JS_LANG_ErrorParsing);?>',
	ResponseText: '<?php echo quot(JS_LANG_ResponseText);?>',
	ErrorEmptyXmlPacket: '<?php echo quot(JS_LANG_ErrorEmptyXmlPacket);?>',
	LoggingToServer: '<?php echo quot(JS_LANG_LoggingToServer);?>',
	GettingMsgsNum: '<?php echo quot(JS_LANG_GettingMsgsNum);?>',
	RetrievingMessage: '<?php echo quot(JS_LANG_RetrievingMessage);?>',
	DeletingMessage: '<?php echo quot(JS_LANG_DeletingMessage);?>',
	DeletingMessages: '<?php echo quot(JS_LANG_DeletingMessages);?>',
	Of: '<?php echo quot(JS_LANG_Of);?>',
	Connection: '<?php echo quot(JS_LANG_Connection);?>',
	Charset: '<?php echo quot(JS_LANG_Charset);?>',
	AutoSelect: '<?php echo quot(JS_LANG_AutoSelect);?>',
	Logout: '<?php echo quot(JS_LANG_Logout);?>',
	NewMessage: '<?php echo quot(JS_LANG_NewMessage);?>',
	Refresh: '<?php echo quot(JS_LANG_Refresh);?>',
	Reply: '<?php echo quot(JS_LANG_Reply);?>',
	ReplyAll: '<?php echo quot(JS_LANG_ReplyAll);?>',
	Delete: '<?php echo quot(JS_LANG_Delete);?>',
	Forward: '<?php echo quot(JS_LANG_Forward);?>',
	NewMessages: '<?php echo quot(JS_LANG_NewMessages);?>',
	Messages: '<?php echo quot(JS_LANG_Messages);?>',
	From: '<?php echo quot(JS_LANG_From);?>',
	To: '<?php echo quot(JS_LANG_To);?>',
	Date: '<?php echo quot(JS_LANG_Date);?>',
	Size: '<?php echo quot(JS_LANG_Size);?>',
	Subject: '<?php echo quot(JS_LANG_Subject);?>',
	FirstPage: '<?php echo quot(JS_LANG_FirstPage);?>',
	PreviousPage: '<?php echo quot(JS_LANG_PreviousPage);?>',
	NextPage: '<?php echo quot(JS_LANG_NextPage);?>',
	LastPage: '<?php echo quot(JS_LANG_LastPage);?>',
	SwitchToPlain: '<?php echo quot(JS_LANG_SwitchToPlain);?>',
	SwitchToHTML: '<?php echo quot(JS_LANG_SwitchToHTML);?>',
	ClickToDownload: '<?php echo quot(JS_LANG_ClickToDownload);?>',
	View: '<?php echo quot(JS_LANG_View);?>',
	ShowFullHeaders: '<?php echo quot(JS_LANG_ShowFullHeaders);?>',
	HideFullHeaders: '<?php echo quot(JS_LANG_HideFullHeaders);?>',
	MessagesInInbox: '<?php echo quot(JS_LANG_MessagesInInbox);?>',
	YouUsing: '<?php echo quot(JS_LANG_YouUsing);?>',
	OfYour: '<?php echo quot(JS_LANG_OfYour);?>',
	Mb: '<?php echo quot(JS_LANG_Mb);?>',
	Kb: '<?php echo quot(JS_LANG_Kb);?>',
	B: '<?php echo quot(JS_LANG_B);?>',
	SendMessage: '<?php echo quot(JS_LANG_SendMessage);?>',
	SaveMessage: '<?php echo quot(JS_LANG_SaveMessage);?>',
	Print: '<?php echo quot(JS_LANG_Print);?>',
	PreviousMsg: '<?php echo quot(JS_LANG_PreviousMsg);?>',
	NextMsg: '<?php echo quot(JS_LANG_NextMsg);?>',
	ShowBCC: '<?php echo quot(JS_LANG_ShowBCC);?>',
	HideBCC: '<?php echo quot(JS_LANG_HideBCC);?>',
	CC: '<?php echo quot(JS_LANG_CC);?>',
	BCC: '<?php echo quot(JS_LANG_BCC);?>',
	ReplyTo: '<?php echo quot(JS_LANG_ReplyTo);?>',
	AttachFile: '<?php echo quot(JS_LANG_AttachFile);?>',
	Attach: '<?php echo quot(JS_LANG_Attach);?>',
	Re: '<?php echo quot(JS_LANG_Re);?>',
	OriginalMessage: '<?php echo quot(JS_LANG_OriginalMessage);?>',
	Sent: '<?php echo quot(JS_LANG_Sent);?>',
	Fwd: '<?php echo quot(JS_LANG_Fwd);?>',
	Low: '<?php echo quot(JS_LANG_Low);?>',
	Normal: '<?php echo quot(JS_LANG_Normal);?>',
	High: '<?php echo quot(JS_LANG_High);?>',
	Importance: '<?php echo quot(JS_LANG_Importance);?>',
	Close: '<?php echo quot(JS_LANG_Close);?>',

	CharsetDefault: '<?php echo quot(JS_LANG_CharsetDefault);?>',
	CharsetArabicAlphabetISO: '<?php echo quot(JS_LANG_CharsetArabicAlphabetISO);?>',
	CharsetArabicAlphabet: '<?php echo quot(JS_LANG_CharsetArabicAlphabet);?>',
	CharsetBalticAlphabetISO: '<?php echo quot(JS_LANG_CharsetBalticAlphabetISO);?>',
	CharsetBalticAlphabet: '<?php echo quot(JS_LANG_CharsetBalticAlphabet);?>',
	CharsetCentralEuropeanAlphabetISO: '<?php echo quot(JS_LANG_CharsetCentralEuropeanAlphabetISO);?>',
	CharsetCentralEuropeanAlphabet: '<?php echo quot(JS_LANG_CharsetCentralEuropeanAlphabet);?>',
	CharsetChineseSimplifiedEUC: '<?php echo quot(JS_LANG_CharsetChineseSimplifiedEUC);?>',
	CharsetChineseSimplifiedGB: '<?php echo quot(JS_LANG_CharsetChineseSimplifiedGB);?>',
	CharsetChineseTraditional: '<?php echo quot(JS_LANG_CharsetChineseTraditional);?>',
	CharsetCyrillicAlphabetISO: '<?php echo quot(JS_LANG_CharsetCyrillicAlphabetISO);?>',
	CharsetCyrillicAlphabetKOI8R: '<?php echo quot(JS_LANG_CharsetCyrillicAlphabetKOI8R);?>',
	CharsetCyrillicAlphabet: '<?php echo quot(JS_LANG_CharsetCyrillicAlphabet);?>',
	CharsetGreekAlphabetISO: '<?php echo quot(JS_LANG_CharsetGreekAlphabetISO);?>',
	CharsetGreekAlphabet: '<?php echo quot(JS_LANG_CharsetGreekAlphabet);?>',
	CharsetHebrewAlphabetISO: '<?php echo quot(JS_LANG_CharsetHebrewAlphabetISO);?>',
	CharsetHebrewAlphabet: '<?php echo quot(JS_LANG_CharsetHebrewAlphabet);?>',
	CharsetJapanese: '<?php echo quot(JS_LANG_CharsetJapanese);?>',
	CharsetJapaneseShiftJIS: '<?php echo quot(JS_LANG_CharsetJapaneseShiftJIS);?>',
	CharsetKoreanEUC: '<?php echo quot(JS_LANG_CharsetKoreanEUC);?>',
	CharsetKoreanISO: '<?php echo quot(JS_LANG_CharsetKoreanISO);?>',
	CharsetLatin3AlphabetISO: '<?php echo quot(JS_LANG_CharsetLatin3AlphabetISO);?>',
	CharsetTurkishAlphabet: '<?php echo quot(JS_LANG_CharsetTurkishAlphabet);?>',
	CharsetUniversalAlphabetUTF7: '<?php echo quot(JS_LANG_CharsetUniversalAlphabetUTF7);?>',
	CharsetUniversalAlphabetUTF8: '<?php echo quot(JS_LANG_CharsetUniversalAlphabetUTF8);?>',
	CharsetVietnameseAlphabet: '<?php echo quot(JS_LANG_CharsetVietnameseAlphabet);?>',
	CharsetWesternAlphabetISO: '<?php echo quot(JS_LANG_CharsetWesternAlphabetISO);?>',
	CharsetWesternAlphabet: '<?php echo quot(JS_LANG_CharsetWesternAlphabet);?>',


	ReportMessageSent: '<?php echo quot(ReportMessageSent);?>',

	WarningPassBlank: '<?php echo quot(WarningPassBlank);?>',
	WarningCorrectIncServer: '<?php echo quot(WarningCorrectIncServer);?>',
	WarningOutServerBlank: '<?php echo quot(WarningOutServerBlank);?>',
	WarningCorrectSMTPServer: '<?php echo quot(WarningCorrectSMTPServer);?>',
	WarningFromBlank: '<?php echo quot(WarningFromBlank);?>',
	WarningLoginFieldBlank: '<?php echo quot(WarningLoginFieldBlank);?>'
};

var Charsets = [
		{ Name: Lang.CharsetDefault, Value: '0' },
		{ Name: Lang.CharsetArabicAlphabetISO, Value: '28596' },
		{ Name: Lang.CharsetArabicAlphabet, Value: '1256' },
		{ Name: Lang.CharsetBalticAlphabetISO, Value: '28594' },
		{ Name: Lang.CharsetBalticAlphabet, Value: '1257' },
		{ Name: Lang.CharsetCentralEuropeanAlphabetISO, Value: '28592' },
		{ Name: Lang.CharsetCentralEuropeanAlphabet, Value: '1250' },
		{ Name: Lang.CharsetChineseSimplifiedEUC, Value: '51936' },
		{ Name: Lang.CharsetChineseSimplifiedGB, Value: '936' },
		{ Name: Lang.CharsetChineseTraditional, Value: '950' },
		{ Name: Lang.CharsetCyrillicAlphabetISO, Value: '28595' },
		{ Name: Lang.CharsetCyrillicAlphabetKOI8R, Value: '20866' },
		{ Name: Lang.CharsetCyrillicAlphabet, Value: '1251' },
		{ Name: Lang.CharsetGreekAlphabetISO, Value: '28597' },
		{ Name: Lang.CharsetGreekAlphabet, Value: '1253' },
		{ Name: Lang.CharsetHebrewAlphabetISO, Value: '28598' },
		{ Name: Lang.CharsetHebrewAlphabet, Value: '1255' },
		{ Name: Lang.CharsetJapanese, Value: '50220' },
		{ Name: Lang.CharsetJapaneseShiftJIS, Value: '932' },
		{ Name: Lang.CharsetKoreanEUC, Value: '949' },
		{ Name: Lang.CharsetKoreanISO, Value: '50225' },
		{ Name: Lang.CharsetLatin3AlphabetISO, Value: '28593' },
		{ Name: Lang.CharsetTurkishAlphabet, Value: '1254' },
		{ Name: Lang.CharsetUniversalAlphabetUTF7, Value: '65000' },
		{ Name: Lang.CharsetUniversalAlphabetUTF8, Value: '65001' },
		{ Name: Lang.CharsetVietnameseAlphabet, Value: '1258'},
		{ Name: Lang.CharsetWesternAlphabetISO, Value: '28591' },
		{ Name: Lang.CharsetWesternAlphabet, Value: '1252' }
		];

var $Title = Array();
$Title[SCREEN_LOGIN]              = Lang.TitleLogin;
$Title[SCREEN_MESSAGES_LIST_VIEW] = Lang.TitleMessagesListView;
$Title[SCREEN_MESSAGES_LIST]      = Lang.TitleMessagesList;
$Title[SCREEN_VIEW_MESSAGE]       = Lang.TitleViewMessage;
$Title[SCREEN_NEW_MESSAGE]        = Lang.TitleNewMessage;
Lang.Title =  $Title;

var $Reply = Array();
$Reply[REPLY]     = Lang.Reply;
$Reply[REPLY_ALL] = Lang.ReplyAll;

var $Delete = Array();
$Delete[DELETE]   = Lang.Delete;