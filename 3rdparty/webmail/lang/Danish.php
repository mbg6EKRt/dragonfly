<?php
	/*Danish translation by Mike Johnsen*/
	define('PROC_WRONG_ACCT_PWD', 'Forkert konto kodeord');
	define('PROC_CANT_GET_SETTINGS', 'Kan ikke hente indstillinger');
	define('PROC_CANT_GET_MSG_LIST', 'Kan ikke læse email liste');
	define('PROC_MSG_HAS_DELETED', 'Denne email er allerede blevet slettet fra mail serveren');
	define('PROC_SESSION_ERROR', 'Den tidligere session blev lukket pga en timeout.');
	
	define('WebMailException', 'Webmail undtagelse opstod');
	define('InvalidUid', 'Ugyldig email UID');
	define('CantCreateUser', 'Kan ikke oprette bruger');
	define('SessionIsEmpty', 'Session er tom');
	define('FileIsTooBig', 'Filen er for stor');

	define('PROC_CANT_DEL_MSGS', 'Kan ikke slette email(s)');
	define('PROC_CANT_SEND_MSG', 'Kan ikke sende email.');
	
	define('PROC_CANT_LEAVE_BLANK', 'Du kan ikke lade * felter stå tomme');
	
	define('LANG_LoginInfo', 'Login Information');
	define('LANG_Email', 'Email');
	define('LANG_Login', 'Login');
	define('LANG_Password', 'Kodeord');
	define('LANG_IncServer', 'Indgående Mail');
	define('LANG_IncPort', 'Port');
	define('LANG_OutServer', 'SMTP Server');
	define('LANG_OutPort', 'Port');
	define('LANG_UseSmtpAuth', 'Brug SMTP godkendelse');
	define('LANG_Enter', 'Enter');

	define('JS_LANG_TitleLogin', 'Login');
	define('JS_LANG_TitleMessagesListView', 'Email liste');
	define('JS_LANG_TitleMessagesList', 'Email liste');
	define('JS_LANG_TitleViewMessage', 'Vis email');
	define('JS_LANG_TitleNewMessage', 'Ny email');

	define('JS_LANG_StandardLogin', 'Standard&nbsp;Login');
	define('JS_LANG_AdvancedLogin', 'Advanceret&nbsp;Login');

	define('JS_LANG_InfoWebMailLoading', 'Vent venligst mens webmail henter indstillingerne&hellip;');
	define('JS_LANG_Loading', 'Loader&hellip;');
	define('JS_LANG_InfoMessagesLoad', 'Vent venligst mens webmail henter email listen');
	define('JS_LANG_InfoSendMessage', 'Emailen blev sendt');
	
	define('JS_LANG_ConfirmAreYouSure', 'Er du sikker?');
	define('JS_LANG_ConfirmEmptySubject', 'Emne feltet er tomt. Vil du fortsætte?');

	define('JS_LANG_WarningEmailBlank', 'Email: feltet skal<br />udfyldes');
	define('JS_LANG_WarningLoginBlank', 'Login: feltet skal<br />udfyldes');
	define('JS_LANG_WarningToBlank', 'Til: feltet skal udfyldes');
	define('JS_LANG_WarningServerPortBlank', 'POP3 og SMTP port nummeret skal udfyldes');
	define('JS_LANG_WarningMarkListItem', 'Marker mindst en ting i listen');

	define('JS_LANG_WarningEmailFieldBlank', 'Email feltet skal udfyldes');
	define('JS_LANG_WarningIncServerBlank', 'POP3 feltet skal udfyldes');
	define('JS_LANG_WarningIncPortBlank', 'POP3 port nummer skal udfyldes');
	define('JS_LANG_WarningIncLoginBlank', 'POP3 login felt skal udfyldes');
	define('JS_LANG_WarningIncPortNumber', 'Feltet POP3 skal indeholde tal.');
	define('JS_LANG_DefaultIncPortNumber', 'Standard POP3 port nummer er 110.');
	define('JS_LANG_WarningIncPassBlank', 'POP3 kodeord skal udfyldes');
	define('JS_LANG_WarningOutPortBlank', 'SMTP Server Port skal udfyldes');
	define('JS_LANG_WarningOutPortNumber', 'SMTP port feltet skal indeholde tal.');
	define('JS_LANG_WarningCorrectEmail', 'Indtast korrekt email.');
	define('JS_LANG_DefaultOutPortNumber', 'Standard SMTP port nummer er 25.');

	define('JS_LANG_ErrorConnectionFailed', 'Forbindelse mislykkeds');
	define('JS_LANG_ErrorRequestFailed', 'Data overførslen er ikke gennemført');
	define('JS_LANG_ErrorAbsentXMLHttpRequest', 'Objektet XMLHttpRequest mangler');
	define('JS_LANG_ErrorWithoutDesc', 'Fejlen uden beskrivelse opstod');
	define('JS_LANG_ErrorParsing', 'Fejl ved gennemgang af XML.');
	define('JS_LANG_ResponseText', 'Svar tekst:');
	define('JS_LANG_ErrorEmptyXmlPacket', 'Tøm XML pakke');

	define('JS_LANG_LoggingToServer', 'Logger på serveren&hellip;');
	define('JS_LANG_GettingMsgsNum', 'Henter antallet af beskeder');
	define('JS_LANG_RetrievingMessage', 'Modtager emails');
	define('JS_LANG_DeletingMessage', 'Sletter email');
	define('JS_LANG_DeletingMessages', 'Sletter email(s)');
	define('JS_LANG_Of', 'af');
	define('JS_LANG_Connection', 'Forbindelse');
	define('JS_LANG_Charset', 'Charset');
	define('JS_LANG_AutoSelect', 'Auto-Vælg');

	define('JS_LANG_Logout', 'Logud');

	define('JS_LANG_NewMessage', 'Ny email');
	define('JS_LANG_Reply', 'Besvar');
	define('JS_LANG_ReplyAll', 'Besvar alle');
	define('JS_LANG_Delete', 'Slet');
	define('JS_LANG_Forward', 'Videresend');

	define('JS_LANG_NewMessages', 'Ny emails');
	define('JS_LANG_Messages', 'Email(s)');

	define('JS_LANG_From', 'Fra');
	define('JS_LANG_To', 'Til');
	define('JS_LANG_Date', 'Dato');
	define('JS_LANG_Size', 'Størrelse');
	define('JS_LANG_Subject', 'Emne');
	
	define('JS_LANG_FirstPage', 'Første side');
	define('JS_LANG_PreviousPage', 'Forrige side');
	define('JS_LANG_NextPage', 'Næste side');
	define('JS_LANG_LastPage', 'Sidste side');
	
	define('JS_LANG_SwitchToPlain', 'Skift til ren tekst');
	define('JS_LANG_SwitchToHTML', 'Skift til HTML');
	define('JS_LANG_ClickToDownload', 'Klik for at downloade');
	define('JS_LANG_View', 'Vis');
	define('JS_LANG_ShowFullHeaders', 'Vis fulde brevhoveder');
	define('JS_LANG_HideFullHeaders', 'Gem brevhoveder');
	
	define('JS_LANG_YouUsing', 'Du bruger');
	define('JS_LANG_OfYour', 'af din');
	define('JS_LANG_Mb', 'MB');
	define('JS_LANG_Kb', 'KB');
	define('JS_LANG_B', 'B');
	
	define('JS_LANG_SendMessage', 'Send');
	define('JS_LANG_SaveMessage', 'Gem');
	define('JS_LANG_Print', 'Print');
	define('JS_LANG_PreviousMsg', 'Forrige email');
	define('JS_LANG_NextMsg', 'Næste email');
	define('JS_LANG_ShowBCC', 'Vis BCC');
	define('JS_LANG_HideBCC', 'Gem BCC');
	define('JS_LANG_CC', 'CC');
	define('JS_LANG_BCC', 'BCC');
	define('JS_LANG_ReplyTo', 'Besvar til');
	define('JS_LANG_AttachFile', 'Vedhæft fil');
	define('JS_LANG_Attach', 'Vedhæft');
	define('JS_LANG_Re', 'Re');
	define('JS_LANG_OriginalMessage', 'Original email');
	define('JS_LANG_Sent', 'Sendt');
	define('JS_LANG_Fwd', 'Fwd');
	define('JS_LANG_Low', 'Lav');
	define('JS_LANG_Normal', 'Normal');
	define('JS_LANG_High', 'Høj');
	define('JS_LANG_Importance', 'Vigtighed');
	define('JS_LANG_Close', 'Luk');

	define('JS_LANG_CharsetDefault', 'Standard');
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
	define('WarningLoginFieldBlank', 'Login felt skal udfyldes');
	define('WarningCorrectLogin', 'Du skal angive et korrekt login.');
	define('WarningPassBlank', 'Kodeord skal udfyldes');
	define('WarningCorrectIncServer', 'Du skal angive en korrekt POP3 server adresse.');
	define('WarningCorrectSMTPServer', 'Du skal angive en korrekt SMTP server adresse.');
	define('WarningFromBlank', 'Fra felt skal udfyldes');

	define('ErrorSMTPConnect', 'Kan ikke oprette forbindelse til SMTP serveren. Check SMTP server indstillinger.');
	define('ErrorSMTPAuth', 'Forkert brugernavn og/eller kodeord. Godkendelse mislykkeds.');
	define('ReportMessageSent', 'Din email er blevet sendt.');
	define('ReportMessageSaved', 'Din email er blevet gemt.');
	define('ErrorPOP3Connect', 'Kan ikke oprette forbindelse til POP3 serveren, check POP3 server indstillinger.');
	define('ErrorPOP3IMAP4Auth', 'Forkert email/login og/eller kodeord. Godkendelse mislykkeds.');
	define('ErrorGetMailLimit', 'Din mailbox kapacitet er opbrugt.');

	define('FileLargerAttachment', 'Fil størrelsen er for stor til den kan vedhæftes.');
	define('FilePartiallyUploaded', 'Kun en del af filen blev uploaded pga. en ukendt fejl.');
	define('NoFileUploaded', 'Ingen filer blev uploaded.');
	define('MissingTempFolder', 'Den midlertidige mappe mangler.');
	define('MissingTempFile', 'Den midlertidige fil mangler.');
	define('UnknownUploadError', 'En ukendt fejl opstod under upload.');
	define('FileLargerThan', 'En ukendt fejl opstod under fil upload. Filene er sikkert størrer end ');
	define('PROC_CANT_LOAD_ACCT', 'Kontoen eksistere ikke, måske er den blevet slettet.');
	
	define('DomainDosntExist', 'Det valgte domænenavn eksistere ikke på serveren.');
	define('ServerIsDisable', 'Brug af mailserveren er blevet deaktiveret af administrator.');
	
	define('PROC_CANT_MAIL_SIZE', 'Kan ikke fange mail data størrelse.');

	define('WarningOutServerBlank', 'Du kan ikke lade SMTP server feltet være blank');

//
	define('JS_LANG_Refresh', 'Reparere');
	define('JS_LANG_MessagesInInbox', 'Emails i Inbox');
	define('JS_LANG_InfoEmptyInbox', 'Inbox er indholdsløs');
?>