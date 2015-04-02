/*
Classes:
	CPageSwitcher
	CLanguageChanger
	CHistoryStorage
*/

function CPageSwitcher(skinName)
{
	this._skinName = skinName;
	this._mainCont = null;
	this._pagesCont = null;
	this._count = 0;
	this._perPage = 0;
	this.PagesCount = 0;
}

CPageSwitcher.prototype = {
	Show: function (page, perPage, count, beginOnclick, endOnclick)
	{
		this.PagesCount = 0;
		if (page == 0) {
			this._mainCont.className = 'wm_inbox_page_switcher';
		} else {
			this.Hide();
			this._count = count;
			this._perPage = perPage;
			if (count > perPage) {
				var strPages = '';
				var pagesCount = Math.ceil(count/perPage);
				this.PagesCount = pagesCount;
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
						strPages += '<a href="#" onclick="' + beginOnclick + '1' + endOnclick + ' return false;"><img title="' + Lang.FirstPage + '" style="width: 8px; height: 9px;" src="skins/' + this._skinName + '/page_switchers/inbox_first_page.gif" /></a>';
						strPages += '<a href="#" onclick="' + beginOnclick + firstPage + endOnclick + ' return false;"><img title="' + Lang.PreviousPage + '" style="width: 5px; height: 9px;" src="skins/' + this._skinName + '/page_switchers/inbox_prev_page.gif" /></a>';
					}
					for (var i = firstPage; i <= lastPage; i++)
					{
						if (page == i)
							strPages += '<font>' + i + '</font>';
						else
							strPages += '<a href="#" onclick="' + beginOnclick + i + endOnclick + ' return false;">' + i + '</a>';
					}
					if (pagesCount > lastPage){
						strPages += '<a href="#" onclick="' + beginOnclick + lastPage + endOnclick + ' return false;"><img title="' + Lang.NextPage + '" style="width: 5px; height: 9px;" src="skins/' + this._skinName + '/page_switchers/inbox_next_page.gif" /></a>';
						strPages += '<a href="#" onclick="' + beginOnclick + pagesCount + endOnclick + ' return false;"><img title="' + Lang.LastPage + '" style="width: 8px; height: 9px;" src="skins/' + this._skinName + '/page_switchers/inbox_last_page.gif" /></a>';
					}
					this._mainCont.className = 'wm_inbox_page_switcher';
					this._pagesCont.innerHTML = strPages;
				}
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
		ps.style.top = (oBounds.Top - ps.offsetHeight) + 'px';
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

function CLanguageChanger()
{
	this._innerHTML = Array();
	this._iCount = 0;
	this._value = Array();
	this._vCount = 0;
	this._title = Array();
	this._tCount = 0;
}

CLanguageChanger.prototype = {
	Register: function (type, obj, field, end, start, number)
	{
		if (!start) start = '';
		switch (type) {
			case 'innerHTML':
				if (!number)
				{
					number = this._iCount;
					this._iCount++;
				}
				this._innerHTML[number] = {Elem: obj, Field: field, End: end, Start: start};
				return number;
			break;
			case 'value':
				if (!number)
				{
					number = this._vCount;
					this._vCount++;
				}
				this._value[number] = {Elem: obj, Field: field, End: end, Start: start};
				return number;
			break;
			case 'title':
				if (!number)
				{
					number = this._tCount;
					this._tCount++;
				}
				this._title[number] = {Elem: obj, Field: field, End: end, Start: start};
				return number;
			break;
		}
	},
	
	Go: function ()
	{
		var i = 0;
		var iCount = this._innerHTML.length;
		for (i=0; i<iCount; i++) {
			var obj = this._innerHTML[i];
			if (obj) obj.Elem.innerHTML = obj.Start + Lang[obj.Field] + obj.End;
		}

		iCount = this._value.length;
		for (i=0; i<iCount; i++) {
			var obj = this._value[i];
			if (obj) obj.Elem.value = Lang[obj.Field] + obj.End;
		}

		iCount = this._title.length;
		for (i=0; i<iCount; i++) {
			var obj = this._title[i];
			if (obj) obj.Elem.title = Lang[obj.Field] + obj.End;
		}
	}
}

function CHistoryStorage(SettingsStorage)
{
	// this for checking HistoryStorage can working
	this.Ready = false;
	// errors list
	this.Errors = [];
	// save input data
	if(SettingsStorage) {
		this.InputSettings = SettingsStorage;
	}
	// default value for steps limit
	this._DefaultMaxLimitSteps = 50;
	// maximum length for error list
	this._MaxErrorListLength = 20;
	// dictionary for save data
	this.Dictionary = new CDictionary();
	this.InStep = false;
	this.Queue = Array();
	this.KeysInStep = Array();
	this.PrevKey = '';
	
	this._historyKey = null;
	this._historyObjectName = null;
	this._form = null;
	this.iframe = null;
	
	this._iframe = null;

	// execute initialization
	this.Initialize();
}

CHistoryStorage.prototype = {
	AddError: function(StrError){
		if(this.Errors.length >= this._MaxErrorListLength)
		{
			this.Errors.reverse().pop();
			this.Errors.reverse();
		}
		this.Errors[this.Errors.length] = StrError;
	},

	Initialize: function(){
		this.Ready = true;
		if (typeof(this.InputSettings.Document) == 'object' && this.InputSettings.Document != null) {
			this.Document = this.InputSettings.Document;
		} else {
			this.Ready = false;
		}
		if (typeof(this.InputSettings.Browser) == 'object' && this.InputSettings.Browser != null) {
			this.Browser = this.InputSettings.Browser;
		} else {
			this.Ready = false;
		}
		if (typeof(this.InputSettings.HistoryStorageObjectName) == 'string') {
			this.HistoryStorageObjectName = this.InputSettings.HistoryStorageObjectName;
		} else {
			this.Ready = false;
		}
		if (typeof(this.InputSettings.PathToPageInIframe) == 'string') {
			this.PathToPageInIframe = this.InputSettings.PathToPageInIframe;
		} else {
			this.Ready = false;
		}

		var _tempLimit = parseInt(this.InputSettings.MaxLimitSteps);
		if(isNaN(_tempLimit)) {
			this.AddError('The maximum number of steps that you specified is invalid. Default value 15 assigned.');
			_tempLimit = this._DefaultMaxLimitSteps;
		} else {
			if(_tempLimit < 1) {
				this.AddError('The maximum number of steps that you specified is invalid. Default value 15 assigned.');
				_tempLimit = this._DefaultMaxLimitSteps;
			}
		}
		this.MaxLimitSteps = _tempLimit;

		this.iframe = CreateChildWithAttrs(document.body, 'iframe', [['id', 'HistoryStorageIframe'], ['name', 'HistoryStorageIframe'], ['src', EmptyHtmlUrl], ['class', 'wm_hide']]);
		var frm = CreateChildWithAttrs(document.body, 'form', [['action', this.PathToPageInIframe], ['target', 'HistoryStorageIframe'], ['method', 'post'], ['id', 'HistoryForm'], ['name', 'HistoryForm'], ['class', 'wm_hide']]);
		this._historyKey = CreateChildWithAttrs(frm, 'input', [['type', 'text'], ['name', 'HistoryKey']]);
		this._historyObjectName = CreateChildWithAttrs(frm, 'input', [['type', 'text'], ['name', 'HistoryStorageObjectName']]);
		this._form = frm;
		/*with (iframe.style) {
			position = 'absolute';
			top = '0px';
			left = '0px';
			width = '500px';
			height = '500px';
			zIndex = '5';
		}*/
	},

	ProcessHistory: function(HistoryKey) {
		this.InStep = false;
		if (this.KeysInStep[HistoryKey]) {
			delete this.KeysInStep[HistoryKey];
		} else {
			this.RestoreFromHistory(HistoryKey);
		}
	},
	
	RestoreFromHistory: function (HistoryKey) {
		if(this.Dictionary.exists(HistoryKey)) {
			var HistoryObject = this.Dictionary.getVal(HistoryKey);
			var args = HistoryObject.Args;
			var ExecuteCommand = 'window.' + HistoryObject.FunctionName + '(HistoryObject.Args)';
			eval(ExecuteCommand);
		} else {
			this.AddError('The specified key doesn\'t exists in history storage');
		}

		if (this.Queue.length > 0) {
			var key = this.Queue.shift();
			if (this.Dictionary.exists(key)) {
				this.DoStep(key);
			}
		}
	},

	AddStep: function(ObjectData){
		var newKey = String(new Date()) + Math.random();

		if( this.Dictionary.count >= this.MaxLimitSteps ) {
			//remove first step because steps count is more then limit
			var keys = this.Dictionary.keys();
			this.Dictionary.remove( keys[0] );
		}
		//add new step
		this.Dictionary.add( newKey, ObjectData );

		if (this.InStep) {
			//move step key to Queue because previouse step still not finished
			this.Queue.push(newKey);
		} else {
			//realize step
			this.DoStep(newKey);
		}
	},
	
	DoStep: function (newKey) {
		if (Browser.Mozilla) {
			WebMail.DataSource.NetLoader.CheckRequest();
			WebMail.HideInfo();
			this.InStep = false;
		}
		if(this.Ready && !this.Browser.Opera) {
			if (this.KeysInStep[this.PrevKey]) {
				delete this.KeysInStep[this.PrevKey];
			}
			this._historyKey.value = newKey;
			this._historyObjectName.value = this.HistoryStorageObjectName;
			this._form.action = this.PathToPageInIframe + '?param=' + Math.random();
			this._form.submit();
			this.KeysInStep[newKey] = true;
			this.PrevKey = newKey;
			this.InStep = true;
			this.RestoreFromHistory(newKey);
		} else {
			this.RestoreFromHistory(newKey);
			this.AddError('Couldn\'t processing action. See Errors list for details.');
		}
	}
}

Ready(INIT_WEBMAIL_PARTS);