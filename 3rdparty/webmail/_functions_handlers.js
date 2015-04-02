function SetHistoryHandler(args)
{
	scrId = args.ScreenId;
	args = WebMail.CheckHistoryObject(args);
	if (null != args) {
		HistoryStorage.AddStep({FunctionName: 'WebMail.RestoreFromHistory', Args: args});
	}
}

/**********************************************/
function DblClickHandler()
{
	var screen = WebMail.Screens[WebMail.ScreenId];
	if (screen)
	{
		if (screen.Id == SCREEN_MESSAGES_LIST_VIEW || screen.Id == SCREEN_MESSAGES_LIST)
		{
			var msg = new CMessage();
			msg.GetFromIdForList(screen._SEPARATOR, this.id);
			var screenId = SCREEN_VIEW_MESSAGE;
			var parts = [PART_MESSAGE_HEADERS, PART_MESSAGE_HTML, PART_MESSAGE_ATTACHMENTS];
			SetHistoryHandler(
				{
					ScreenId: screenId,
					MsgUid: msg.Uid,
					MsgCharset: msg.Charset,
					MsgParts: parts
				}
			);
		}
	}
}

function ClickMessageHandler(id)
{
	var screen = WebMail.Screens[WebMail.ScreenId];
	if (screen)
	{
		if (screen.Id == SCREEN_MESSAGES_LIST_VIEW)
		{
			screen._needPlain = false;
			var msg = new CMessage();
			msg.GetFromIdForList(screen._SEPARATOR, id);
			if (null == screen._msgObj || msg.Uid != screen._msgObj.Uid || msg.Charset != screen._msgObj.Charset) {
				screen.CleanMessageBody();
				var parts = [PART_MESSAGE_HEADERS, PART_MESSAGE_HTML, PART_MESSAGE_ATTACHMENTS];
				SetHistoryHandler(
					{
						ScreenId: screen.Id,
						Page: screen._page,
						MsgUid: msg.Uid,
						MsgCharset: msg.Charset,
						MsgParts: parts
					}
				);
			}
		}
	}
}

function ResizeMessagesTab(number)
{
	var screen = WebMail.Screens[WebMail.ScreenId];
	if (screen)
	{
		if (screen.Id == SCREEN_MESSAGES_LIST_VIEW || screen.Id == SCREEN_MESSAGES_LIST)
		{
			screen._inboxTable.ResizeColumnsWidth(number);
		}
	}	
}
/**********************************************/
function GetMessagesListHandler(redrawIndex, page) {
	var screen = WebMail.Screens[WebMail.ListScreenId];
	if (screen) screen.RedrawControls(redrawIndex, page);
	WebMail.DataSource.Get(TYPE_MESSAGES_LIST, { Page: page }, [], '' );
}

function GetMessageHandler(messageUid, messageParts, charset) {
	var msg = new CMessage();
	msg.Uid = messageUid;
	msg.Charset = charset;
	var msgId = msg.GetIdForList(screen._SEPARATOR, screen.Id);
	if (null == charset || 'undefined' == charset)
	{
		charset = AUTOSELECT_CHARSET;
	}
	var xml = '<param name="uid">' + GetCData(HtmlDecode(messageUid)) + '</param>';
	WebMail.DataSource.Get(TYPE_MESSAGE, {Charset: charset, Uid: messageUid}, messageParts, xml );
}

function RequestMessagesOperationHandler(type, idArray) {
	var screenId = WebMail.ScreenId;
	var screen = WebMail.Screens[screenId];
	if (type != -1 && screenId == WebMail.ListScreenId) {
		screen.GetXmlMessagesOperation(type, idArray);
	}
}

function GetHandler(type, params, parts, xml) {
	WebMail.DataSource.Get(type, params, parts, xml);
}
/**********************************************/
function SelectScreenHandler(screenId) {
	WebMail.ScreenIdForLoad = screenId;
	ShowScreenHandler();
}

function ShowScreenHandler() {
	WebMail.ShowScreen(ShowScreenHandler);
}

function LoadHandler() {
	WebMail.HideInfo();
	//alert(['RECIEVE', this.responseText]);//
	WebMail.DataSource.ParseXML(this.responseXML, this.responseText);
}

function ErrorHandler() {
	WebMail.ShowError(this.ErrorDesc);
}

function InfoHandler() {
	WebMail.ShowInfo(this.Info);
	setTimeout("WebMail.HideInfo();", 10000);
}

function ShowLoadingInfoHandler() {
	WebMail.ShowInfo(Lang.Loading);
}

function TakeDataHandler() {
	if (this.Data) {
		WebMail.PlaceData(this.Data);
	}
}

function RequestHandler(action, request, xml) {
	WebMail.DataSource.Request({action: action, request: request}, xml);
}

function RequestUserSettings(xml) {
	WebMail.DataSource.Request({action: 'update', request: 'settings'}, xml);
}

function RequestAccountProperties(xml) {
	WebMail.DataSource.Request({action: 'update', request: 'account'}, xml);
}

function RequestAddAccountProperties(xml) {
	WebMail.DataSource.Request({action: 'new', request: 'account'}, xml);
}

function RemoveAccountHandle(id) {
	WebMail.DataSource.Request({action: 'delete', request: 'account', 'id_acct': id}, '');
}

function ResizeBodyHandler() {
	if (WebMail) {
		WebMail.ResizeBody('all');
	}
}

function ClickBodyHandler(ev) {
	if (WebMail) {
		WebMail.ClickBody(ev);
	}
}

function LoadAttachmentHandler(attachment) {
	WebMail.LoadAttachment(attachment);
}

Ready(INIT_FUNCTIONS_HANDLERS);