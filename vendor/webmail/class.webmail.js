/*
Classes:
	CWebMail
	CSettingsList
	CDataType
	CDataSource
	CCache
*/

function CheckShownItems()
{
	WebMail.PopupMenus.checkShownItems();
}

function CWebMail(Title, SkinName){
	this.isBuilded = false;
	this.shown = false;
	
	this.Accounts = null;
	this.SectionId = -1;
	this.Sections = Array();
	this.ScreenId = -1;
	this.Screens = Array();
	this.DataSource = null;
	this.ScriptLoader = new CScriptLoader();
	this.Settings = null;
	this.ListScreenId = -1;
	this.StartScreen = -1;
	this.ScreenIdForLoad = this.ListScreenId;
	this._message = null;
	this._replyAction = -1;
	this.forEditParams = [];

	this._title = Title;
	this._skinName = SkinName;
	this.LangChanger = new CLanguageChanger();
	this._fromField = '';
	this._email = '';

	this._html = document.getElementById('html');
	this._content = document.getElementById('content');
	this._copyright = document.getElementById('copyright');
	this._popupMenus = null;
	this._skinLink = document.getElementById('skin');
	this._newSkinLink = null;
	this._head = document.getElementsByTagName('head')[0];
	
	this._accountsBar = null;
	var _replaceDiv = null;
	var _accountNameObject = null;

	this._fadeEffect = new CFadeEffect('WebMail._fadeEffect');
	this._infoMessage = null;
	this._infoObj = null;
	this._infoCount = 0;
	this._errorObj = null;
	this._reportObj = null
	this.BuildInformation();
	
	this._idAcct = -1;
	this._signature = null;
	this.HistoryArgs = null;
	this.HistoryObj = null;
	
	this._msgsPerPage = 20;
	this._viewMode = VIEW_MODE_WITH_PANE;
	
	this._pageSwitcher = new CPageSwitcher(SkinName);
	
	this._messagesList = null;
}

CWebMail.prototype = {
	PlaceData: function(Data)
	{
		var screen;
		var Type = Data.Type;
		switch (Type){
			case TYPE_ACCOUNT_PROPERTIES:
				this._fromField = Data.Email;
				_accountNameObject.innerHTML = Data.Email;
				var obj = this;
				_accountNameObject.onclick = function () {
					SetHistoryHandler(
						{
							ScreenId: obj.ListScreenId
						}
					);
					return false;
				}
				if (this.ScreenId == SCREEN_NEW_MESSAGE) {
					screen = this.Screens[SCREEN_NEW_MESSAGE];
					if (screen) {
						screen.SetFromField(this._fromField);
					}
				}
				break;
			case TYPE_SETTINGS_LIST:
				this.Settings = Data;
				this.ParseSettings();
				if (screen = this.Screens[this.ListScreenId]) screen.ParseSettings(Data);
				if (this.ScreenId == -1)
					if (this.StartScreen != -1) {
						SelectScreenHandler(this.StartScreen);
					} else {
						if (this.ListScreenId != -1) {
							SelectScreenHandler(this.ListScreenId);
						} else {
							SelectScreenHandler(SCREEN_MESSAGES_LIST_VIEW);
						}
					}
				break;
			case TYPE_UPDATE:
				switch (Data.Value) {

					case 'send_message':
						this.ShowReport(Lang.ReportMessageSent)

						SetHistoryHandler(
							{
								ScreenId: this.ListScreenId
							}
						);
						break;
				}
			break;
			case TYPE_MESSAGES_LIST:
				this._messagesList = Data;
				if (screen = this.Screens[SCREEN_MESSAGES_LIST_VIEW]) screen.PlaceData(Data);
				if (screen = this.Screens[SCREEN_MESSAGES_LIST]) screen.PlaceData(Data);
				if (screen = this.Screens[SCREEN_VIEW_MESSAGE]) screen.PlaceData(Data);
				break;
			case TYPE_MESSAGE:
				this._message = Data;
				var uid = Data.Uid;
				if (this.DataSource.Cache.ClearMessage(uid, Data.Charset)) {
					this.DataSource.Cache.ClearMessagesList();
					var screen = this.Screens[this.ListScreenId];
					if (screen) {
						if (screen._selection) {
							var newId = this._message.GetIdForList(screen._SEPARATOR, screen.Id);
							screen._selection.ChangeLineId(this._message, newId);
						}
					}
				}
				if (4 == this.forEditParams.length && id == this.forEditParams[0] && uid == this.forEditParams[1] &&
				 fId == this.forEditParams[2] && fName == this.forEditParams[3]) {
					if (SCREEN_NEW_MESSAGE == this.ScreenId) {
						this.Screens[SCREEN_NEW_MESSAGE].UpdateMessage(this._message);
					} else {
						Screens[SCREEN_NEW_MESSAGE].ShowHandler = 'screen.UpdateMessage(this._message);';
						SelectScreenHandler(SCREEN_NEW_MESSAGE);
					}
					this.forEditParams = [];
				}
				if (this._replyAction != -1) {
					Screens[SCREEN_NEW_MESSAGE].ShowHandler = 'screen.UpdateMessageForReply(this._message, ' + this._replyAction + ');';
					SelectScreenHandler(SCREEN_NEW_MESSAGE);
					this._replyAction = -1;
				} else if (this.ListScreenId == SCREEN_MESSAGES_LIST) {
					if (this.ScreenId != SCREEN_VIEW_MESSAGE) {
						SelectScreenHandler(SCREEN_VIEW_MESSAGE);
					}
				}
				if (this.ScreenId == SCREEN_VIEW_MESSAGE || null != this.HistoryArgs && this.HistoryArgs.ScreenId == SCREEN_VIEW_MESSAGE) {
					this.Screens[SCREEN_VIEW_MESSAGE].Fill(this._message);
				}
				if (this.ScreenId == SCREEN_MESSAGES_LIST_VIEW)
					this.Screens[SCREEN_MESSAGES_LIST_VIEW].PlaceData(Data);
				break;
			case TYPE_MESSAGES_OPERATION:
				if (Data.OperationInt == DELETE && this.ScreenId == SCREEN_VIEW_MESSAGE) {
					var screen = this.Screens[SCREEN_VIEW_MESSAGE];
					if (screen) screen.PlaceData(Data);
				}
				if (screen = this.Screens[SCREEN_MESSAGES_LIST_VIEW]) screen.PlaceData(Data);
				if (screen = this.Screens[SCREEN_MESSAGES_LIST]) screen.PlaceData(Data);
				break;
			default:
				if (this.ScreenId != -1)
					this.Screens[this.ScreenId].PlaceData(Data);
				break;
		}
	},
	
	SetStartScreen: function (start)
	{
		switch (start) {
			case 1:
				this.StartScreen = SCREEN_NEW_MESSAGE;
				if (ToAddr && ToAddr.length > 0)
				{
					Screens[SCREEN_NEW_MESSAGE].ShowHandler = "screen.SetToField('" + ToAddr + "')";
				}
			break;
			default:
				this.StartScreen = this.ListScreenId;
			break;
		}
	},
	
	CheckHistoryObject: function (args)
	{
		if (!args.IdAcct) args.IdAcct = this._idAcct;
		var checked = false; //parameters' set is such as previouse one
		if (null == this.HistoryObj) {
			checked = true;  //another
		}
		if (!checked) {
			switch (args.ScreenId) {
				case SCREEN_MESSAGES_LIST_VIEW:
				case SCREEN_VIEW_MESSAGE:
					if (args.MsgId != 'undefined' && args.MsgId != null) {
						if (args.MsgUid == this.HistoryObj.MsgUid && args.MsgCharset == this.HistoryObj.MsgCharset && 
						 args.ScreenId == this.HistoryObj.ScreenId) {
							checked = false;
						} else {
							checked = true;
						}
					} else {
						checked = true;
					}
				break;
				default:
					checked = true;
				break;
			}
		}
		if (checked) {
			this.HistoryObj = args;
			return args;
		} else {
			return null;
		}
	},
	
	RestoreFromHistory: function (args)
	{
		if (this._fromField.length == 0)
		{
			this.DataSource.Get(TYPE_ACCOUNT_PROPERTIES, { }, [], '');
		}
		this.HistoryArgs = args;
		switch (args.ScreenId) 
		{
			case SCREEN_NEW_MESSAGE:
				if (args.ForReply) 
				{
					this._replyAction = args.ReplyType;
					GetMessageHandler(args.MsgUid, args.MsgParts, args.MsgCharset);
				}
			break;
			case SCREEN_VIEW_MESSAGE:
				if (SCREEN_MESSAGES_LIST_VIEW == this.ScreenId)
				{
					var listScreen = this.Screens[SCREEN_MESSAGES_LIST_VIEW];
					if (listScreen)
					{
						var msg = new CMessage();
						msg.Uid = args.MsgUid;
						msg.Charset = args.MsgCharset;
						listScreen.msgForView = msg;
					}
				}
				GetMessageHandler(args.MsgUid, args.MsgParts, args.MsgCharset);
			break;
		}
		if (this.ScreenId != args.ScreenId) {
			if (SCREEN_VIEW_MESSAGE != args.ScreenId) {
				SelectScreenHandler(args.ScreenId);
			}
		} else {
			var screen;
			if (screen = this.Screens[this.ScreenId]) {
				screen.RestoreFromHistory(args);
				this.HistoryArgs = null;
			} else {
				SelectScreenHandler(args.ScreenId);
			}
		}
	},
	
	LoadAttachment: function (attachment)
	{
		var screen;
		if (screen = this.Screens[SCREEN_NEW_MESSAGE])
			screen.LoadAttachment(attachment);
	},
	
	ParseSettings: function ()
	{
		var settings = this.Settings;
		if (this._msgsPerPage != settings.MsgsPerPage) {
			this._msgsPerPage = settings.MsgsPerPage;
			this.DataSource.Cache.ClearMessagesList();
		}
		if (this._viewMode != settings.ViewMode || this.ListScreenId == -1) {
			this._viewMode = settings.ViewMode;
			if (this._viewMode & VIEW_MODE_WITH_PANE == VIEW_MODE_WITH_PANE) {
				this.ListScreenId = SCREEN_MESSAGES_LIST_VIEW;
			} else {
				this.ListScreenId = SCREEN_MESSAGES_LIST;
			}
		}
		this.ChangeSkin(settings.DefSkin);
	},

	UpdateSettings: function (newSettings)
	{
		if (null != newSettings.MsgsPerPage) {
			this.Settings.MsgsPerPage = newSettings.MsgsPerPage;
		}
		if (null != newSettings.DisableRte) {
			this.Settings.AllowDhtmlEditor = newSettings.DisableRte ? false : true;
		}
		if ((null != newSettings.TimeOffset) && (newSettings.TimeOffset != this.Settings.TimeOffset)) {
			this.Settings.TimeOffset = newSettings.TimeOffset;
		}
		if (null != newSettings.ViewMode) {
			this.Settings.ViewMode = newSettings.ViewMode;
		}
		if (null != newSettings.DefSkin) {
			this.Settings.DefSkin = newSettings.DefSkin;
		}
		if (null != newSettings.DefLang) {
			if (this.Settings.DefLang != newSettings.DefLang) {
				this.Settings.DefLang = newSettings.DefLang;
				var obj = this;
				this.ScriptLoader.Load([LanguageUrl], function () { obj.LoadFromLang(); });
			}
		}
		if ((null != newSettings.DateFormat) && (newSettings.DateFormat != this.Settings.DateFormat)) {
			this.Settings.DateFormat = newSettings.DateFormat;
		}
		this.ParseSettings();
		if (this.ScreenId != this.ListScreenId && (this.ScreenId == SCREEN_MESSAGES_LIST || this.ScreenId == SCREEN_MESSAGES_LIST_VIEW))
			SelectScreenHandler(this.ListScreenId);
	},
	
	LoadFromLang: function ()
	{
		var obj = this;
		this.ScriptLoader.Load(['inc.from-lang.js', '_defines.js'], function () { obj.ChangeLang(); });
	},
	
	ChangeLang: function ()
	{
		this.SetTitle();
		var screen = this.Screens[SCREEN_MESSAGES_LIST_VIEW];
		if (screen && null != screen._toolBar) { screen._toolBar.ChangeLang(); }
		screen = this.Screens[SCREEN_MESSAGES_LIST];
		if (screen && null != screen._toolBar) { screen._toolBar.ChangeLang(); }
		screen = this.Screens[SCREEN_VIEW_MESSAGE];
		if (screen && null != screen._toolBar) { screen._toolBar.ChangeLang(); }
		screen = this.Screens[SCREEN_NEW_MESSAGE];
		if (screen && null != screen._toolBar) { screen._toolBar.ChangeLang(); }
		this.LangChanger.Go();
	},

	SetTitle: function ()
	{
		document.title = this._title + ' - ' + Lang.Title[this.ScreenId];
	},
	
	ChangeSkin: function (newSkin)
	{
		if (this._skinName != newSkin){
			this._skinName = newSkin;
			var newLink = document.createElement('link');
			newLink.setAttribute('type', 'text/css');
			newLink.setAttribute('rel', 'stylesheet');
			newLink.href = 'skins/' + newSkin + '/styles.css';
			this._head.appendChild(newLink);
			this._newSkinLink = newLink;
			if (this.isBuilded) {
				this._errorObj.ChangeSkin(newSkin);
			}
			this._pageSwitcher.ChangeSkin(newSkin);
		} else
			this._newSkinLink = null;
	},

	Build: function()
	{
		this._popupMenus = new CPopupMenus();
		this.BuildAccountsList();
		document.body.onclick = ClickBodyHandler;
		this._pageSwitcher.Build();
		this.isBuilded = true;
	},
	
	ResizeBody: function (mode)
	{
		if (this.isBuilded) {
			var width = GetWidth();
			if (Browser.IE && Browser.Version < 7)
				document.body.style.width = width + 'px';
			if (this.ScreenId != -1)
				this.Screens[this.ScreenId].ResizeBody(mode);
			this._errorObj.Resize();
			this._infoObj.Resize();
			this._reportObj.Resize();
		}
	},
	
	ClickBody: function (ev)
	{
		if (this.isBuilded) {
			this._popupMenus.checkShownItems();
			if (this.ScreenId != -1)
				this.Screens[this.ScreenId].ClickBody(ev);
		}
	},
	
	ReplyClick: function (type)
	{
		if (this.ListScreenId == SCREEN_MESSAGES_LIST_VIEW) {
			var screen;
			if (screen = this.Screens[this.ListScreenId]) {
				var msg = screen._msgObj;
			}
		} else {
			var msg = this._message;
		}
		if (msg != null)
		{
			if (type == FORWARD)
			{
				var parts = [PART_MESSAGE_HEADERS, PART_MESSAGE_FORWARD_PLAIN, PART_MESSAGE_ATTACHMENTS];
			}
			else
			{
				var parts = [PART_MESSAGE_HEADERS, PART_MESSAGE_REPLY_PLAIN];
			}
			SetHistoryHandler(
				{
					ScreenId: SCREEN_NEW_MESSAGE,
					ForReply: true,
					ReplyType: type,
					MsgUid: msg.Uid,
					MsgParts: parts
				}
			);
		}
	},
	
	ShowScreen: function(loadHandler)
	{
		var screenId = this.ScreenIdForLoad;
		var screen, section;
		if (screen = this.Screens[screenId]) {
			if (this._newSkinLink != null) {
				this._head.removeChild(this._skinLink);
				this._skinLink = this._newSkinLink;
				this._newSkinLink = null;
			}
			if (this.ScreenId != -1)
				this.Screens[this.ScreenId].Hide();
			this.ScreenId = screenId;
			this.SectionId = Screens[screenId].SectionId;
			if (!screen.isBuilded)
				screen.Build(this._content, this._accountsBar, this._popupMenus, this.Settings);
			if (screen.hasCopyright) {
				this._copyright.className = 'wm_copyright';
				SetBodyAutoOverflow(true);
			} else {
				this._copyright.className = 'wm_hide';
				SetBodyAutoOverflow(false);
			}
			this.Show();
			document.title = this._title + ' - ' + Lang.Title[screenId];
			eval(Screens[screenId].ShowHandler);
			switch (screen.Id) {
				case SCREEN_MESSAGES_LIST_VIEW:
					screen.SetPageSwitcher(this._pageSwitcher);
					break;
				case SCREEN_MESSAGES_LIST:
					screen.SetPageSwitcher(this._pageSwitcher);
					break;
				case SCREEN_NEW_MESSAGE:
					screen.SetFromField(this._fromField);
					break;
				case SCREEN_VIEW_MESSAGE:
					screen.ParseSettings(this.Settings);
					if (!(Browser.IE && Browser.Version > 6)) {
						if (null != this._message)
							screen.PlaceData(this._message);
					}
					if (null != this._messagesList)
						screen.PlaceData(this._messagesList);
					break;
			}
			if (null != this.HistoryArgs && screen.Id == this.HistoryArgs.ScreenId) {
				screen.Show(this.Settings, this.HistoryArgs);
			} else {
				screen.Show(this.Settings, null);
			}
			this.HistoryArgs = null;
		} else {
			if (! this.isBuilded) {
				this.Hide();
				this._copyright.className = 'wm_hide';
				this.Build();
				this.ShowInfo(Lang.InfoWebMailLoading);
				this.DataSource.onError = ErrorHandler;
				this.DataSource.onGet = TakeDataHandler;
			}
			var sectionId = Screens[screenId].SectionId;
			if (section = this.Sections[sectionId]) {
				var sectionScreens = Sections[sectionId].Screens;
				for (var i in sectionScreens) {
					if (!(screen = this.Screens[i])) {
						eval(sectionScreens[i]);
						if (Screens[screenId].PreRender)
							screen.Build(this._content, this._accountsBar, this._popupMenus, this.Settings);
						this.Screens[i] = screen;
					}
				}
				loadHandler.call(this);
			} else {
				this.Sections[sectionId] = true;
				this.ScriptLoader.Load(Sections[sectionId].Scripts, loadHandler);
			}
		}
	},
	
	Show: function ()
	{
		if (!this.shown)
		{
			this.shown = true;
			this.HideInfo();
			this._content.className = 'wm_content';
		}
	},

	Hide: function ()
	{
		this.shown = false;
		this._content.className = 'wm_hide';
	},
	
	BuildAccountsList: function()
	{
		this._accountsBar = CreateChild(this._content, 'table');
		this._accountsBar.className = 'wm_accountslist';
		var tr = this._accountsBar.insertRow(0);
		var td = tr.insertCell(0);
		_replaceDiv = CreateChild(td, 'div');
		_replaceDiv.className = 'wm_accountslist_email';
		_accountNameObject = CreateChild(_replaceDiv, 'a');
		_accountNameObject.href = '#';
		_accountNameObject.onclick = function() {return false;}

		div = CreateChild(td, 'div'); div.className = 'wm_accountslist_logout';
		a = CreateChild(div, 'a'); a.href = LoginUrl + '?mode=logout'; a.innerHTML = Lang.Logout;
		WebMail.LangChanger.Register('innerHTML', a, 'Logout', '');
	},
	
	HideInfo: function()
	{
		if (this.shown) {
			if (this._infoCount > 0)
			{
				this._infoCount--;
			}
			if (this._infoCount == 0)
			{
				this._infoObj.Hide();
			}
		}
	},
	
	ShowError: function(errorDesc)
	{
		this._errorObj.Show(errorDesc);
		if (this.ScreenId == SCREEN_NEW_MESSAGE)
		{
			var screen = this.Screens[SCREEN_NEW_MESSAGE];
			if (screen)
			{
				screen.SetErrorHappen();
			}
		}
	},

	ShowInfo: function(Info)
	{
		if (this.shown) {
			this._infoMessage.innerHTML = Info;
			this._infoObj.Show();
			this._infoCount++;
			this._infoObj.Resize();
		}
	},

	ShowReport: function(report, priorDelay)
	{
		if (this.shown)
		{
			this._reportObj.Show(report, priorDelay);
		}
	},

	BuildInformation: function()
	{
		var tbl = document.getElementById('info_cont');
		this._infoMessage = document.getElementById('info_message');
		this._infoObj = new CInformation(tbl, 'wm_information');

		this._errorObj = new CError('WebMail._errorObj', this._skinName);
		this._errorObj.Build();
		this._errorObj.SetFade(this._fadeEffect);

		this._reportObj = new CReport('WebMail._reportObj');
		this._reportObj.Build();
		this._reportObj.SetFade(this._fadeEffect);
	}	
}

function CSettingsList()
{
	this.Type = TYPE_SETTINGS_LIST;
	this.ShowTextLabels = false;
	this.MsgsPerPage = 20;
	this.DefSkin = 'Hotmail_Style';
	this.MailBoxLimit = 0;
	this.ViewMode = VIEW_MODE_WITH_PANE;
}

CSettingsList.prototype = {
	GetStringDataKeys: function(_SEPARATOR)
	{
		var arDataKeys = [ ];
		return arDataKeys.join(_SEPARATOR);
	},//GetStringDataKeys

	GetFromXML: function(RootElement)
	{
		var attr = RootElement.getAttribute('show_text_labels');
		if (attr) this.ShowTextLabels = (attr == 1) ? true : false;

		attr = RootElement.getAttribute('msgs_per_page');
		if (attr) this.MsgsPerPage = attr - 0;

		attr = RootElement.getAttribute('mailbox_limit');
		if (attr) this.MailBoxLimit = attr - 0;

		attr = RootElement.getAttribute('view_mode');
		if (attr) this.ViewMode = attr - 0;

		var settingsParts = RootElement.childNodes;
		var settCount = settingsParts.length;
		for (var i = settCount-1; i >= 0; i--) {
			var part = settingsParts[i].childNodes;
			if (part.length > 0)
				switch (settingsParts[i].tagName) {
					case 'def_skin':
						this.DefSkin = part[0].nodeValue;
						break;
				}//switch
		}//for
	}//GetFromXML
}

function CDataType(Type, Caching, CacheLimit, CacheByParts, RequestParams, GetRequest)
{
	this.Type = Type;//int
	this.Caching = Caching;//bool
	this.CacheLimit = CacheLimit;//int
	this.CacheByParts = CacheByParts;//bool
	this.RequestParams = RequestParams;//obj
	/*
	ex. for messages list: {
			Page: "page"
		}
	*/
	this.GetRequest = GetRequest;//string; ex. for messages list: 'messages'
}

function CDataSource(DataTypes, ActionUrl, ErrorHandler, InfoHandler, LoadHandler, TakeDataHandler, RequestHandler)
{
	this._SEPARATOR = '@$%';

	this.Cache = new CCache(DataTypes);
	this.NetLoader = new CNetLoader();

	this.Data = null;

	this.ActionUrl = ActionUrl;

	this.Info = null;
	this.ErrorDesc = null;

	this.onInfo = InfoHandler;
	this.onError = ErrorHandler;
	this.onLoad = LoadHandler;
	this.onGet = TakeDataHandler;
	this.onRequest = RequestHandler;

	this.DataTypes = [];
	for (Key in DataTypes)
	{
		this.DataTypes[DataTypes[Key].Type] = DataTypes[Key];
	}
}

CDataSource.prototype = {
	Get: function( intDataType, objDataKeys, arDataParts, xml )
	{
		var Cache = this.Cache;
		var DataType = this.DataTypes[intDataType];
		var Caching = DataType.Caching;
		var CacheByParts = DataType.CacheByParts;

		var Mode = 0;
		if (CacheByParts) {
			for (Key in arDataParts) {
				Mode = (1 << arDataParts[Key]) | Mode;
			}
		}

		var arDataKeys = [];
		for(Key in objDataKeys) { arDataKeys.push( objDataKeys[Key] ); }
		if (Caching) {
			var StringDataKeys = DataType.GetRequest + this._SEPARATOR + arDataKeys.join(this._SEPARATOR);
		} else {
			var StringDataKeys = DataType.GetRequest;
		}

		this.Data = null;
		if (Caching && Cache.ExistsData( intDataType, StringDataKeys )) {// there is in the cache!
			this.Data = Cache.GetData( intDataType, StringDataKeys );
			if (CacheByParts) {
				Mode = (Mode | this.Data.Parts) ^ this.Data.Parts;
			}
		}

		if (!(Caching && Cache.ExistsData( intDataType, StringDataKeys )) || (CacheByParts && (Mode != 0))) {
			var Url = this.ActionUrl;
			var arParams = [];
			arParams['action'] = 'get';
			arParams['request'] = DataType.GetRequest;
			if (CacheByParts) arParams['mode'] = Mode;
			var objRequestParams = DataType.RequestParams;
			for(var Param in objRequestParams)
			{
				arParams[objRequestParams[Param]] = objDataKeys[Param];
			}
			var XMLParams = this.GetXML(arParams, xml);
			this.onRequest.call(this);
			//alert(['SEND', XMLParams]);//
			this.NetLoader.LoadXMLDoc( Url, 'xml=' + encodeURIComponent(XMLParams), this.onLoad, this.onError );
		} else {
			this.onGet.call(this);
		}
	},
	
	Request: function( objParams, xml )
	{
		var Url = this.ActionUrl;
		var XMLParams = this.GetXML(objParams, xml);
		this.onRequest.call(this);
		//alert(['SEND', XMLParams]);//
		this.NetLoader.LoadXMLDoc( Url, 'xml=' + encodeURIComponent(XMLParams), this.onLoad, this.onError );
	},
	
	GetXML: function( arParams, xml )
	{
		var strResult = '';
		for(var ParamName in arParams)
		{
			strResult += '<param name="' + ParamName + '" value="' + arParams[ParamName] + '"/>';
		}
		strResult = '<?xml version="1.0" encoding="utf-8"?><webmail>' + strResult + xml + '</webmail>';
		return strResult;
	},
	
	ParseXML: function(XmlDoc, TextDoc)
	{
		if (XmlDoc && XmlDoc.documentElement && typeof(XmlDoc) == 'object' && typeof(XmlDoc.documentElement) == 'object')
		{
			var RootElement = XmlDoc.documentElement;
			if (RootElement && RootElement.tagName == 'webmail') {
				var Objects = RootElement.childNodes;
				if ( Objects.length == 0 ) {
					this.ErrorDesc = Lang.ErrorParsing + '<br/>Error code 4.<br/>' + Lang.ResponseText + '<br/>' + TextDoc;
					this.onError.call(this);
				} else {
					this.Data = null;
					var ObjectXML = null;
					var isObject = false;
					for (var key=Objects.length-1; key>=0; key--) {
						var ObjectName = Objects[key].tagName;
						switch (ObjectName) {
							case 'settings_list':
								this.Data = new CSettingsList();
								ObjectXML = Objects[key]; isObject = true;
								break;
							case 'update':
								this.Data = new CUpdate();
								ObjectXML = Objects[key]; isObject = true;
								break;
							case 'message':
								this.Data = new CMessage();
								ObjectXML = Objects[key]; isObject = true;
								break;
							case 'messages':
								this.Data = new CMessages();
								ObjectXML = Objects[key]; isObject = true;
								break;
							case 'operation_messages':
								this.Data = new COperationMessages();
								ObjectXML = Objects[key]; isObject = true;
								break;
							case 'account':
								this.Data = new CAccountProperties();
								ObjectXML = Objects[key]; isObject = true;
								break;
							case 'information':
								var Info = Objects[key].childNodes[0].nodeValue;
								if (Info && Info.length > 0) {
									WebMail.ShowReport(Info, 10000);
								}
								break;
							case 'error':
								var attr = Objects[key].getAttribute('code');
								if (attr) {
									document.location = LoginUrl + '?error=' + attr;
								} else {
									var ErrorDesc = Objects[key].childNodes[0].nodeValue;
									if (ErrorDesc && ErrorDesc.length > 0) {
										this.ErrorDesc = ErrorDesc;
									} else {
										this.ErrorDesc = Lang.ErrorWithoutDesc;
									}
									this.onError.call(this);
								}
								break;
							case 'session_error':
								document.location = LoginUrl + '?error=1';
							break;
						}//switch (ObjectName)
					}//for
					if (isObject == true) {
						if (this.Data && ObjectXML) {
							var Cache = this.Cache;
							var intDataType = this.Data.Type;
							var DataType = this.DataTypes[intDataType]
							if (typeof(DataType) == 'object') {
								var Caching = DataType.Caching;
								var CacheByParts = DataType.CacheByParts;
								this.Data.GetFromXML(ObjectXML);
								if (Caching) {
									StringDataKeys = DataType.GetRequest + this._SEPARATOR + this.Data.GetStringDataKeys(this._SEPARATOR);
									if (CacheByParts && Cache.ExistsData( intDataType, StringDataKeys)) {
										this.Data = Cache.GetData( intDataType, StringDataKeys );
										this.Data.GetFromXML(ObjectXML);
										Cache.ReplaceData(intDataType, StringDataKeys, this.Data);
									} else {
										Cache.AddData(intDataType, StringDataKeys, this.Data);
									}
								}
							} else {
								this.Data.GetFromXML(ObjectXML);
							}
							this.onGet.call(this);
						} else {
							this.ErrorDesc = Lang.ErrorParsing + '<br/>Error code 3.<br/>' + Lang.ResponseText + '<br/>' + TextDoc;
							this.onError.call(this);
						}
					}//if (isObject == true)
				}// if (Objects.length == 0)
			} else {
				this.ErrorDesc = Lang.ErrorParsing + '<br/>Error code 2.<br/>' + Lang.ResponseText + '<br/>' + TextDoc;
				this.onError.call(this);
			}//if (RootElement.tagName == 'webmail')
		} else {
			this.ErrorDesc = Lang.ErrorParsing + '<br/>Error code 1.<br/>' + Lang.ResponseText + '<br/>' + TextDoc;
			this.onError.call(this);
		}//if (RootElement)
	}
}

function CCache(DataTypes)
{
	this.DataTypes = [];
	this.Dictionaries = [];
	for(a in DataTypes)
	{
		this.AddDataType(DataTypes[a]);
	}
}

CCache.prototype = {
	AddDataType: function(ObjectDataType)
	{
		this.DataTypes[ObjectDataType.Type] = ObjectDataType;
		this.Dictionaries[ObjectDataType.Type] = new CDictionary();
	},

	ExistsData: function(DataType, Key)
	{
		if( typeof( this.DataTypes[DataType] ) == 'object' && typeof( this.Dictionaries[DataType] ) == 'object' ) {
			return this.Dictionaries[DataType].exists( Key );
		} else {
			return false;
		}
	},

	AddData: function(DataType, Key, Value)
	{
		if (this.Dictionaries[DataType].count >= this.DataTypes[DataType].CacheLimit) {
			var Keys = this.Dictionaries[DataType].keys();
			this.Dictionaries[DataType].remove(Keys[0]);
		}
		this.Dictionaries[DataType].add( Key, Value );
	},
	
	ClearMessagesList: function()
	{
		var dict = this.Dictionaries[TYPE_MESSAGES_LIST];
		dict.removeAll();
	},
	
	SetMessagesCount: function(count)
	{
		var dict = this.Dictionaries[TYPE_MESSAGES_LIST];
		var keys = dict.keys();
		for (var i in keys) {
			var msg = dict.getVal(keys[i]);
			if (msg.MessagesCount != count) {
				dict.remove(keys[i]);
			}
		}
	},
	
	ClearMessage: function(uid, charset)
	{
		var deleted = false;
		var dict = this.Dictionaries[TYPE_MESSAGE];
		var keys = dict.keys();
		for (var i in keys) {
			var msg = dict.getVal(keys[i]);
			if (msg.Uid == uid && msg.Charset != charset) {
				dict.remove(keys[i]);
				deleted = true;
			}
		}
		return deleted;
	},
	
	GetData: function(DataType, Key)
	{
		return this.Dictionaries[DataType].getVal( Key );
	},
	
	ReplaceData: function(DataType, Key, Value)
	{
		this.Dictionaries[DataType].setVal( Key, Value );
	}
}

Ready(INIT_WEBMAIL);