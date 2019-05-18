<?php
	define('PROC_WRONG_ACCT_PWD', 'Verkeerd paswoord');
	define('PROC_CANT_GET_SETTINGS', 'Kan de instellingen niet vinden');
	define('PROC_CANT_GET_MSG_LIST', 'Kan berichtenlijst niet ophalen');
	define('PROC_MSG_HAS_DELETED', 'Dit bericht is al verwijderd van de mailserver');
	define('PROC_SESSION_ERROR', 'De vorige sessie is beëindigd wegens een timeout.');
	
	define('WebMailException', 'WebMail fout gebeurd');
	define('InvalidUid', 'Ongeldig Bericht UID');
	define('CantCreateUser', 'Kan gebruiker niet maken');
	define('SessionIsEmpty', 'Sessie is leeg');
	define('FileIsTooBig', 'Het bestand is te groot');
	
	define('PROC_CANT_DEL_MSGS', 'Kan bericht(en) niet verwijderen');
	define('PROC_CANT_SEND_MSG', 'Kan bericht niet verzenden.');
	
	define('PROC_CANT_LEAVE_BLANK', 'Gelieve alle velden gemarkeerd met * in te vullen');
	
	define('LANG_LoginInfo', 'Login Informatie');
	define('LANG_Email', 'Email');
	define('LANG_Login', 'Login');
	define('LANG_Password', 'Paswoord');
	define('LANG_IncServer', 'Inkomende Mail');
	define('LANG_IncPort', 'Port');
	define('LANG_OutServer', 'SMTP Server');
	define('LANG_OutPort', 'Port');
	define('LANG_UseSmtpAuth', 'Gebruik SMTP authenticatie');
	define('LANG_Enter', 'Enter');
	
	define('JS_LANG_TitleLogin', 'Login');
	define('JS_LANG_TitleMessagesListView', 'Berichtenlijst');
	define('JS_LANG_TitleMessagesList', 'Berichtenlijst');
	define('JS_LANG_TitleViewMessage', 'Bericht bekijken');
	define('JS_LANG_TitleNewMessage', 'Nieuw bericht');
	
	define('JS_LANG_StandardLogin', 'Standaard&nbsp;Login');
	define('JS_LANG_AdvancedLogin', 'Geavanceerde&nbsp;Login');
	
	define('JS_LANG_InfoWebMailLoading', 'Even geduld, bezig met laden&hellip;');
	define('JS_LANG_Loading', 'Bezig met laden&hellip;');
	define('JS_LANG_InfoMessagesLoad', 'Even geduld, bezig met ophalen van berichten');
	define('JS_LANG_InfoSendMessage', 'Het bericht is verzonden');
	
	define('JS_LANG_ConfirmAreYouSure', 'Bent u zeker?');
	define('JS_LANG_ConfirmEmptySubject', 'Het onderwerp-veld is leeg. Bent u zeker dat u wil verdergaan?');
	
	define('JS_LANG_WarningEmailBlank', 'U kan het <br />Email: veld niet leeg laten');
	define('JS_LANG_WarningLoginBlank', 'U kan het leave<br />Login: veld niet leeg laten');
	define('JS_LANG_WarningToBlank', 'U kan het Aan: veld niet leeg laten');
	define('JS_LANG_WarningServerPortBlank', 'U kan de POP3 en<br />SMTP server/poort velden niet leeg laten');
	define('JS_LANG_WarningMarkListItem', 'Gelieve minstens één item te markeren in de lijst');
	
	define('JS_LANG_WarningEmailFieldBlank', 'U kan het Email veld niet leeg laten');
	define('JS_LANG_WarningIncServerBlank', 'U kan het POP3 Server veld niet leeg laten');
	define('JS_LANG_WarningIncPortBlank', 'U kan het POP3 Server Port veld niet leeg laten');
	define('JS_LANG_WarningIncLoginBlank', 'U kan het POP3 Login veld niet leeg laten');
	define('JS_LANG_WarningIncPortNumber', 'Gelieve een positief getal in het POP3 poort veld in te vullen.');
	define('JS_LANG_DefaultIncPortNumber', 'Standaard POP3 poort nummer is 110.');
	define('JS_LANG_WarningIncPassBlank', 'U kan het POP3 Paswoord veld niet leeg laten');
	define('JS_LANG_WarningOutPortBlank', 'U kan het SMTP Server Port veld niet leeg laten');
	define('JS_LANG_WarningOutPortNumber', 'Gelieve een positief getal in het SMTP poort veld in te vullen.');
	define('JS_LANG_WarningCorrectEmail', 'Gelieve een correct emailadres in te vullen.');
	define('JS_LANG_DefaultOutPortNumber', 'Standaard SMTP poort nummer is 25.');
	
	define('JS_LANG_ErrorConnectionFailed', 'Verbinding mislukt');
	define('JS_LANG_ErrorRequestFailed', 'De dataoverdracht is niet voltooid');
	define('JS_LANG_ErrorAbsentXMLHttpRequest', 'Het object XMLHttpRequest bestaat niet');
	define('JS_LANG_ErrorWithoutDesc', 'Een onbekende fout is gebeurd.');
	define('JS_LANG_ErrorParsing', 'Fout bij het interpreteren van de XML.');
	define('JS_LANG_ResponseText', 'Antwoordtekst:');
	define('JS_LANG_ErrorEmptyXmlPacket', 'Leeg XML pakket');
	
	define('JS_LANG_LoggingToServer', 'Bezig met inloggen op de srever&hellip;');
	define('JS_LANG_GettingMsgsNum', 'Ophalen van aantal berichten');
	define('JS_LANG_RetrievingMessage', 'Bericht ophalen');
	define('JS_LANG_DeletingMessage', 'Bericht verwijderen');
	define('JS_LANG_DeletingMessages', 'Bericht(en) verwijderen');
	define('JS_LANG_Of', 'van');
	define('JS_LANG_Connection', 'Verbinding');
	define('JS_LANG_Charset', 'Karakterset');
	define('JS_LANG_AutoSelect', 'Auto-selectie');
	
	define('JS_LANG_Logout', 'Afmelden');
	
	define('JS_LANG_NewMessage', 'Nieuw bericht');
	define('JS_LANG_Reply', 'Antwoorden');
	define('JS_LANG_ReplyAll', 'Allen antwoorden');
	define('JS_LANG_Delete', 'Verwijderen');
	define('JS_LANG_Forward', 'Doorsturen');
	
	define('JS_LANG_NewMessages', 'Nieuwe berichten');
	define('JS_LANG_Messages', 'Bericht(en)');
	
	define('JS_LANG_From', 'Van');
	define('JS_LANG_To', 'Aan');
	define('JS_LANG_Date', 'Datum');
	define('JS_LANG_Size', 'Grootte');
	define('JS_LANG_Subject', 'Onderwerp');
	
	define('JS_LANG_FirstPage', 'Eerste pagina');
	define('JS_LANG_PreviousPage', 'Vorige pagina');
	define('JS_LANG_NextPage', 'Volgende pagina');
	define('JS_LANG_LastPage', 'Laatste pagina');
	
	define('JS_LANG_SwitchToPlain', 'Naar plain text overschakelen');
	define('JS_LANG_SwitchToHTML', 'Naar HTML overschakelen');
	define('JS_LANG_ClickToDownload', 'Klik om te downloaden');
	define('JS_LANG_View', 'Weergeven');
	define('JS_LANG_ShowFullHeaders', 'Volledige headers tonen');
	define('JS_LANG_HideFullHeaders', 'Volledige headers verbergen');
	
	define('JS_LANG_YouUsing', 'U gebruikt');
	define('JS_LANG_OfYour', 'van uw');
	define('JS_LANG_Mb', 'MB');
	define('JS_LANG_Kb', 'KB');
	define('JS_LANG_B', 'B');
	
	define('JS_LANG_SendMessage', 'Verzenden');
	define('JS_LANG_SaveMessage', 'Opslaan');
	define('JS_LANG_Print', 'Afdrukken');
	define('JS_LANG_PreviousMsg', 'Vorig bericht');
	define('JS_LANG_NextMsg', 'Volgend bericht');
	define('JS_LANG_ShowBCC', 'BCC weergeven');
	define('JS_LANG_HideBCC', 'BCC verbergen');
	define('JS_LANG_CC', 'CC');
	define('JS_LANG_BCC', 'BCC');
	define('JS_LANG_ReplyTo', 'Antwoorden aan');
	define('JS_LANG_AttachFile', 'Bestand koppelen');
	define('JS_LANG_Attach', 'Koppelen');
	define('JS_LANG_Re', 'Re');
	define('JS_LANG_OriginalMessage', 'Origineel bericht');
	define('JS_LANG_Sent', 'Verzonden');
	define('JS_LANG_Fwd', 'Fwd');
	define('JS_LANG_Low', 'Laag');
	define('JS_LANG_Normal', 'Normal');
	define('JS_LANG_High', 'Hoog');
	define('JS_LANG_Importance', 'Prioriteit');
	define('JS_LANG_Close', 'Sluiten');
	
	define('JS_LANG_CharsetDefault', 'Standaard');
	define('JS_LANG_CharsetArabicAlphabetISO', 'Arabisch Alfabet (ISO)');
	define('JS_LANG_CharsetArabicAlphabet', 'Arabisch Alfabet (Windows)');
	define('JS_LANG_CharsetBalticAlphabetISO', 'Baltisch Alfabet (ISO)');
	define('JS_LANG_CharsetBalticAlphabet', 'Baltisch Alfabet (Windows)');
	define('JS_LANG_CharsetCentralEuropeanAlphabetISO', 'Centraal Europees Alfabet (ISO)');
	define('JS_LANG_CharsetCentralEuropeanAlphabet', 'Centraal Europees Alfabet (Windows)');
	define('JS_LANG_CharsetChineseSimplifiedEUC', 'Chinese Simplified (EUC)');
	define('JS_LANG_CharsetChineseSimplifiedGB', 'Chinese Simplified (GB2312)');
	define('JS_LANG_CharsetChineseTraditional', 'Chinees Traditioneel');
	define('JS_LANG_CharsetCyrillicAlphabetISO', 'Cyrillisch Alfabet (ISO)');
	define('JS_LANG_CharsetCyrillicAlphabetKOI8R', 'Cyrillisch Alfabet (KOI8-R)');
	define('JS_LANG_CharsetCyrillicAlphabet', 'Cyrillisch Alfabet (Windows)');
	define('JS_LANG_CharsetGreekAlphabetISO', 'Grieks Alfabet (ISO)');
	define('JS_LANG_CharsetGreekAlphabet', 'Grieks Alfabet (Windows)');
	define('JS_LANG_CharsetHebrewAlphabetISO', 'Hebreeuws Alfabet (ISO)');
	define('JS_LANG_CharsetHebrewAlphabet', 'Hebreeuws Alfabet (Windows)');
	define('JS_LANG_CharsetJapanese', 'Japans');
	define('JS_LANG_CharsetJapaneseShiftJIS', 'Japans (Shift-JIS)');
	define('JS_LANG_CharsetKoreanEUC', 'Koreaans (EUC)');
	define('JS_LANG_CharsetKoreanISO', 'Koreaans (ISO)');
	define('JS_LANG_CharsetLatin3AlphabetISO', 'Latin 3 Alphabet (ISO)');
	define('JS_LANG_CharsetTurkishAlphabet', 'Turks Alfabet');
	define('JS_LANG_CharsetUniversalAlphabetUTF7', 'Universeel Alfabet (UTF-7)');
	define('JS_LANG_CharsetUniversalAlphabetUTF8', 'Universeel Alfabet (UTF-8)');
	define('JS_LANG_CharsetVietnameseAlphabet', 'Vietnamees Alfabet (Windows)');
	define('JS_LANG_CharsetWesternAlphabetISO', 'Westers Alfabet (ISO)');
	define('JS_LANG_CharsetWesternAlphabet', 'Westers Alfabet (Windows)');
	
// webmail 4.1 constants
	define('WarningLoginFieldBlank', 'Login veld kan niet leeg zijn.');
	define('WarningCorrectLogin', 'Kies een correcte login.');
	define('WarningPassBlank', 'Paswoord veld kan niet leeg zijn.');
	define('WarningCorrectIncServer', 'Kies een correct POP3 server adres.');
	define('WarningCorrectSMTPServer', 'Kies een correct SMTP server adres.');
	define('WarningFromBlank', 'Vanm veld kan niet leeg zijn.');
	
	define('ErrorSMTPConnect', 'Kan niet verbinden met de SMTP server. Controleer de SMTP server instellingen.');
	define('ErrorSMTPAuth', 'Verkeerde gebruikersnaam en/of paswoord. Aanmelden mislukt.');
	define('ReportMessageSent', 'Uw bericht is verzonden.');
	define('ReportMessageSaved', 'Uw bericht werd opgeslagen.');
	define('ErrorPOP3Connect', 'Kan niet verbinden met de POP3 server, Controleer de POP3 server instellingen.');
	define('ErrorPOP3IMAP4Auth', 'Verkeerde email/login en/of paswoord. Aanmelden mislukt.');
	define('ErrorGetMailLimit', 'Sorry, de limiet van uw mailbox werd bereikt.');
	
	define('FileLargerAttachment', 'De bestandsgrootte is hoger dan toegelaten.');
	define('FilePartiallyUploaded', 'Enkel een gedeelte van het bestand werd geuploaded, te wijten aan een onbekende fout.');
	define('NoFileUploaded', 'Geen bestand geuploaded.');
	define('MissingTempFolder', 'De tijdelijke map is onbestaande.');
	define('MissingTempFile', 'Het tijdelijk bestand is onbestaande.');
	define('UnknownUploadError', 'Een onbekende fout is opgetreden.');
	define('FileLargerThan', 'Fout bij het uploaden. Waarschijnlijk is het bestand groter dan ');
	define('PROC_CANT_LOAD_ACCT', 'Deze account bestaat niet, misschien werd ze juist verwijderd.');
	
	define('DomainDosntExist', 'Dit domain bestaat niet op de mailserver.');
	define('ServerIsDisable', 'Deze mailserver gebruiken werd verboden door de beheerder.');
	
	define('PROC_CANT_MAIL_SIZE', 'Kan bestandsgrootte niet ophalen.');
	
	define('WarningOutServerBlank', 'Het veld SMTP Server kan niet leeg zijn');

//
	define('JS_LANG_Refresh', 'Vernieuwen');
	define('JS_LANG_MessagesInInbox', 'Bericht(en) in Inbox');
	define('JS_LANG_InfoEmptyInbox', 'Inbox is leeg');
?>