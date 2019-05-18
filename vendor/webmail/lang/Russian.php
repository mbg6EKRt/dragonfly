<?php
	define('PROC_WRONG_ACCT_PWD', 'Неправильный пароль.');
	define('PROC_CANT_GET_SETTINGS', 'Ошибка при получении настроек');
	define('PROC_CANT_GET_MSG_LIST', 'Ошибка при получении списка папок.');
	define('PROC_MSG_HAS_DELETED', 'Возможно, сообщение было удалено с сервера.');
	define('PROC_SESSION_ERROR', 'Предыдущая сессия была завершена по тайм-ауту.');

	define('WebMailException', 'WebMail: произошла ошибка.');
	define('InvalidUid', 'Неправильный UID сообщения.');
	define('CantCreateUser', 'Ошибка при создании пользователя.');
	define('SessionIsEmpty', 'Пустая сессия.');
	define('FileIsTooBig', 'Файл слишком большой.');

	define('PROC_CANT_DEL_MSGS', 'Ошибка при удалении сообщения(й).');
	define('PROC_CANT_SEND_MSG', 'Ошибка при отправлении письма.');

	define('PROC_CANT_LEAVE_BLANK', 'Поля, помеченные *, обязательны для заполнения.');
	
	define('LANG_LoginInfo', 'Информация для входа');
	define('LANG_Email', 'Электропочта');
	define('LANG_Login', 'Логин');
	define('LANG_Password', 'Пароль');
	define('LANG_IncServer', 'Входящая почта');
	define('LANG_IncPort', 'Порт');
	define('LANG_OutServer', 'SMTP-сервер');
	define('LANG_OutPort', 'Порт');
	define('LANG_UseSmtpAuth', 'Использовать SMTP-аутентификацию');
	define('LANG_Enter', 'Войти');

	define('JS_LANG_TitleLogin', 'Логин');
	define('JS_LANG_TitleMessagesListView', 'Список писем');
	define('JS_LANG_TitleMessagesList', 'Список писем');
	define('JS_LANG_TitleViewMessage', 'Просмотр сообщения');
	define('JS_LANG_TitleNewMessage', 'Новое сообщение');

	define('JS_LANG_StandardLogin', 'Стандартный&nbsp;логин');
	define('JS_LANG_AdvancedLogin', 'Расширенный&nbsp;логин');

	define('JS_LANG_InfoWebMailLoading', 'Подождите, пока WebMail загрузится&hellip;');
	define('JS_LANG_Loading', 'Загрузка&hellip;');
	define('JS_LANG_InfoMessagesLoad', 'Подождите, пока WebMail загрузит список сообщений&hellip;');
	define('JS_LANG_InfoSendMessage', 'Сообщение успешно отправлено.');

	define('JS_LANG_ConfirmAreYouSure', 'Вы уверены?');
	define('JS_LANG_ConfirmEmptySubject', 'Поле темы пустое. Хотите продолжить?');

	define('JS_LANG_WarningEmailBlank', 'Необходимо заполнить поле Электропочта.');
	define('JS_LANG_WarningLoginBlank', 'Необходимо заполнить поле Логин.');
	define('JS_LANG_WarningToBlank', 'Необходимо заполнить поле Кому');
	define('JS_LANG_WarningServerPortBlank', 'Необходимо заполнить поля POP3 и<br />SMTP сервера/порта');
	define('JS_LANG_WarningMarkListItem', 'Выберите, пожалуйста, хотя бы один элемент в списке.');

	define('JS_LANG_WarningEmailFieldBlank', 'Необходимо заполнить поле Электропочта.');
	define('JS_LANG_WarningIncServerBlank', 'Необходимо заполнить поле POP3 сервера.');
	define('JS_LANG_WarningIncPortBlank', 'Необходимо заполнить поле порта POP3 сервера.');
	define('JS_LANG_WarningIncLoginBlank', 'Необходимо заполнить поле POP3 логина.');
	define('JS_LANG_WarningIncPortNumber', 'Необходимо указать положительное число в поле порта POP3 сервера.');
	define('JS_LANG_DefaultIncPortNumber', 'Значение порта POP3 по умолчанию - 110.');
	define('JS_LANG_WarningIncPassBlank', 'Необходимо заполнить поле POP3 пароля.');
	define('JS_LANG_WarningOutPortBlank', 'Необходимо заполнить поле порта SMTP сервера.');
	define('JS_LANG_WarningOutPortNumber', 'Необходимо указать положительное число в поле порта SMTP сервера.');
	define('JS_LANG_WarningCorrectEmail', 'Необходимо указать корректное значение электропочты.');
	define('JS_LANG_DefaultOutPortNumber', 'Значение порта SMTP по умолчанию - 25.');

	define('JS_LANG_ErrorConnectionFailed', 'Неудачное соединение.');
	define('JS_LANG_ErrorRequestFailed', 'Загрузка данных не была завершена.');
	define('JS_LANG_ErrorAbsentXMLHttpRequest', 'Объект XMLHttpRequest отсутствует.');
	define('JS_LANG_ErrorWithoutDesc', 'Произошла неизвестная ошибка.');
	define('JS_LANG_ErrorParsing', 'Ошибка разбора XML.');
	define('JS_LANG_ResponseText', 'Текст ответа:');
	define('JS_LANG_ErrorEmptyXmlPacket', 'Пустой XML пакет.');

	define('JS_LANG_LoggingToServer', 'Соединение с сервером&hellip;');
	define('JS_LANG_GettingMsgsNum', 'Получение количества сообщений');
	define('JS_LANG_RetrievingMessage', 'Получение сообщения');
	define('JS_LANG_DeletingMessage', 'Удаление сообщения');
	define('JS_LANG_DeletingMessages', 'Удаление сообщения(й)');
	define('JS_LANG_Of', 'из');
	define('JS_LANG_Connection', 'Соединение');
	define('JS_LANG_Charset', 'Кодировка');
	define('JS_LANG_AutoSelect', 'Автоматический выбор');

	define('JS_LANG_Logout', 'Выход');

	define('JS_LANG_NewMessage', 'Новое сообщение');
	define('JS_LANG_Reply', 'Ответить');
	define('JS_LANG_ReplyAll', 'Ответить всем');
	define('JS_LANG_Delete', 'Удалить');
	define('JS_LANG_Forward', 'Переслать');

	define('JS_LANG_NewMessages', 'Новые сообщения');
	define('JS_LANG_Messages', 'Сообщение(й)');

	define('JS_LANG_From', 'От');
	define('JS_LANG_To', 'Кому');
	define('JS_LANG_Date', 'Дата');
	define('JS_LANG_Size', 'Размер');
	define('JS_LANG_Subject', 'Тема');

	define('JS_LANG_FirstPage', 'Первая страница');
	define('JS_LANG_PreviousPage', 'Предыдущая страница');
	define('JS_LANG_NextPage', 'Следующая страница');
	define('JS_LANG_LastPage', 'Последняя страница');

	define('JS_LANG_SwitchToPlain', 'Переключить на простой текст');
	define('JS_LANG_SwitchToHTML', 'Переключить на HTML');
	define('JS_LANG_ClickToDownload', 'Кликните для загрузки');
	define('JS_LANG_View', 'Просмотр');
	define('JS_LANG_ShowFullHeaders', 'Показать все заголовки');
	define('JS_LANG_HideFullHeaders', 'Скрыть все заголовки');

	define('JS_LANG_YouUsing', 'Вы используете');
	define('JS_LANG_OfYour', 'из');
	define('JS_LANG_Mb', 'MB');
	define('JS_LANG_Kb', 'KB');
	define('JS_LANG_B', 'B');

	define('JS_LANG_SendMessage', 'Отправить');
	define('JS_LANG_SaveMessage', 'Сохранить');
	define('JS_LANG_Print', 'Печать');
	define('JS_LANG_PreviousMsg', 'Предыдущее сообщение');
	define('JS_LANG_NextMsg', 'Следующее сообщение');
	define('JS_LANG_ShowBCC', 'Показать скрытые копии');
	define('JS_LANG_HideBCC', 'Спрятать скрытые копии');
	define('JS_LANG_CC', 'Копии');
	define('JS_LANG_BCC', 'Скрытые копии');
	define('JS_LANG_ReplyTo', 'Обратный адрес');
	define('JS_LANG_AttachFile', 'Прикрепить файл');
	define('JS_LANG_Attach', 'Загрузить');
	define('JS_LANG_Re', 'Re');
	define('JS_LANG_OriginalMessage', 'Пересылаемое сообщение');
	define('JS_LANG_Sent', 'Отправлено');
	define('JS_LANG_Fwd', 'Fwd');
	define('JS_LANG_Low', 'Низкий');
	define('JS_LANG_Normal', 'Обычный');
	define('JS_LANG_High', 'Высокий');
	define('JS_LANG_Importance', 'Приоритет');
	define('JS_LANG_Close', 'Закрыть');
	
	define('JS_LANG_CharsetDefault', 'По умолчанию');
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
	define('WarningLoginFieldBlank', 'Необходимо ввести значение в поле Логин.');
	define('WarningCorrectLogin', 'Необходимо указать корректное значение поля Логин.');
	define('WarningPassBlank', 'Необходимо указать значение поля Пароль.');
	define('WarningCorrectIncServer', 'Необходимо указать корректное значение поля POP3 сервер.');
	define('WarningCorrectSMTPServer', 'Необходимо указать корректное значение поля SMTP сервер.');
	define('WarningFromBlank', 'Необходимо указать значение поля Кому.');

	define('ErrorSMTPConnect', 'Ошибка соединения с SMTP сервером. Проверьте настройки SMTP сервера.');
	define('ErrorSMTPAuth', 'Неправильные логин и/или пароль. Неудачная аутентификация.');
	define('ReportMessageSent', 'Ваше сообщение отправлено.');
	define('ReportMessageSaved', 'Ваше сообщение сохранено.');
	define('ErrorPOP3Connect', 'Ошибка соединения с POP3 сервером, проверьте настройки POP3 сервера.');
	define('ErrorPOP3IMAP4Auth', 'Неправильные электропочта, логин и/или пароль. Неудачная аутентификация.');
	define('ErrorGetMailLimit', 'Извините, превышен лимит использования вашего ящика.');

	define('FileLargerAttachment', 'Размер файла превышает Attachment Size limit.');
	define('FilePartiallyUploaded', 'Произошла неизвестная ошибка. Загружена только часть файла.');
	define('NoFileUploaded', 'Никакой файл не был загружен.');
	define('MissingTempFolder', 'Временная папка отсутствует.');
	define('MissingTempFile', 'Временный файл отсутствует.');
	define('UnknownUploadError', 'Произошла неизвестная ошибка загрузки файла.');
	define('FileLargerThan', 'Ошибка загрузки файла. Возможно, файл больше, чем ');
	define('PROC_CANT_LOAD_ACCT', 'Аккаунт не существует, возможно, он только что был удален.');
	
	define('DomainDosntExist', 'Такой домен отсутствует в почтовом сервере.');
	define('ServerIsDisable', 'Использование почтового сервера запрещено администратором.');
	
	define('PROC_CANT_MAIL_SIZE', 'Ошибка при попытке получить размер почтового ящика.');

	define('WarningOutServerBlank', 'Необходимо заполнить поле SMTP сервера.');

//
	define('JS_LANG_Refresh', 'Обновить');
	define('JS_LANG_MessagesInInbox', 'сообщение(й)');
	define('JS_LANG_InfoEmptyInbox', 'Нет сообщений');
?>