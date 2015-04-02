<?php
// MailBee Webmail 4.x Swedish Resource strings
// Translation: Peter Strömblad, http://webbhotell.praktit.se
// Revision: 2007-10-31
	define('PROC_WRONG_ACCT_PWD', 'Fel lösenord');
	define('PROC_CANT_GET_SETTINGS', 'Kunde ej hämta inställningar');
	define('PROC_CANT_GET_MSG_LIST', 'Kunde ej hämta meddelandelista');
	define('PROC_MSG_HAS_DELETED', 'Detta meddelande har redan raderats från e-postservern');
	define('PROC_SESSION_ERROR', 'Föregående session avbröts pga tidsgräns.');

	define('WebMailException', 'WebbMail undantagsfel uppstod');
	define('InvalidUid', 'Ogiltigt meddelande UID (unik identifierare)');
	define('CantCreateUser', 'Kan ej skapa användare');
	define('SessionIsEmpty', 'Sessionen är tom');
	define('FileIsTooBig', 'Filen är för stor');

	define('PROC_CANT_DEL_MSGS', 'Kan ej ta bort meddelande/n');
	define('PROC_CANT_SEND_MSG', 'kan ej skicka meddelande.');

	define('PROC_CANT_LEAVE_BLANK', 'Fält med * måste fyllas i');

	define('LANG_LoginInfo', 'Login information');
	define('LANG_Email', 'Epostadress');
	define('LANG_Login', 'Login');
	define('LANG_Password', 'Lösenord');
	define('LANG_IncServer', 'Inkommande Epostserver');
	define('LANG_IncPort', 'Port');
	define('LANG_OutServer', 'Utgående Epostserver (SMTP)');
	define('LANG_OutPort', 'Port');
	define('LANG_UseSmtpAuth', 'Använd SMTP autentisering');
	define('LANG_Enter', 'Enter');

	define('JS_LANG_TitleLogin', 'Login');
	define('JS_LANG_TitleMessagesListView', 'Meddelandelista');
	define('JS_LANG_TitleMessagesList', 'Meddelandelista');
	define('JS_LANG_TitleViewMessage', 'Visa Meddelande');
	define('JS_LANG_TitleNewMessage', 'Nytt Meddelande');

	define('JS_LANG_StandardLogin', 'Standard Inloggning');
	define('JS_LANG_AdvancedLogin', 'Avancerad Inloggning');

	define('JS_LANG_InfoWebMailLoading', 'Vänligen vänta, laddar&hellip;');
	define('JS_LANG_Loading', 'Laddar&hellip;');
	define('JS_LANG_InfoMessagesLoad', 'Vänligen vänta, laddar meddelandelista');
	define('JS_LANG_InfoSendMessage', 'Meddelandet har skickats');

	define('JS_LANG_ConfirmAreYouSure', 'Är du säker?');
	define('JS_LANG_ConfirmEmptySubject', 'Titelraden är tom. Vill du fortsätta?');

	define('JS_LANG_WarningEmailBlank', 'Avsändarfältet får ej vara tomt');
	define('JS_LANG_WarningLoginBlank', 'Inloggningsfältet får ej vara tomt');
	define('JS_LANG_WarningToBlank', 'Till-fältet får ej vara tomt');
	define('JS_LANG_WarningServerPortBlank', 'POP3 och SMTP/Port fälten får ej vara tomma');
	define('JS_LANG_WarningMarkListItem', 'Vänligen markera minst en i listan');

	define('JS_LANG_WarningEmailFieldBlank', 'Fältet Epost kan ej vara tomt');
	define('JS_LANG_WarningIncServerBlank', 'Fältet POP3 Server får ej vara tomt');
	define('JS_LANG_WarningIncPortBlank', 'Fältet POP3 Serverport får ej vara tomt');
	define('JS_LANG_WarningIncLoginBlank', 'Fältet POP3 inloggning kan ej vara tomt');
	define('JS_LANG_WarningIncPortNumber', 'Fältet POP3 serverport måste vara positivt heltal.');
	define('JS_LANG_DefaultIncPortNumber', 'Standardport för POP3 är 110.');
	define('JS_LANG_WarningIncPassBlank', 'Fältet POP3 lösenord får ej vara tomt.');
	define('JS_LANG_WarningOutPortBlank', 'Fältet SMTP Server Port får ej vara blankt.');
	define('JS_LANG_WarningOutPortNumber', 'Fältet SMTP Server Port måste vara positivt heltal.');
	define('JS_LANG_WarningCorrectEmail', 'Du måste ange korrekt epostadress.');
	define('JS_LANG_DefaultOutPortNumber', 'Standardport för SMTP är 25.');

	define('JS_LANG_ErrorConnectionFailed', 'Förbindelsen fallerade');
	define('JS_LANG_ErrorRequestFailed', 'Dataöverföringen har inte fullförts');
	define('JS_LANG_ErrorAbsentXMLHttpRequest', 'Objektet XMLHttpRequest saknas');
	define('JS_LANG_ErrorWithoutDesc', 'Okänt fel');
	define('JS_LANG_ErrorParsing', 'Fel vid tolkning av XML.');
	define('JS_LANG_ResponseText', 'Svarsmeddelande:');
	define('JS_LANG_ErrorEmptyXmlPacket', 'Tomt XML paket');

	define('JS_LANG_LoggingToServer', 'Loggar in på server&hellip;');
	define('JS_LANG_GettingMsgsNum', 'Hämtar antal meddelanden');
	define('JS_LANG_RetrievingMessage', 'Hämtar meddelande');
	define('JS_LANG_DeletingMessage', 'Raderar meddelande');
	define('JS_LANG_DeletingMessages', 'Raderar meddelanden');
	define('JS_LANG_Of', 'av');
	define('JS_LANG_Connection', 'Förbindelse');
	define('JS_LANG_Charset', 'Charset');
	define('JS_LANG_AutoSelect', 'Auto-val');

	define('JS_LANG_Logout', 'Logga ut');

	define('JS_LANG_NewMessage', 'Nytt Meddelande');
	define('JS_LANG_Reply', 'Svara');
	define('JS_LANG_ReplyAll', 'Svara alla');
	define('JS_LANG_Delete', 'Radera');
	define('JS_LANG_Forward', 'Framåt');

	define('JS_LANG_NewMessages', 'Nya Meddelanden');
	define('JS_LANG_Messages', 'Meddelande/n');

	define('JS_LANG_From', 'Från');
	define('JS_LANG_To', 'Till');
	define('JS_LANG_Date', 'Datum');
	define('JS_LANG_Size', 'Storlek');
	define('JS_LANG_Subject', 'Ämne');

	define('JS_LANG_FirstPage', 'Första sidan');
	define('JS_LANG_PreviousPage', 'Föregående sida');
	define('JS_LANG_NextPage', 'Nästa sida');
	define('JS_LANG_LastPage', 'Sista sidan');

	define('JS_LANG_SwitchToPlain', 'Visa som Oformaterad Text');
	define('JS_LANG_SwitchToHTML', 'Visa som HTML');
	define('JS_LANG_ClickToDownload', 'Klicka för att hämta');
	define('JS_LANG_View', 'Visa');
	define('JS_LANG_ShowFullHeaders', 'Visa fullständigt brevhuvud');
	define('JS_LANG_HideFullHeaders', 'Dölj fullständigt brevhuvud');

	define('JS_LANG_YouUsing', 'Du använder');
	define('JS_LANG_OfYour', 'av dina');
	define('JS_LANG_Mb', 'MB');
	define('JS_LANG_Kb', 'KB');
	define('JS_LANG_B', 'B');

	define('JS_LANG_SendMessage', 'Skicka');
	define('JS_LANG_SaveMessage', 'Spara');
	define('JS_LANG_Print', 'Skriv ut');
	define('JS_LANG_PreviousMsg', 'Föregående meddelande');
	define('JS_LANG_NextMsg', 'Nästa meddelande');
	define('JS_LANG_ShowBCC', 'Visa Hemlig kopia');
	define('JS_LANG_HideBCC', 'Dölj Hemlig kopia');
	define('JS_LANG_CC', 'Kopia');
	define('JS_LANG_BCC', 'Hemlig Kopia');
	define('JS_LANG_ReplyTo', 'Svara till');
	define('JS_LANG_AttachFile', 'Bifoga fil');
	define('JS_LANG_Attach', 'Bifoga');
	define('JS_LANG_Re', 'Sv');
	define('JS_LANG_OriginalMessage', 'Ursprungligt meddelande');
	define('JS_LANG_Sent', 'Skickat');
	define('JS_LANG_Fwd', 'Vidarebefordra');
	define('JS_LANG_Low', 'Låg');
	define('JS_LANG_Normal', 'Normal');
	define('JS_LANG_High', 'Hög');
	define('JS_LANG_Importance', 'Prioritet');
	define('JS_LANG_Close', 'Stäng');

	define('JS_LANG_CharsetDefault', 'Default');
	define('JS_LANG_CharsetArabicAlphabetISO', 'Arabiskt alfabet (ISO)');
	define('JS_LANG_CharsetArabicAlphabet', 'Arabiskt alfabet (Windows)');
	define('JS_LANG_CharsetBalticAlphabetISO', 'Baltiskt alfabet (ISO)');
	define('JS_LANG_CharsetBalticAlphabet', 'Baltiskt alfabet (Windows)');
	define('JS_LANG_CharsetCentralEuropeanAlphabetISO', 'Central Europeiskt alfabet (ISO)');
	define('JS_LANG_CharsetCentralEuropeanAlphabet', 'Central Europeiskt alfabet (Windows)');
	define('JS_LANG_CharsetChineseSimplifiedEUC', 'Chinese Simplified (EUC)');
	define('JS_LANG_CharsetChineseSimplifiedGB', 'Chinese Simplified (GB2312)');
	define('JS_LANG_CharsetChineseTraditional', 'Kinesiskt traditionellt (Big5)');
	define('JS_LANG_CharsetCyrillicAlphabetISO', 'Cyrilliskt alfabet (ISO)');
	define('JS_LANG_CharsetCyrillicAlphabetKOI8R', 'Cyrilliskt alfabet (KOI8-R)');
	define('JS_LANG_CharsetCyrillicAlphabet', 'Cyrilliskt alfabet (Windows)');
	define('JS_LANG_CharsetGreekAlphabetISO', 'Grekiskt alfabet (ISO)');
	define('JS_LANG_CharsetGreekAlphabet', 'Grekiskt alfabet (Windows)');
	define('JS_LANG_CharsetHebrewAlphabetISO', 'Hebreeiskt alfabet (ISO)');
	define('JS_LANG_CharsetHebrewAlphabet', 'Hebreeiskt alfabet (Windows)');
	define('JS_LANG_CharsetJapanese', 'Japanese');
	define('JS_LANG_CharsetJapaneseShiftJIS', 'Japanese (Shift-JIS)');
	define('JS_LANG_CharsetKoreanEUC', 'Koreanskt (EUC)');
	define('JS_LANG_CharsetKoreanISO', 'Koreanskt (ISO)');
	define('JS_LANG_CharsetLatin3AlphabetISO', 'Latin 3 alfabet (ISO)');
	define('JS_LANG_CharsetTurkishAlphabet', 'Turkiskt alfabet');
	define('JS_LANG_CharsetUniversalAlphabetUTF7', 'Universal alfabet (UTF-7)');
	define('JS_LANG_CharsetUniversalAlphabetUTF8', 'Universal alfabet (UTF-8)');
	define('JS_LANG_CharsetVietnameseAlphabet', 'Vietnamesiskt alfabet (Windows)');
	define('JS_LANG_CharsetWesternAlphabetISO', 'Western alfabet (ISO)');
	define('JS_LANG_CharsetWesternAlphabet', 'Western alfabet (Windows)');

//webmail 4.1 constants
	define('WarningLoginFieldBlank', 'You cannot leave Login field blank.');
	define('WarningCorrectLogin', 'Du måste ange en korrekt inloggning');
	define('WarningPassBlank', 'Du kan inte låta lösenordsfältet vara tomt.');
	define('WarningCorrectIncServer', 'Du måste ange en giltig POP3 serveradress.');
	define('WarningCorrectSMTPServer', 'Du måste ange en korrekt SMTP serveradress.');
	define('WarningFromBlank', 'Du kan inte lämna fältet Från tomt.');

	define('ErrorSMTPConnect', 'Kan ej ansluta till SMTP-server. Kontrollera SMTP-inställningarna.');
	define('ErrorSMTPAuth', 'Fel användarnanm och/eller lösenord. Autentisering misslyckades.');
	define('ReportMessageSent', 'Ditt meddelande har skickats.');
	define('ReportMessageSaved', 'Ditt meddelande har sparats.');
	define('ErrorPOP3Connect', 'Kan ej ansluta till POP3-servern. Kontrollera POP3-inställningarna.');
	define('ErrorPOP3IMAP4Auth', 'Fel epost/login och/eller lösenord. Autentisering misslyckades.');
	define('ErrorGetMailLimit', 'Förlåt, din brevlåda är full.');

	define('FileLargerAttachment', 'Filen är större än tillåten storlek för bilagor.');
	define('FilePartiallyUploaded', 'Filen bifogades inte i sin helhet pga ett okänt fel.');
	define('NoFileUploaded', 'Ingen fil bifogades.');
	define('MissingTempFolder', 'Temporär katalog saknas.');
	define('MissingTempFile', 'Temporär fil saknas.');
	define('UnknownUploadError', 'Ett okänt fel inträffade vid hämtning av bifogad fil.');
	define('FileLargerThan', 'Fel vid bifoga fil. Troligen pga att filen är större än');
	define('PROC_CANT_LOAD_ACCT', 'Kontot finns inte, troligen har det raderats.');

	define('DomainDosntExist', 'Domänen finns ej på servern.');
	define('ServerIsDisable', 'E-postservern är tillfälligt stängd av administratören.');

	define('PROC_CANT_MAIL_SIZE', 'Fel i hämtning av utrymmesbegränsning.');

	define('WarningOutServerBlank', 'Fältet SMTP Server får ej vara tomt');

//
	define('JS_LANG_Refresh', 'Friska upp');
	define('JS_LANG_MessagesInInbox', 'Meddelanden');
	define('JS_LANG_InfoEmptyInbox', 'Nej meddelandena');
?>