<?php
	define('PROC_WRONG_ACCT_PWD', 'Hibás jelszó');
	define('PROC_CANT_GET_SETTINGS', 'Nem lehet a beállításokat lekérni');
	define('PROC_CANT_GET_MSG_LIST', 'Nem lehet lekérni az üzenetek listáját');
	define('PROC_MSG_HAS_DELETED', 'Ez az üzenet már törölve lett a szerverről');
	define('PROC_SESSION_ERROR', 'Az előző munkamenet megszakítva időtúllépés miatt.');

	define('WebMailException', 'WebMail kivételes hiba történt');
	define('InvalidUid', 'Érvénytelen üzenet azonosító');
	define('CantCreateUser', 'Nem lehet a felhasználót létrehozni');
	define('SessionIsEmpty', 'A munkamenet üres');
	define('FileIsTooBig', 'Túl nagy méretű fájl');

	define('PROC_CANT_DEL_MSGS', 'Nem lehet törölni az üzenete(ke)t');
	define('PROC_CANT_SEND_MSG', 'Nem lehet elküldeni az üzenetet.');

	define('PROC_CANT_LEAVE_BLANK', 'Nem hagyhatja üresen a *-al jelölt mezőket');
	
	define('LANG_LoginInfo', 'Belépési információk');
	define('LANG_Email', 'E-mail cím');
	define('LANG_Login', 'Postafiók');
	define('LANG_Password', 'Jelszó');
	define('LANG_IncServer', 'Bejövő Üzenet');
	define('LANG_IncPort', 'Port');
	define('LANG_OutServer', 'SMTP Szerver');
	define('LANG_OutPort', 'Port');
	define('LANG_UseSmtpAuth', 'SMTP hitelesítés használata');
	define('LANG_Enter', 'Belépés');

	define('JS_LANG_TitleLogin', 'Belépés');
	define('JS_LANG_TitleMessagesListView', 'Üzenetek listája');
	define('JS_LANG_TitleMessagesList', 'Üzenetek listája');
	define('JS_LANG_TitleViewMessage', 'Üzenet megtekintése');
	define('JS_LANG_TitleNewMessage', 'Új üzenet');

	define('JS_LANG_StandardLogin', 'Egyszerűsített&nbsp;Belépés');
	define('JS_LANG_AdvancedLogin', 'Bővített&nbsp;Belépés');

	define('JS_LANG_InfoWebMailLoading', 'Kérem várjon amíg a WebMail töltődik&hellip;');
	define('JS_LANG_Loading', 'Töltés&hellip;');
	define('JS_LANG_InfoMessagesLoad', 'Kérjem várjon amíg a WebMail az üzenetek listáját tölti');
	define('JS_LANG_InfoSendMessage', 'Az üzenet elküldve');

	define('JS_LANG_ConfirmAreYouSure', 'Biztos benne?');
	define('JS_LANG_ConfirmEmptySubject', 'A tárgy mező üres, biztosan folytatja?');

	define('JS_LANG_WarningEmailBlank', 'Nem hagyhatja az<br />E-mail cím: mezőt üresen');
	define('JS_LANG_WarningLoginBlank', 'Nem hagyhatja a<br />Postafiók: mezőt üresen');
	define('JS_LANG_WarningToBlank', 'Nem hagyhatja a Címzett: mezőt üresen');
	define('JS_LANG_WarningServerPortBlank', 'Nem hagyhatja a POP3<br />SMTP szerver/port mezőket üresen');
	define('JS_LANG_WarningMarkListItem', 'Kérjük jelöljön meg legalább egy üzenetet a listában');

	define('JS_LANG_WarningEmailFieldBlank', 'Nem hagyhatja üresen az E-mail mezőt');
	define('JS_LANG_WarningIncServerBlank', 'Nem hagyhatja üresen a POP3 Szerver mezőt');
	define('JS_LANG_WarningIncPortBlank', 'Nem hagyhatja üresen a POP3 Szerver Port mezőt');
	define('JS_LANG_WarningIncLoginBlank', 'Nem hagyhatja üresen a POP3 Azonosító mezőt');
	define('JS_LANG_WarningIncPortNumber', 'Kérjük adjon meg pozitív számot a POP3 port mezőben.');
	define('JS_LANG_DefaultIncPortNumber', 'Alapértelmezett POP3 portszám a 110.');
	define('JS_LANG_WarningIncPassBlank', 'Nem hagyhatja üresen a POP3 Jelszó mezőt');
	define('JS_LANG_WarningOutPortBlank', 'Nem hagyhatja üresen a SMTP Szerver Port mezőt');
	define('JS_LANG_WarningOutPortNumber', 'Kérjük adjon meg pozitív számot az SMTP port mezőben.');
	define('JS_LANG_WarningCorrectEmail', 'Kérjük adjon meg valós e-mail címet.');
	define('JS_LANG_DefaultOutPortNumber', 'Az alapértelmezett SMTP port a 25.');

	define('JS_LANG_ErrorConnectionFailed', 'Sikertelen kapcsolódás');
	define('JS_LANG_ErrorRequestFailed', 'Az adatok lekérése sikertelen');
	define('JS_LANG_ErrorAbsentXMLHttpRequest', 'Az XMLHttpRequest objektum hibás');
	define('JS_LANG_ErrorWithoutDesc', 'Leírás nélküli hiba történt');
	define('JS_LANG_ErrorParsing', 'Hiba az XML fájl olvasása közben.');
	define('JS_LANG_ResponseText', 'Válasz szöveg:');
	define('JS_LANG_ErrorEmptyXmlPacket', 'Üres XML csomag');

	define('JS_LANG_LoggingToServer', 'Kapcsolódás a szerverhez&hellip;');
	define('JS_LANG_GettingMsgsNum', 'Az üzenetek számának lekérése');
	define('JS_LANG_RetrievingMessage', 'Üzenetek fogadása');
	define('JS_LANG_DeletingMessage', 'Üzenet törlése');
	define('JS_LANG_DeletingMessages', 'Üzenet(ek) törlése');
	define('JS_LANG_Of', ' ');
	define('JS_LANG_Connection', 'Kapcsolat');
	define('JS_LANG_Charset', 'Karakterkészlet');
	define('JS_LANG_AutoSelect', 'Automatikus választás');

	define('JS_LANG_Logout', 'Kilépés');

	define('JS_LANG_NewMessage', 'Új üzenet');
	define('JS_LANG_Reply', 'Válasz');
	define('JS_LANG_ReplyAll', 'Válasz mindenkinek');
	define('JS_LANG_Delete', 'Törlés');
	define('JS_LANG_Forward', 'Továbbítás');

	define('JS_LANG_NewMessages', 'Új üzenetek');
	define('JS_LANG_Messages', 'Üzenet(ek)');

	define('JS_LANG_From', 'Feladó');
	define('JS_LANG_To', 'Címzett');
	define('JS_LANG_Date', 'Dátum');
	define('JS_LANG_Size', 'Méret');
	define('JS_LANG_Subject', 'Tárgy');

	define('JS_LANG_FirstPage', 'Első oldal');
	define('JS_LANG_PreviousPage', 'Előző oldal');
	define('JS_LANG_NextPage', 'Következő oldal');
	define('JS_LANG_LastPage', 'Utolsó oldal');

	define('JS_LANG_SwitchToPlain', 'Váltás sima szövegre');
	define('JS_LANG_SwitchToHTML', 'Váltás HTML-re');
	define('JS_LANG_ClickToDownload', 'Kattintson ide a letöltéshez');
	define('JS_LANG_View', 'Megtekint');
	define('JS_LANG_ShowFullHeaders', 'Üzenet fejléc megtekintése');
	define('JS_LANG_HideFullHeaders', 'Üzenet fejléc elrejtése');

	define('JS_LANG_YouUsing', 'Felhasznált adat: ');
	define('JS_LANG_OfYour', ', a teljeses rendelkezésre állóból: ');
	define('JS_LANG_Mb', 'MB');
	define('JS_LANG_Kb', 'KB');
	define('JS_LANG_B', 'B');

	define('JS_LANG_SendMessage', 'Elküld');
	define('JS_LANG_SaveMessage', 'Mentés');
	define('JS_LANG_Print', 'Nyomtatás');
	define('JS_LANG_PreviousMsg', 'Előző üzenet');
	define('JS_LANG_NextMsg', 'Következő üzenet');
	define('JS_LANG_ShowBCC', 'Titkos másolat megjelenítése');
	define('JS_LANG_HideBCC', 'Titkos másolat elrejtése');
	define('JS_LANG_CC', 'Másolatot kap');
	define('JS_LANG_BCC', 'Titkos másolat');
	define('JS_LANG_ReplyTo', 'Válasz mint');
	define('JS_LANG_AttachFile', 'Fájl csatolása');
	define('JS_LANG_Attach', 'Csatolás');
	define('JS_LANG_Re', 'Re');
	define('JS_LANG_OriginalMessage', 'Eredeti üzenet');
	define('JS_LANG_Sent', 'Elküldve');
	define('JS_LANG_Fwd', 'Továbbítva');
	define('JS_LANG_Low', 'Alacsony');
	define('JS_LANG_Normal', 'Normál');
	define('JS_LANG_High', 'Magas');
	define('JS_LANG_Importance', 'Fontosság');
	define('JS_LANG_Close', 'Bezár');
	
	define('JS_LANG_CharsetDefault', 'Alapértelmezett');
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
	define('WarningLoginFieldBlank', 'Nem hagyhatja a Belépés mezőt üresen.');
	define('WarningCorrectLogin', 'Kérjük töltse ki helyesen a Belépés mezőt.');
	define('WarningPassBlank', 'Nem hagyhatja a Jelszó mezőt üresen.');
	define('WarningCorrectIncServer', 'Kérjük adjon meg helyes POP3 szerver címet.');
	define('WarningCorrectSMTPServer', 'Kérjük adjon meg helyes SMTP szerver címet.');
	define('WarningFromBlank', 'Nem hagyhatja a Feladó mezőt üresen.');

	define('ErrorSMTPConnect', 'Nem lehet csatlakozni az SMTP kiszolgálóhoz. Kérjük ellenőrizze a beállításokat.');
	define('ErrorSMTPAuth', 'Hibás felhasználónév vagy jelszó. Sikertelen SMTP hitelesítés.');
	define('ReportMessageSent', 'Az üzenet elküldve.');
	define('ReportMessageSaved', 'Az üzenet elmentve.');
	define('ErrorPOP3Connect', 'Sikertelen kapcsolódás a POP3 kiszolgálóhoz. Kérjük ellenőrizze a beállításokat.');
	define('ErrorPOP3IMAP4Auth', 'Hibás e-mail cím/postafiók és/vagy jelszó. Sikertelen belépés.');
	define('ErrorGetMailLimit', 'A postafiókja megtelt.');

	define('FileLargerAttachment', 'A csatolás mérete túl nagy.');
	define('FilePartiallyUploaded', 'A csatolás csak egy része került feltöltésre hiba miatt.');
	define('NoFileUploaded', 'A csatolás nem lett feltöltve.');
	define('MissingTempFolder', 'Az átmeneti tároló könyvtár hiányzik.');
	define('MissingTempFile', 'Az átmeneti fájl hiányzik.');
	define('UnknownUploadError', 'Ismeretlen fájl feltöltési hiba.');
	define('FileLargerThan', 'Fájl feltöltési hiba. Valószínű, hogy a fájl mérete nagyobb, mint ');
	define('PROC_CANT_LOAD_ACCT', 'A fiók nem létezik, valószínűleg törölésre került.');
	
	define('DomainDosntExist', 'Ilyen domain név nem létezik a szerveren.');
	define('ServerIsDisable', 'A levelező kiszolgáló használatát az adminisztrátor megtiltotta.');
	
	define('PROC_CANT_MAIL_SIZE', 'Nem lehet lekérdezni a levél méretét.');

	define('WarningOutServerBlank', 'Nem hagyhatja az SMTP Szerver mezőt üresen');
	
//
	define('JS_LANG_Refresh', 'Frissítés');
	define('JS_LANG_MessagesInInbox', 'Üzenet a beérkezett üzenetk mappában');
	define('JS_LANG_InfoEmptyInbox', 'Nincs beérkezett üzenet');
?>