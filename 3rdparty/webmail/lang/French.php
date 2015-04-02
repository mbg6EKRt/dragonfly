<?php
	define('PROC_WRONG_ACCT_PWD', 'Mauvais mot de passe');
	define('PROC_CANT_GET_SETTINGS', 'Impossible d\'obtenir les paramètres');
	define('PROC_CANT_GET_MSG_LIST', 'Impossible d\'obtenir la liste des dossiers');
	define('PROC_MSG_HAS_DELETED', 'The message a été supprimé du serveur de mail');
	define('PROC_SESSION_ERROR', 'La précédente session a été terminée ŕ cause d\'un délai dépassé.');

	define('WebMailException', 'Une exception WEBMAIL est survenue');
	define('InvalidUid', 'Invalid Message UID');
	define('CantCreateUser', 'Impossible de créer l\'utilisateur');
	define('SessionIsEmpty', 'La session est vide');
	define('FileIsTooBig', 'Le fichier est trop gros');

	define('PROC_CANT_DEL_MSGS', 'Impossible d\'effacer message(s)');
	define('PROC_CANT_SEND_MSG', 'Impossible d\'envoyer le message.');

	define('PROC_CANT_LEAVE_BLANK', 'Vous ne pouvez pas laisser le champ * vide');
	
	define('LANG_LoginInfo', 'Information de l\'identifiant');
	define('LANG_Email', 'Email');
	define('LANG_Login', 'Identifiant');
	define('LANG_Password', 'Mot de passe');
	define('LANG_IncServer', 'Mail entrant');
	define('LANG_IncPort', 'Port');
	define('LANG_OutServer', 'SMTP Server');
	define('LANG_OutPort', 'Port');
	define('LANG_UseSmtpAuth', 'Utiliser l\'authentification SMTP');
	define('LANG_Enter', 'Entrer');

	define('JS_LANG_TitleLogin', 'Identifiant');
	define('JS_LANG_TitleMessagesListView', 'Liste des Messages');
	define('JS_LANG_TitleMessagesList', 'Liste des Messages');
	define('JS_LANG_TitleViewMessage', 'Voir un Message');
	define('JS_LANG_TitleNewMessage', 'Nouveau Message');

	define('JS_LANG_StandardLogin', 'Identification&nbsp;Standard');
	define('JS_LANG_AdvancedLogin', 'Identification&nbsp;avancée');

	define('JS_LANG_InfoWebMailLoading', 'Veuillez patienter pendant le chargement de WEBMAIL &hellip;');
	define('JS_LANG_Loading', 'Chargement &hellip;');
	define('JS_LANG_InfoMessagesLoad', 'Veuillez patienter pendant que WEBMAIL récupère la liste des messages');
	define('JS_LANG_InfoSendMessage', 'Le message a été envoyé');

	define('JS_LANG_ConfirmAreYouSure', 'Etes vous sûr ?');
	define('JS_LANG_ConfirmEmptySubject', 'Le sujet est vide. Voulez-vous continuer ?');

	define('JS_LANG_WarningEmailBlank', 'Vous ne pouvez pas laisser le champ<br />Email: champ vide');
	define('JS_LANG_WarningLoginBlank', 'Vous ne pouvez pas laisser le champ<br />Identifiant: champ vide');
	define('JS_LANG_WarningToBlank', 'Vous ne pouvez pas laisser le champ: zone vide');
	define('JS_LANG_WarningServerPortBlank', 'Vous ne pouvez pas laisser le champ POP3 et<br />SMTP server/port champ vides.');
	define('JS_LANG_WarningMarkListItem', 'Merci de choisir au moins un élément dans la liste.');

	define('JS_LANG_WarningEmailFieldBlank', 'Vous ne pouvez pas laisser le champ Email vide');
	define('JS_LANG_WarningIncServerBlank', 'Vous ne pouvez pas laisser le champ Serveur POP3 vide');
	define('JS_LANG_WarningIncPortBlank', 'Vous ne pouvez pas laisser le champ Serveur POP3 vide');
	define('JS_LANG_WarningIncLoginBlank', 'Vous ne pouvez pas laisser le champ Identifiant POP3 vide');
	define('JS_LANG_WarningIncPortNumber', 'Vous devez spécifier une valeur positive pour le port POP3');
	define('JS_LANG_DefaultIncPortNumber', 'Le numéro de port par défaut pour POP3 est 110.');
	define('JS_LANG_WarningIncPassBlank', 'Vous ne pouvez pas laisser le champ mot de passe POP3 vide');
	define('JS_LANG_WarningOutPortBlank', 'Vous ne pouvez pas laisser le champ port du serveur SMTP vide');
	define('JS_LANG_WarningOutPortNumber', 'Vous devez spécifier une valeur positive pour le port SMTP.');
	define('JS_LANG_WarningCorrectEmail', 'Vous devez spécifier l\'adresse email correctement.');
	define('JS_LANG_DefaultOutPortNumber', 'Le numéro du port SMTP par défaut est 25.');

	define('JS_LANG_ErrorConnectionFailed', 'Impossible de se connecter');
	define('JS_LANG_ErrorRequestFailed', 'Le transfert des données ne s\'est pas terminé');
	define('JS_LANG_ErrorAbsentXMLHttpRequest', 'L\'objet XMLHttpRequest n\'est pas présent.');
	define('JS_LANG_ErrorWithoutDesc', 'Une erreur inconnue et sans description est survenue');
	define('JS_LANG_ErrorParsing', 'Une erreur, lors de l\'analyse du fichier XML est survenue.');
	define('JS_LANG_ResponseText', 'Texte de réponse :');
	define('JS_LANG_ErrorEmptyXmlPacket', 'Les paquets de données XML sont vides');

	define('JS_LANG_LoggingToServer', 'Connexion au serveur &hellip;');
	define('JS_LANG_GettingMsgsNum', 'Réception du nombre de messages');
	define('JS_LANG_RetrievingMessage', 'Réception du message');
	define('JS_LANG_DeletingMessage', 'Effacement du message');
	define('JS_LANG_DeletingMessages', 'Effacement du (des) message(s)');
	define('JS_LANG_Of', 'de');
	define('JS_LANG_Connection', 'Connexion');
	define('JS_LANG_Charset', 'Caractère');
	define('JS_LANG_AutoSelect', 'sélection automatique');

	define('JS_LANG_Logout', 'Déconnexion');

	define('JS_LANG_NewMessage', 'Nouveau Message');
	define('JS_LANG_Reply', 'Répondre');
	define('JS_LANG_ReplyAll', 'Répondre à tous');
	define('JS_LANG_Delete', 'Effacer');
	define('JS_LANG_Forward', 'Transférer');

	define('JS_LANG_NewMessages', 'Nouveaux Messages');
	define('JS_LANG_Messages', 'Message(s)');

	define('JS_LANG_From', 'De');
	define('JS_LANG_To', 'A');
	define('JS_LANG_Date', 'Date');
	define('JS_LANG_Size', 'Taille');
	define('JS_LANG_Subject', 'Sujet');

	define('JS_LANG_FirstPage', 'Première Page');
	define('JS_LANG_PreviousPage', 'Page Précédente');
	define('JS_LANG_NextPage', 'Page Suivante');
	define('JS_LANG_LastPage', 'Dernière Page');

	define('JS_LANG_SwitchToPlain', 'Basculer vers du texte simple ');
	define('JS_LANG_SwitchToHTML', 'Basculer vers du texte HTML');
	define('JS_LANG_ClickToDownload', 'Cliquer pour télécharger ');
	define('JS_LANG_View', 'Voir');
	define('JS_LANG_ShowFullHeaders', 'Montrer l\'intégralité des entêtes du Email');
	define('JS_LANG_HideFullHeaders', 'Masquer les entêtes du Email');

	define('JS_LANG_YouUsing', 'Vous utilisez');
	define('JS_LANG_OfYour', 'de votre');
	define('JS_LANG_Mb', 'MB');
	define('JS_LANG_Kb', 'KB');
	define('JS_LANG_B', 'B');

	define('JS_LANG_SendMessage', 'Envoyer');
	define('JS_LANG_SaveMessage', 'Enregistrer');
	define('JS_LANG_Print', 'Imprimer');
	define('JS_LANG_PreviousMsg', 'Message Précédent');
	define('JS_LANG_NextMsg', 'Message Suivant');
	define('JS_LANG_ShowBCC', 'Montrer BCC');
	define('JS_LANG_HideBCC', 'Cacher BCC');
	define('JS_LANG_CC', 'CC');
	define('JS_LANG_BCC', 'BCC');
	define('JS_LANG_ReplyTo', 'Répondre&nbsp;à');
	define('JS_LANG_AttachFile', 'Attacher une pièce jointe');
	define('JS_LANG_Attach', 'Attacher');
	define('JS_LANG_Re', 'Re');
	define('JS_LANG_OriginalMessage', 'Message Original');
	define('JS_LANG_Sent', 'Envoyer');
	define('JS_LANG_Fwd', 'Transférer');
	define('JS_LANG_Low', 'Basse');
	define('JS_LANG_Normal', 'Normal');
	define('JS_LANG_High', 'Haute');
	define('JS_LANG_Importance', 'Importance');
	define('JS_LANG_Close', 'Fermer');
	
	define('JS_LANG_CharsetDefault', 'défaut');
	define('JS_LANG_CharsetArabicAlphabetISO', 'Alphabet arabe(ISO)');
	define('JS_LANG_CharsetArabicAlphabet', 'Alphabet arabe (Windows)');
	define('JS_LANG_CharsetBalticAlphabetISO', 'Alphabet baltique (ISO)');
	define('JS_LANG_CharsetBalticAlphabet', 'Alphabet baltique (Windows)');
	define('JS_LANG_CharsetCentralEuropeanAlphabetISO', 'Alphabet de l\'Europe centrale (ISO)');
	define('JS_LANG_CharsetCentralEuropeanAlphabet', 'Alphabet de l\'Europe centrale (Windows)');
	define('JS_LANG_CharsetChineseSimplifiedEUC', 'Chinese Simplified (EUC)');
	define('JS_LANG_CharsetChineseSimplifiedGB', 'Chinese Simplified (GB2312)');
	define('JS_LANG_CharsetChineseTraditional', 'Chinois Traditionnel (Big5)');
	define('JS_LANG_CharsetCyrillicAlphabetISO', 'Alphabet cyrillique (ISO)');
	define('JS_LANG_CharsetCyrillicAlphabetKOI8R', 'Alphabet cyrillique (KOI8-R)');
	define('JS_LANG_CharsetCyrillicAlphabet', 'Alphabet cyrillique (Windows)');
	define('JS_LANG_CharsetGreekAlphabetISO', 'Alphabet Grec (ISO)');
	define('JS_LANG_CharsetGreekAlphabet', 'Alphabet Grec (Windows)');
	define('JS_LANG_CharsetHebrewAlphabetISO', 'Alphabet hébreu (ISO)');
	define('JS_LANG_CharsetHebrewAlphabet', 'Alphabet hébreu (Windows)');
	define('JS_LANG_CharsetJapanese', 'Japonais');
	define('JS_LANG_CharsetJapaneseShiftJIS', 'Japonais (Shift-JIS)');
	define('JS_LANG_CharsetKoreanEUC', 'Coréen  (EUC)');
	define('JS_LANG_CharsetKoreanISO', 'Coréen  (ISO)');
	define('JS_LANG_CharsetLatin3AlphabetISO', 'Alphabet Latin 3(ISO)');
	define('JS_LANG_CharsetTurkishAlphabet', 'Alphabet Turc');
	define('JS_LANG_CharsetUniversalAlphabetUTF7', 'Alphabet Universel (UTF-7)');
	define('JS_LANG_CharsetUniversalAlphabetUTF8', 'Alphabet Universel (UTF-8)');
	define('JS_LANG_CharsetVietnameseAlphabet', 'Alphabet vietnamien (Windows)');
	define('JS_LANG_CharsetWesternAlphabetISO', 'Alphabet Occidental (ISO)');
	define('JS_LANG_CharsetWesternAlphabet', 'Alphabet Occidental (Windows)');

// webmail 4.1 constants
	define('WarningLoginFieldBlank', 'Vous ne pouvez pas laisser le champ Login (nom d\'utilisateur) vide.');
	define('WarningCorrectLogin', 'Vous devriez spécifier un nom d\'utilisateur (Login) correct.');
	define('WarningPassBlank', 'Vous ne pouvez pas laissez le champ Mot de Passe vide.');
	define('WarningCorrectIncServer', 'Vous devriez spécifier une adresse de serveur POP3 correcte.');
	define('WarningCorrectSMTPServer', 'Vous devriez spécifier une adresse de serveur SMTP correcte.');
	define('WarningFromBlank', 'Vous ne pouvez pas laisser le champ DE vide.');

	define('ErrorSMTPConnect', 'Impossible de se connecter au serveur SMTP. Vérifiez les paramètres de votre serveur SMTP.');
	define('ErrorSMTPAuth', 'Mauvais nom d\'utilisateur ou mot de passe. L\'authentification a échoué.');
	define('ReportMessageSent', 'Votre message a été envoyé.');
	define('ReportMessageSaved', 'Votre message a été enregistré.');
	define('ErrorPOP3Connect', 'Impossible de se connecter au serveur POP3, vérifiez les paramètres du serveur POP3.');
	define('ErrorPOP3IMAP4Auth', 'Mauvais email/nom d\'utilisateur ou mot de passe. l\'authentification a échoué.');
	define('ErrorGetMailLimit', 'Désolé, votre boite mail dépasse la taille limite.');

	define('FileLargerAttachment', 'Le fichier attaché dépasse la taille maximum autorisée.');
	define('FilePartiallyUploaded', 'Seulement une partie du fichier a été télécharger à cause d\'une erreur.');
	define('NoFileUploaded', 'Aucun fichier n\'a été télécharger.');
	define('MissingTempFolder', 'Le répertoire temporaire est manquant.');
	define('MissingTempFile', 'Le fichier temporaire est manquant.');
	define('UnknownUploadError', 'Une erreur inattendue est survenue lors du téléchargement du fichier.');
	define('FileLargerThan', 'Erreur de téléchargement. Vraisemblablement, le fichier est plus grand que');
	define('PROC_CANT_LOAD_ACCT', 'Le compte n\'existe pas, peut-être a t\'il été effacé.');

	define('DomainDosntExist', 'Ce nom de domaine n\'existe pas sur le serveur de mails.');
	define('ServerIsDisable', 'L\'utilisation du serveur de mail par un administrateur est interdite.');

	define('PROC_CANT_MAIL_SIZE', 'Impossible d\'obtenir la taille du message.');

	define('WarningOutServerBlank', 'Vous ne pouvez pas laisser le champ Serveur SMTP vide');

//
	define('JS_LANG_Refresh', 'Rafraîchir');
	define('JS_LANG_MessagesInInbox', 'Messages');
	define('JS_LANG_InfoEmptyInbox', 'Pas de messages');
?>