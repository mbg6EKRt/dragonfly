/*
Classes:
	CVerticalResizer
	CHorizontalResizer
	CSelection
	CToolButton
	CToolBar
	CVariableColumn
	CVariableTable
	CVariableCell
	CVariableMsgLine
*/

function CVerticalResizer(DIVMovable, parentTable, divHSize, minLeftWidth, minRightWidth, leftPosition, endMoveHandler, type) {
	// set internal data by outside parameters
	if (type) {
		this._type       = type;
	} else {
		this._type       = 0;
	}
	switch (this._type)
	{
		case 0:
			this._class      = 'wm_vresizer';
			this._classPress = 'wm_vresizer_press';
		break;
		case 1:
			this._class      = 'wm_vresizer_mess';
			this._classPress = 'wm_vresizer_mess';
		break;
		case 2:
			this._class      = 'wm_inbox_headers_separate';
			this._classPress = 'wm_inbox_headers_separate';
		break;
	}
	this._DIVMovable     = DIVMovable;
	this._parentTable    = parentTable;
	this._divHSize	     = divHSize;
	this._minLeftWidth   = minLeftWidth;
	this._minRightWidth  = minRightWidth;
	this._leftPosition   = leftPosition;
	this._beginPosition  = 0;
	this._endMoveHandler = endMoveHandler;

	// set some internal data by default values (this values must be overwritten)
	this._leftBorder  = 0;
	this._rightBorder = 600;
	this._leftLimit   = 80;
	this._rightLimit  = 550;

	this._divVSize = 2;
	this._divVSizePress = 2;
	
	with(this._DIVMovable.style)
	{
		width = this._divHSize + 'px';
		height = this._divVSize + 'px';
		cursor = 'e-resize';
	}
	switch (this._type) {
		case 0:
			this._leftShear = 0;
			this._DIVMovable.style.left = '1px';
			break;
		case 1:
		case 2:
			this._leftShear = leftPosition;
			break;
	}
	this._DIVMovable.className = this._class;
	if (this._type != 2)
	{
		this._DIVMovable.innerHTML = '&nbsp;';
	}
	
	// this handler is necessary to begins moving
	var obj = this;
	this._DIVMovable.onmousedown = function(e)
	{
		obj.beginMoving(e);
		return false; //don't select content in Opera
	}
}

CVerticalResizer.prototype = {
	updateVerticalSize: function(vert_size, vert_size_press)
	{
		this._divVSize = vert_size;
		this._DIVMovable.style.height = this._divVSize + 'px';
		if (this._type == 2)
		{
			this._divVSizePress = vert_size_press;
		}
		else
		{
			this._divVSizePress = vert_size;
		}
	},
	
	updateMinLeftWidth: function(minLeftWidth)
	{
		this._minLeftWidth = minLeftWidth;
	},
	
	updateMinRightWidth: function(minRightWidth)
	{
		this._minRightWidth = minRightWidth;
	},
	
	updateLeftPosition: function (leftPosition)
	{
		var diff = leftPosition - this._leftPosition;
		this._minLeftWidth += diff;
		this._leftPosition = leftPosition;
		this._DIVMovable.style.left = leftPosition + 'px';
	},

	beginMoving: function(e)
	{
   		e = e ? e : event;
		this._beginPosition = e.clientX;
		this._DIVMovable.className = this._classPress;
		if (this._type == 2)
		{
			this._DIVMovable.style.height = this._divVSizePress + 'px';
		}
		//don't select content in IE
		document.onselectstart = function() {return false;}
		document.onselect = function() {return false;}
		
		// calculate borders of this._parentTable
		var bounds = GetBounds(this._parentTable);
		this._leftBorder  = bounds.Left;
		this._rightBorder = bounds.Left + bounds.Width;

		// calculate moving limits (for center of movable td/div)
		this._leftLimit   = this._leftBorder  + this._minLeftWidth + (this._beginPosition - this._leftPosition) - this._leftBorder;
		this._rightLimit  = this._rightBorder - this._minRightWidth - ((this._leftPosition + 6) - this._beginPosition) - this._leftBorder;

		// hang moving handlers	
		var obj = this;
		this._parentTable.onmousemove = function(e)
		{
		    if ( arguments.length == 0 )
        		e = event;
			obj.processMoving( e.clientX ); 
		}
		
		this._parentTable.onmouseup = function()
		{
			obj.endMoving();
		}
		
		this._parentTable.onmouseout = function(e)
		{
		    if ( arguments.length == 0 )
        		e = event;

        	var b = GetBounds(this);
			var left_border   = b.Left;
			var top_border    = b.Top;
			var right_border  = left_border + b.Width;
			var bottom_border = top_border  + b.Height;
			
			// it is necessary to prevent incorrect action on mouseout event
			if( e.clientX<=left_border || e.clientX>=right_border ||
				e.clientY<=top_border  || e.clientY>=bottom_border )
			{
				obj.endMoving();
			}
		}
	},
	
	processMoving: function(mouse_x)	
	{
		// check and correct mouse_x if it is necessary
		if( mouse_x < this._leftLimit ){
			mouse_x = this._leftLimit;
		}
		if( mouse_x > this._rightLimit ){
			mouse_x = this._rightLimit;
		}
		switch (this._type) {
			case 0:
				this._DIVMovable.style.left = mouse_x - this._beginPosition + 1 + 'px';
				this._leftShear = mouse_x - this._beginPosition;
				break;
			case 1:
				var new_left = this._leftPosition + mouse_x - this._beginPosition;
				if( new_left < (this._leftLimit - (this._beginPosition - this._leftPosition)) ){
					new_left = this._leftLimit - (this._beginPosition - this._leftPosition);
				}
				if( new_left > this._rightLimit	 ){
					new_left = this._rightLimit + ((this._leftPosition + 6) - this._beginPosition);
				}
				this._leftShear = new_left;
				if (this._type == 1) eval(this._endMoveHandler);
				break;
			case 2:
				var new_left = this._leftPosition + mouse_x - this._beginPosition;
				if( new_left < (this._leftLimit - (this._beginPosition - this._leftPosition)) ){
					new_left = this._leftLimit - (this._beginPosition - this._leftPosition);
				}
				if( new_left > this._rightLimit	 ){
					new_left = this._rightLimit + ((this._leftPosition + 6) - this._beginPosition);
				}
				this._DIVMovable.style.left = new_left + 'px';
				this._leftShear = new_left;
				break;
		}
	},
	
	endMoving: function()
	{
		document.onselectstart = function() {}
		document.onselect = function() {}
		this._parentTable.onmousemove = '';
		this._parentTable.onmouseup = '';
		this._parentTable.onmouseout = '';
		this._DIVMovable.className = this._class;
		if (this._type == 2)
		{
			this._DIVMovable.style.height = this._divVSize + 'px';
		}
		switch (this._type) {
			case 0:
				this._DIVMovable.style.left = '1px';
				var new_left = this._leftPosition + this._leftShear;
				if( new_left < (this._leftLimit - (this._beginPosition - this._leftPosition)) ){
					new_left = this._leftLimit - (this._beginPosition - this._leftPosition);
				}
				if( new_left > this._rightLimit	 ){
					new_left = this._rightLimit + ((this._leftPosition + 6) - this._beginPosition);
				}
				this._leftPosition = new_left;
				this._leftShear = 0;
				eval(this._endMoveHandler);
				break;
			case 1:
				this._leftPosition = this._leftShear;
				break;
			case 2:
				this._leftPosition = this._leftShear;
				eval(this._endMoveHandler);
				break;
		}
	},
	
	free: function()
	{
		this._parentTable.onmousemove = '';
		this._parentTable.onmouseup = '';
		this._parentTable.onmouseout = '';
		this._DIVMovable.onmousedown = '';
		with(this._DIVMovable.style)
		{
			cursor = 'default';
		}		
	},
	
	busy: function(width)
	{
		this._leftPosition = width;
		
		with(this._DIVMovable.style)
		{
			cursor = 'e-resize';
		}		
		
		// this handler is necessary to begins moving
		var obj = this;
		this._DIVMovable.onmousedown = function(e)
		{
			obj.beginMoving(e);
			return false; //don't select content in Opera
		}	
	}
}

function CHorizontalResizer(DIVMovable, parentTable, divVSize, minUpperHeight, minLowerHeight, topPosition, endMoveHandler) {
	// set internal data by outside parameters
	this._DIVMovable     = DIVMovable;
	this._parentTable    = parentTable;// table (HTML Element) which contents all changable TRs
	this._divVSize	     = divVSize;// vertical size of movable TR/TD/DIV
	this._minUpperHeight = minUpperHeight;// minimal height when upper TR has good look
	this._minLowerHeight = minLowerHeight;// minimal height when lower TR has good look
	this._topPosition    = topPosition;
	this._topShear       = 0;
	this._beginPosition  = 0;
	this._endMoveHandler = endMoveHandler;

	this._class          = 'wm_hresizer';
	this._classPress     = 'wm_hresizer_press';
	
	// set some internal data by default values (this values must be overwritten)
	this._upperBorder  = 114;
	this._lowerBorder = 815;
	this._upperLimit   = 268;
	this._lowerLimit  = 665;

	this._divHSize = 2	;

	with(this._DIVMovable.style)
	{
		width = this._divHSize + 'px';
		height = this._divVSize + 'px';
		cursor = 's-resize';
		top = '0px';
	}
	this._DIVMovable.className = this._class;
	this._DIVMovable.innerHTML = '&nbsp;';

	// this handler is necessary to begins moving
	var obj = this;
	this._DIVMovable.onmousedown = function(e)
	{
		obj.beginMoving(e);
		return false; //don't select content in Opera
	}
}

CHorizontalResizer.prototype = 
{
	updateHorizontalSize: function(horiz_size)
	{
		this._divHSize = horiz_size;
		this._DIVMovable.style.width = this._divHSize + 'px';
	},

	beginMoving: function(e)
	{
   		e = e ? e : event;
		this._beginPosition = e.clientY;
		this._DIVMovable.className = this._classPress;
		//don't select content in IE
		document.onselectstart = function() {return false;}
		document.onselect = function() {return false;}

		// calculate borders of this._parentTable
		var bounds = GetBounds(this._parentTable);
		this._upperBorder = bounds.Top;
		this._lowerBorder = bounds.Top + bounds.Height;

		// calculate moving limits (for center of movable td/div)
		this._upperLimit = this._upperBorder + this._minUpperHeight + (this._beginPosition - this._topPosition) - this._upperBorder;
		this._lowerLimit = this._lowerBorder - this._minLowerHeight - ((this._topPosition + 6) - this._beginPosition) - this._upperBorder;

		// hang moving handlers	
		var obj = this;
		this._parentTable.onmousemove = function(e)
		{
		    if ( arguments.length == 0 )
        		e = event;
			obj.processMoving( e.clientY ); 
		}

		this._parentTable.onmouseup = function()
		{
			obj.endMoving();
		}

		this._parentTable.onmouseout = function(e)
		{
		    if ( arguments.length == 0 )
        		e = event;

        	var b = GetBounds(this);
			var left_border   = b.Left;
			var top_border    = b.Top;
			var right_border  = left_border + b.Width;
			var bottom_border = top_border  + b.Height;
			
			// it is necessary to prevent incorrect action on mouseout event
			if( e.clientX<=left_border || e.clientX>=right_border ||
				e.clientY<=top_border  || e.clientY>=bottom_border )
			{
				obj.endMoving();
			}
		}
	},

	processMoving: function(mouse_y)	
	{
		// check and correct mouse_y if it is necessary
		if( mouse_y < this._upperLimit ){
			mouse_y = this._upperLimit;
		}
		if( mouse_y > this._lowerLimit ){
			mouse_y = this._lowerLimit;
		}
		this._DIVMovable.style.top = mouse_y - this._beginPosition + 'px';
		this._topShear = mouse_y - this._beginPosition;
	},
	
	endMoving: function()
	{
		this._DIVMovable.className = this._class;
		this._DIVMovable.style.top = '0px';
		document.onselectstart = function() {}
		document.onselect = function() {}
		var new_top = this._topPosition + this._topShear;
		if( new_top < (this._upperLimit - (this._beginPosition - this._topPosition)) ){
			new_top = this._upperLimit - (this._beginPosition - this._topPosition);
		}
		if( new_top > this._lowerLimit + ((this._topPosition + 6) - this._beginPosition) ){
			new_top = this._lowerLimit + ((this._topPosition + 6) - this._beginPosition);
		}
		this._topPosition = new_top;
		this._topShear = 0;
		this._parentTable.onmousemove = '';
		this._parentTable.onmouseup = '';
		this._parentTable.onmouseout = '';
		eval(this._endMoveHandler);
	},
	
	free: function()
	{
		this._parentTable.onmousemove = '';
		this._parentTable.onmouseup = '';
		this._parentTable.onmouseout = '';
		this._DIVMovable.onmousedown = '';
		with(this._DIVMovable.style)
		{
			cursor = 'default';
		}		
	}
}

function CSelection()
{
	this.lines = Array();
	this.Length = 0;
	this.prev = -1;
	this.Checkbox = null;
}

CSelection.prototype = 
{
	SetCheckBox: function (checkbox)
	{
		this.Checkbox = checkbox;
	},
	
	Free: function ()
	{
		this.lines = Array();
		this.Length = 0;
		this.prev = -1;
	},
	
	AddLine: function (line)
	{
		this.lines.push(line);
		this.Length = this.lines.length;
	},
	
	ChangeLineId: function (msg, newId)
	{
		for (var i = this.Length-1; i >= 0; i--) {
			var line = this.lines[i];
			if (line.MsgUid == msg.Uid) {
				if (newId) {
					line.Id = newId;
					line.Node.id = newId;
				}
				line.MsgFromAddr = msg.FromAddr;
				line.MsgSubject = msg.Subject;
				line.ApplyFromSubj();
			}
		}
	},
	
	GetCheckedLines: function ()
	{
		var idArray = Array();
		var unreaded = 0;
		for (var i = this.Length-1; i >= 0; i--) {
			var line = this.lines[i];
			if (line.Checked == true) {
				if (!line.Read)
					unreaded++;
				idArray.push(line.Id);
			}
		}
		return {IdArray: idArray, Unreaded: unreaded};
	},
	
	CheckCtrlLine: function(id)
	{
		for (var i = this.Length-1; i >= 0; i--) {
			var line = this.lines[i];
			if (line.Id == id){
				if (line.Checked == false) {
					line.Check();
					this.prev = i;
				} else {
					line.Uncheck();
				}
			}
		}
		this.ReCheckAllBox();
	},
	
	CheckLine: function(id)
	{
		for (var i = this.Length-1; i >= 0; i--) {
			var line = this.lines[i];
			if (line.Id == id){
				line.Check();
				this.prev = i;
			} else {
				line.Uncheck();
			}
		}
		this.ReCheckAllBox();
	},
	
	DragItemsNumber: function (id)
	{
		var findLine = null;
		var number = 0;
		for (var i = this.Length-1; i >= 0; i--) {
			var line = this.lines[i];
			if (line.Id == id){
				findLine = line;
			}
			if (line.Checked) {
				number++;
			}
		}
		if (null == findLine) {
			return 0;
		} else if (findLine.Checked) {
			return number;
		} else {
			this.CheckLine(id);
			return 1;
		}
	},
	
	CheckShiftLine: function(id)
	{
		if (this.prev == -1) {
			this.CheckLine(id);
		} else {
			var isChecking = false;
			var prev = this.prev;
			for (var i = 0; i < this.Length; i++) {
				var line = this.lines[i];
				if (this.prev == i || line.Id == id)
					isChecking = isChecking ? false : true;
				if (line.Id == id)
					prev = i;
				if (isChecking || this.prev == i || line.Id == id) {
					line.Check();
				} else {
					line.Uncheck();
				}
				if (this.prev == i && line.Id == id)
					isChecking = isChecking ? false : true;
			}
		}
		this.ReCheckAllBox();
	},
	
	CheckAll: function ()
	{
		for (var i = this.Length-1; i >= 0; i--) {
			this.lines[i].Check();
		}
		this.prev = -1;
	},
	
	UncheckAll: function ()
	{
		for (var i = this.Length-1; i >= 0; i--) {
			this.lines[i].Uncheck();
		}
		this.prev = -1;
	},
	
	ReCheckAllBox: function()
	{
		var isAllCheck = true;
		for (var i = this.Length-1; i >= 0; i--)
		{
			if (this.lines[i].Checked == false)
			{
				isAllCheck = false;
				break;
			}
		}
		if (null != this.Checkbox)
		{
			this.Checkbox.checked = isAllCheck;
		}
	}
}

function CreateToolBarItemClick(type)
{
	return function () { RequestMessagesOperationHandler(type, [], 1); }
}

function CreateReplyClick(type)
{
	return function () {
		WebMail.ReplyClick(type);
	}
}

function CToolButton(container, path, text, title, imgFile, imgClass, langField, titleLangField)
{
	this.Cont = container;
	this._imgFile = imgFile;
	this._path = path;
	this._langField = langField;
	if (titleLangField) {
		this._titleLangField = titleLangField;
	} else {
		this._titleLangField = langField;
	}
	
	this.Img = null;
	this._text = null;
	
	this.Build(container, path, text, title, imgFile, imgClass);
}

CToolButton.prototype = {
	SetImgFile: function (imgFile) {
		this._imgFile = imgFile;
		this.SetImgSrc();
	},
	
	SetImgPath: function (path)
	{
		this._path = path;
		this.SetImgSrc();
	},
	
	SetImgSrc: function ()
	{
		this.Img.src = this._path + this._imgFile;
	},
	
	MakeActive: function (className, classNameOver, imgFile, clickHandler)
	{
		this.SetImgFile(imgFile);
		this.Cont.className = className;
		this.Cont.onclick = clickHandler;
		this.Cont.onmouseover = function () { this.className = classNameOver; }
		this.Cont.onmouseout = function () { this.className = className; }
	},

	MakeInActive: function (className, imgFile)
	{
		this.SetImgFile(imgFile);
		this.Cont.className = className;
		this.Cont.onclick = function () { };
		this.Cont.onmouseover = function () { }
		this.Cont.onmouseout = function () { }
	},
	
	ChangeLang: function (langField)
	{
		if (langField) {
			this._langField = langField;
		}
		if (this._langField.length > 0) {
			this.SetText(Lang[this._langField]);
		}
		if (this._titleLangField.length > 0) {
			this.Img.title = Lang[this._titleLangField];
		}
	},

	SetText: function (text)
	{
		this._text.innerHTML = text;
	},
	
	ShowText: function ()
	{
		this._text.className = '';
	},
	
	HideText: function ()
	{
		var prop = ReadStyle(this.Img, 'display');
		if (prop == 'none') {
			this._text.className = '';
		} else {
			this._text.className = 'wm_hide';
		}
	},
	
	Build: function (container, path, text, title, imgFile, imgClass)
	{
		this.Img = CreateChildWithAttrs(container, 'img', [['src', path + imgFile], ['class', imgClass], ['title', title]]);
		this._text = CreateChild(container, 'span');
		this.SetText(text);
	}
}

function CToolBar(parent, skinName)
{
	this._skinName = skinName;

	this.table = CreateChild(parent, 'table');
	this.table.className = 'wm_toolbar';
	var tr = this.table.insertRow(0);
	this._container = tr.insertCell(0);
	
	this._descriptions = Array();
	this._descriptions[TOOLBAR_NEW_MESSAGE] = {
		title: Lang.NewMessage,
		imgFile: 'new_message.gif',
		imgClass: 'wm_menu_new_message_img',
		langField: 'NewMessage'
	}
	this._descriptions[TOOLBAR_REFRESH] = {
		title: Lang.Refresh,
		imgFile: 'refresh.gif',
		imgClass: 'wm_menu_check_mail_img',
		langField: 'Refresh'
	}
	this._descriptions[TOOLBAR_DELETE] = {
		title: $Delete[DELETE],
		imgFile: 'delete.gif',
		imgClass: 'wm_menu_delete_img',
		langField: 'Delete'
	}
	this._descriptions[TOOLBAR_FORWARD] = {
		title: Lang.Forward,
		imgFile: 'forward.gif',
		imgClass: 'wm_menu_forward_img',
		langField: 'Forward'
	}
	this._descriptions[TOOLBAR_SEND_MESSAGE] = {
		title: Lang.SendMessage,
		imgFile: 'send.gif',
		imgClass: 'wm_menu_send_message_img',
		langField: 'SendMessage'
	}
	this._descriptions[TOOLBAR_SAVE_MESSAGE] = {
		title: Lang.SaveMessage,
		imgFile: 'save.gif',
		imgClass: 'wm_menu_save_message_img',
		langField: 'SaveMessage'
	}
	this._descriptions[TOOLBAR_PRINT_MESSAGE] = {
		title: Lang.Print,
		imgFile: 'print.gif',
		imgClass: 'wm_menu_print_message_img',
		langField: 'Print'
	}
	
	this._buttons = Array();
}

CToolBar.prototype = {
	ShowTextLabels: function () {
		var iCount = this._buttons.length;
		for (var i=0; i<iCount; i++) {
			this._buttons[i].ShowText();
		}
	},
	
	HideTextLabels: function () {
		var iCount = this._buttons.length;
		for (var i=0; i<iCount; i++) {
			this._buttons[i].HideText();
		}
	},
	
	ChangeSkin: function (newSkin) {
		var iCount = this._buttons.length;
		for (var i=0; i<iCount; i++) {
			this._buttons[i].SetImgPath('skins/' + newSkin + '/menu/');
		}
		this._skinName = newSkin;
	},
	
	ChangeLang: function () {
		var iCount = this._buttons.length;
		for (var i=0; i<iCount; i++) {
			this._buttons[i].ChangeLang();
		}
	},

	AddItem: function(itemId, clickHandler, mode) {
		var div = CreateChild(this._container, 'div');
		div.onmouseover = function() { this.className = 'wm_toolbar_item_over'; }
		div.onmouseout = function() { this.className = 'wm_toolbar_item'; }
		if (mode) {
			div.className = 'wm_hide';
		} else {
			div.className = 'wm_toolbar_item';
		}
		var itemDesc = this._descriptions[itemId];
		
		var button = new CToolButton(div, 'skins/' + this._skinName + '/menu/', itemDesc.title, itemDesc.title, itemDesc.imgFile, itemDesc.imgClass, itemDesc.langField);
		this._buttons.push(button);
		
		div.onclick = clickHandler;
		return div;
	},
	
	AddNextPrevItem: function(itemId) {
		var div = CreateChild(this._container, 'div');

		if (TOOLBAR_PREV_MESSAGE == itemId) {
			var title = Lang.PreviousMsg;
			var titleLangField = 'PreviousMsg';
			var gif = 'message_up.gif';
		} else {
			var title = Lang.NextMsg;
			var titleLangField = 'NextMsg';
			var gif = 'message_down.gif';
		}
		
		var button = new CToolButton(div, 'skins/' + this._skinName + '/menu/', '', title, gif, 'wm_menu_next_prev_img', '', titleLangField);
		this._buttons.push(button);
		return button;
	},
	
	AddPriorityItem: function() {
		var div = CreateChild(this._container, 'div');
		var button = new CToolButton(div, 'skins/' + this._skinName + '/menu/', Lang.Normal, Lang.Importance, 'priority_normal.gif', 'wm_menu_priority_img', 'Normal', 'Importance');
		this._buttons.push(button);
		return button;
	},

	AddReplyItem: function(replyNumber, popupMenus, mode) {
		var replyMenu = CreateChild(document.body, 'div');
		replyMenu.className = 'wm_hide';
		for (var i in $Reply) {
			if (i != replyNumber) {
				var item = CreateChild(replyMenu, 'div');
				item.onmouseover = function() { this.className = 'wm_menu_item_over'; }
				item.onmouseout = function() { this.className = 'wm_menu_item'; }
				item.className = 'wm_menu_item';

				var button = new CToolButton(item, 'skins/' + this._skinName + '/menu/', $Reply[i], $Reply[i], Reply[i].Image, 'wm_menu_replyall_img', Reply[i].LangField);
				this._buttons.push(button);

				item.onclick = CreateReplyClick(i);
			}
		}

		var replyReplace = CreateChild(this._container, 'div');
		if (mode) {
			replyReplace.className = 'wm_hide';
		} else {
			replyReplace.className = 'wm_tb';
		}
		var replyTitle = CreateChild(replyReplace, 'div');
		replyTitle.className = 'wm_toolbar_item';

		var button = new CToolButton(replyTitle, 'skins/' + this._skinName + '/menu/', $Reply[replyNumber], $Reply[replyNumber], Reply[replyNumber].Image, 'wm_menu_reply_img', Reply[replyNumber].LangField);
		this._buttons.push(button);

		replyTitle.onclick = CreateReplyClick(replyNumber);
		var replyControl = CreateChild(replyReplace, 'div');
		replyControl.className = 'wm_toolbar_item';

		var button = new CToolButton(replyControl, 'skins/' + this._skinName + '/menu/', '', '', 'popup_menu_arrow.gif', 'wm_menu_control_img', '');
		this._buttons.push(button);

		popupMenus.addItem(replyMenu, replyControl, 'wm_popup_menu', replyReplace, replyTitle, 'wm_tb', 'wm_tb_press', 'wm_toolbar_item', 'wm_toolbar_item_over');
		return replyReplace;
	}
}


function CVariableColumn(id, params, hasCheckBox, selection)
{
	this.Id = -1;
	this.Field = '';
	this._langField = '';
	this._imgPath = '';
	this._langNumber = -1;

	this.Align = 'center';
	this.Width = 100;
	this.MinWidth = 100;
	this._left = 0;
	this._padding = 2;

	this._htmlElem = null;
	this.LineElem = null;

	this._isResize = false;
	this.Resizer = null;
	this.isLast = false;
	this._resizerWidth = 3;

	this.filled = false;
	this.CheckBox = null;
	if (hasCheckBox && id == IH_CHECK)
	{
		this._isCheckBox = true;
		this._selection = selection;
	}
	else
	{
		this._isCheckBox = false;
		this._selection = null;
	}
	this.ChangeField(id, params);
}

CVariableColumn.prototype = 
{
	ChangeField: function (id, params, skinName)
	{
		this.Id = id;
		this.Field = 'f' + params.DisplayField;
		this._langField = params.LangField;
		this._imgPath = params.Picture;
		if (params.Align == 'left' || params.Align == 'center' || params.Align == 'right')
		{
			this.Align = params.Align;
		}
		else
		{
			this.Align = 'center';
		}
		if (this.filled == false)
		{
			this.Width = params.Width;
			this.filled = true;
		}
		this.MinWidth = params.MinWidth;
		this._isResize = params.IsResize;
		if (skinName)
		{
			this.SetContent(skinName);
		}
	},
	
	SetContent: function (skinName)
	{
		var contentNode = null;
		if (this._isCheckBox)
		{
			contentNode = document.createElement('input');
			contentNode.type = 'checkbox';
			var obj = this;
			contentNode.onclick = function ()
			{
				if (null != obj._selection && obj._selection.Length > 0)
				{
					if (contentNode.checked)
					{
						obj._selection.CheckAll();
					}
					else
					{
						obj._selection.UncheckAll();
					}
				}
			}
			this.CheckBox = contentNode;
		}
		else if (this._langField.length > 0)
		{
			contentNode = document.createElement('span');
			contentNode.innerHTML = Lang[this._langField];
			if (this._langNumber == -1)
			{
				this._langNumber = WebMail.LangChanger.Register('innerHTML', contentNode, this._langField, '', '');
			}
			else
			{
				this._langNumber = WebMail.LangChanger.Register('innerHTML', contentNode, this._langField, '', '', this._langNumber);
			}
		}
		else if (this._imgPath.length > 0)
		{
			contentNode = document.createElement('img');
			contentNode.src = 'skins/' + skinName + '/' + this._imgPath;
		}
		CleanNode(this._htmlElem);
		var nobr = CreateChild(this._htmlElem, 'nobr');
		if (null != contentNode)
		{
			nobr.appendChild(contentNode);
		}
	},
	
	SetWidth: function (width)
	{
		if (this.Width != width)
		{
			this.Width = width;
			this._htmlElem.style.width = width - 2*this._padding - this._resizerWidth + 'px';
			if (this.LineElem != null)
			{
				this.LineElem.style.width = width - 2*this._padding + 'px';
			}
		}
	},
	
	ResizeWidth: function ()
	{
		var width = this.Resizer._leftPosition - this._left + this._resizerWidth;
		this.SetWidth(width);
		return this.Resizer._leftPosition + this._resizerWidth;
	},
	
	ResizeLeft: function (left)
	{
		if (this.isLast)
		{
			this.SetWidth(this.Width + this._left - left);
		}
		this._left = left;
		this._htmlElem.style.left = left + 'px';
		if (null != this.Resizer)
		{
			this.Resizer.updateLeftPosition(left + this.Width - this._resizerWidth);
		}
		if (this.isLast)
		{
			return left;
		}
		else
		{
			return left + this.Width;
		}
	},
	
	Build: function (parent, xleft, isLast, resizeHandler, skinName)
	{
		this.isLast = isLast;
		var child = CreateChild(parent, 'div');
		with (child.style)
		{
			textAlign = this.Align;
			paddingLeft = '2px';
			paddingRight = '2px';
			width = (this.Width - 2*this._padding - this._resizerWidth) + 'px';
			left = xleft + 'px';
			overflow = 'hidden';
		}
		this._left = xleft;
		this._htmlElem = child;
		this.SetContent(skinName);
		if (!isLast)
		{
			var child = CreateChild(parent, 'div');
			child.className = 'wm_inbox_headers_separate';
			with (child.style)
			{
				width = this._resizerWidth + 'px';
				left = (xleft + this.Width - this._resizerWidth) + 'px';
			}
			var child1 = CreateChild(child, 'div');
			if (this._isResize)
			{
				this.Resizer = new CVerticalResizer(child, parent, this._resizerWidth, xleft + this.MinWidth, 10, xleft + this.Width - this._resizerWidth, resizeHandler, 2);
			}
			return xleft + this.Width;
		}
		return xleft;
	}
}

function CVariableTable(skinName, selection, dragNDrop, hasCheckBox)
{
	this._skinName = skinName;
	
	this._columnsCount = 0;
	this._columnsArr = Array();
	this._width = 0;
	
	this._headers = null;
	this._lines = null;
	this._linesTbl = null;
	
	this._selection = selection;
	this._dragNDrop = dragNDrop;
	this._timer = null;
	this._lastClickLineId = '';
	
	this.hasCheckBox = hasCheckBox;
}

CVariableTable.prototype = 
{
	CleanLines: function (msg)
	{
		this._selection.Free();
		if (null != this._dragNDrop) this._dragNDrop.SetSelection(null);
		CleanNode(this._lines);
		this._linesTbl = null;
		var div = CreateChild(this._lines, 'div');
		div.className = 'wm_inbox_info_message';
		div.innerHTML = msg;
	},
	
	ChangeSkin: function (newSkin)
	{
		this._skinName = newSkin;
		for (var i=0; i<this._columnsCount; i++)
		{
			var column = this._columnsArr[i];
			column.SetContent(newSkin);
		}
	},
	
	ResizeColumnsHeight: function ()
	{
		var hOffsetHeight = this._headers.offsetHeight;
		var lOffsetHeight = this._lines.offsetHeight;
		var minRightWidth = 0;
		for (var i=this._columnsCount-1; i>=0; i--)
		{
			if (this._columnsArr[i].Resizer != null)
			{
				this._columnsArr[i].Resizer.updateVerticalSize(hOffsetHeight, hOffsetHeight + lOffsetHeight - 2);
				this._columnsArr[i].Resizer.updateMinRightWidth(minRightWidth);
			}
			if (i == this._columnsCount-1)
			{
				minRightWidth += this._columnsArr[i].MinWidth;
			}
			else
			{
				minRightWidth += this._columnsArr[i].Width;
			}
		}
	},
	
	ResizeColumnsWidth: function (number)
	{
		var left = this._columnsArr[number].ResizeWidth();
		for (var i=number+1; i<this._columnsCount; i++)
		{
			left = this._columnsArr[i].ResizeLeft(left);
		}
		this._width = left;
		this.ResizeColumnsHeight();
	},
	
	Resize: function (width)
	{
		if (width < this._width + this._columnsArr[this._columnsCount - 1].MinWidth)
		{
			width = this._width + this._columnsArr[this._columnsCount - 1].MinWidth;
		}
		this._headers.style.width = width + 'px';
		this._lines.style.width = width + 'px';
		if (this._linesTbl != null)
		{
			this._linesTbl.style.width = width + 'px';
		}

		var lastCell = this._columnsArr[this._columnsCount - 1];
		if (lastCell != null)
		{
			lastCell.SetWidth(width - this._width + lastCell._resizerWidth);
		}
		
		this.ResizeColumnsHeight();
	},
	
	GetHeight: function ()
	{
		var height = 0;
		var offsetHeight = this._headers.offsetHeight;
		if (offsetHeight) height += offsetHeight;
		offsetHeight = this._lines.offsetHeight;
		if (offsetHeight) height += offsetHeight;
		return height;
	},
	
	GetLines: function ()
	{
		return this._lines;
	},
	
	SetLinesHeight: function (height)
	{
		this._lines.style.height = height +'px';
	},
	
	AddColumn: function (id, params)
	{
		var column = new CVariableColumn(id, params, this.hasCheckBox, this._selection);
		this._columnsArr[this._columnsCount++] = column;
		return column;
	},
	
	Fill: function (objsArr, separator, screenId, clickHandler, dblClickHandler)
	{
		CleanNode(this._lines);
		this._lastClickLineId = '';
		if (null != this._dragNDrop) this._dragNDrop.SetSelection(this._selection);
		var tbl = CreateChild(this._lines, 'table');
		this._linesTbl = tbl;
		for (var i=0; i<objsArr.length; i++)
		{
			var tr = tbl.insertRow(i);
			tr.className = 'wm_inbox_item';
			var obj = objsArr[i];
			tr.id = obj.GetIdForList(separator, screenId);
			line = new CVariableMsgLine(this._skinName, obj, tr, this.hasCheckBox);
			for (var j=0; j<this._columnsCount; j++)
			{
				var column = this._columnsArr[j];
				var td = tr.insertCell(j);
				line.SetContainer(column.Field, td);
				if (column.Field == 'fCheck' || column.Field == 'fHasAttachments')
					td.name = 'not_view';
				with (td.style)
				{
					textAlign = column.Align;
					paddingLeft = column._padding + 'px';
					paddingRight = column._padding + 'px';
				}
				if (i == 0)
				{
					column.LineElem = td;
					td.style.width = column.Width - 2*column._padding + 'px';
				}
			}
			this._selection.AddLine(line);
			if (null != this._dragNDrop) this._dragNDrop.AddDragObject(tr);
			var obj = this;
			tr.onclick = function(e)
			{
				if (null != obj._dragNDrop) obj._dragNDrop.EndDrag();
				e = e ? e : window.event;
				if (Browser.Mozilla) {var elem = e.target;}
				else {var elem = e.srcElement;}
				var elem1 = elem;
				while (elem && elem.tagName != 'TD')
				{
					elem = elem.parentNode;
				}
				if (elem1 && elem1.tagName == 'INPUT' || e.ctrlKey)
				{
					obj._selection.CheckCtrlLine(this.id);
				}
				else if (e.shiftKey)
				{
					obj._selection.CheckShiftLine(this.id);
				}
				else if (obj.hasCheckBox && elem1 && elem1.tagName == 'NOBR' && elem1.id.substr(0,12) == 'view_message')
				{
					dblClickHandler.call(this);
				}
				else if (!obj.hasCheckBox)
				{
					obj._selection.CheckLine(this.id);
					if (obj._lastClickLineId != this.id)
					{
						obj._lastClickLineId = this.id;
						obj._timer = setTimeout(clickHandler + "('" + JsQuote(this.id) + "')", 200);
					}
				}
			}
			tr.ondblclick = function (e)
			{
				e = e ? e : window.event;
				if (Browser.Mozilla) {var elem = e.target;}
				else {var elem = e.srcElement;}
				if (!(elem && elem.tagName == 'INPUT'))
				{
					if (null != obj._dragNDrop) obj._dragNDrop.EndDrag();
					if (null != obj._timer) clearTimeout(obj._timer);
					dblClickHandler.call(this);
				}
			}
		}
		if (null != this._selection.Checkbox)
		{
			this._selection.Checkbox.checked = false;
		}
	},
	
	Build: function (parent)
	{
		var div = CreateChild(parent, 'div');
		div.className = 'wm_inbox';

		var headers = CreateChild(div, 'div');
		headers.className = 'wm_inbox_headers';
		this._headers = headers;

		var left = 0;
		for (var i=0; i<this._columnsCount; i++)
		{
			var column = this._columnsArr[i];
			left = column.Build(headers, left, (i == this._columnsCount-1), 'ResizeMessagesTab(' + i + ');', this._skinName);
			if (null != column.CheckBox)
			{
				this._selection.SetCheckBox(column.CheckBox);
			}
		}
		this._width = left;
		
		var lines = CreateChild(div, 'div');
		lines.className = 'wm_inbox_lines';
		this._lines = lines;
	}
}

function CVariableCell(node, content)
{
	this.Node = node;
	this.Content = content;
}

function CVariableMsgLine(skinName, msg, tr, hasCheckBox)
{
	tr.onmousedown = function() { return false; }	//don't select content in Opera
	tr.onselectstart = function() { return false; }	//don't select content in IE
	tr.onselect = function() { return false; }		//don't select content in IE
	this._skinName = skinName;

	this._className = '';
	this.Checked = false;
	this.hasCheckBox = hasCheckBox;

	this.Node = tr;
	this.Id = tr.id;
	this.SetClassName();
	this.ApplyClassName();
	
	if (this.hasCheckBox)
	{
		var checkBox = document.createElement('input');
		checkBox.type = 'checkbox';
		this.fCheck = new CVariableCell(checkBox, '');
	}
	else
	{
		this.fCheck = new CVariableCell(null, '');
	}
	
	var content = '';
	if (msg.HasAttachments)
	{
		content = '<img src="skins/' + this._skinName + '/menu/attachment.gif" />';
	}
	this.fHasAttachments = new CVariableCell(null, content);

	this.MsgFromAddr = msg.FromAddr;
	this.MsgDate = msg.Date;
	this.MsgSize = msg.Size;
	this.MsgSubject = msg.Subject;
	this.MsgUid = msg.Uid;
	this.fFromAddr = new CVariableCell(null, msg.FromAddr);
	this.fToAddr = new CVariableCell(null, msg.ToAddr);
	this.fDate = new CVariableCell(null, msg.Date);
	this.fSize = new CVariableCell(null, GetFriendlySize(msg.Size));
	this.fSubject = new CVariableCell(null, msg.Subject);
}

CVariableMsgLine.prototype = 
{
	Check: function()
	{
		this.Checked = true;
		if (this.hasCheckBox)
		{
			this.fCheck.Node.checked = true;
		}
		this.ApplyClassName();
	},

	Uncheck: function()
	{
		this.Checked = false;
		if (this.hasCheckBox)
		{
			this.fCheck.Node.checked = false;
		}
		this.ApplyClassName();
	},
	
	SetClassName: function ()
	{
		this._className = 'wm_inbox_item';
	},
	
	ApplyClassName: function ()
	{
		if (this.Checked)
			this.Node.className = this._className + '_select';
		else
			this.Node.className = this._className;
	},
	
	SetContainer: function (field, container)
	{
		if (field == 'fCheck' && this.hasCheckBox)
		{
			container.appendChild(this.fCheck.Node);
		}
		else
		{
			this[field].Node = container;
			if ((field == 'fFromAddr' || field == 'fSubject') && this.hasCheckBox)
			{
				container.innerHTML = '<a href="javascript:void(0)" onclick="return false;"><nobr id="view_message_' + Math.random() + '">' + this[field].Content + '</nobr></a>';
			}
			else
			{
				container.innerHTML = '<nobr>' + this[field].Content + '</nobr>';
			}
		}
	},

	ApplyFromSubj: function ()
	{
		if (this.hasCheckBox)
		{
			this.fFromAddr.Content = '<a href="javascript:void(0)" onclick="return false;"><nobr id="view_message_' + Math.random() + '">' + this.MsgFromAddr + '</nobr></a>';
			this.fSubject.Content = '<a href="javascript:void(0)" onclick="return false;"><nobr id="view_message_' + Math.random() + '">' + this.MsgSubject + '</nobr></a>';
		}
		else
		{
			this.fFromAddr.Content = '<nobr>' + this.MsgFromAddr + '</nobr>';
			this.fSubject.Content = '<nobr>' + this.MsgSubject + '</nobr>';
		}
		this.fFromAddr.Node.innerHTML = this.fFromAddr.Content;
		this.fSubject.Node.innerHTML = this.fSubject.Content;
	}
}

Ready(INIT_SCREENS_PARTS);