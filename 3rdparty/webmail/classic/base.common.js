/*
Classes:
	CPageSwitcher
	CVerticalResizer
	CHorizontalResizer
	CSelectionPart
	CSelection
	CMainContainer
	CMessageList
*/

function CPageSwitcher(skinName)
{
	this._skinName = skinName;
	this._mainCont = null;
	this._pagesCont = null;
	this._count = 0;
	this._perPage = 0;
}

CPageSwitcher.prototype = {
	Show: function (page, perPage, count, beginOnclick, endOnclick)
	{
		this._count = count;
		this._perPage = perPage;
		if (count > perPage) {
			var strPages = '';
			var pagesCount = Math.ceil(count/perPage);
			if (pagesCount > 4)
			{
				var firstPage = page - 2;
				if (firstPage < 1) firstPage = 1;
				var lastPage = firstPage + 4;
				if (lastPage > pagesCount)
				{
					lastPage = pagesCount;
					firstPage = lastPage - 4;
				}
			} else {
				var firstPage = 1;
				var lastPage = pagesCount;
			}
			if (firstPage != lastPage) {
				if (firstPage > 1){
					strPages += '<a href="#" onclick="' + beginOnclick + '1' + endOnclick + ' return false;"><img title="First Page" style="width: 8px; height: 9px;" src="skins/' + this._skinName + '/page_switchers/inbox_first_page.gif" /></a>';
					strPages += '<a href="#" onclick="' + beginOnclick + firstPage + endOnclick + ' return false;"><img title="Previous Page" style="width: 5px; height: 9px;" src="skins/' + this._skinName + '/page_switchers/inbox_prev_page.gif" /></a>';
				}
				for (var i = firstPage; i <= lastPage; i++)
				{
					if (page == i)
						strPages += '<font>' + i + '</font>';
					else
						strPages += '<a href="#" onclick="' + beginOnclick + i + endOnclick + ' return false;">' + i + '</a>';
				}
				if (pagesCount > lastPage){
					strPages += '<a href="#" onclick="' + beginOnclick + lastPage + endOnclick + ' return false;"><img title="Next Page" style="width: 5px; height: 9px;" src="skins/' + this._skinName + '/page_switchers/inbox_next_page.gif" /></a>';
					strPages += '<a href="#" onclick="' + beginOnclick + pagesCount + endOnclick + ' return false;"><img title="Last Page" style="width: 8px; height: 9px;" src="skins/' + this._skinName + '/page_switchers/inbox_last_page.gif" /></a>';
				}
				this._mainCont.className = 'wm_inbox_page_switcher';
				this._pagesCont.innerHTML = strPages;
			}
		}
	},
	
	GetLastPage: function (removeCount)
	{
		var count = this._count - removeCount;
		var perPage = this._perPage;
		var page = Math.ceil(count/perPage);
		if (page < 1) page = 1;
		return page;
	},
	
	Hide: function ()
	{
		this._mainCont.className = 'wm_hide';
	},

	Replace: function (obj)
	{
		var oBounds = GetBounds(obj);
		var ps = this._mainCont;
		ps.style.top = (oBounds.Top + 3) + 'px';
		ps.style.left = (oBounds.Left + oBounds.Width - ps.offsetWidth - 18) + 'px';
	},
	
	ChangeSkin: function (skinName)
	{
		this._skinName = skinName;
	},
	
	Build: function ()
	{
		var tbl = CreateChild(document.body, 'table');
		this._mainCont = tbl;
		tbl.className = 'wm_hide';
		var tr = tbl.insertRow(0);
		var td = tr.insertCell(0);
		td.className = 'wm_inbox_page_switcher_left';
		td = tr.insertCell(1);
		this._pagesCont = td;
		td.className = 'wm_inbox_page_switcher_pages';
		td = tr.insertCell(2);
		td.className = 'wm_inbox_page_switcher_right';
	}
}

//----------------------

function CVerticalResizer(DIVMovable, parentTable, divHSize, minLeftWidth, minRightWidth, leftPosition, endMoveHandler, type) {
	// set internal data by outside parameters
	
	this._type 			 = (type) ? type : 0;
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

	this._divVSize = 1;

	with(this._DIVMovable.style)
	{
		width = this._divHSize + 'px';
		height = this._divVSize + 'px';
		cursor = 'e-resize';
	}
	switch (this._type) {
		case 0:
			this._leftShear = 0;
			with(this._DIVMovable.style)
			{
				background = 'none';
				left = '1px';
			}
			break;
		case 1:
			this._leftShear = leftPosition;
			break;
	}
	this._DIVMovable.innerHTML = '&nbsp;';
	
	// this handler is necessary to begins moving
	var obj = this;
	this._DIVMovable.onmousedown = function(e)
	{
		obj.beginMoving(e);
		return false; //don't select content in Opera
	}
}

CVerticalResizer.prototype = {
	updateVerticalSize: function(vert_size)
	{
		this._divVSize = vert_size;
		this._DIVMovable.style.height = this._divVSize + 'px';
	},
	
	beginMoving: function(e)
	{
		Iframe.HideIE();
   		e = e ? e : event;
		this._beginPosition = e.clientX;
		if (this._type == 0) this._DIVMovable.style.background = '#979899';
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
				eval(this._endMoveHandler);
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
		switch (this._type) {
			case 0:
				this._DIVMovable.style.background = 'none';
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
		}
		CreateCookie('wm_vert_resizer', this._leftPosition, 20);
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
	
	// set some internal data by default values (this values must be overwritten)
	this._upperBorder  = 114;
	this._lowerBorder = 815;
	this._upperLimit   = 268;
	this._lowerLimit  = 665;

	this._divHSize = 1	;

	with(this._DIVMovable.style)
	{
		width = this._divHSize + 'px';
		height = this._divVSize + 'px';
		cursor = 's-resize';
		background = 'none';
		top = '0px';
	}
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
		Iframe.HideIE();
   		e = e ? e : event;
		this._beginPosition = e.clientY; 
		this._DIVMovable.style.background = '#979899';
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
		this._DIVMovable.style.background = 'none';
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
		Iframe.ShowIE();
		CreateCookie('wm_horiz_resizer', this._topPosition, 20);
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

//---------------------

function CSelectionPart(tr, skinName)
{
	tr.onmousedown = function() {return false;}//don't select content in Opera
	tr.onselectstart = function() {return false;}//don't select content in IE
	tr.onselect = function() {return false;}//don't select content in IE
	this._tr = tr;
	this._className = tr.className;

	this.Id = tr.id;
	this.Checked = false;
	
	var collection = this._tr.getElementsByTagName('td');
	if (collection.length > 5) {
		this._checkTd = collection[0];
		var checkboxcoll = this._checkTd.getElementsByTagName('input');
		if (checkboxcoll.length > 0) {
				this._checkbox = checkboxcoll[0];
		}
		this._fromTd = collection[2];
		this._subjTd = collection[5];
	}
	
	this.Read = true;
	this.Replied = false;
	this.Forwarded = false;
	this.Deleted = false;
	this.Gray = false;
	
	var idArray = tr.id.split("-----");
	
	this.MsgUid =(idArray.length > 0) ? idArray[0] : "-1";
	this.MsgFromAddr = "";
	this.MsgSubject = "";

	this.SetClassName();
	this.ApplyClassName();
}

CSelectionPart.prototype = {
	Check: function()
	{
		this.Checked = true;
		this.ApplyClassName();
		this.AppleCheckBox();
	},

	Uncheck: function()
	{
		this.Checked = false;
		this.ApplyClassName();
		this.AppleCheckBox();
	},
	
	SetClassName: function ()
	{
		this._className = 'wm_inbox_item';
	},
	
	AppleCheckBox: function ()
	{
		if (this._checkbox) this._checkbox.checked = (this.Checked);
	},
	
	ApplyClassName: function ()
	{
		var className = this._className;
		if (this.Checked) className += '_select';
		this._tr.className = className;
	},
	
	ApplyFromSubj: function ()
	{
		this._fromTd.innerHTML = '<nobr>' + this.MsgFromAddr + '</nobr>';
		this._subjTd.innerHTML = '<nobr>' + this.MsgSubject + '</nobr>';
	}
}

function CSelection(skinName)
{
	this.lines = Array();
	this.length = 0;
	this.prev = -1;
	this._skinName = skinName;
	
	this.AllCheckBox = document.getElementById("allcheck");
	this.LinesObj = document.getElementById("list");
}

CSelection.prototype = 
{
	Fill: function  ()
	{
		var messObj;
		var trCollection = this.LinesObj.getElementsByTagName('tr');
		var iCount = trCollection.length;
		for (var i = 0; i < iCount; i++)
		{
			this.AddLine(new CSelectionPart(trCollection[i], this._skinName));
		}
	},

	AddLine: function (line)
	{
		this.lines.push(line);
		this.length = this.lines.length;
	},
	
	SetParams: function (idArray, field, value, isAllMess)
	{
		var readed = 0;
		if (isAllMess)
			idArray = [-1];
		for (var i = this.length-1; i >= 0; i--) {
			var line = this.lines[i];
			for (var j in idArray) {
				if (line.Id == idArray[j] || isAllMess) {
					var LineArray = idArray[j].split(sep);
					folderId = (LineArray) ? LineArray[2] : '';
					switch (field) {
						case 'Replied':
							line.Replied = value;
							break;
						case 'Forwarded':
							line.Forwarded = value;
							break;
						case 'Gray':
							line.Gray = value;
							line.ApplyClassName();
							break;
					}//switch field
				}//if
			}//for j
		}//for i
		return readed;
	},
	
	ChangeLineId: function (msg, newId)
	{
		for (var i = this.length-1; i >= 0; i--) {
			var line = this.lines[i];
			if (line.MsgUid == msg.Uid) {
				line.Id = newId;
				line._tr.id = newId;
				line.MsgFromAddr = msg.FromAddr;
				line.MsgSubject = msg.Subject;
				line.ApplyFromSubj();
			}
		}
	},
	
	UpdateSubject: function(lineId, subj, from)
	{
		for (var i = this.length-1; i >= 0; i--) {
			var line = this.lines[i];
			if (line.Id == lineId) {
				line.MsgFromAddr = from;
				line.MsgSubject = subj;
				line.ApplyFromSubj();
			}
		}
	},
		
	GetCheckedLines: function ()
	{
		var idArray = Array();
		var unreaded = 0;
		for (var i = this.length-1; i >= 0; i--) {
			var line = this.lines[i];
			if (line.Checked == true) {
				if (!line.Read)
					unreaded++;
				idArray.push(line.Id);
			}
		}
		return {IdArray: idArray, Unreaded: unreaded};
	},
	
	GetCheckedLinesObj: function ()
	{
		var messArray = Array();
		for (var i = this.length-1; i >= 0; i--)
		{
			var line = this.lines[i];
			if (line.Checked == true) messArray.push(line);
		}
		return messArray;
	},
	
	GetLinesById: function (lineId)
	{
		for (var i = this.length-1; i >= 0; i--)
		{
			var line = this.lines[i];
			if (line.Id == lineId) return line;
		}
		return null;
	},
	
	CheckCtrlLine: function(id)
	{
		for (var i = this.length-1; i >= 0; i--) {
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
	
	ReCheckAllBox: function()
	{
		var isAllCheck = true;
		for (var i = this.length-1; i >= 0; i--) {
			if (this.lines[i].Checked == false) { isAllCheck = false;}
		}
		if (this.AllCheckBox)
		{
			this.AllCheckBox.checked = isAllCheck;
		}		
	},
	
	CheckCBox: function(id)
	{
		for (var i = this.length-1; i >= 0; i--) {
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
		
	CheckAllbox: function(objCheckbox)
	{
		for (var i = this.length-1; i >= 0; i--) {
			var line = this.lines[i];
			if (objCheckbox.checked) {
				line.Check();
			} else {
				line.Uncheck();
			}
		}		
	},
	
	CheckLine: function(id)
	{
		for (var i = this.length-1; i >= 0; i--) {
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
		for (var i = this.length-1; i >= 0; i--) {
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
			for (var i = 0; i < this.length; i++) {
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
			}
			//this.prev = prev;
		}
		this.ReCheckAllBox();
	},
	
	UncheckAll: function ()
	{
		for (var i = this.length-1; i >= 0; i--) {
			this.lines[i].Uncheck();
		}
		this.prev = -1;
	}
}

//-------------------

function CMainContainer()
{
		this.table = document.getElementById("main_container");

		this.info = document.getElementById("info");

		this.logo = document.getElementById("logo");
		this.accountslist = document.getElementById("accountslist");
		this.toolbar = document.getElementById("toolbar");
		this.lowtoolbar = document.getElementById("lowtoolbar");
		
		//logo + accountslist + toolbar + lowtoolbar
		this.external_height = 56 + 32 + 26 + 24;
		this.inner_height = 362;
}

CMainContainer.prototype =
{
	getExternalHeight: function()
	{
		var res = 3;
		var offsetHeight = 0;
		offsetHeight = this.logo.offsetHeight;         if (offsetHeight) { res += offsetHeight; }
		offsetHeight = this.accountslist.offsetHeight; if (offsetHeight) { res += offsetHeight; } else { res += 32; }
		offsetHeight = this.toolbar.offsetHeight;      if (offsetHeight) { res += offsetHeight; } else { res += 26; }
		offsetHeight = this.lowtoolbar.offsetHeight;   if (offsetHeight) { res += offsetHeight; } else { res += 24; }
		this.external_height = res;
		return this.external_height;
	},
	
	showContent: function()
	{
		this.info.className = 'wm_hide';
	},
	
	hideContent: function()
	{
		this.info.className = 'wm_information';
	}
}

function CMessageList()
{
	this.page_switcher = PageSwitcher._mainCont;
	
	this.divback = document.getElementById('divbackground');
	this.parent_table = document.getElementById('inbox_part');
	this.parent_div = document.getElementById('inbox_div');

	this.mess_container = document.getElementById('list_container');
	this.mess_table = document.getElementById('list');
	this.subject = document.getElementById('subject');
	
	this.inbox_headers = document.getElementById('inbox_headers');
	
	this.width = 350;
	this.height = 300;
}

CMessageList.prototype =
{
	resizeElementsHeight: function(height)
	{
		this.height = height;
		this.parent_table.style.height = this.height + 'px';
		this.parent_div.style.height = this.height + 'px';
		var ihHeight = this.inbox_headers.offsetHeight; if (ihHeight == 0) ihHeight = 22;
		var bordersHeight = 1;
		this.mess_container.style.height = (this.height - ihHeight - bordersHeight) + 'px';
	},
	
	resizeElementsWidth: function(width)
	{
		this.width = width;
		this.parent_table.style.width = this.width + 'px';
		this.parent_div.style.width = this.width + 'px';
		this.mess_container.style.width = this.width + 'px';
		this.mess_table.style.width = this.width + 'px';
		this.divback.style.width = this.width + 'px';
		this.subject.style.width = (this.width - 390) + 'px';
	}
}