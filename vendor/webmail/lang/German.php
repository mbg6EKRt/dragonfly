<?php
	define('PROC_WRONG_ACCT_PWD', 'Falsches Passwort');
	define('PROC_CANT_GET_SETTINGS', 'Keine Einstellungen vorhanden');
	define('PROC_CANT_GET_MSG_LIST', 'Fehler beim Lesen der Nachrichten-Liste');
	define('PROC_MSG_HAS_DELETED', 'Diese Nachricht wurde bereits vom Mail-Server gelöscht');
	define('PROC_SESSION_ERROR', 'Die vorherige Sitzung wurde wegen Zeitüberschreitung beendet.');

	define('WebMailException', 'WebMail Fehler aufgetreten');
	define('InvalidUid', 'Falsche Nachrichten UID');
	define('CantCreateUser', 'Kann den User nicht erstellen');
	define('SessionIsEmpty', 'Session ist leer');
	define('FileIsTooBig', 'Die Datei ist zu gross');

	define('PROC_CANT_DEL_MSGS', 'Konnte Nachricht/en nicht löschen');
	define('PROC_CANT_SEND_MSG', 'Nachricht konnte nicht gesendet werden');

	define('PROC_CANT_LEAVE_BLANK', 'Felder mit * müssen ausgefüllt sein');

	define('LANG_LoginInfo', 'Titel der Login-Maske');
	define('LANG_Email', 'E-mail');
	define('LANG_Login', 'Benutzername');
	define('LANG_Password', 'Passwort');
	define('LANG_IncServer', 'Posteingangsserver&nbsp;Mail');
	define('LANG_IncPort', 'Port');
	define('LANG_OutServer', 'SMTP&nbsp;Server');
	define('LANG_OutPort', 'Port');
	define('LANG_UseSmtpAuth', '&nbsp;SMTP&nbsp;Authentifizierung');
	define('LANG_Enter', 'Enter');

	define('JS_LANG_TitleLogin', 'Login');
	define('JS_LANG_TitleMessagesListView', 'Nachrichten-Liste');
	define('JS_LANG_TitleMessagesList', 'Nachrichten Liste');
	define('JS_LANG_TitleViewMessage', 'Zeige Nachricht');
	define('JS_LANG_TitleNewMessage', 'Neue Nachricht');

	define('JS_LANG_StandardLogin', 'Standard&nbsp;Login');
	define('JS_LANG_AdvancedLogin', 'Erweitertes&nbsp;Login');

	define('JS_LANG_InfoWebMailLoading', 'Bitte warten - laden&hellip;');
	define('JS_LANG_Loading', 'Laden&hellip;');
	define('JS_LANG_InfoMessagesLoad', 'Bitte warten - Laden der Nachrichten-Liste');
	define('JS_LANG_InfoSendMessage', 'Die Nachricht wurde gesendet');

	define('JS_LANG_ConfirmAreYouSure', 'Sind Sie sicher?');
	define('JS_LANG_ConfirmEmptySubject', 'Das Betreff-Feld ist leer. Möchten Sie trotzem weiterfahren?');

	define('JS_LANG_WarningEmailBlank', 'Das Feld <br />Email: wird benötigt');
	define('JS_LANG_WarningLoginBlank', 'Das Feld <br />Login: wird benötigt');
	define('JS_LANG_WarningToBlank', 'Das Feld To: wird benötigt');
	define('JS_LANG_WarningServerPortBlank', 'Die Felder POP3 and<br />SMTP server/port werden benötigt');
	define('JS_LANG_WarningMarkListItem', 'Bitte Markieren Sie mindestens ein Objekt in der Liste');

	define('JS_LANG_WarningEmailFieldBlank', 'Das Feld E-Mail darf nicht leer sein');
	define('JS_LANG_WarningIncServerBlank', 'Das Feld POP3 Server darf nicht leer sein');
	define('JS_LANG_WarningIncPortBlank', 'Das Feld POP3 Server Port darf nicht leer sein');
	define('JS_LANG_WarningIncLoginBlank', 'Das Feld POP3 Login darf nicht leer sein');
	define('JS_LANG_WarningIncPortNumber', 'Sie sollten einen positiven Wert in POP3 port eingeben.');
	define('JS_LANG_DefaultIncPortNumber', 'Standard POP3 port nummer ist 110.');
	define('JS_LANG_WarningIncPassBlank', 'Das Feld POP3 Passwort darf nicht leer sein');
	define('JS_LANG_WarningOutPortBlank', 'Das Feld SMTP Server Port darf nicht leer sein');
	define('JS_LANG_WarningOutPortNumber', 'Sie sollten einen positiven Wert in  SMTP port eingeben.');
	define('JS_LANG_WarningCorrectEmail', 'Eine gültige E-Mail-Adresse wird benötigt.');
	define('JS_LANG_DefaultOutPortNumber', 'Standard SMTP port nummer ist 25.');

	define('JS_LANG_ErrorConnectionFailed', 'Verbindung fehlgeschlagen');
	define('JS_LANG_ErrorRequestFailed', 'Die Datenübertragung konnte nicht abgeschlossen werden');
	define('JS_LANG_ErrorAbsentXMLHttpRequest', 'Das Objekt XMLHttpRequest ist absent');
	define('JS_LANG_ErrorWithoutDesc', 'Es ist ein unbekannter Fehler aufgetreten');
	define('JS_LANG_ErrorParsing', 'Error während parsing XML.');
	define('JS_LANG_ResponseText', 'Antwort text:');
	define('JS_LANG_ErrorEmptyXmlPacket', 'Leeres XML Paket');

	define('JS_LANG_LoggingToServer', 'Verbinde zum Server&hellip;');
	define('JS_LANG_GettingMsgsNum', 'Beziehe Anzahl der Nachrichten');
	define('JS_LANG_RetrievingMessage', 'Empfange Nachricht');
	define('JS_LANG_DeletingMessage', 'Lösche Nachricht');
	define('JS_LANG_DeletingMessages', 'Lösche Nachricht/en');
	define('JS_LANG_Of', 'von');
	define('JS_LANG_Connection', 'Verbindung');
	define('JS_LANG_Charset', 'Charset');
	define('JS_LANG_AutoSelect', 'Auto-Select');

	define('JS_LANG_Logout', 'Logout');

	define('JS_LANG_NewMessage', 'Neue Nachricht');
	define('JS_LANG_Reply', 'Antworten');
	define('JS_LANG_ReplyAll', 'Allen antworten');
	define('JS_LANG_Delete', 'löschen');
	define('JS_LANG_Forward', 'Weiterleiten');

	define('JS_LANG_NewMessages', 'Neue Nachrichten');
	define('JS_LANG_Messages', 'Nachricht/en');

	define('JS_LANG_From', 'Von');
	define('JS_LANG_To', 'An');
	define('JS_LANG_Date', 'Datum');
	define('JS_LANG_Size', 'Grösse');
	define('JS_LANG_Subject', 'Betreff');

	define('JS_LANG_FirstPage', 'erste Seite');
	define('JS_LANG_PreviousPage', 'vorige Seite');
	define('JS_LANG_NextPage', 'nächste Seite');
	define('JS_LANG_LastPage', 'letzte Seite');

	define('JS_LANG_SwitchToPlain', 'Wechseln zur Nur-Text Ansicht');
	define('JS_LANG_SwitchToHTML', 'Wechsle zu HTML Ansicht');
	define('JS_LANG_ClickToDownload', 'Klicken zum downloaden');
	define('JS_LANG_View', 'Ansicht');
	define('JS_LANG_ShowFullHeaders', 'Vollständige Kopfzeilen anzeigen');
	define('JS_LANG_HideFullHeaders', 'Vollständige Kopfzeilen verbergen');

	define('JS_LANG_YouUsing', 'Sie benutzen');
	define('JS_LANG_OfYour', 'von');
	define('JS_LANG_Mb', 'MB');
	define('JS_LANG_Kb', 'KB');
	define('JS_LANG_B', 'B');

	define('JS_LANG_SendMessage', 'Senden');
	define('JS_LANG_SaveMessage', 'Speichern');
	define('JS_LANG_Print', 'Drucken');
	define('JS_LANG_PreviousMsg', 'Vorige Nachricht');
	define('JS_LANG_NextMsg', 'Nächste Nachricht');
	define('JS_LANG_ShowBCC', 'BCC anzeigen');
	define('JS_LANG_HideBCC', 'BCC verbergen');

	define('JS_LANG_CC', 'CC');
	define('JS_LANG_BCC', 'BCC');
	define('JS_LANG_ReplyTo', 'Reply&nbsp;To');
	define('JS_LANG_AttachFile', 'Datei anhängen');
	define('JS_LANG_Attach', 'anhängen');
	define('JS_LANG_Re', 'Re');
	define('JS_LANG_OriginalMessage', 'Original Nachricht');
	define('JS_LANG_Sent', 'gesendet');
	define('JS_LANG_Fwd', 'Fwd');
	define('JS_LANG_Low', 'Niedrig');
	define('JS_LANG_Normal', 'Normal');
	define('JS_LANG_High', 'Hoch');
	define('JS_LANG_Importance', 'Dringlichkeit');
	define('JS_LANG_Close', 'Schliessen');

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
	define('WarningLoginFieldBlank', 'Login Feld wird benötigt.');
	define('WarningCorrectLogin', 'Sie müssen einen gültigen Login angeben.');
	define('WarningPassBlank', 'Das Passwort Feld darf nicht leer sein.');
	define('WarningCorrectIncServer', 'Sie müssen eine gültige POP3 server addresse angeben.');
	define('WarningCorrectSMTPServer', 'Sie müssen eine gültige SMTP server addresse angeben.');
	define('WarningFromBlank', 'Das Feld Von: darf nicht leer sein.');

	define('ErrorSMTPConnect', 'Kann nicht zum SMTP server verbinden. Überprüfen Sie die SMTP server Einstellungen.');
	define('ErrorSMTPAuth', 'Falscher Benutzername/Passwort. Authentifikation fehlgeschlagen.');
	define('ReportMessageSent', 'Ihre Nachricht wurde gesendet.');
	define('ReportMessageSaved', 'Ihre Nachricht wurde gespeichert.');
	define('ErrorPOP3Connect', 'Kann nicht zum POP3 server verbinden, Überprüfen Sie die POP3 server Einstellungen.');
	define('ErrorPOP3IMAP4Auth', 'Falsche E-Mail/Benutzername und/oder Passwort. Authentifikation fehlgeschlagen.');
	define('ErrorGetMailLimit', 'Sorry, Ihre Mailbox-Limite ist erreicht.');

	define('FileLargerAttachment', 'Die Datei überschreitet das Limit.');
	define('FilePartiallyUploaded', 'Aus unbekannten Fehlern wurde nur ein Teil der Datei hochgeladen.');
	define('NoFileUploaded', 'Keine Dateien hochgeladen.');
	define('MissingTempFolder', 'Der temporäre Ordner fehlt.');
	define('MissingTempFile', 'Die temporäre Datei fehlt.');
	define('UnknownUploadError', 'Ein unbekannter Datei-Upload-Fehler ist aufgetreten.');
	define('FileLargerThan', 'Datei-Upload-Fehler. Wahrscheinlich ist die Datei grösser als ');
	define('PROC_CANT_LOAD_ACCT', 'Das Konto existiert nicht, oder wurde gelöscht.');

	define('DomainDosntExist', 'Diese Domain existiert nicht auf dem Mail-Server.');
	define('ServerIsDisable', 'Zugriff wurde vom Administrator untersagt/gesperrt.');

	define('PROC_CANT_MAIL_SIZE', 'Kann den verfügbaren Speicherplatz nicht abrufen.');

	define('WarningOutServerBlank', 'Das Feld SMTP Server wird benötigt');

	define('JS_LANG_Refresh', 'Aktualisieren');
	define('JS_LANG_MessagesInInbox', 'Nachricht/en im Posteingang');
	define('JS_LANG_InfoEmptyInbox', 'Posteingang ist leer');
?>