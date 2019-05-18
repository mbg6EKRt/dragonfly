// defines for sections
var SECTION_LOGIN    = 0;
var SECTION_MAIL     = 1;

// defines for screens
var SCREEN_LOGIN              = 0;
var SCREEN_MESSAGES_LIST_VIEW = 1;
var SCREEN_MESSAGES_LIST      = 2;
var SCREEN_VIEW_MESSAGE       = 3;
var SCREEN_NEW_MESSAGE        = 4;

var Sections = Array();
Sections[SECTION_LOGIN]    = {Scripts: [], Screens: Array()}
Sections[SECTION_MAIL]     = {Scripts: [], Screens: Array()}
Sections[SECTION_MAIL].Screens[SCREEN_MESSAGES_LIST_VIEW] = 'screen = new CMessagesListViewScreen(SkinName);';
Sections[SECTION_MAIL].Screens[SCREEN_MESSAGES_LIST] = 'screen = new CMessagesListScreen(SkinName);';
Sections[SECTION_MAIL].Screens[SCREEN_VIEW_MESSAGE] = 'screen = new CViewMessageScreen(SkinName);';
Sections[SECTION_MAIL].Screens[SCREEN_NEW_MESSAGE] = 'screen = new CNewMessageScreen(SkinName);';

var Screens = Array();
Screens[SCREEN_LOGIN]              = {SectionId: SECTION_LOGIN,    PreRender: true,  ShowHandler: ''}
Screens[SCREEN_MESSAGES_LIST_VIEW] = {SectionId: SECTION_MAIL,     PreRender: true,  ShowHandler: ''}
Screens[SCREEN_MESSAGES_LIST]      = {SectionId: SECTION_MAIL,     PreRender: false, ShowHandler: ''}
Screens[SCREEN_VIEW_MESSAGE]       = {SectionId: SECTION_MAIL,     PreRender: false, ShowHandler: ''}
Screens[SCREEN_NEW_MESSAGE]        = {SectionId: SECTION_MAIL,     PreRender: true,  ShowHandler: ''}

// defines data types
var TYPE_SETTINGS_LIST      = 0;
var TYPE_UPDATE             = 1;
var TYPE_MESSAGES_LIST      = 4;
var TYPE_MESSAGES_OPERATION = 5;
var TYPE_MESSAGE            = 6;
var TYPE_ACCOUNT_PROPERTIES = 8;

//defines for reply
var REPLY     = 0;
var REPLY_ALL = 1;
var FORWARD   = 2;

//defines images for reply
var Reply = Array();
Reply[REPLY]     = {Image: 'reply.gif',    LangField: 'Reply'}
Reply[REPLY_ALL] = {Image: 'replyall.gif', LangField: 'ReplyAll'}

//defines for delete
var DELETE   = 6;

var Delete = Array();
Delete[DELETE]   = {Image: 'delete.gif', LangField: 'Delete'}

var OperationTypes = Array();
OperationTypes[DELETE]          = 'delete';

//defines for inbox headers
var IH_CHECK       = 0;
var IH_ATTACHMENTS = 1;
var IH_FROM        = 3;
var IH_TO          = 4;
var IH_DATE        = 5;
var IH_SIZE        = 6;
var IH_SUBJECT     = 7;
var IH_CC          = 8;
var IH_BCC         = 9;
var IH_REPLY_TO    = 10;

var InboxHeaders = Array();
InboxHeaders[IH_CHECK] =
{
	DisplayField: 'Check',
	LangField: '',
	Picture: '',
	Align: 'center', 
	Width: 24,
	MinWidth: 24,
	IsResize: false
}
InboxHeaders[IH_ATTACHMENTS] =
{
	DisplayField: 'HasAttachments',
	LangField: '',
	Picture: 'menu/attachment.gif',
	Align: 'center', 
	Width: 20,
	MinWidth: 20,
	IsResize: false
}
InboxHeaders[IH_FROM] =
{
	DisplayField: 'FromAddr',
	LangField: 'From',
	Picture: '',
	Align: 'left', 
	Width: 150,
	MinWidth: 100,
	IsResize: false
}
InboxHeaders[IH_TO] =
{
	DisplayField: 'ToAddr',
	LangField: 'To',
	Picture: '',
	Align: 'left', 
	Width: 150,
	MinWidth: 100,
	IsResize: false
}
InboxHeaders[IH_DATE] =
{
	DisplayField: 'Date',
	LangField: 'Date',
	Picture: '',
	Align: 'center', 
	Width: 140,
	MinWidth: 100,
	IsResize: false
}
InboxHeaders[IH_SIZE] =
{
	DisplayField: 'Size',
	LangField: 'Size',
	Picture: '',
	Align: 'center', 
	Width: 50,
	MinWidth: 40,
	IsResize: false
}
InboxHeaders[IH_SUBJECT] =
{
	DisplayField: 'Subject',
	LangField: 'Subject',
	Picture: '',
	Align: 'left', 
	Width: 150,
	MinWidth: 100,
	IsResize: false
}
InboxHeaders[IH_CC] =
{
	DisplayField: 'CCAddr',
	LangField: 'CC',
	Picture: '',
	Align: 'center', 
	Width: 100,
	MinWidth: 100,
	IsResize: false
}
InboxHeaders[IH_BCC] =
{
	DisplayField: 'BCCAddr',
	LangField: 'BCC',
	Picture: '',
	Align: 'center', 
	Width: 100,
	MinWidth: 100,
	IsResize: false
}
InboxHeaders[IH_REPLY_TO] =
{
	DisplayField: 'ReplyToAddr',
	LangField: 'ReplyTo',
	Picture: '',
	Align: 'center', 
	Width: 100,
	MinWidth: 100,
	IsResize: false
}

//defines for parts of message type
var PART_MESSAGE_HEADERS               = 0;
var PART_MESSAGE_HTML                  = 1;
var PART_MESSAGE_MODIFIED_PLAIN_TEXT   = 2;
var PART_MESSAGE_REPLY_HTML            = 3;
var PART_MESSAGE_REPLY_PLAIN           = 4;
var PART_MESSAGE_FORWARD_HTML          = 5;
var PART_MESSAGE_FORWARD_PLAIN         = 6;
var PART_MESSAGE_FULL_HEADERS          = 7;
var PART_MESSAGE_ATTACHMENTS           = 8;
var PART_MESSAGE_UNMODIFIED_PLAIN_TEXT = 9;
 
// defines ready states
var READY_STATE_UNINITIALIZED = 0;
var READY_STATE_LOADING       = 1;
var READY_STATE_LOADED        = 2;
var READY_STATE_INTERACTIVE   = 3;
var READY_STATE_COMPLETE      = 4;

// defines for toolbar items
var TOOLBAR_NEW_MESSAGE     = 0;
var TOOLBAR_REFRESH         = 1;
var TOOLBAR_DELETE          = 3;
var TOOLBAR_FORWARD         = 5;
var TOOLBAR_SEND_MESSAGE    = 9;
var TOOLBAR_SAVE_MESSAGE    = 10;
var TOOLBAR_PRINT_MESSAGE   = 11;
var TOOLBAR_PREV_MESSAGE    = 12;
var TOOLBAR_NEXT_MESSAGE    = 13;

var REDRAW_NOTHING = 0;
var REDRAW_PAGE    = 3;

var AUTOSELECT_CHARSET = -1;

var VIEW_MODE_WITH_PANE     = 1;

var Fonts = ['Arial', 'Arial Black', 'Courier New', 'Tahoma', 'Times New Roman', 'Verdana']

Ready(INIT_DEFINES);