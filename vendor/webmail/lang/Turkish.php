<?php
	define('PROC_WRONG_ACCT_PWD', 'Hatalı şifre');
	define('PROC_CANT_GET_SETTINGS', 'Ayarlara ulaşılamıyor');
	define('PROC_CANT_GET_MSG_LIST', 'Mesaj listesi getirilemedi');
	define('PROC_MSG_HAS_DELETED', 'Bu mesaj, posta sunucusu üzerinden daha önce silinmiş');
	define('PROC_SESSION_ERROR', 'Önceki oturum, süre aşımı nedeniyle sona erdirilmiştir.');

	define('WebMailException', 'WebMail istisna durum oluştu');
	define('InvalidUid', 'Hatalı Mesaj UID');
	define('CantCreateUser', 'Kullanıcı oluşturulamadı');
	define('SessionIsEmpty', 'Oturum bilgisi boş');
	define('FileIsTooBig', 'Dosya çok büyük');

	define('PROC_CANT_DEL_MSGS', 'Mesaj(lar) silinemedi');
	define('PROC_CANT_SEND_MSG', 'Mesaj gönderilemedi.');

	define('PROC_CANT_LEAVE_BLANK', '* işaretli alanları boş bırakamazsınız');

	define('LANG_LoginInfo', 'Giriş Bilgileri');
	define('LANG_Email', 'E-posta');
	define('LANG_Login', 'Kullanıcı Adı');
	define('LANG_Password', 'Şifre');
	define('LANG_IncServer', 'Gelen&nbsp;Posta&nbsp;Sunucusu');
	define('LANG_IncPort', 'Port');
	define('LANG_OutServer', 'SMTP&nbsp;Sunucu');
	define('LANG_OutPort', 'Port');
	define('LANG_UseSmtpAuth', 'SMTP&nbsp;kimlik&nbsp;doğrulamayı&nbsp;kullan');
	define('LANG_Enter', 'Giriş');

	define('JS_LANG_TitleLogin', 'Giriş');
	define('JS_LANG_TitleMessagesListView', 'Mesaj Listesi');
	define('JS_LANG_TitleMessagesList', 'Mesaj Listesi');
	define('JS_LANG_TitleViewMessage', 'Mesaj Oku');
	define('JS_LANG_TitleNewMessage', 'Yeni Mesaj');

	define('JS_LANG_StandardLogin', 'Standart&nbsp;Giriş');
	define('JS_LANG_AdvancedLogin', 'Gelişmiş&nbsp;Giriş');

	define('JS_LANG_InfoWebMailLoading', 'WebMail yüklenirken bekleyiniz &hellip;');
	define('JS_LANG_Loading', 'Yükleniyor &hellip;');
	define('JS_LANG_InfoMessagesLoad', 'WebMail mesaj listesini yüklerken bekleyiniz.');
	define('JS_LANG_InfoSendMessage', 'Mesaj gönderildi');

	define('JS_LANG_ConfirmAreYouSure', 'Emin misiniz?');
	define('JS_LANG_ConfirmEmptySubject', 'Mesaj konu başlığı boş. Devam etmek ister misiniz?');

	define('JS_LANG_WarningEmailBlank', 'E-posta:<br /> boş bırakılamaz');
	define('JS_LANG_WarningLoginBlank', 'Kullanıcı Adı: <br /> boş bırakılamaz');
	define('JS_LANG_WarningToBlank', 'Kime: alanı boş bırakılamaz');
	define('JS_LANG_WarningServerPortBlank', 'POP3 ve SMTP sunucu/port alanları<br /> boş bırakılamaz');
	define('JS_LANG_WarningMarkListItem', 'Listede yeralan mesajlardan en az birini seçiniz.');

	define('JS_LANG_WarningEmailFieldBlank', 'E-posta alanı boş bırakılamaz');
	define('JS_LANG_WarningIncServerBlank', 'POP3 Sunucu alanı boş bırakılamaz');
	define('JS_LANG_WarningIncPortBlank', 'POP3 Sunucu port boş bırakılamaz');
	define('JS_LANG_WarningIncLoginBlank', 'POP3 Kullanıcı Adı boş bırakılamaz');
	define('JS_LANG_WarningIncPortNumber', 'POP3 Port alanı pozitif bir sayı olmalıdır.');
	define('JS_LANG_DefaultIncPortNumber', 'Öntanımlı POP3 port numarası, sırasıyla 110 şeklindedir.');
	define('JS_LANG_WarningIncPassBlank', 'POP3 Şifre alanı boş bırakılamaz');
	define('JS_LANG_WarningOutPortBlank', 'SMTP Sunucu Port alanı boş bırakılamaz');
	define('JS_LANG_WarningOutPortNumber', 'SMTP Port alanı  pozitif bir sayı olmalıdır.');
	define('JS_LANG_WarningCorrectEmail', 'Lütfen geçerli bir e-posta adresi giriniz.');
	define('JS_LANG_DefaultOutPortNumber', 'Öntanımlı SMTP portu 25\'dir');

	define('JS_LANG_ErrorConnectionFailed', 'Bağlantı başarısız');
	define('JS_LANG_ErrorRequestFailed', 'Veri transferi hala tamamlanmadı');
	define('JS_LANG_ErrorAbsentXMLHttpRequest', 'XMLHttpRequest objesi eksik');
	define('JS_LANG_ErrorWithoutDesc', 'Tanımsız bir hata oluştu');
	define('JS_LANG_ErrorParsing', 'XML parsing hatası.');
	define('JS_LANG_ResponseText', 'Yanıt metni:');
	define('JS_LANG_ErrorEmptyXmlPacket', 'Boş XML paketi');

	define('JS_LANG_LoggingToServer', 'Sunucuya giriş yapılıyor &hellip;');
	define('JS_LANG_GettingMsgsNum', 'Mesaj sayısı alınıyor');
	define('JS_LANG_RetrievingMessage', 'Mesajlar alınıyor');
	define('JS_LANG_DeletingMessage', 'Mesaj siliniyor');
	define('JS_LANG_DeletingMessages', 'Mesaj(lar) siliniyor');
	define('JS_LANG_Of', '/');
	define('JS_LANG_Connection', 'Bağlantı');
	define('JS_LANG_Charset', 'Karakter seti');
	define('JS_LANG_AutoSelect', 'Otomatik seçim');

	define('JS_LANG_Logout', 'Çıkış');

	define('JS_LANG_NewMessage', 'Yeni Mesaj');
	define('JS_LANG_Reply', 'Yanıtla');
	define('JS_LANG_ReplyAll', 'Tümünü Yanıtla');
	define('JS_LANG_Delete', 'Sil');
	define('JS_LANG_Forward', 'İlet');

	define('JS_LANG_NewMessages', 'Yeni Mesajlar');
	define('JS_LANG_Messages', 'Mesaj(lar)');

	define('JS_LANG_From', 'Kimden');
	define('JS_LANG_To', 'Kime');
	define('JS_LANG_Date', 'Tarih');
	define('JS_LANG_Size', 'Boyut');
	define('JS_LANG_Subject', 'Konu');

	define('JS_LANG_FirstPage', 'İlk Sayfa');
	define('JS_LANG_PreviousPage', 'Önceki Sayfa');
	define('JS_LANG_NextPage', 'Sonraki Sayfa');
	define('JS_LANG_LastPage', 'Son Sayfa');

	define('JS_LANG_SwitchToPlain', 'Düz Yazı Görünüme Geç');
	define('JS_LANG_SwitchToHTML', 'HTML Görünüme Geç');
	define('JS_LANG_ClickToDownload', 'Yüklemek için tıklayınız ');
	define('JS_LANG_View', 'Göster');
	define('JS_LANG_ShowFullHeaders', 'Detaylı Başlık Bilgisi Göster');
	define('JS_LANG_HideFullHeaders', 'Detaylı Başlık Bilgisini Gizle');

	define('JS_LANG_YouUsing', 'Posta kutunuzda kullanılan alan');
	define('JS_LANG_OfYour', ', toplam alan ');
	define('JS_LANG_Mb', 'MB');
	define('JS_LANG_Kb', 'KB');
	define('JS_LANG_B', 'B');

	define('JS_LANG_SendMessage', 'Gönder');
	define('JS_LANG_SaveMessage', 'Kaydet');
	define('JS_LANG_Print', 'Yazdır');
	define('JS_LANG_PreviousMsg', 'Önceki Mesaj');
	define('JS_LANG_NextMsg', 'Sonraki Mesaj');
	define('JS_LANG_ShowBCC', 'BCC Göster');
	define('JS_LANG_HideBCC', 'BCC Gizle');
	define('JS_LANG_CC', 'CC');
	define('JS_LANG_BCC', 'BCC');
	define('JS_LANG_ReplyTo', 'Yanıtla');
	define('JS_LANG_AttachFile', 'Dosya Ekle');
	define('JS_LANG_Attach', 'Ekle');
	define('JS_LANG_Re', 'Re');
	define('JS_LANG_OriginalMessage', 'Orijinal Mesaj');
	define('JS_LANG_Sent', 'Gönderildi');
	define('JS_LANG_Fwd', 'Fwd');
	define('JS_LANG_Low', 'Düşük');
	define('JS_LANG_Normal', 'Normal');
	define('JS_LANG_High', 'Yüksek');
	define('JS_LANG_Importance', 'Önem');
	define('JS_LANG_Close', 'Kapat');

	define('JS_LANG_CharsetDefault', 'Default');
	define('JS_LANG_CharsetArabicAlphabetISO', 'Arapça (ISO)');
	define('JS_LANG_CharsetArabicAlphabet', 'Arapça (Windows)');
	define('JS_LANG_CharsetBalticAlphabetISO', 'Baltık (ISO)');
	define('JS_LANG_CharsetBalticAlphabet', 'Baltık (Windows)');
	define('JS_LANG_CharsetCentralEuropeanAlphabetISO', 'Orta Avrupa (ISO)');
	define('JS_LANG_CharsetCentralEuropeanAlphabet', 'Orta Avrupa (Windows)');
	define('JS_LANG_CharsetChineseSimplifiedEUC', 'Chinese Simplified (EUC)');
	define('JS_LANG_CharsetChineseSimplifiedGB', 'Chinese Simplified (GB2312)');
	define('JS_LANG_CharsetChineseTraditional', 'Geleneksel Çince (Big5)');
	define('JS_LANG_CharsetCyrillicAlphabetISO', 'Kril (ISO)');
	define('JS_LANG_CharsetCyrillicAlphabetKOI8R', 'Kril (KOI8-R)');
	define('JS_LANG_CharsetCyrillicAlphabet', 'Kril (Windows)');
	define('JS_LANG_CharsetGreekAlphabetISO', 'Yunan (ISO)');
	define('JS_LANG_CharsetGreekAlphabet', 'Yunan (Windows)');
	define('JS_LANG_CharsetHebrewAlphabetISO', 'İbrani (ISO)');
	define('JS_LANG_CharsetHebrewAlphabet', 'İbrani (Windows)');
	define('JS_LANG_CharsetJapanese', 'Japon');
	define('JS_LANG_CharsetJapaneseShiftJIS', 'Japon (Shift-JIS)');
	define('JS_LANG_CharsetKoreanEUC', 'Kore (EUC)');
	define('JS_LANG_CharsetKoreanISO', 'Kore (ISO)');
	define('JS_LANG_CharsetLatin3AlphabetISO', 'Latin 3 (ISO)');
	define('JS_LANG_CharsetTurkishAlphabet', 'Türkçe');
	define('JS_LANG_CharsetUniversalAlphabetUTF7', 'Üniversal (UTF-7)');
	define('JS_LANG_CharsetUniversalAlphabetUTF8', 'Üniversal (UTF-8)');
	define('JS_LANG_CharsetVietnameseAlphabet', 'Vietnam(Windows)');
	define('JS_LANG_CharsetWesternAlphabetISO', 'Batı(ISO)');
	define('JS_LANG_CharsetWesternAlphabet', 'Batı(Windows)');

// webmail 4.1 constants
	define('WarningLoginFieldBlank', 'Giriş alanını boş bırakamazsınız.');
	define('WarningCorrectLogin', 'Hatasız giriş bilgisi belirtmelisiniz.');
	define('WarningPassBlank', 'Şifre alanını boş bırakamazsınız.');
	define('WarningCorrectIncServer', 'Doğru POP3 sunucu adresi girmelisiniz.');
	define('WarningCorrectSMTPServer', 'Doğru SMTP sunucu adresi girmelisiniz.');
	define('WarningFromBlank', 'Kimden alanını boş bırakamazsınız.');

	define('ErrorSMTPConnect', 'SMTP sunucusuna bağlanılamadı. SMTP sunucu ayarlarını kontrol ediniz.');
	define('ErrorSMTPAuth', 'Hatalı kullanıcı adı ve/veya şifre. Doğrulama başarısız.');
	define('ReportMessageSent', 'Mesajınız gönderilmiştir.');
	define('ReportMessageSaved', 'Mesajınız kaydedilmiştir.');
	define('ErrorPOP3Connect', 'POP3 sunucusuna bağlanılamadı. POP3 sunucu ayarlarını kontrol ediniz.');
	define('ErrorPOP3IMAP4Auth', 'Hatalı eposta/giriş ve/veya şifre. Doğrulama başarısız.');
	define('ErrorGetMailLimit', 'Üzgünüm, posta kutunuzun limiti doldu. ');

	define('FileLargerAttachment', 'Dosya boyutu, ek dosya boyutu sınırlarını aşmıştır. ');
	define('FilePartiallyUploaded', 'Bilinmeyen bir hata nedeniyle, dosyanın sadece bazı parçaları yüklendi.');
	define('NoFileUploaded', 'Dosya yüklenemedi.');
	define('MissingTempFolder', 'Geçici klasör kayıp.');
	define('MissingTempFile', 'Geçici dosya kayıp.');
	define('UnknownUploadError', 'Bilinmeyen bir yükleme hatası oluştu.');
	define('FileLargerThan', 'Dosya yükleme hatası. Yüksek olasılıkla; dosya, izin verilenden büyük ');
	define('PROC_CANT_LOAD_ACCT', 'Hesap bulunamadı, muhtemelen daha önce silinmiştir.');

	define('DomainDosntExist', 'Böyle bir domain posta sunucusu üzerinde bulunamadı.');
	define('ServerIsDisable', 'Posta sunucusu kullanımı, yönetici tarafından engellenmiştir.');

	define('PROC_CANT_MAIL_SIZE', 'Posta saklama boyut bilgisi alınamadı.');

	define('WarningOutServerBlank', 'SMTP sunucu alanı boş bırakılamaz.');

//
	define('JS_LANG_Refresh', 'Yenile');
	define('JS_LANG_MessagesInInbox', 'adet mesaj bulundu');
	define('JS_LANG_InfoEmptyInbox', 'Gelen kutusu boş');
?>