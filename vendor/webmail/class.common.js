/*
Classes, prototypes:
	CBrowser
	CError
	CReport
	ReportPrototype
	CInformation
	CFadeEffect
	CValidate
	CPopupMenu
	CPopupMenus
*/

function CBrowser(){
	this.Init = function(){
		var len = this.Profiles.length;
		for(var i = 0; i < len; i++)
		{
			if(this.Profiles[i].Criterion)
			{
				this.Name = this.Profiles[i].Id;
				this.Version = this.Profiles[i].Version();
				this.Allowed = this.Version >= this.Profiles[i].AtLeast;
     			break;
			}
   		}
		this.IE = (this.Name == "Microsoft Internet Explorer");
		this.Opera = (this.Name == "Opera");
		this.Mozilla = (this.Name == "Mozilla" || this.Name == "Firefox" || this.Name == "Netscape");
		this.Gecko = (this.Opera || this.Mozilla);
	}

	this.Profiles = [
		{
			Id: "Opera",
			Criterion: window.opera,
			AtLeast: 8,
			Version: function()
			{
				var r = navigator.userAgent;
				var start1 = r.indexOf("Opera/");
				var start2 = r.indexOf("Opera ");
				if (-1 == start1) {
					var start = start2 + 6;
					var end = r.length;
				} else {
					var start = start1 + 6;
					var end = r.indexOf(" ");
				}
				r = parseFloat(r.slice(start, end));
				return r;
			}
		},
		{
			Id: "Firefox",
			Criterion:
			(
				(navigator.appCodeName.toLowerCase() == "mozilla") &&
				(navigator.appName.toLowerCase() == "netscape") &&
				(navigator.product.toLowerCase() == "gecko") &&
				(navigator.userAgent.toLowerCase().indexOf("firefox") != -1)
			),
			AtLeast: 1,
			Version: function()
			{
				var r = navigator.userAgent.split(" ").reverse().join(" ");
				r = parseFloat(r.slice(r.indexOf("/")+1,r.indexOf(" ")));
				return r;
			}
		},
		{
			Id: "Netscape",
			Criterion:
			(
				(navigator.appCodeName.toLowerCase() == "mozilla") &&
				(navigator.appName.toLowerCase() == "netscape") &&
				(navigator.product.toLowerCase() == "gecko") &&
				(navigator.userAgent.toLowerCase().indexOf("netscape") != -1)
			),
			AtLeast: 7,
			Version: function()
			{
				var r = navigator.userAgent.split(" ").reverse().join(" ");
				r = parseFloat(r.slice(r.indexOf("/")+1,r.indexOf(" ")));
				return r;
			}
		},
		{
			Id: "Mozilla",
			Criterion:
			(
				(navigator.appCodeName.toLowerCase() == "mozilla") &&
				(navigator.appName.toLowerCase() == "netscape") &&
				(navigator.product.toLowerCase() == "gecko") &&
				(navigator.userAgent.toLowerCase().indexOf("mozilla") != -1)
			),
			AtLeast: 1,
			Version: function()
			{
				var r = navigator.userAgent;
				return parseFloat(r.split("Firefox/").reverse().join(" "));
			}
		},
		{
			Id: "Safari",
			Criterion:
			(
				(navigator.appCodeName.toLowerCase() == "mozilla") &&
				(navigator.appName.toLowerCase() == "netscape") &&
				(navigator.product.toLowerCase() == "gecko") &&
				(navigator.userAgent.toLowerCase().indexOf("safari") != -1)
			),
			AtLeast: 1.2,
			Version: function()
			{
				var r = navigator.userAgent;
				return parseFloat(r.split("Version/").reverse().join(" "));
			}
		},
		{
			Id: "Microsoft Internet Explorer",
			Criterion:
			(
				(navigator.appName.toLowerCase() == "microsoft internet explorer") &&
				(navigator.appVersion.toLowerCase().indexOf("msie") != 0) &&
				(navigator.userAgent.toLowerCase().indexOf("msie") != 0) &&
				(!window.opera)
			),
			AtLeast: 5,
			Version: function()
			{
				var r = navigator.userAgent.toLowerCase();
				r = parseFloat(r.slice(r.indexOf("msie")+4,r.indexOf(";",r.indexOf("msie")+4)));
				return r;
			}
		}
	];

	this.Init();
}

function CError(name, skinName)
{
	this._skinName = skinName;
	this._name = name;
	this._containerObj = null;
	this._messageObj = null;
	this._imgObj = null;
	this._controlObj = null;
	this._fadeObj = null;
	this._delay = 10000;

	this.ChangeSkin = function (newSkin)
	{
		this._skinName = newSkin;
		this._imgObj.src = 'skins/' + this._skinName + '/error.gif';
	},
	
	this.Build = function ()
	{
		var tbl = CreateChild(document.body, 'table');
		tbl.className = 'wm_hide';
		var tr = tbl.insertRow(0);
		var td = tr.insertCell(0);
		td.className = 'wm_info_image';
		var img = CreateChild(td, 'img');
		img.src = 'skins/' + this._skinName + '/error.gif';
		this._imgObj = img;
		td = tr.insertCell(1);
		td.className = 'wm_info_message';
		this._containerObj = tbl;
		this._messageObj = CreateChild(td, 'span');
		this._controlObj = new CInformation(tbl, 'wm_error_information');
	}
}

function CReport(name)
{
	this._name = name;
	this._containerObj = null;
	this._messageObj = null;
	this._controlObj = null;
	this._fadeObj = null;
	this._delay = 5000;

	this.Build = function ()
	{
		var tbl = CreateChild(document.body, 'table');
		tbl.className = 'wm_hide';
		var tr = tbl.insertRow(0);
		var td = tr.insertCell(0);
		td.className = 'wm_info_message';
		this._containerObj = tbl;
		this._messageObj = CreateChild(td, 'span');
		this._controlObj = new CInformation(tbl, 'wm_report_information');
	}
}

ReportPrototype = 
{
	Show: function (msg, priorDelay)
	{
		this._messageObj.innerHTML = msg;
		this._controlObj.Show();
		this._controlObj.Resize();
		if (null != this._fadeObj)
		{
		    if (priorDelay) var interval = this._fadeObj.Go(this._containerObj, priorDelay);
		    else var interval = this._fadeObj.Go(this._containerObj, this._delay);
			if (this._name)
			{
				setTimeout(this._name + '.Hide()', interval);
			}
		}
		else
		{
			if (this._name)
			{
		        if (priorDelay) setTimeout(this._name + '.Hide()', priorDelay);
		        else setTimeout(this._name + '.Hide()', this._delay);
			}
		}
	},
	
	SetFade: function (fadeObj)
	{
		this._fadeObj = fadeObj;
	},
	
	Hide: function ()
	{
		this._controlObj.Hide();
		if (null != this._fadeObj)
		{
			this._fadeObj.SetOpacity(1);
		}
	},
	
	Resize: function ()
	{
		this._controlObj.Resize();		
	}
}

CReport.prototype = ReportPrototype;
CError.prototype = ReportPrototype;

/* for control placement and displaying of information block */
function CInformation(cont, cls)
{
	this._mainContainer = cont;
	this._containerClass = cls;
}

CInformation.prototype = {
	Show: function ()
	{
		this._mainContainer.className = this._containerClass;
	},
	
	Hide: function ()
	{
		this._mainContainer.className = 'wm_hide';
	},

	Resize: function ()
	{
		var tbl = this._mainContainer;
		tbl.style.width = 'auto';
		var offsetWidth = tbl.offsetWidth;
		var width = GetWidth();
		if (offsetWidth >  0.4 * width) {
			tbl.style.width = '40%';
			offsetWidth = tbl.offsetWidth;
		}
		tbl.style.left = (width - offsetWidth) + 'px';
		tbl.style.top = this.GetScrollY() + 'px';
	},

	GetScrollY: function()
	{
		var scrollY = 0;
		if (document.body && typeof document.body.scrollTop != "undefined")
		{
			scrollY += document.body.scrollTop;
			if (scrollY == 0 && document.body.parentNode && typeof document.body.parentNode != "undefined")
			{
				scrollY += document.body.parentNode.scrollTop;
			}
		} else if (typeof window.pageXOffset != "undefined")  {
			scrollY += window.pageYOffset;
		}
		return scrollY;
	}
}

function CFadeEffect(name)
{
	this._name = name;
	this._elem = null;
}

CFadeEffect.prototype = 
{
	Go: function (elem, delay)
	{
		this._elem = elem;
		var interval = 50;
		var iCount = 10;
		var diff = 1/iCount;
		for(var i=0; i<=iCount; i++)
		{
			setTimeout(this._name + '.SetOpacity('+ (1 - diff*i) +')', delay + interval*i);
		}
		return delay + interval*iCount;
	},
	
	SetOpacity: function (opacity)
	{
		var elem = this._elem;
		// Internet Exploder 5.5+
		if (document.body.filters && navigator.appVersion.match(/MSIE ([\d.]+);/)[1]>=5.5)
		{
			opacity *= 100;
			var oAlpha = elem.filters['DXImageTransform.Microsoft.alpha'] || elem.filters.alpha;
			if (oAlpha)
			{
				oAlpha.opacity = opacity;
			}
			else
			{
				elem.style.filter += "progid:DXImageTransform.Microsoft.Alpha(opacity="+opacity+")";
			}
		}
		else
		{
			elem.style.opacity = opacity;		// CSS3 compliant (Moz 1.7+, Safari 1.2+, Opera 9)
			elem.style.MozOpacity = opacity;	// Mozilla 1.6-, Firefox 0.8
			elem.style.KhtmlOpacity = opacity;	// Konqueror 3.1, Safari 1.1
		}
	}
}

function CValidate()
{
}

CValidate.prototype = 
{
    IsEmpty : function (strValue)
    {
        if(strValue.replace(/\s+/g,'') == '')
        {
            return true;
        }
        return false;
    },
    
    HasEmailForbiddenSymbols : function (strValue)
    {
        if(strValue.match(/[^A-Z0-9\"!#\$%\^\{\}`~&'\+-=_@\.]/i))
        {
            return true;
        }
        return false;
    },
    
    IsCorrectEmail : function (strValue)
    {
        if(   strValue.match(/^[A-Z0-9\"!#\$%\^\{\}`~&'\+-=_\.]+@[A-Z0-9\.-]+$/i)  )
        {
            return true;
        }
        return false;
    },
    
    IsCorrectServerName : function (strValue)
    {
        if(!strValue.match(/[^A-Z0-9\.-]/i))
        {
            return true;
        }
        return false;
    },
    
    IsPositiveNumber : function (intValue)
    {
        if(isNaN(intValue) || intValue <= 0 || Math.round(intValue) != intValue)
        {
            return false;
        }
        return true;
    },
    
    IsPort : function (intValue)
    {
        if(this.IsPositiveNumber(intValue) && intValue <= 65535)
        {
            return true;
        }
        return false;
    },
    
    HasSpecSymbols : function (strValue)
    {
        if(strValue.match(/[\"\/\\\*\?<>\|:]/))
        {
            return true;
        }
        return false;
    },
    
    IsCorrectFileName : function (strValue)
    {
        if(!this.HasSpecSymbols(strValue))
        {
            if(strValue.match(/^(CON|AUX|COM1|COM2|COM3|COM4|LPT1|LPT2|LPT3|PRN|NUL)$/i))
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        return false;
    },
    
    CorrectWebPage : function (strValue)
    {
        return strValue.replace(/^[\/;<=>\[\\#\?]+/g,'');
    },
    
    HasFileExtention : function (strValue, strExtension)
    {           
        if( strValue.substr(strValue.length - strExtension.length - 1,strExtension.length + 1).toLowerCase() == '.'+strExtension.toLowerCase())
        {
            return true;
        }
        return false;
    }
    
}

function CPopupMenu(popup_menu, popup_control, menu_class, popup_move, popup_title, move_class, move_press_class, title_class, title_over_class)
{
	this.popup = popup_menu;
	this.control = popup_control;
	this.move = popup_move;
	this.title = popup_title;
	this.menu_class = menu_class;
	this.move_class = move_class;
	this.move_press_class = move_press_class;
	this.title_class = title_class;
	this.title_over_class = title_over_class;
}

function CPopupMenus()
{
	this.items = Array();
	this.isShown = 0;
}

CPopupMenus.prototype = {
	getLength: function()
	{
		return this.items.length;
	},
	
	addItem: function(popup_menu, popup_control, menu_class, popup_move, popup_title, move_class, move_press_class, title_class, title_over_class)
	{
		this.items.push(new CPopupMenu(popup_menu, popup_control, menu_class, popup_move, popup_title, move_class, move_press_class, title_class, title_over_class));
		this.hideItem(this.getLength() - 1);
	},
	
	showItem: function(item_id)
	{
		this.hideAllItems();
		var item = this.items[item_id];
		var bounds = GetBounds(this.items[item_id].move);
		item.popup.style.left = bounds.Left + 'px';
		item.popup.style.top = bounds.Top + bounds.Height + 'px';

		item.popup.className = item.menu_class;
		if (item.title_class && item.title_class != ''){
			item.control.className = item.title_class;
			item.title.className = item.title_class;
		}
		if (item.move_press_class && item.move_press_class != '')
			item.move.className = item.move_press_class;
		var obj = this;
		item.control.onclick = function()
		{
			obj.hideItem(item_id);
		}
		var borders = 1;
		if (item.title_over_class != ''){
			item.control.onmouseover = function(){}
			item.control.onmouseout = function(){}
			item.title.onmouseover = function(){}
			item.title.onmouseout = function(){}
			borders = 2;
		}
		this.isShown = 2;
		item.popup.style.width = 'auto';
		var pOffsetWidth = item.popup.offsetWidth;
		var cOffsetWidth = item.control.offsetWidth;
		if (item.control == item.title) {
			var tOffsetWidth = 0;
		} else {
			var tOffsetWidth = item.title.offsetWidth;
		}
		if (pOffsetWidth < (cOffsetWidth + tOffsetWidth - borders)) {
			item.popup.style.width = (cOffsetWidth + tOffsetWidth - borders) + 'px';
		}
		else
		{
			item.popup.style.width = (pOffsetWidth + borders) + 'px';
		}

		var pOffsetHeight = item.popup.offsetHeight;
		var height = GetHeight();
		if (pOffsetHeight > height*2/3)
			item.popup.style.height = Math.round(height*2/3) + 'px';
		
	},
	
	hideItem: function(item_id)
	{
		this.items[item_id].popup.className = 'wm_hide';
		if (this.items[item_id].move_class && this.items[item_id].move_class != '' && this.items[item_id].move.className != 'wm_hide')
			this.items[item_id].move.className = this.items[item_id].move_class;
		var obj = this;
		this.items[item_id].control.onclick = function()
		{
			obj.showItem(item_id);
		}
		if (obj.items[item_id].title_over_class != ''){
			this.items[item_id].control.onmouseover = function()
			{
				obj.items[item_id].title.className = obj.items[item_id].title_over_class; 
				obj.items[item_id].control.className = obj.items[item_id].title_over_class;
			}
			this.items[item_id].control.onmouseout = function()
			{
				obj.items[item_id].title.className = obj.items[item_id].title_class; 
				obj.items[item_id].control.className = obj.items[item_id].title_class; 
			}
			this.items[item_id].title.onmouseover = function()
			{
				obj.items[item_id].title.className = obj.items[item_id].title_over_class; 
			}
			this.items[item_id].title.onmouseout = function()
			{
				obj.items[item_id].title.className = obj.items[item_id].title_class; 
			}
		}
	},
	
	hideAllItems: function()
	{
		for (var i = this.getLength() - 1; i >= 0; i--) {
			this.hideItem(i);
		}
		this.isShown = 0;
	},
	
	checkShownItems: function()
	{
		if (this.isShown == 1){
			this.hideAllItems()
		}
		if (this.isShown == 2){
			this.isShown = 1;
		}
	}
}

Ready(INIT_COMMON);
