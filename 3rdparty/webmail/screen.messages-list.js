/*
Classes:
	CMessagesListScreen
*/

function CMessagesListScreen(skinName)
{
	this.Id = SCREEN_MESSAGES_LIST;
	this.isBuilded = false;
	this.hasCopyright = true;
	this.shown = false;

	this._showTextLabels = true;
	this._mailboxLimit = 0;
	this._skinName = skinName;
	this._messagesPerPage = 0;
	
	this._page = 1;

	this._SEPARATOR = '@#%';

	this._mainContainer = null;

	this._toolBar = null;
	this._pop3DeleteTool = null;

	this._pageSwitcher = null;

	this._inboxContainer = null;
	this._inboxTable = null;
	this._fromToColumn = null;
	this._inboxLines = null;
	this._selection = new CSelection();
	this._inboxWidth = 361;
	this._inboxBordersWidth = 1;
	this._messagesObj = null;
	this._messagesCount = 0;

	this._messagesInInbox = null;
	this._spaceInfo = null;
	this._spaceProgressBar = null;

	this.PlaceData = function (Data)
	{
		var Type = Data.Type;
		switch (Type){
			case TYPE_MESSAGES_LIST:
				this.PlaceMessagesList(Data);
				break;
			case TYPE_MESSAGES_OPERATION:
				this.PlaceMessagesOperation(Data);
				break;
		}
	}
	
	this.ResizeBody = function (mode)
	{
		if (this.isBuilded) {
			var width = GetWidth();
			if (width < 550) {
				width = 550;
			}
			this.ResizeInboxContainerWidth(width);
			this.ResizeInboxWidth();
			if (null != this._pageSwitcher) this._pageSwitcher.Replace(this._inboxLines);
		}
	}
	
	this.ParseSettings = function (settings)
	{
		this._showTextLabels = settings.ShowTextLabels;
		this._mailboxLimit = settings.MailBoxLimit;
		this.ChangeSkin(settings.DefSkin);
		if (this._messagesPerPage != settings.MsgsPerPage) {
			if (this.isBuilded) {
				this._page = 1;
				this._messagesPerPage = settings.MsgsPerPage;
				SetHistoryHandler(
					{
						ScreenId: this.Id,
						Page: this._page,
						MsgUid: null,
						MsgCharset: null,
						MsgParts: null
					}
				);
			} else {
				this.RedrawPages(this._page);
			}
		} else {
			this.RedrawPages(this._page);
		}
	}
	
	this.ChangeSkin = function (newSkin)
	{
		if (this._skinName != newSkin) {
			this._skinName = newSkin;
			if (this.isBuilded) {
				this._toolBar.ChangeSkin(newSkin);
				this._inboxTable.ChangeSkin(newSkin);
				this.RedrawPages(this._page);
				this.FillByMessages();
			}
		}
	}
	
	this.Build = function (container, accountsBar, PopupMenus, settings)
	{
		var obj = this;
		this.ParseSettings(settings);
		this._mainContainer = CreateChild(container, 'div');
		this._mainContainer.className = 'wm_hide';

		this.BuildToolBar(PopupMenus);

		var div = CreateChild(this._mainContainer, 'div');
		div.className = 'wm_background';
		var tbl = CreateChild(div, 'table');
		tbl.className = 'wm_mail_container';
		var tr = tbl.insertRow(0);

		this._inboxContainer = tr.insertCell(0);
		this._inboxContainer.onmousedown = function (ev)
		{
			if (obj._selection.Length > 0 && isRightClick(ev))
			{
				obj._selection.UncheckAll();
			}
			return false;
		}
		this.BuildInboxTable();

		tr = tbl.insertRow(1);
		td = tr.insertCell(0);
		td.className = 'wm_lowtoolbar';
		var span = CreateChild(td, 'span');
		this._messagesInInbox = span;
		span.className = 'wm_lowtoolbar_messages';
		this.WriteMsgsCountInInbox(0);
		this._spaceInfo = CreateChild(td, 'span');
		this._spaceInfo.className = 'wm_lowtoolbar_space_info';
		div = CreateChild(this._spaceInfo, 'div');
		div.className = 'wm_progressbar';
		this._spaceProgressBar = CreateChild(div, 'div');
		this._spaceProgressBar.className = 'wm_progressbar_used';

		this.isBuilded = true;
	}//Build
	
	this.BuildToolBar = function (PopupMenus)
	{
		var obj = this;
		var toolbar = new CToolBar(this._mainContainer, this._skinName);
		//new message tool
		var item = toolbar.AddItem(TOOLBAR_NEW_MESSAGE, function ()
		{
			SetHistoryHandler(
			{
				ScreenId: SCREEN_NEW_MESSAGE,
				ForReply: false
			});
		}, false);
		//refresh tool
		item = toolbar.AddItem(TOOLBAR_REFRESH, function ()
		{
			WebMail.DataSource.Cache.ClearMessagesList();
			GetMessagesListHandler(REDRAW_NOTHING, obj._page);
		}, false);
		//delete tool
		this._pop3DeleteTool = toolbar.AddItem(TOOLBAR_DELETE, function () { RequestMessagesOperationHandler(DELETE, [], 0); }, false);

		this._toolBar = toolbar;
	}
}

MessagesListPrototype = {
	PlaceMessagesList: function (Data)
	{
		this._messagesObj = Data;
		if (this.shown) {
			this._page = Data.Page;
			this.WriteMsgsCountInInbox(Data.MessagesCount);
			this.FillByMessages();
		}
	},

	PlaceMessagesOperation: function (Data)
	{
		if (this.shown && Data.OperationInt == DELETE)
		{
			WebMail.DataSource.Cache.ClearMessagesList();
			GetMessagesListHandler(REDRAW_NOTHING, this._page);
		}
	},

	Show: function (settings, historyArgs)
	{
		this.shown = true;
		this._mainContainer.className = '';
		this.ParseSettings(settings);
		this.ResizeBody('all');
		if (null != historyArgs) {
			this.RestoreFromHistory(historyArgs);
		}
		if (this._showTextLabels) {
			this._toolBar.ShowTextLabels();
		} else {
			this._toolBar.HideTextLabels();
		}
	},
	
	RestoreFromHistory: function (args)
	{
		if (null != args) {
			if (null == this._messagesObj || this._page != args.Page) {
				var page = args.Page;
				if (null == page || 'undefined' == page)
				{
					page = this._page;
				}
				GetMessagesListHandler(args.RedrawType, page);
			}
			if (null != args.MsgUid && null != args.MsgCharset && null != args.MsgParts) {
				GetMessageHandler(args.MsgUid, args.MsgParts, args.MsgCharset);
			} else if (this.Id == SCREEN_MESSAGES_LIST_VIEW) {
				this.CleanMessageBody();
			}
		}
	},
	
	Hide: function ()
	{
		this.shown = false;
		this._mainContainer.className = 'wm_hide';
		if (null != this._pageSwitcher) this._pageSwitcher.Hide();
	},

	ClickBody: function(ev)
	{
	},

	ResizeInboxContainerWidth: function (width)
	{
		var validator = new CValidate();
		if (validator.IsPositiveNumber(width) && width >=400)
		{
			this._inboxWidth = width;
			this._inboxContainer.style.width = width + 'px';
		}
	},
	
	ResizeInboxWidth: function ()
	{
		var offsetWidth;
		if (offsetWidth = this._inboxContainer.offsetWidth) {
			var width = this._inboxWidth - this._inboxBordersWidth;
			if (offsetWidth > width) {
				this._inboxTable.Resize(width);
			} else {
				this._inboxTable.Resize(offsetWidth);
			}
		}
	},
	
	CleanInboxLines: function (msg)
	{
		this._inboxTable.CleanLines(msg);
		if (null != this._pageSwitcher) this._pageSwitcher.Hide();
	},

	RedrawControls: function (redrawIndex, page)
	{
		switch (redrawIndex - 0) {
			case REDRAW_PAGE:
				this.RedrawPages(page);
				break;
		}
		this.CleanInboxLines(Lang.InfoMessagesLoad);
	},
	
	SetPageSwitcher: function (pageSwitcher)
	{
		this._pageSwitcher = pageSwitcher;
		this._pageSwitcher.Hide();
	},
	
	WriteMsgsCountInInbox: function (count)
	{
		if (this._messagesCount != count)
		{
			this._messagesCount = count;
			this._messagesInInbox.innerHTML = count + ' ' + Lang.MessagesInInbox;
			WebMail.DataSource.Cache.SetMessagesCount(count);
		}
	},
	
	FillSpaceInfo: function (limit, size)
	{
		if (limit > 0) {
			var percent = Math.round(size / limit * 100);
		} else {
			var percent = 0;
		}
		if (percent > 100) percent = 100;
		if (percent < 1) percent = 1;
		this._spaceInfo.title = Lang.YouUsing + ' ' + percent + '% ' + Lang.OfYour + ' ' + GetFriendlySize(limit);
		this._spaceProgressBar.style.width = percent + 'px';
	},
	
	GetXmlMessagesOperation: function (type, idArray)
	{
		var xml = '';
		if (this._selection.Length > 0) {
			if (idArray.length == 0) {
				var res = this._selection.GetCheckedLines();
				idArray = res.IdArray;
			} 
			for (var i in idArray) {
				var msg = new CMessage();
				msg.GetFromIdForList(this._SEPARATOR, idArray[i]);
				xml += '<message>';
				xml += '<uid>' + GetCData(HtmlDecode(msg.Uid)) + '</uid>';
				xml += '</message>';
			}
			if (xml != '') {
				xml = '<messages>' + xml + '</messages>';
			}
		}
		if (xml.length > 0)
		{
			if (type == DELETE && confirm(Lang.ConfirmAreYouSure)) {
				WebMail.DataSource.Request({action: 'operation_messages', request: OperationTypes[type]}, xml);
				if (this.Id == SCREEN_MESSAGES_LIST_VIEW) {
					//message in preview pane will remove
					this.CleanMessageBody();
				}
			}
		}
		else
		{
			alert(Lang.WarningMarkListItem);
		}
	},
	
	FillByMessages: function ()
	{
		var msgsObj = this._messagesObj;
		this.FillSpaceInfo(this._mailboxLimit, msgsObj.MailboxSize);
		var msgsArray = msgsObj.List;
		if (msgsArray.length == 0)
		{
			this.CleanInboxLines(Lang.InfoEmptyInbox);
		}
		else
		{
			this._inboxTable.Fill(msgsArray, this._SEPARATOR, this.Id, 'ClickMessageHandler', DblClickHandler);
			this.RedrawPages(this._page);
			if (this.Id == SCREEN_MESSAGES_LIST_VIEW)
			{
				if (null != this._pageSwitcher) this._pageSwitcher.Replace(this._inboxLines);
				this.ResizeInboxWidth();
			}
			else
			{
				WebMail.ResizeBody('all');
			}
		}
	},
	
	RedrawPages: function (page)
	{
		if (this._messagesObj && this._pageSwitcher) {
			var perPage = this._messagesPerPage;
			var count = this._messagesObj.MessagesCount;
			var beginOnclick = 'SetHistoryHandler( { ScreenId: ' + this.Id + ', ';
			beginOnclick += 'Page: ';
			var endOnclick = ', ';
			endOnclick += 'RedrawType: ' + REDRAW_PAGE + ', ';
			endOnclick += 'MsgUid: null, ';
			endOnclick += 'MsgCharset: null, ';
			endOnclick += 'MsgParts: null } );';
			if (this.shown && null != this._pageSwitcher) {
				this._pageSwitcher.Show(page, perPage, count, beginOnclick, endOnclick);
				this._pageSwitcher.Replace(this._inboxLines);
			}
		}
	},
	
	BuildInboxTable: function ()
	{
		var hasCheckBox = true;
		if (this.Id == SCREEN_MESSAGES_LIST_VIEW)
		{
			hasCheckBox = false;
		}
    	var inboxTable = new CVariableTable(this._skinName, this._selection, null, hasCheckBox);
    	inboxTable.AddColumn(IH_CHECK, InboxHeaders[IH_CHECK]);
    	inboxTable.AddColumn(IH_ATTACHMENTS, InboxHeaders[IH_ATTACHMENTS]);
    	this._fromToColumn = inboxTable.AddColumn(IH_FROM, InboxHeaders[IH_FROM]);
    	inboxTable.AddColumn(IH_DATE, InboxHeaders[IH_DATE]);
    	inboxTable.AddColumn(IH_SIZE, InboxHeaders[IH_SIZE]);
    	inboxTable.AddColumn(IH_SUBJECT, InboxHeaders[IH_SUBJECT]);
    	inboxTable.Build(this._inboxContainer);
    	this._inboxLines = inboxTable.GetLines();
    	this._inboxTable = inboxTable;
	}
}

CMessagesListScreen.prototype = MessagesListPrototype;

Ready(INIT_MESSAGES_LIST);