<?php
	define('PROC_WRONG_ACCT_PWD', 'A senha da conta está errada');
	define('PROC_CANT_GET_SETTINGS', 'Não foi possível carregar as configurações');
	define('PROC_CANT_GET_MSG_LIST', 'Não foi possível carregar a lista de mensagens');
	define('PROC_MSG_HAS_DELETED', 'Esta mensagem já tinha sido excluída do servidor de e-mail');
	define('PROC_SESSION_ERROR', 'A sessão foi terminada devido ao longo período de inatividade na conta.');

	define('WebMailException', 'Ocorreu um erro desconhecido');
	define('InvalidUid', 'Invalid Message UID');
	define('CantCreateUser', 'Não foi possível criar usuário');
	define('SessionIsEmpty', 'A sessão está vazia');
	define('FileIsTooBig', 'O arquivo é muito grande');

	define('PROC_CANT_DEL_MSGS', 'Não foi possível excluir a(s) mensagem(s)');
	define('PROC_CANT_SEND_MSG', 'Não foi possível enviar mensagem:');

	define('PROC_CANT_LEAVE_BLANK', 'Você não pode deixar em branco os campos assinalados com *');

	define('LANG_LoginInfo', 'Informações para o Login');
	define('LANG_Email', 'Email');
	define('LANG_Login', 'Login');
	define('LANG_Password', 'Senha');
	define('LANG_IncServer', 'Servidor de entrada');
	define('LANG_IncPort', 'Porta');
	define('LANG_OutServer', 'Servidor de saída');
	define('LANG_OutPort', 'Porta');
	define('LANG_UseSmtpAuth', 'Autenticação');
	define('LANG_Enter', 'Entrar');

	define('JS_LANG_TitleLogin', 'Login');
	define('JS_LANG_TitleMessagesListView', 'Lista de Mensagens');
	define('JS_LANG_TitleMessagesList', 'Lista de Mensagens');
	define('JS_LANG_TitleViewMessage', 'Exibir Mensagem');
	define('JS_LANG_TitleNewMessage', 'Nova Mensagem');

	define('JS_LANG_StandardLogin', 'Login&nbsp;padrão');
	define('JS_LANG_AdvancedLogin', 'Login&nbsp;avançado');

	define('JS_LANG_InfoWebMailLoading', 'Por favor aguarde, carregando &hellip;');
	define('JS_LANG_Loading', 'Carregando &hellip;');
	define('JS_LANG_InfoMessagesLoad', 'Por favor aguarde, carregando lista de mensagens');
	define('JS_LANG_InfoSendMessage', 'A mensagem foi enviada');

	define('JS_LANG_ConfirmAreYouSure', 'Você tem certeza?');
	define('JS_LANG_ConfirmEmptySubject', 'O campo assunto está em branco. Tem certeza que deseja continuar?');

	define('JS_LANG_WarningEmailBlank', 'Você não pode deixar<br />o campo e-mail em branco');
	define('JS_LANG_WarningLoginBlank', 'Você não pode deixar<br />o campo login em branco');
	define('JS_LANG_WarningToBlank', 'Você não pode deixar: Campos em branco');
	define('JS_LANG_WarningServerPortBlank', 'Preencha os campos POP3 e SMTP server');
	define('JS_LANG_WarningMarkListItem', 'Por favor, selecione pelo menos um ítem');

	define('JS_LANG_WarningEmailFieldBlank', 'Você deve preencher o campo E-mail');
	define('JS_LANG_WarningIncServerBlank', 'Você deve preencher o campo POP3 Server');
	define('JS_LANG_WarningIncPortBlank', 'Você deve preencher o campo POP3 Server Port');
	define('JS_LANG_WarningIncLoginBlank', 'Você deve preencher o campo POP3 Login');
	define('JS_LANG_WarningIncPortNumber', 'Você deve especificar um número positivo no campo porta POP3.');
	define('JS_LANG_DefaultIncPortNumber', 'A porta padrão POP3 é 110.');
	define('JS_LANG_WarningIncPassBlank', 'Você deve preencher o campo senha POP3');
	define('JS_LANG_WarningOutPortBlank', 'Você deve preencher o campo porta SMTP Server');
	define('JS_LANG_WarningOutPortNumber', 'Você deve especificar um número positivo no campo porta SMTP.');
	define('JS_LANG_WarningCorrectEmail', 'Informe um e-mail válido.');
	define('JS_LANG_DefaultOutPortNumber', 'A porta padrão SMTP é 25.');

	define('JS_LANG_ErrorConnectionFailed', 'Não foi possível conectar');
	define('JS_LANG_ErrorRequestFailed', 'A transferência dos dados não foi completada');
	define('JS_LANG_ErrorAbsentXMLHttpRequest', 'O objeto XMLHttpRequest está ausente');
	define('JS_LANG_ErrorWithoutDesc', 'Ocorreu um erro desconhecido');
	define('JS_LANG_ErrorParsing', 'Erro durante análise XML.');
	define('JS_LANG_ResponseText', 'Texto de Resposta:');
	define('JS_LANG_ErrorEmptyXmlPacket', 'Pacote XML vazio');

	define('JS_LANG_LoggingToServer', 'Conectando no servidor  &hellip;');
	define('JS_LANG_GettingMsgsNum', 'Recebendo total de mensagens');
	define('JS_LANG_RetrievingMessage', 'Baixando mensagem');
	define('JS_LANG_DeletingMessage', 'Excluindo mensagem');
	define('JS_LANG_DeletingMessages', 'Excluindo mensagem(s)');
	define('JS_LANG_Of', 'of');
	define('JS_LANG_Connection', 'Conexão');
	define('JS_LANG_Charset', 'Charset');
	define('JS_LANG_AutoSelect', 'Auto seleção');

	define('JS_LANG_Logout', 'Sair');

	define('JS_LANG_NewMessage', 'Nova mensagem');
	define('JS_LANG_Reply', 'Responder');
	define('JS_LANG_ReplyAll', 'Responder para todos');
	define('JS_LANG_Delete', 'Excluir');
	define('JS_LANG_Forward', 'Encaminhar');

	define('JS_LANG_NewMessages', 'Novas mensagens');
	define('JS_LANG_Messages', 'Mensagem(s)');

	define('JS_LANG_From', 'De');
	define('JS_LANG_To', 'Para');
	define('JS_LANG_Date', 'Data');
	define('JS_LANG_Size', 'Tamanho');
	define('JS_LANG_Subject', 'Assunto');

	define('JS_LANG_FirstPage', 'Primeira página');
	define('JS_LANG_PreviousPage', 'Página anterior');
	define('JS_LANG_NextPage', 'Próxima página');
	define('JS_LANG_LastPage', 'Ultima página');

	define('JS_LANG_SwitchToPlain', 'Exibir em modo texto');
	define('JS_LANG_SwitchToHTML', 'Exibir em modo HTML');
	define('JS_LANG_ClickToDownload', 'Clique para copiar');
	define('JS_LANG_View', 'Exibir');
	define('JS_LANG_ShowFullHeaders', 'Mostrar Cabeçalho completo');
	define('JS_LANG_HideFullHeaders', 'Ocultar Cabeçalho completo');

	define('JS_LANG_YouUsing', 'Você está usando');
	define('JS_LANG_OfYour', 'of your');
	define('JS_LANG_Mb', 'MB');
	define('JS_LANG_Kb', 'KB');
	define('JS_LANG_B', 'B');

	define('JS_LANG_SendMessage', 'Enviar');
	define('JS_LANG_SaveMessage', 'Salvar');
	define('JS_LANG_Print', 'Imprimir');
	define('JS_LANG_PreviousMsg', 'Mensagens anterior');
	define('JS_LANG_NextMsg', 'Próxima mensagem');
	define('JS_LANG_ShowBCC', 'Mostrar Bcc');
	define('JS_LANG_HideBCC', 'Ocultar Bcc');
	define('JS_LANG_CC', 'Cc');
	define('JS_LANG_BCC', 'Bcc');
	define('JS_LANG_ReplyTo', 'Responder&nbsp;para');
	define('JS_LANG_AttachFile', 'Anexar arquivo');
	define('JS_LANG_Attach', 'Anexar');
	define('JS_LANG_Re', 'Re');
	define('JS_LANG_OriginalMessage', 'Mensagem original');
	define('JS_LANG_Sent', 'Enviada');
	define('JS_LANG_Fwd', 'Fwd');
	define('JS_LANG_Low', 'Baixa');
	define('JS_LANG_Normal', 'Normal');
	define('JS_LANG_High', 'Alta');
	define('JS_LANG_Importance', 'Urgente');
	define('JS_LANG_Close', 'Fechar');

	define('JS_LANG_CharsetDefault', 'Padrão');
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

//webmail 4.1 constants
	define('WarningLoginFieldBlank', 'Você não pode deixar o campo login em branco.');
	define('WarningCorrectLogin', 'Você deve especificar um login correto.');
	define('WarningPassBlank', 'Você não pode deixar o campo senha em branco.');
	define('WarningCorrectIncServer', 'Você deve especificar um servidor POP3 correto.');
	define('WarningCorrectSMTPServer', 'Você deve especificar um servidor SMTP correto.');
	define('WarningFromBlank', 'Você não pode deixar o campo De em branco.');

	define('ErrorSMTPConnect', 'Não foi possível conectar no servidor SMTP. Verifique suas configurações.');
	define('ErrorSMTPAuth', 'Login ou senha inválidos. Falha na autenticação.');
	define('ReportMessageSent', 'Sua mensagem foi enviada com sucesso.');
	define('ReportMessageSaved', 'Sua mensagem foi salva com sucesso.');
	define('ErrorPOP3Connect', 'Não foi possível conectar no servidor POP3. Verifique suas configurações.');
	define('ErrorPOP3IMAP4Auth', 'Login ou senha inválidos. Falha na autenticação.');
	define('ErrorGetMailLimit', 'Desculpe, seu limite de caixa postal excedeu.');

	define('FileLargerAttachment', 'O arquivo em anexo excedeu o limite permitido.');
	define('FilePartiallyUploaded', 'Somente uma parte do arquivo foi anexado devido a um erro desconhecido.');
	define('NoFileUploaded', 'Nenhum arquivo foi anexado.');
	define('MissingTempFolder', 'A pasta temporária está faltando.');
	define('MissingTempFile', 'O arquivo temporário está faltando.');
	define('UnknownUploadError', 'Um erro desconhecido ocorreu ao anexar o arquivo.');
	define('FileLargerThan', 'Erro anexando arquivo. provavelmente, o arquivo é maior do que  ');
	define('PROC_CANT_LOAD_ACCT', 'A conta não existe, talvez, ela tenha sido excluída.');

	define('DomainDosntExist', 'O domínio não existe no servidor.');
	define('ServerIsDisable', 'O uso do servidor está proibido pelo administrador.');

	define('PROC_CANT_MAIL_SIZE', 'Não foi possível pegar o tamanho da mensagem.');

	define('WarningOutServerBlank', 'Você não pode deixar o campo SMTP em branco.');

//
	define('JS_LANG_Refresh', 'Refresh');
	define('JS_LANG_MessagesInInbox', 'Mensagens');
	define('JS_LANG_InfoEmptyInbox', 'Nenhuma mensagens');
?>