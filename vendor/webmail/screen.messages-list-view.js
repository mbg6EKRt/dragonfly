/*
Classes:
	CMessagesListViewScreen
*/

function CMessagesListViewScreen(skinName)
{
	this.Id = SCREEN_MESSAGES_LIST_VIEW;
	this.isBuilded = false;
	this.hasCopyright = false;
	this.shown = false;
	
	this._showTextLabels = true;
	this._mailboxLimit = 0;
	this._mailboxSize = 0;
	this._replyNumber = REPLY;
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
	this._inboxBordersWidth = 0;
	this._messagesObj = null;
	this._messagesCount = 0;

	this._msgViewer = null;

	this._messageId = -1;
	this._messageUid = '';
	this._msgCharset = AUTOSELECT_CHARSET;
	this._msgObj = null;//object CMessage, that is replaced in preview pane
	this.msgForView = null;
	this.forEditParams = [];
	
	this._messagesInInbox = null;
	this._spaceInfo = null;
	this._spaceProgressBar = null;

	//logo + accountslist + toolbar + lowtoolbar
	this._externalHeight = 56 + 32 + 26 + 24;
	this._logo = null;
	this._accountsBar = null;
	this._lowToolBar = null;

	this._hResizerHeight = 4;
	this._horizResizerObj = null;
	
	this._inboxHeight = 100;
	this._inboxHeadersHeight = 21;
	this._inboxAllBordersHeight = 3;
	//border + inbox headers
	this._defaultInboxHeight = 150;
	this._minUpper = 1 + this._inboxHeadersHeight;

	this._replyTool = null;
	this._forwardTool = null;

	this._messageHeadersHeight = 48;
	this._messagePadding = 16;
	//2 borders + resizer + message headers + message
	this._minLower = 2 + this._hResizerHeight + this._messageHeadersHeight + 100;
	this._minLower = 200;
	this._messageHeadersContainer = null;
	this._messageFrom = null;
	this._messageSwitcher = null;
	this._messageTo = null;
	this._messageDate = null;
	this._messageCC = null;
	this._messageBCC = null;
	this._copies = null;
	this._messageSubject = null;
	this._messageCharset = null;
	
	this.PlaceData = function(Data)
	{
		var Type = Data.Type;
		switch (Type){
			case TYPE_MESSAGES_LIST:
				this.PlaceMessagesList(Data);
				break;
			case TYPE_MESSAGE:
				this._msgObj = Data;
				var uid = Data.Uid;
				var charset = Data.Charset;
				if (null != this.msgForView && this.msgForView.Uid == uid && this.msgForView.Charset == charset) {
					SelectScreenHandler(SCREEN_VIEW_MESSAGE);
					this.msgForView = null;
				}
				this._messageUid = uid;
				this._msgCharset = charset;
				this.FillByMessage();
				break;
			case TYPE_MESSAGES_OPERATION:
				this.PlaceMessagesOperation(Data);
				break;
		}
	}
	
	this.ResizeBody = function (mode)
	{
		if (this.isBuilded) {
			this.ResizeScreen(mode);
			if (!Browser.IE && mode == 'all') {
				this.ResizeScreen(mode);
			}
		}
	}
	
	this.ResizeScreen = function (mode)
	{
		var isAuto = false;
		var height = GetHeight();
		var innerHeight = height - this.GetExternalHeight();
		if (innerHeight < 300) {
			innerHeight = 300;
			isAuto = true;
		}

		if (mode != 'width') {
			this._inboxHeight = this._horizResizerObj._topPosition - this._minUpper;
			this.ResizeInboxHeight(innerHeight);
		}
		
		var width = GetWidth();
		if (mode != 'height') {
			if (width < 550) {
				width = 550;
			}
			this.ResizeInboxContainerWidth(width);
			this._horizResizerObj.updateHorizontalSize(width);
		}

		this.ResizeInboxWidth();
		if (mode != 'height') { this.ResizeMessageWidth(); }
		else { this._msgViewer.ResizeWidth(this._inboxWidth); }
		if (mode != 'width') {this.ResizeInboxHeight(innerHeight);}
		if (null != this._pageSwitcher) this._pageSwitcher.Replace(this._inboxLines);
		SetBodyAutoOverflow(isAuto);
	}
	
	this.GetExternalHeight = function()
	{
		var x = this._logo.offsetHeight + this._accountsBar.offsetHeight + this._toolBar.table.offsetHeight + this._lowToolBar.offsetHeight;
		if (x != 0)
			this._externalHeight = x;
		return this._externalHeight;
	}
	
	this.ResizeMessageWidth = function()
	{
		var clientWidth, rightPartClientWidth;
		if (!(rightPartClientWidth = this._messageSwitcher.clientWidth))
			rightPartClientWidth = 150;
		rightPartClientWidth = rightPartClientWidth + 17 + 32;
		this._messageFrom.style.width = 'auto';
		if (clientWidth = this._messageFrom.clientWidth) {
			if (clientWidth > (this._inboxWidth - rightPartClientWidth))
				this._messageFrom.style.width = (this._inboxWidth - rightPartClientWidth) + 'px';
		}
		if (!(rightPartClientWidth = this._messageDate.clientWidth))
			rightPartClientWidth = 150;
		rightPartClientWidth = rightPartClientWidth + 24;
		this._messageTo.style.width = 'auto';
		if (clientWidth = this._messageTo.clientWidth) {
			if (clientWidth > (this._inboxWidth - rightPartClientWidth))
				this._messageTo.style.width = (this._inboxWidth - rightPartClientWidth) + 'px';
		}
		if (this._copies.className == '') {
			if (this._messageCC.innerHTML == '') {
				this._messageBCC.style.width = this._inboxWidth - 12;
			} else if (this._messageBCC.innerHTML == '') {
				this._messageCC.style.width = this._inboxWidth - 12;
			} else {
				var halfWidth = Math.ceil(this._inboxWidth) - 12;
				this._messageCC.style.width = 'auto';
				if (this._messageCC.clientWidth > halfWidth) {
					this._messageCC.style.width = halfWidth;
					this._messageBCC.style.width = halfWidth;
				}
			}
		}
		rightPartClientWidth = this._messageCharset.clientWidth;
		this._messageSubject.style.width = 'auto';
		if (rightPartClientWidth != 0) {
			rightPartClientWidth = rightPartClientWidth + 17;
			if (clientWidth = this._messageSubject.clientWidth) {
				if (clientWidth > (this._inboxWidth - rightPartClientWidth))
					this._messageSubject.style.width = (this._inboxWidth - rightPartClientWidth) + 'px';
			}
		}
		this._msgViewer.ResizeWidth(this._inboxWidth);
	}
	
	this.GetMessageExternalHeight = function()
	{
		var inboxHeight = this._inboxTable.GetHeight();
		offsetHeight = this._messageHeadersContainer.offsetHeight;
		if (offsetHeight)
		{
			this._messageHeadersHeight = offsetHeight;
		}
		return inboxHeight + this._inboxAllBordersHeight + this._hResizerHeight + this._messageHeadersHeight;
	}
	
	this.ResizeInboxHeight = function(height)
	{
		var validator = new CValidate();
		if (validator.IsPositiveNumber(height) && height >=100)
		{
			var messInnerHeight = height - this.GetMessageExternalHeight();
			if (messInnerHeight < 100) {
				this._inboxHeight -= 100 - messInnerHeight;
				messInnerHeight = 100;
			}
			if (this._inboxHeight < 100) {
				this._inboxHeight = 100;
			}
			this._inboxTable.SetLinesHeight(this._inboxHeight);
			this._horizResizerObj._topPosition = this._inboxHeight + this._minUpper;
			CreateCookie('wm_horiz_resizer', this._horizResizerObj._topPosition, 14);
			this._msgViewer.ResizeHeight(messInnerHeight);
		}
	}

	this.ParseSettings = function (settings)
	{
		this._showTextLabels = settings.ShowTextLabels;
		this._mailboxLimit = settings.MailBoxLimit;
		this.ChangeSkin(settings.DefSkin);
		if (this._messagesPerPage != settings.MsgsPerPage)
		{
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
	
	this.Build = function(container, accountsBar, PopupMenus, settings)
	{
		this.ParseSettings(settings);
		this._logo = document.getElementById('logo');
		this._mainContainer = CreateChild(container, 'div');
		this._mainContainer.className = 'wm_hide';
		this._accountsBar = accountsBar;

		this.BuildToolBar(PopupMenus);

		var div = CreateChild(this._mainContainer, 'div');
		div.className = 'wm_background';
		var tbl = CreateChild(div, 'table');
		tbl.className = 'wm_mail_container';
		var tr = tbl.insertRow(0);

		this._inboxContainer = tr.insertCell(0);
		var obj = this;
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
		div = CreateChild(td, 'div');
		div.className = 'wm_hresizer_height';
		var HResizer = CreateChild(td, 'div');
		HResizer.className = 'wm_hresizer';
		div = CreateChild(td, 'div');
		div.className = 'wm_hresizer_height';

		tr = tbl.insertRow(2);
		td = tr.insertCell(0);
		this.BuildMessageContainer(td);

		tr = tbl.insertRow(3);
		this._lowToolBar = tr.insertCell(0);
		this._lowToolBar.className = 'wm_lowtoolbar';
		this._messagesInInbox = CreateChild(this._lowToolBar, 'span');
		this._messagesInInbox.className = 'wm_lowtoolbar_messages';
		this.WriteMsgsCountInInbox(0);
		this._spaceInfo = CreateChild(this._lowToolBar, 'span');
		this._spaceInfo.className = 'wm_lowtoolbar_space_info';
		div = CreateChild(this._spaceInfo, 'div');
		div.className = 'wm_progressbar';
		this._spaceProgressBar = CreateChild(div, 'div');
		this._spaceProgressBar.className = 'wm_progressbar_used';
		var horizResizer = ReadCookie('wm_horiz_resizer');
		var val = new CValidate();
		if (!val.IsEmpty(horizResizer) && val.IsPositiveNumber(horizResizer))
		{
			this._defaultInboxHeight = horizResizer-0;
		}
		this._horizResizerObj = new CHorizontalResizer(HResizer, this._mainContainer, 2, this._minUpper + 100, this._minLower, this._defaultInboxHeight, 'WebMail.ResizeBody(\'height\');');
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
		//reply tool (reply, reply all)
		this._replyTool = toolbar.AddReplyItem(this._replyNumber, PopupMenus, false);
		//forward tool
		this._forwardTool = toolbar.AddItem(TOOLBAR_FORWARD, CreateReplyClick(FORWARD), false);
		//delete tool
		this._pop3DeleteTool = toolbar.AddItem(TOOLBAR_DELETE, function () { RequestMessagesOperationHandler(DELETE, [], 0); }, false);
		
		this._toolBar = toolbar;
	}
	
	this.CleanMessageBody = function ()
	{
		this._msgObj = null;
		this._messageFrom.innerHTML = '';
		this._messageTo.innerHTML = '';
		this._messageDate.innerHTML = '';
		this._messageCC.innerHTML = '';
		this._messageBCC.innerHTML = '';
		this._copies.className = 'wm_hide';
		this._messageSubject.innerHTML = '';
		this._messageCharset.innerHTML = '';
		this._msgViewer.Clean();
		this.ResizeBody('all');
		this._msgObj = null;
	}
	
	this.FillByMessage = function()
	{
		var thisMessage = this._msgObj;

		var from = this._msgObj.FromAddr;
		if (from) this._messageFrom.innerHTML = '<font>' + Lang.From + ':</font>' + from;
		else this._messageFrom.innerHTML = '<font>' + Lang.From + ':</font>';
		var to = this._msgObj.ToAddr;
		if (to) this._messageTo.innerHTML = '<font>' + Lang.To + ':</font>' + to;
		else this._messageTo.innerHTML = '<font>' + Lang.To + ':</font>';
		var date = this._msgObj.Date;
		if (date) this._messageDate.innerHTML = '<font>' + Lang.Date + ':</font>' + date;
		else this._messageDate.innerHTML = '<font>' + Lang.Date + ':</font>';

		this._copies.className = 'wm_hide';
		var cc = this._msgObj.CCAddr;
		if (cc) {
			this._messageCC.innerHTML = '<font>' + Lang.CC + ':</font>' + cc;
			this._copies.className = '';
		}
		var bcc = this._msgObj.BCCAddr;
		if (bcc) {
			this._messageBCC.innerHTML = '<font>' + Lang.BCC + ':</font>' + bcc;
			this._copies.className = '';
		}

		var subject = this._msgObj.Subject;
		if (subject) this._messageSubject.innerHTML = '<font>' + Lang.Subject + ':</font>' + subject;
		else this._messageSubject.innerHTML = '<font>' + Lang.Subject + ':</font>';
		if (this._msgObj.HasCharset && this._msgObj.Charset == -1) {
			CleanNode(this._messageCharset);
		} else {
			this.FillMessageCharset(this._msgObj.Charset);
		}

		this._msgViewer.Fill(thisMessage);
		this.ResizeBody('all');
		if (null != this._pageSwitcher) this._pageSwitcher.Replace(this._inboxLines);
	}//FillByMessage

	this.FillMessageCharset = function (charset) {
		var charset = this._msgObj.Charset;
		var charsetCont = this._messageCharset;
		CleanNode(charsetCont);
		var font = CreateChild(charsetCont, 'font');
		font.innerHTML = Lang.Charset + ':';
		var sel = CreateChild(charsetCont, 'select');
		sel.onchange = function () {
			SetHistoryHandler(
				{
					ScreenId: obj.Id,
					Page: obj._page,
					MsgUid: obj._messageUid,
					MsgCharset: this.value,
					MsgParts: [PART_MESSAGE_HEADERS, PART_MESSAGE_HTML, PART_MESSAGE_ATTACHMENTS]
				}
			);
		}
		var opt;
		var obj = this;
		for (var i in Charsets) {
			if (Charsets[i].Value == 0) {
				var value = AUTOSELECT_CHARSET;
			} else {
				var value = Charsets[i].Value;
			}
			opt = CreateChildWithAttrs(sel, 'option', [['value', value]]);
			opt.innerHTML = Charsets[i].Name;
			if (charset == value) {
				opt.selected = true;
			} else {
				opt.selected = false;
			}
		}
		sel.blur();
	}
	
	this.BuildMessageContainer = function(td)
	{
		var obj = this;
		var div = CreateChild(td, 'div');
		div.className = 'wm_message_container';
		
		var tbl = CreateChild(div, 'table');
		var tr = tbl.insertRow(0);
		var td = tr.insertCell(0);

		this._messageHeadersContainer = CreateChild(td, 'div');
		this._messageHeadersContainer.className = 'wm_message_headers';

		var div2 = CreateChild(this._messageHeadersContainer, 'div');
		this._messageFrom = CreateChild(div2, 'span');
		this._messageFrom.className = 'wm_message_left wm_message_resized';
		
		this._messageSwitcher = CreateChild(div2, 'span');
		this._messageSwitcher.className = 'wm_hide';
		var a = CreateChildWithAttrs(this._messageSwitcher, 'a', [['href', '']]);
		a.innerHTML = Lang.SwitchToPlain;
		a.onclick = function () {
			var part = obj._msgViewer.GetMsgPart();
			GetMessageHandler(obj._messageUid, [part], obj._msgCharset);
			return false;
		}

		div2 = CreateChild(this._messageHeadersContainer, 'div');
		this._messageTo = CreateChild(div2, 'span');
		this._messageTo.className = 'wm_message_left wm_message_resized';
		this._messageDate = CreateChild(div2, 'span');
		this._messageDate.className = 'wm_message_left';

		div2 = CreateChild(this._messageHeadersContainer, 'div');
		div2.className = 'wm_hide';
		this._messageCC = CreateChild(div2, 'span');
		this._messageCC.className = 'wm_message_left wm_message_resized';
		this._messageBCC = CreateChild(div2, 'span');
		this._messageBCC.className = 'wm_message_left';
		this._copies = div2;

		div2 = CreateChild(this._messageHeadersContainer, 'div');
		this._messageSubject = CreateChild(div2, 'span');
		this._messageSubject.className = 'wm_message_left wm_message_resized';
		this._messageCharset = CreateChild(div2, 'span');
		this._messageCharset.className = 'wm_message_right';

		tr = tbl.insertRow(1);
		td = tr.insertCell(0);
		this._msgViewer = new CMessageViewer();
		this._msgViewer.Build(td, 0);
		this._msgViewer.SetSwitcher(this._messageSwitcher, 'wm_message_right', a);
	}
}

CMessagesListViewScreen.prototype = MessagesListPrototype;

Ready(INIT_MESSAGES_LIST_VIEW);