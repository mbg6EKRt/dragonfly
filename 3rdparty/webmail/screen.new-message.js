/*
Classes:
	CNewMessageScreen
*/

function CNewMessageScreen(skinName)
{
	this.Id = SCREEN_NEW_MESSAGE;
	this.isBuilded = false;
	this.hasCopyright = true;
	this._skinName = skinName;
	
	this.shown = false;
	this._idAcct = -1;
	
	this._msgObj = new CMessage();
	this._newMessage = true;
	this._fromField = '';

	this._showTextLabels = true;

	this._mainContainer = null;
	this._toolBar = null
	this._logo = null;
	this._copyright = null;
	this._accountsBar = null;
	this._headersTbl = null;
	this._uploadTbl = null;
	//logo + accountslist + toolbar
	this.ExternalHeight = 56 + 32 + 26 + 24;

	this._bccSwitcher = null;
	this._hasBcc = false;
	this._bccCont = null;

	this._fromObj = null;
	this._toObj = null;
	this._ccObj = null;
	this._bccObj = null;
	this._subjectObj = null;
	this._priorityButton = null;
	this._priority = 3;

	this._plainEditorObj = null;
	this._plainEditorCont = null;
	
	this._uploadForm = null;
	this._attachments = Array();
	this._rowIndex = 0;
	this._attachmentsTbl = null;
	
	this._sending = false;
}

CNewMessageScreen.prototype = {
	PlaceData: function (Data)
	{
	},
	
	SetErrorHappen: function ()
	{
		this._sending = false;
	},
	
	Show: function (settings)
	{
		if (WebMail._fromField.length == 0)
		{
			WebMail.DataSource.Get(TYPE_ACCOUNT_PROPERTIES, { }, [], '');
		}
		this._sending = false;
		this.ParseSettings(settings);
		this._mainContainer.className = '';
		if (this._showTextLabels) {
			this._toolBar.ShowTextLabels();
		} else {
			this._toolBar.HideTextLabels();
		}
		this.shown = true;
		this.Fill();
		this.ResizeBody();
	},
	
	ParseSettings: function (settings)
	{
		this._showTextLabels = settings.ShowTextLabels;
		this.ChangeSkin(settings.DefSkin);
	},
	
	ChangeSkin: function (newSkin)
	{
		if (this._skinName != newSkin) {
			this._skinName = newSkin;
			if (this.isBuilded) {
				this._toolBar.ChangeSkin(newSkin);
			}
		}
	},

	RestoreFromHistory: function (historyArgs)
	{
	},

	Hide: function ()
	{
		this.shown = false;
		this.SetNewMessage();
		this._mainContainer.className = 'wm_hide';
	},
	
	ClickBody: function (ev)
	{
	},

	GetExternalHeight: function()
	{
		var res = 0;
		var x;
		if (x = this._logo.offsetHeight) { res += x; }
		if (x = this._accountsBar.offsetHeight) { res += x; }
		if (x = this._toolBar.table.offsetHeight) { res += x; }
		if (x = this._headersTbl.offsetHeight) { res += x; }
		if (x = this._plainEditorCont.offsetHeight) { res -= x; }
		if (x = this._attachmentsTbl.offsetHeight) { res += x; }
		if (x = this._uploadTbl.offsetHeight) { res += x; }
		if (x = this._copyright.offsetHeight) { res += x; }
		if (res != 0)
			this.ExternalHeight = res;
		return this.ExternalHeight;
	},
	
	ResizeBody: function (mode)
	{
		if (this.isBuilded) {
			var width = GetWidth();
			if (width < 684)
				width = 684;
			width = width - 40;
			var height = GetHeight() - this.GetExternalHeight() - 40;
			if (height < 200) height = 200;

			this._plainEditorObj.style.height = height + 'px';
			this._plainEditorObj.style.width = width + 'px';
		}
	},
	
	SetNewMessage: function ()
	{
		this._newMessage = true;
		this._msgObj = new CMessage();
		this.ChangeFromAddr();
	},
	
	ChangeFromAddr: function ()
	{
		this._msgObj.FromAddr = this._fromField;
	},
	
	SetFromField: function (value)
	{
		this._fromField = value;
		this.ChangeFromAddr();
		this.Fill();
	},
	
	UpdateMessageForReply: function (message, replyAction)
	{
		this._newMessage = false;
		Screens[SCREEN_NEW_MESSAGE].ShowHandler = '';
		this._msgObj = new CMessage();
		this._msgObj.PrepareForReply(message, replyAction, this._fromField);
		this._msgObj.FromAddr = this._fromField;
		this.Fill();
	},
	
	SetToField: function (toField)
	{
		Screens[SCREEN_NEW_MESSAGE].ShowHandler = '';
		this.SetNewMessage();
		this._msgObj.ToAddr = toField;
		this.Fill();
	},

	UpdateMessage: function (message)
	{
		this._newMessage = false;
		Screens[SCREEN_NEW_MESSAGE].ShowHandler = '';
		this._msgObj = new CMessage();
		this._msgObj.PrepareForEditing(message);
		this.Fill();
	},

	Fill: function ()
	{
		if ((null != this._msgObj) && this.shown) {
			var msg = this._msgObj;
			this.SetPriority(msg.Importance);
			
			this._fromObj.value = msg.FromAddr;
			this._toObj.value = msg.ToAddr;
			this._ccObj.value = msg.CCAddr;
			this._bccObj.value = msg.BCCAddr;
			if (msg.BCCAddr.length == 0) {
				this._bccSwitcher.innerHTML = Lang.ShowBCC;
				this._hasBcc = false;
				this._bccCont.className = 'wm_hide';
			} else {
				this._bccSwitcher.innerHTML = Lang.HideBCC;
				this._hasBcc = true;
				this._bccCont.className = '';
			}
			this._subjectObj.value = msg.Subject;

			this._plainEditorObj.value = HtmlDecodeBody(msg.PlainBody);
			this._plainEditorObj.tabIndex = 6;
			this.RedrawAttachments(msg.Attachments);
			this.RebuildUploadForm();
		}
	},//Fill
	
	RedrawAttachments: function (attachs)
	{
		CleanNode(this._attachmentsTbl);
		this._attachments = Array();
		this._rowIndex = 0;
		for (var i in attachs) {
			this.LoadAttachment(attachs[i]);
		}
	},//RedrawAttachments
	

//mode = 0 - send message
	SaveChanges: function (mode)
	{
		if (this._sending && mode == 0) return;
		var fromValue = Trim(this._fromObj.value);
		if (mode == 0 && fromValue.length < 1)
		{
			alert(Lang.WarningFromBlank);
			return;
		}
		var toValue = Trim(this._toObj.value);
		var ccValue = Trim(this._ccObj.value);
		var bccValue = Trim(this._bccObj.value);
		if (mode == 0 && toValue.length < 1 && ccValue.length < 1 && bccValue.length < 1)
		{
			alert(Lang.WarningToBlank);
			return;
		}
		var subjectValue = this._subjectObj.value;
		if (mode == 1 || subjectValue.length != 0 || confirm(Lang.ConfirmEmptySubject))
		{
			var newMsg = new CMessage();
			newMsg.FromAddr = this._fromObj.value;
			newMsg.ToAddr = toValue;
			newMsg.CCAddr = ccValue;
			if (this._hasBcc) newMsg.BCCAddr = this._bccObj.value;
			newMsg.Subject = subjectValue;
			newMsg.Importance = this._priority;
			
			newMsg.HasHtml = false;
			newMsg.PlainBody = this._plainEditorObj.value;
			
			newMsg.Attachments = this._attachments;

			newMsg.Id = this._msgObj.Id;
			newMsg.Uid = this._msgObj.Uid;

			var xml = newMsg.GetInXML();
			if (mode == 0)
			{
				RequestHandler('send', 'message', xml);
				this._sending = true;
			}
		}
	},//SaveChanges
	
	SwitchBccMode: function ()
	{
		if (this._hasBcc) {
			this._bccSwitcher.innerHTML = Lang.ShowBCC;
			this._hasBcc = false;
			this._bccCont.className = 'wm_hide';
		} else {
			this._bccSwitcher.innerHTML = Lang.HideBCC;
			this._hasBcc = true;
			this._bccCont.className = '';
		}
	},//SwitchBccMode
	
	CreateDeleteAttachmentClick: function (index, obj)
	{
		return function () { obj.DeleteAttachment(index); return false; }
	},//CreateDeleteAttachmentClick
	
	LoadAttachment: function (attachment)
	{
		var obj = this;
		var tbl = this._attachmentsTbl;
		var tr = tbl.insertRow(this._rowIndex);
		var td = tr.insertCell(0);
		td.className = 'wm_attachment';
		var params = GetFileParams(attachment.FileName);
		var img = CreateChildWithAttrs(td, 'img', [['src', 'images/icons/' + params.image]]);
		var span = CreateChild(td, 'span');
		span.innerHTML = attachment.FileName + '&nbsp;(' + GetFriendlySize(attachment.Size) + ')&nbsp;';
		var a = CreateChildWithAttrs(td, 'a', [['href', '#']]);
		a.onclick = this.CreateDeleteAttachmentClick(this._rowIndex, obj);
		a.innerHTML = Lang.Delete;
		this._attachments[this._rowIndex] = attachment;
		this._rowIndex++;
		this.RebuildUploadForm();
	},//LoadAttachment
	
	DeleteAttachment: function (index)
	{
		delete this._attachments[index];
		var attachs = this._attachments;
		this.RedrawAttachments(attachs);
	},//DeleteAttachment
	
	ChangePriority: function ()
	{
		var pr = this._priority;
		switch (pr) {
			case 5:
				this.SetPriority(3);
			break;
			case 3:
				this.SetPriority(1);
			break;
			case 1:
				this.SetPriority(5);
			break;
		}
	},//ChangePriority
	
	SetPriority: function (pr)
	{
		switch (pr) {
			case 5:
				this._priority = 5;
				this._priorityButton.SetImgFile('priority_low.gif');
				this._priorityButton.SetText(Lang.Low);
			break;
			case 3:
				this._priority = 3;
				this._priorityButton.SetImgFile('priority_normal.gif');
				this._priorityButton.SetText(Lang.Normal);
			break;
			case 1:
				this._priority = 1;
				this._priorityButton.SetImgFile('priority_high.gif');
				this._priorityButton.SetText(Lang.High);
			break;
		}
	},//SetPriority
	
	BuildToolBar: function ()
	{
		var obj = this;
		var toolBar = new CToolBar(this._mainContainer, this._skinName);
		var item = toolBar.AddItem(TOOLBAR_SEND_MESSAGE, function () { obj.SaveChanges(0); });
		this._priorityButton = toolBar.AddPriorityItem();
		this._priorityButton.MakeActive('wm_toolbar_item', 'wm_toolbar_item_over', 'priority_normal.gif', function () { obj.ChangePriority(); });
		this._toolBar = toolBar;
	},//BuildToolBar

	RebuildUploadForm: function ()
	{
		var form = this._uploadForm;
		CleanNode(form);
		var span = CreateChild(form, 'span');
		span.innerHTML = Lang.AttachFile + ':&nbsp;';
		var inp = CreateChildWithAttrs(form, 'input', [['type', 'file'], ['class', 'wm_file'], ['name', 'fileupload']]);
		this._uploadFile = inp;
		span = CreateChild(form, 'span');
		span.innerHTML = '&nbsp;';
		inp = CreateChildWithAttrs(form, 'input', [['type', 'submit'], ['class', 'wm_button'], ['value', Lang.Attach]]);
	},//RebuildUploadForm
	
	Build: function (container, accountsBar, popupMenus, settings)
	{
		var obj = this;
		this._showTextLabels = settings.ShowTextLabels;

		this._mainContainer = CreateChild(container, 'div');
		this._mainContainer.className = 'wm_hide';

		this._logo = document.getElementById('logo');
		this._copyright = document.getElementById('copyright');
		this._accountsBar = accountsBar;

		this.BuildToolBar();
		
		var tbl = CreateChild(this._mainContainer, 'table');
		this._headersTbl = tbl;
		tbl.className = 'wm_new_message';
		var RowIndex = 0;
		
		var tr = tbl.insertRow(RowIndex++);
		var td = tr.insertCell(0);
		td.className = 'wm_new_message_title';
		td.innerHTML = Lang.From + ':';
		WebMail.LangChanger.Register('innerHTML', td, 'From', ':');
		td = tr.insertCell(1);
		var inp = CreateChildWithAttrs(td, 'input', [['type', 'text'], ['class', 'wm_input'], ['size', '93'], ['maxlength', '255']]);
		inp.tabIndex = 1;
		this._fromObj = inp;
		
		tr = tbl.insertRow(RowIndex++);
		td = tr.insertCell(0);
		td.className = 'wm_new_message_title';
		td.innerHTML = Lang.To + ':';
		WebMail.LangChanger.Register('innerHTML', td, 'To', ':');
		td = tr.insertCell(1);
		inp = CreateChildWithAttrs(td, 'input', [['type', 'text'], ['class', 'wm_input'], ['size', '93'], ['maxlength', '255']]);
		inp.tabIndex = 2;
		this._toObj = inp;
		
		tr = tbl.insertRow(RowIndex++);
		td = tr.insertCell(0);
		td.className = 'wm_new_message_title';
		td.innerHTML = Lang.CC + ':';
		WebMail.LangChanger.Register('innerHTML', td, 'CC', ':');
		td = tr.insertCell(1);
		nobr = CreateChild(td, 'nobr');
		inp = CreateChildWithAttrs(nobr, 'input', [['type', 'text'], ['class', 'wm_input'], ['size', '93'], ['maxlength', '255']]);
		inp.tabIndex = 3;
		this._ccObj = inp;
		var span = CreateChild(nobr, 'span');
		span.innerHTML = '&nbsp;';
		a = CreateChildWithAttrs(nobr, 'a', [['href', '#']]);
		a.onclick = function () { obj.SwitchBccMode(); return false; }
		a.innerHTML = Lang.ShowBCC;
		WebMail.LangChanger.Register('innerHTML', a, 'ShowBCC', '');
		a.tabIndex = -1;
		this._bccSwitcher = a;
		this._hasBcc = false;

		tr = tbl.insertRow(RowIndex++);
		tr.className = 'wm_hide';
		td = tr.insertCell(0);
		td.className = 'wm_new_message_title';
		td.innerHTML = Lang.BCC + ':';
		WebMail.LangChanger.Register('innerHTML', td, 'BCC', ':');
		td = tr.insertCell(1);
		inp = CreateChildWithAttrs(td, 'input', [['type', 'text'], ['class', 'wm_input'], ['size', '93'], ['maxlength', '255']]);
		inp.tabIndex = 4;
		this._bccObj = inp;
		this._bccCont = tr;

		tr = tbl.insertRow(RowIndex++);
		td = tr.insertCell(0);
		td.className = 'wm_new_message_title';
		td.innerHTML = Lang.Subject + ':';
		WebMail.LangChanger.Register('innerHTML', td, 'Subject', ':');
		td = tr.insertCell(1);
		inp = CreateChildWithAttrs(td, 'input', [['type', 'text'], ['class', 'wm_input'], ['size', '93'], ['maxlength', '255']]);
		inp.tabIndex = 5;
		this._subjectObj = inp;

		tr = tbl.insertRow(RowIndex++);
		td = tr.insertCell(0);
		td.colSpan = 2;
		var txt = CreateChild(td, 'textarea');
		txt.className = 'wm_input';
		txt.tabIndex = 6;
		this._plainEditorObj = txt;
		this._plainEditorCont = td;

		tbl = CreateChild(this._mainContainer, 'table');
		tbl.className = 'wm_new_message';
		this._attachmentsTbl = tbl;

		tbl = CreateChild(this._mainContainer, 'table');
		tbl.className = 'wm_new_message';
		tr = tbl.insertRow(0);
		td = tr.insertCell(0);
		td.className = 'wm_attach';
		var uploadFrame = CreateChildWithAttrs(td, 'iframe', [['src', EmptyHtmlUrl], ['name', 'UploadFrame'], ['id', 'UploadFrame'], ['class', 'wm_hide']]);
		this._uploadForm = CreateChildWithAttrs(td, 'form', [['action', UploadUrl], ['method', 'post'], ['enctype', 'multipart/form-data'], ['target', 'UploadFrame'], ['id', 'UploadForm']]);
		this.RebuildUploadForm();
		var obj = this;
		this._uploadForm.onsubmit = function () {
			if (obj._uploadFile.value.length == 0) return false;
		}
		this._uploadTbl = tbl;

		this.isBuilded = true;
	}//Build
}

Ready(INIT_NEW_MESSAGE);