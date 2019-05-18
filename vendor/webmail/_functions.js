function IsClearForFS(str) {
	var symbols = ['"', '/', '\\', '*', '?', '<', '>', '|', ':'];
	var clear = true;
	var symbIndex;
	var iCount = symbols.length;
	for (var i=0; i<iCount; i++) {
		symbIndex = str.indexOf(symbols[i]);
		if (symbIndex != -1) {
			clear = false;
		}
	}
	if (clear) {
		var words = ['CON', 'AUX', 'COM1', 'COM2', 'COM3', 'COM4', 'LPT1', 'LPT2', 'LPT3', 'PRN', 'NUL'];
		iCount = words.length;
		for (i=0; i<iCount; i++) {
			if (str.toUpperCase() == words[i]) {
				clear = false;
			}
		}
	}
	return clear;
}

function GetBorderWidth(style, width)
{
	if (style == 'none')
	{
		return 0;
	}
	else
	{
		var floatWidth = parseFloat(width);
		if (isNaN(floatWidth))
		{
			return 0;
		}
		else
		{
			return Math.round(floatWidth);
		}
	}
}

function GetBorders(element)
{
	if (Browser.Mozilla)
	{
		var top = GetBorderWidth(ReadStyle(element, 'border-top-style'), ReadStyle(element, 'border-top-width'));
		var right = GetBorderWidth(ReadStyle(element, 'border-right-style'), ReadStyle(element, 'border-right-width'));
		var bottom = GetBorderWidth(ReadStyle(element, 'border-bottom-style'), ReadStyle(element, 'border-bottom-width'));
		var left = GetBorderWidth(ReadStyle(element, 'border-left-style'), ReadStyle(element, 'border-left-width'));
	}
	else
	{
		var top = GetBorderWidth(ReadStyle(element, 'borderTopStyle'), ReadStyle(element, 'borderTopWidth'));
		var right = GetBorderWidth(ReadStyle(element, 'borderRightStyle'), ReadStyle(element, 'borderRightWidth'));
		var bottom = GetBorderWidth(ReadStyle(element, 'borderBottomStyle'), ReadStyle(element, 'borderBottomWidth'));
		var left = GetBorderWidth(ReadStyle(element, 'borderLeftStyle'), ReadStyle(element, 'borderLeftWidth'));
	}
	return {Top: top, Right: right, Bottom: bottom, Left: left}
}

function ReadStyle(element, property)
{
	if (element.style[property])
	{
		return element.style[property]
	}
	else if (element.currentStyle)
	{
		return element.currentStyle[property]
	}
	else if (document.defaultView && document.defaultView.getComputedStyle)
	{
		var style = document.defaultView.getComputedStyle(element, null)
		return style.getPropertyValue(property)
	}
	else
	{
		return null
	}
}

//email parts for adding to contacts
function GetEmailParts(fullEmail)
{
	var quote1 = fullEmail.indexOf('"');
	var quote2 = fullEmail.indexOf('"', quote1+1);
	var leftBrocket = fullEmail.indexOf('<', quote2);
	var prevLeftBroket = -1;
	while (leftBrocket != -1) {
		prevLeftBroket = leftBrocket;
		leftBrocket = fullEmail.indexOf('<', leftBrocket+1);
	}
	leftBrocket = prevLeftBroket;
	var rightBrocket = fullEmail.indexOf('>', leftBrocket+1);
	var name = '';
	var email = '';
	if (leftBrocket == -1) {
		email = Trim(fullEmail);
	} else {
		if (quote1 == -1) {
			name = Trim(fullEmail.substring(0, leftBrocket));
		} else {
			name = Trim(fullEmail.substring(quote1+1, quote2));
		}
		email = Trim(fullEmail.substring(leftBrocket+1, rightBrocket));
	}
	return {Name: name, Email: email, FullEmail: fullEmail}
}

function SetBodyAutoOverflow(isAuto)
{
	if (isAuto) {
		var OverFlow = 'auto';
		var Scroll = 'yes';
	} else {
		var OverFlow = 'hidden';
		var Scroll = 'no';
	}
	if (Browser.IE) {
		WebMail._html.style.overflow = OverFlow;
	} else {
		document.body.scroll = Scroll;
		document.body.style.overflow = OverFlow;
	}
}

function OpenURL(strUrl)
{
	var val = new CValidate();
	strUrl = val.CorrectWebPage(Trim(strUrl));
	if (strUrl.length > 0) {
		var newWin, strProt;
		strProt = strUrl.substr(0,4);
		if (strProt != "http" && strProt != "ftp:")
			strUrl = "http://" + strUrl;
		newWin = window.open(encodeURI(strUrl), null,"toolbar=yes,location=yes,directories=yes,status=yes,scrollbars=yes,resizable=yes,copyhistory=yes")
		newWin.focus();
	}
}

function Ltrim(str) {
    return str.replace(/^\s+/, '');
}

function Rtrim(str) {
    return str.replace(/\s+$/, '');
}

function Trim(str) {
    return str.replace(/^\s+/, '').replace(/\s+$/, '');
}

function ReplaceStr(source, search, replace)
{
	var result = '';
	if (source) {
		var i = source.indexOf(search);
		var searchLen = search.length;
		while ( i != -1){
			result += source.substring(0, i) + replace;
			source = source.substring(i + searchLen);
			i = source.indexOf(search);
		}
		result += source;
	}
	return result;
}

function HtmlEncode(source)
{
	source = ReplaceStr(source, '&', '&amp;');
	source = ReplaceStr(source, '>', '&gt;');
	source = ReplaceStr(source, '<', '&lt;');
	return source;
}

function HtmlDecode(source)
{
	source = ReplaceStr(source, '&lt;', '<');
	source = ReplaceStr(source, '&gt;', '>');
	source = ReplaceStr(source, '&amp;', '&');
	return source;
}

function JsQuote(source)
{
	source = ReplaceStr(source, "\\", "\\\\");
	source = ReplaceStr(source, "'", "\\'");
	return source;
}

function HtmlEncodeBody(source)
{
	return ReplaceStr(source, ']]>', '&#93;&#93;&gt;');
}

function HtmlDecodeBody(source)
{
	return ReplaceStr(source, '&#93;&#93;&gt;', ']]>');
}

function GetCData(source, isBody)
{
	if (isBody) {
		return '<![CDATA[' + HtmlEncodeBody(source) + ']]>';
	}
	else {
		return '<![CDATA[' + HtmlEncode(source) + ']]>';
	}
}

function isEnter(ev)
{
	var key = -1;
	if (window.event)
		key = window.event.keyCode;
	else if (ev)
		key = ev.which;
	if (key == 13)
		return true;
	else
		return false;
}


function isRightClick(ev)
{
	var key = -1;
	if (window.event)
		key = window.event.button;
	else if (ev)
		key = ev.which;
	if (key == 3 || key == 2)
		return true;
	else
		return false;
}

function GetWidth()
{
	var width = 1024;
	if (document.documentElement && document.documentElement.clientWidth)
		width = document.documentElement.clientWidth;
	else if (document.body.clientWidth)
		width = document.body.clientWidth;
	else if (self.innerWidth)
		width = self.innerWidth;
	return width;
}

function GetHeight()
{
	var height = 768;
	if (self.innerHeight)
		height = self.innerHeight;
	else if (document.documentElement && document.documentElement.clientHeight)
		height = document.documentElement.clientHeight;
	else if (document.body.clientHeight)
		height = document.body.clientHeight;
	return height;
}

function CreateChild(parent, tagName)
{
	var node = document.createElement(tagName);
	parent.appendChild(node);
	return node;
}

function CreateTextChild(parent, text)
{
	var node = document.createTextNode(text);
	parent.appendChild(node);
	return node;
}
    
function CreateChildWithAttrs(parent, tagName, arAttrs)
{
	if (Browser.IE) {
		var strAttrs = '';
		var attrsLen = arAttrs.length;
		for (var i=attrsLen-1; i>=0; i--) {
			var t = arAttrs[i];
			var key = t[0];
			var val = t[1];
			strAttrs += ' ' + key + '="'+ val + '"';
		}
		tagName = '<' + tagName + strAttrs + '>';
		var node = document.createElement(tagName);
	} else {
		var node = document.createElement(tagName);
		var attrsLen = arAttrs.length;
		for (var i=attrsLen-1; i>=0; i--) {
			var t = arAttrs[i];
			var key = t[0];
			var val = t[1];
			node.setAttribute(key, val);
		}
	}
	parent.appendChild(node);
	return node;
}

function Dump(data, level)
{
    if (level == null) level = 1;
    var str = '';
    var dataType = typeof(data);
    if (dataType == "object") {
        str += dataType + " {";
        for (var key in data) {
            for (var i=0; i<level; i++) str += "  ";
            str += '\n' + key + ": " + Dump(data[key], level+1);
        }
        for (var i=0; i<level-1; i++) str += "  ";
        str += "}"
    } else {
		if (dataType != 'function')
			str += "" + data;
    }
    return str;
}

function GetBounds(object)
{
	if (object == null) 
		return {Left: 0, Top: 0, Width: 0, Height: 0};
	var left = object.offsetLeft;
	var top = object.offsetTop;
	for (var parent = object.offsetParent; parent; parent = parent.offsetParent)
	{
		left += parent.offsetLeft;
		top += parent.offsetTop;
	}
	return {Left: left, Top: top, Width: object.offsetWidth, Height: object.offsetHeight};
}

function CleanNode(object)
{
  while (object.firstChild)
    object.removeChild(object.firstChild);
}

function CreateCookie(name, value, days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days*24*60*60*1000));
		var expires = "; expires=" + date.toGMTString();
	}
	else var expires = "";
	document.cookie = name + "=" + value + expires;
}

function ReadCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) {
			return c.substring(nameEQ.length, c.length);
		}
	}
	return '';
}

function EraseCookie(name) {
	CreateCookie(name, "", -1);
}

function GetBirthDay(d, m, y)
{
	res = '';
	if (y != 0) {
		res += y;
		if (d != 0 || m != 0) res += ',';
	}
	if (d != 0) res += ' ' + d;
	switch (m) {
		case 1: res += ' Jan'; break;
		case 2: res += ' Feb'; break;
		case 3: res += ' Mar'; break;
		case 4: res += ' Apr'; break;
		case 5: res += ' May'; break;
		case 6: res += ' Jun'; break;
		case 7: res += ' Jul'; break;
		case 8: res += ' Aug'; break;
		case 9: res += ' Sep'; break;
		case 10: res += ' Oct'; break;
		case 11: res += ' Nov'; break;
		case 11: res += ' Dec'; break;
	}
	return res;
}
	
function GetFriendlySize(byteSize)
{
	var size = Math.ceil(byteSize / 1024);
	var mbSize = size / 1024;
	if (mbSize > 1){
		size = Math.ceil(mbSize*10)/10 + Lang.Mb;
	} else {
		size = size + Lang.Kb;
	}
	return size;
}

function GetExtension(fileName)
{
	var ext = '';
	var dotPos = fileName.lastIndexOf('.');
	if (dotPos > -1)
	{
		ext = fileName.substr(dotPos + 1).toLowerCase();
	}
	return ext;
}

function GetFileParams(fileName)
{
	var ext = GetExtension(fileName);
	switch (ext)
	{
		case 'asp':
		case 'asa':
		case 'inc':
			return {image: 'application_asp.gif', view: false}
			break;
		case 'css':
			return {image: 'application_css.gif', view: false}
			break;
		case 'doc':
			return {image: 'application_doc.gif', view: false}
			break;
		case 'html':
		case 'shtml':
		case 'phtml':
		case 'htm':
			return {image: 'application_html.gif', view: false}
			break;
		case 'pdf':
			return {image: 'application_pdf.gif', view: false}
			break;
		case 'xls':
			return {image: 'application_xls.gif', view: false}
			break;
		case 'bat':
		case 'exe':
		case 'com':
			return {image: 'executable.gif', view: false}
			break;
		case 'bmp':
			return {image: 'image_bmp.gif', view: true}
			break;
		case 'gif':
			return {image: 'image_gif.gif', view: true}
			break;
		case 'jpg':
		case 'jpeg':
			return {image: 'image_jpeg.gif', view: true}
			break;
		case 'tiff':
		case 'tif':
			return {image: 'image_tiff.gif', view: true}
			break;
		case 'txt':
			return {image: 'text_plain.gif', view: false}
			break;
		default:
			return {image: 'attach.gif', view: false}
			break;
	}
}

	function ParseEmailStr (recipients, fromAddr)
	{
		if (null == recipients)  return '';

		var arRecipients = Array();
		var sWorkingRecipients = HtmlDecode(recipients);
		var sWorkingRecipients = Trim(sWorkingRecipients);

		var emailStartPos = 0;
		var emailEndPos = 0;

		var isInQuotes = false;
		var chQuote = '"';
		var isInAngleBrackets = false;
		var isInBrackets = false;

		var currentPos = 0;
		
		var sWorkingRecipientsLen = sWorkingRecipients.length;
		
		while (currentPos < sWorkingRecipientsLen) {
			var currentChar = sWorkingRecipients.substring(currentPos, currentPos+1);
			switch (currentChar) {
				case '\'':
				case '"':
					if (!isInQuotes) {
						chQuote = currentChar;
						isInQuotes = true;
					} else if (chQuote == currentChar) {
						isInQuotes = false;
					}
				break;
				case '<':
					if (!isInAngleBrackets) {
						isInAngleBrackets = true;
					}
				break;
				case '>':
					if (isInAngleBrackets) {
						isInAngleBrackets = false;
					}
				break;
				case '(':
					if (!isInBrackets) {
						isInBrackets = true;
					}
				break;
				case ')':
					if (isInBrackets) {
						isInBrackets = false;
					}
				break;
				case ',':
				case ';':											
					if (!isInAngleBrackets && !isInBrackets && !isInQuotes) {
						emailEndPos = currentPos;
						var str = sWorkingRecipients.substring(emailStartPos, emailEndPos);
						if (Trim(str).length > 0) {
							sRecipient = GetEmailParts(str);
							var inList = false;
							var iCount = arRecipients.length;
							for (var i=0; i<iCount; i++) {
								if (arRecipients[i].Email == sRecipient.Email) inList = true;
							}
							if (!inList) {
								arRecipients.push(sRecipient);
							}
						}
						emailStartPos = currentPos + 1;
					}
				break;
			}
			currentPos++;
		}
		var iCount = arRecipients.length;
		Recipients = Array();
		fromRecipient = GetEmailParts(fromAddr);
		for (var i=0; i<iCount; i++) {
			if (iCount > 1) {
				if (fromRecipient.Email != arRecipients[i].Email) {
					Recipients.push(arRecipients[i].FullEmail);
				}
			} else {
				Recipients.push(arRecipients[i].FullEmail);
			}
		}
		return Recipients.join(', ');
	}

Ready(INIT_FUNCTIONS);