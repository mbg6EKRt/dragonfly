<?php
//WebMail supports the following languages:
//Dansk, Nederlands, English, Français, Magyar, Português Brasil, Русский, Svenska, Türkçe
	define('PROC_WRONG_ACCT_PWD', 'Wrong account password');
	define('PROC_CANT_GET_SETTINGS', 'Can\'t get settings');
	define('PROC_CANT_GET_MSG_LIST', 'Can\'t get message list');
	define('PROC_MSG_HAS_DELETED', 'This message has already been deleted from the mail server');
	define('PROC_SESSION_ERROR', 'The previous session was terminated due to a timeout.');

	define('WebMailException', 'WebMail exception occured');
	define('InvalidUid', 'Invalid Message UID');
	define('CantCreateUser', 'Can\'t create user');
	define('SessionIsEmpty', 'Session is empty');
	define('FileIsTooBig', 'The file is too big');

	define('PROC_CANT_DEL_MSGS', 'Can\'t delete message(s)');
	define('PROC_CANT_SEND_MSG', 'Can\'t send message.');

	define('PROC_CANT_LEAVE_BLANK', 'You can\'t leave * fields blank');
	
	define('LANG_LoginInfo', 'Login Information');
	define('LANG_Email', 'Email');
	define('LANG_Login', 'Login');
	define('LANG_Password', 'Password');
	define('LANG_IncServer', 'Incoming Mail');
	define('LANG_IncPort', 'Port');
	define('LANG_OutServer', 'SMTP Server');
	define('LANG_OutPort', 'Port');
	define('LANG_UseSmtpAuth', 'Use SMTP authentication');
	define('LANG_Enter', 'Enter');

	define('JS_LANG_TitleLogin', 'Login');
	define('JS_LANG_TitleMessagesListView', 'Messages List');
	define('JS_LANG_TitleMessagesList', 'Messages List');
	define('JS_LANG_TitleViewMessage', 'View Message');
	define('JS_LANG_TitleNewMessage', 'New Message');

	define('JS_LANG_StandardLogin', 'Standard&nbsp;Login');
	define('JS_LANG_AdvancedLogin', 'Advanced&nbsp;Login');

	define('JS_LANG_InfoWebMailLoading', 'Please wait while WebMail is loading&hellip;');
	define('JS_LANG_Loading', 'Loading&hellip;');
	define('JS_LANG_InfoMessagesLoad', 'Please wait while WebMail is loading messages list');
	define('JS_LANG_InfoSendMessage', 'The message was sent');

	define('JS_LANG_ConfirmAreYouSure', 'Are you sure?');
	define('JS_LANG_ConfirmEmptySubject', 'The subject field is empty. Do you wish to continue?');

	define('JS_LANG_WarningEmailBlank', 'You cannot leave<br />Email: field blank');
	define('JS_LANG_WarningLoginBlank', 'You cannot leave<br />Login: field blank');
	define('JS_LANG_WarningToBlank', 'You cannot leave To: field blank');
	define('JS_LANG_WarningServerPortBlank', 'You cannot leave POP3 and<br />SMTP server/port fields blank');
	define('JS_LANG_WarningMarkListItem', 'Please mark at least one item in the list');

	define('JS_LANG_WarningEmailFieldBlank', 'You cannot leave Email field blank');
	define('JS_LANG_WarningIncServerBlank', 'You cannot leave POP3 Server field blank');
	define('JS_LANG_WarningIncPortBlank', 'You cannot leave POP3 Server Port field blank');
	define('JS_LANG_WarningIncLoginBlank', 'You cannot leave POP3 Login field blank');
	define('JS_LANG_WarningIncPortNumber', 'You should specify a positive number in POP3 port field.');
	define('JS_LANG_DefaultIncPortNumber', 'Default POP3 port number is 110.');
	define('JS_LANG_WarningIncPassBlank', 'You cannot leave POP3 Password field blank');
	define('JS_LANG_WarningOutPortBlank', 'You cannot leave SMTP Server Port field blank');
	define('JS_LANG_WarningOutPortNumber', 'You should specify a positive number in SMTP port field.');
	define('JS_LANG_WarningCorrectEmail', 'You should specify a correct e-mail.');
	define('JS_LANG_DefaultOutPortNumber', 'Default SMTP port number is 25.');

	define('JS_LANG_ErrorConnectionFailed', 'Connection is unsuccessful');
	define('JS_LANG_ErrorRequestFailed', 'The data transfer has not been completed');
	define('JS_LANG_ErrorAbsentXMLHttpRequest', 'The object XMLHttpRequest is absent');
	define('JS_LANG_ErrorWithoutDesc', 'The error without description occured');
	define('JS_LANG_ErrorParsing', 'Error while parsing XML.');
	define('JS_LANG_ResponseText', 'Response text:');
	define('JS_LANG_ErrorEmptyXmlPacket', 'Empty XML packet');

	define('JS_LANG_LoggingToServer', 'Logging on to server&hellip;');
	define('JS_LANG_GettingMsgsNum', 'Getting number of messages');
	define('JS_LANG_RetrievingMessage', 'Retrieving message');
	define('JS_LANG_DeletingMessage', 'Deleting message');
	define('JS_LANG_DeletingMessages', 'Deleting message(s)');
	define('JS_LANG_Of', 'of');
	define('JS_LANG_Connection', 'Connection');
	define('JS_LANG_Charset', 'Charset');
	define('JS_LANG_AutoSelect', 'Auto-Select');

	define('JS_LANG_Logout', 'Logout');

	define('JS_LANG_NewMessage', 'New Message');
	define('JS_LANG_Reply', 'Reply');
	define('JS_LANG_ReplyAll', 'Reply to All');
	define('JS_LANG_Delete', 'Delete');
	define('JS_LANG_Forward', 'Forward');

	define('JS_LANG_NewMessages', 'New Messages');
	define('JS_LANG_Messages', 'Message(s)');

	define('JS_LANG_From', 'From');
	define('JS_LANG_To', 'To');
	define('JS_LANG_Date', 'Date');
	define('JS_LANG_Size', 'Size');
	define('JS_LANG_Subject', 'Subject');

	define('JS_LANG_FirstPage', 'First Page');
	define('JS_LANG_PreviousPage', 'Previous Page');
	define('JS_LANG_NextPage', 'Next Page');
	define('JS_LANG_LastPage', 'Last Page');

	define('JS_LANG_SwitchToPlain', 'Switch to Plain Text View');
	define('JS_LANG_SwitchToHTML', 'Switch to HTML View');
	define('JS_LANG_ClickToDownload', 'Click to download');
	define('JS_LANG_View', 'View');
	define('JS_LANG_ShowFullHeaders', 'Show Full Headers');
	define('JS_LANG_HideFullHeaders', 'Hide Full Headers');

	define('JS_LANG_YouUsing', 'You are using');
	define('JS_LANG_OfYour', 'of your');
	define('JS_LANG_Mb', 'MB');
	define('JS_LANG_Kb', 'KB');
	define('JS_LANG_B', 'B');

	define('JS_LANG_SendMessage', 'Send');
	define('JS_LANG_SaveMessage', 'Save');
	define('JS_LANG_Print', 'Print');
	define('JS_LANG_PreviousMsg', 'Previous Message');
	define('JS_LANG_NextMsg', 'Next Message');
	define('JS_LANG_ShowBCC', 'Show BCC');
	define('JS_LANG_HideBCC', 'Hide BCC');
	define('JS_LANG_CC', 'CC');
	define('JS_LANG_BCC', 'BCC');
	define('JS_LANG_ReplyTo', 'Reply To');
	define('JS_LANG_AttachFile', 'Attach File');
	define('JS_LANG_Attach', 'Attach');
	define('JS_LANG_Re', 'Re');
	define('JS_LANG_OriginalMessage', 'Original Message');
	define('JS_LANG_Sent', 'Sent');
	define('JS_LANG_Fwd', 'Fwd');
	define('JS_LANG_Low', 'Low');
	define('JS_LANG_Normal', 'Normal');
	define('JS_LANG_High', 'High');
	define('JS_LANG_Importance', 'Importance');
	define('JS_LANG_Close', 'Close');
	
	define('JS_LANG_CharsetDefault', 'Default');
	define('JS_LANG_CharsetArabicAlphabetISO', 'Arabic Alphabet (ISO)');
	define('JS_LANG_CharsetArabicAlphabet', 'Arabic Alphabet (Windows)');
	define('JS_LANG_CharsetBalticAlphabetISO', 'Baltic Alphabet (ISO)');
	define('JS_LANG_CharsetBalticAlphabet', 'Baltic Alphabet (Windows)');
	define('JS_LANG_CharsetCentralEuropeanAlphabetISO', 'Central European Alphabet (ISO)');
	define('JS_LANG_CharsetCentralEuropeanAlphabet', 'Central European Alphabet (Windows)');
	define('JS_LANG_CharsetChineseSimplifiedEUC', 'Chinese Simplified (EUC)');
	define('JS_LANG_CharsetChineseSimplifiedGB', 'Chinese Simplified (GB2312)');
	define('JS_LANG_CharsetChineseTraditional', 'Chinese Traditional (Big5)');
	define('JS_LANG_CharsetCyrillicAlphabetISO', 'Cyrillic Alphabet (ISO)');
	define('JS_LANG_CharsetCyrillicAlphabetKOI8R', 'Cyrillic Alphabet (KOI8-R)');
	define('JS_LANG_CharsetCyrillicAlphabet', 'Cyrillic Alphabet (Windows)');
	define('JS_LANG_CharsetGreekAlphabetISO', 'Greek Alphabet (ISO)');
	define('JS_LANG_CharsetGreekAlphabet', 'Greek Alphabet (Windows)');
	define('JS_LANG_CharsetHebrewAlphabetISO', 'Hebrew Alphabet (ISO)');
	define('JS_LANG_CharsetHebrewAlphabet', 'Hebrew Alphabet (Windows)');
	define('JS_LANG_CharsetJapanese', 'Japanese');
	define('JS_LANG_CharsetJapaneseShiftJIS', 'Japanese (Shift-JIS)');
	define('JS_LANG_CharsetKoreanEUC', 'Korean (EUC)');
	define('JS_LANG_CharsetKoreanISO', 'Korean (ISO)');
	define('JS_LANG_CharsetLatin3AlphabetISO', 'Latin 3 Alphabet (ISO)');
	define('JS_LANG_CharsetTurkishAlphabet', 'Turkish Alphabet');
	define('JS_LANG_CharsetUniversalAlphabetUTF7', 'Universal Alphabet (UTF-7)');
	define('JS_LANG_CharsetUniversalAlphabetUTF8', 'Universal Alphabet (UTF-8)');
	define('JS_LANG_CharsetVietnameseAlphabet', 'Vietnamese Alphabet (Windows)');
	define('JS_LANG_CharsetWesternAlphabetISO', 'Western Alphabet (ISO)');
	define('JS_LANG_CharsetWesternAlphabet', 'Western Alphabet (Windows)');

// webmail 4.1 constants
	define('WarningLoginFieldBlank', 'You cannot leave Login field blank.');
	define('WarningCorrectLogin', 'You should specify a correct login.');
	define('WarningPassBlank', 'You cannot leave Password field blank.');
	define('WarningCorrectIncServer', 'You should specify a correct POP3 server address.');
	define('WarningCorrectSMTPServer', 'You should specify a correct SMTP server address.');
	define('WarningFromBlank', 'You cannot leave From: field blank.');

	define('ErrorSMTPConnect', 'Can\'t connect to SMTP server. Check SMTP server settings.');
	define('ErrorSMTPAuth', 'Wrong username and/or password. Authentication failed.');
	define('ReportMessageSent', 'Your message has been sent.');
	define('ReportMessageSaved', 'Your message has been saved.');
	define('ErrorPOP3Connect', 'Can\'t connect to POP3 server, check POP3 server settings.');
	define('ErrorPOP3IMAP4Auth', 'Wrong email/login and/or password. Authentication failed.');
	define('ErrorGetMailLimit', 'Sorry, your mailbox size limit is exceeded.');

	define('FileLargerAttachment', 'The file size exceeds Attachment Size limit.');
	define('FilePartiallyUploaded', 'Only a part of the file was uploaded due to an unknown error.');
	define('NoFileUploaded', 'No file was uploaded.');
	define('MissingTempFolder', 'The temporary folder is missing.');
	define('MissingTempFile', 'The temporary file is missing.');
	define('UnknownUploadError', 'An unknown file upload error occurred.');
	define('FileLargerThan', 'File upload error. Most probably, the file is larger than ');
	define('PROC_CANT_LOAD_ACCT', 'The account doesn\'t exist, perhaps, it has just been deleted.');
	
	define('DomainDosntExist', 'Such domain doesn\'t exist on mail server.');
	define('ServerIsDisable', 'Using mail server is prohibited by administrator.');
	
	define('PROC_CANT_MAIL_SIZE', 'Can\'t get mail storage size.');

	define('WarningOutServerBlank', 'You cannot leave SMTP Server field blank');

//
	define('JS_LANG_Refresh', 'Refresh');
	define('JS_LANG_MessagesInInbox', 'Message(s) in Inbox');
	define('JS_LANG_InfoEmptyInbox', 'Inbox is empty');
?>