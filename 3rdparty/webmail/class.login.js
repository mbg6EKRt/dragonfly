var WebMail;
var LoginScreen;
var ScriptLoader;
var infoObj, infoMessage;

var Browser = new CBrowser();
if (!Browser.Allowed)
	isAjax = false;

var NetLoader = new CNetLoader();
var transport = NetLoader.GetTransport();
if (!transport)
	isAjax = false;

function AjaxInit()
{
	infoObj = document.getElementById('info');
	infoMessage = document.getElementById('info_message');
	LoginScreen.AjaxInit(TryLoginHandler);
}

function Init()
{
	LoginScreen = new CLoginScreen();
	if (isAjax) {
		ScriptLoader = new CScriptLoader();
		ScriptLoader.Load(Sections[SECTION_LOGIN].Scripts, AjaxInit);
	}
}

function TryLoginHandler() {
	infoObj.className = 'wm_information';
	infoMessage.innerHTML = Lang.Loading;
	NetLoader.LoadXMLDoc(ActionUrl, 'xml=' + encodeURIComponent(this.Xml), LoginHandler, LoginErrorHandler);
}

function LoginErrorHandler() {
	infoObj.className = 'wm_hide';
	LoginScreen.ShowError(this.ErrorDesc);
}

function LoginHandler() {
	infoObj.className = 'wm_hide';
	var XmlDoc = this.responseXML;
	if (XmlDoc && XmlDoc.documentElement && typeof(XmlDoc) == 'object' && typeof(XmlDoc.documentElement) == 'object')
	{
		var RootElement = XmlDoc.documentElement;
		if (RootElement && RootElement.tagName == 'webmail')
		{
			var Objects = RootElement.childNodes;
			if ( Objects.length == 0 )
			{
				LoginScreen.ShowError(Lang.ErrorEmptyXmlPacket);
			} else {
				var iCount = Objects.length;
				for (var i=iCount-1; i>=0; i--)
				{
					switch (Objects[i].tagName)
					{
						case 'login':
							document.location = WebMailUrl;
						break;
						case 'error':
							var attr = Objects[i].getAttribute('code');
							if (attr)
							{
								document.location = LoginUrl + '?error=' + attr;
							}
							else
							{
								var errorDesc = Objects[i].childNodes[0].nodeValue;
								if (errorDesc && errorDesc.length > 0)
								{
									LoginScreen.ShowError(errorDesc);
								}
								else
								{
									LoginScreen.ShowError(Lang.ErrorWithoutDesc);
								}
							}
						break;
					}
				}//for
			}
		}
		else
		{
			LoginScreen.ShowError(Lang.ErrorParsing + '<br/>Error code 2.<br/>' + Lang.ResponseText + '<br/>' + this.responseXML);
		}//if (RootElement)
	}
	else
	{
		LoginScreen.ShowError(Lang.ErrorParsing + '<br/>Error code 1.<br/>' + Lang.ResponseText + '<br/>' + this.responseXML);
	}//if (XmlDoc)
}

/*
Classes:
	CLoginScreen
	CTip
*/

function CLoginScreen()
{
	this.isBuilded = true;
	this.Tip = new CTip();
	this._isAjax = false;

	this._container = document.getElementById("login_screen");
	this._loginError = document.getElementById("login_error");
	
	this._mode = 'standard';
	this._incoming = document.getElementById("incoming");
	this._outgoing = document.getElementById("outgoing");
	this._authentication = document.getElementById("authentication");
	this.LoginForm = document.getElementById("login_form");
	this._loginTable = document.getElementById("login_table");
	this._email = document.getElementById("email");
	this._emailCont = document.getElementById("email_cont");
	this._login = document.getElementById("login");
	this._loginCont = document.getElementById("login_cont");
	this._loginParent = document.getElementById("login_parent");
	this._domain = null;
	this._password = document.getElementById("password");
	this._incServer = document.getElementById("inc_server");
	this._incPort = document.getElementById("inc_port");
	this._outServer = document.getElementById("out_server");
	this._outPort = document.getElementById("out_port");
	this._smtpAuth = document.getElementById("smtp_auth");
	this.Init();
	this.MakeView();
}

CLoginScreen.prototype = {
	Init: function ()
	{
		var obj = this;
		this.LoginForm.onsubmit = function ()
		{
			if (!obj.CheckLoginForm()) return false;
		}
		/* email */
		this._email.onfocus = function ()
		{
			this.className = 'wm_input_focus';
			obj.EmailFocus();
		}
		this._email.onkeypress = function (ev)
		{
			if (!isEnter(ev)) obj.Tip.Hide('email');
		}
		/* login */
		this._login.onfocus = function ()
		{
			this.className = 'wm_input_focus';
			obj.LoginFocus();
		}
		this._login.onkeypress = function (ev)
		{
			if (!isEnter(ev)) obj.Tip.Hide('login');
		}
		/* password */
		this._password.onfocus = function ()
		{
			this.className = 'wm_input_focus wm_password_input';
			obj.PasswordFocus();
		}
		this._password.onkeypress = function (ev)
		{
			if (!isEnter(ev)) obj.Tip.Hide('password');
		}
		/* incoming mail */
		this._incServer.onkeypress = function (ev)
		{
			if (!isEnter(ev)) obj.Tip.Hide('inc_server');
		}
		this._incPort.onkeypress = function (ev)
		{
			if (!isEnter(ev)) obj.Tip.Hide('inc_port');
		}
		/* ougoing mail */
		this._outServer.onkeypress = function (ev)
		{
			if (!isEnter(ev)) obj.Tip.Hide('out_server');
		}
		this._outPort.onkeypress = function (ev)
		{
			if (!isEnter(ev)) obj.Tip.Hide('out_port');
		}
	},
	
	MakeView: function ()
	{
		var isAdvancedMode = this._mode == 'advanced' || AdvancedLogin == '1';
		if (isAdvancedMode) {
			this._emailCont.className = '';
			this._email.tabIndex = 1;
			this._loginCont.className = '';
			this._login.tabIndex = 2;
		} else if (HideLoginMode >= 20) {
			this.Tip.Hide('email');
			this._emailCont.className = 'wm_hide';
			this._email.tabIndex = -1;
			this._loginCont.className = '';
			this._login.tabIndex = 2;
		} else if (HideLoginMode >= 10) {
			this.Tip.Hide('login');
			this._emailCont.className = '';
			this._email.tabIndex = 1;
			this._loginCont.className = 'wm_hide';
			this._login.tabIndex = -1;
		}
		if (isAdvancedMode || HideLoginMode != 21 && HideLoginMode != 23) {
			if (this._domain != null) {
				this._loginCont.removeChild(this._domain);
				this._domain = null;
				this._loginParent.colSpan = 4;
				this._login.style.width = '220px';
				this._loginTable.className = 'wm_login wm_fixed';
			}
		} else {
			if (this._domain == null) {
				this._loginParent.colSpan = 2;
				this._domain = CreateChild(this._loginCont, 'td');
				this._domain.innerHTML = '@' + DomainOptional;
				this._domain.colSpan = 2;
				this._login.style.width = '150px';
				this._loginTable.className = 'wm_login';
			}
		}
	},
	
	EmailFocus: function ()
	{
		this._email.select();
	},

	LoginFocus: function ()
	{
		if (this._login.value.length == 0 && this._email.value.length != 0)
		{
			this._login.value = this._email.value;
		}
		this._login.select();
	},

	PasswordFocus: function ()
	{
		this._password.select();
	},

	CheckLoginForm: function()
	{
		var val = new CValidate();
		this.Tip.Hide('');
		var isAdvancedMode = this._mode == 'advanced' || AdvancedLogin == '1';
		/* email */
		var vEmail = Trim(this._email.value);
		if (val.IsEmpty(vEmail) && (isAdvancedMode || HideLoginMode < 20))
		{
			this.Tip.Show(Lang.WarningEmailBlank, this._email, 'email');
			return false;
		}
		if (!val.IsCorrectEmail(vEmail) && (isAdvancedMode || HideLoginMode < 20))
		{
			this.Tip.Show(Lang.WarningCorrectEmail, this._email, 'email');
			return false;
		}
		/* login */
		var vLogin = Trim(this._login.value);
		if (val.IsEmpty(vLogin) && (isAdvancedMode || HideLoginMode != 10 && HideLoginMode != 11))
		{
			this.Tip.Show(Lang.WarningLoginBlank, this._login, 'login');
			return false;
		}
		/* password */
		var vPassword = Trim(this._password.value);
		if (val.IsEmpty(vPassword))
		{
			this.Tip.Show(Lang.WarningPassBlank, this._password, 'password');
			return false;
		}
		/* incoming mail */
		var vIncServer = Trim(this._incServer.value);
		if (val.IsEmpty(vIncServer) && (isAdvancedMode))
		{
			this.Tip.Show(Lang.WarningIncServerBlank, this._incPort, 'inc_server');
			return false;
		}
		if (!val.IsCorrectServerName(vIncServer) && (isAdvancedMode))
		{
			this.Tip.Show(Lang.WarningCorrectIncServer, this._incPort, 'inc_server');
			return false;
		}
		var vIncPort = Trim(this._incPort.value);
		if (val.IsEmpty(vIncPort) && (isAdvancedMode))
		{
			this.Tip.Show(Lang.WarningIncPortBlank, this._incPort, 'inc_port');
			return false;
		}
		else if (!val.IsPort(vIncPort) && (isAdvancedMode))
		{
			this.Tip.Show(Lang.WarningIncPortNumber + '<br />' + Lang.DefaultIncPortNumber, this._incPort, 'inc_port');
			return false;
		}
		/* outgoing mail */
		var vOutServer = Trim(this._outServer.value);
		if (val.IsEmpty(vOutServer) && (isAdvancedMode))
		{
			this.Tip.Show(Lang.WarningOutServerBlank, this._outPort, 'out_server');
			return false;
		}
		if (!val.IsCorrectServerName(vOutServer) && (isAdvancedMode))
		{
			this.Tip.Show(Lang.WarningCorrectSMTPServer, this._outPort, 'out_server');
			return false;
		}
		var vOutPort = Trim(this._outPort.value);
		if (val.IsEmpty(vOutPort) && (isAdvancedMode))
		{
			this.Tip.Show(Lang.WarningOutPortBlank, this._outPort, 'out_port');
			return false;
		}
		if (!val.IsPort(vOutPort) && (isAdvancedMode))
		{
			this.Tip.Show(Lang.WarningOutPortNumber + '<br />' + Lang.DefaultOutPortNumber, this._outPort, 'out_port');
			return false;
		}
		return true;
	},
	
	sf: function ()
	{
		if (this._isAjax) {
			this.HideError();
			if (this._mode == 'advanced')
				this.AdvancedLogin = '1';
			else
				this.AdvancedLogin = '0';
			var xml = '<param name="action" value="login"/>';
			xml += '<param name="request" value=""/>';
			xml += '<param name="mail_inc_port" value="' + this._incPort.value + '"/>';
			xml += '<param name="mail_out_port" value="' + this._outPort.value + '"/>';
			if (this._smtpAuth.checked) {
				xml += '<param name="mail_out_auth" value="1"/>';
			} else {
				xml += '<param name="mail_out_auth" value="0"/>';
			}
			xml += '<param name="email">' + GetCData(this._email.value) + '</param>';
			xml += '<param name="mail_inc_host">' + GetCData(this._incServer.value) + '</param>';
			xml += '<param name="mail_inc_login">' + GetCData(this._login.value) + '</param>';
			xml += '<param name="mail_inc_pass">' + GetCData(this._password.value) + '</param>';
			xml += '<param name="mail_out_host">' + GetCData(this._outServer.value) + '</param>';
			if (this._mode == 'advanced') {
				xml += '<param name="advanced_login" value="1"/>';
			} else {
				xml += '<param name="advanced_login" value="0"/>';
			}
			this.Xml = '<?xml version="1.0" encoding="utf-8"?><webmail>' + xml + '</webmail>';
			if (Browser.IE) {
				this._email.blur();
				this._login.blur();
				this._password.blur();
				this._incServer.blur();
				this._incPort.blur();
				this._outServer.blur();
				this._outPort.blur();
			}
			this.onSubmit.call(this);
		} else {
			this.LoginForm.submit();
		}
	},
	
	AjaxInit: function (SubmitHandler)
	{
		if (AllowAdvancedLogin) {
			this._loginModeSwitcher = document.getElementById("login_mode_switcher");
			this._loginModeSwitcher.href = '#';
			var obj = this;
			this._loginModeSwitcher.onclick = function(){
				if (obj._mode == 'standard') {
					obj._mode = 'advanced';
					obj._incoming.className = '';
					obj._outgoing.className = '';
					obj._authentication.className = '';
					obj._loginModeSwitcher.innerHTML = Lang.StandardLogin;
					obj.MakeView();
				} else {
					obj._mode = 'standard';
					obj._incoming.className = 'wm_hide';
					obj._outgoing.className = 'wm_hide';
					obj._authentication.className = 'wm_hide';
					obj._loginModeSwitcher.innerHTML = Lang.AdvancedLogin;
					obj.MakeView();
				}
				return false;
			}
		}
		this.onSubmit = SubmitHandler;
		this._isAjax = true;
		var obj = this;
		this.LoginForm.onsubmit = function () {
			return false;
		}
		var submit = document.getElementById("submit");
		submit.onclick = function() {
			if (obj.CheckLoginForm()){
				obj.sf();
			}
		}
	},
	
	ShowError: function (errorDesc)
	{
		this._loginError.className = 'wm_login_error';
		this._loginError.innerHTML = errorDesc;
	},

	HideError: function ()
	{
		this._loginError.className = 'wm_hide';
	},
	
	Show: function ()
	{
		this._container.className = '';
	},
	
	Hide: function ()
	{
		this._container.className = 'wm_hide';
	},
	
	ResizeBody: function ()
	{
	},
	
	ClickBody: function ()
	{
	},
	
	PlaceData: function ()
	{
	}
}

function CTip()
{
	this._container = CreateChild(document.body, 'table');
	this._container.className = 'wm_hide';
	var tr = this._container.insertRow(0);
	var td = tr.insertCell(0);
	td.className = 'wm_tip_arrow';
	this._message = tr.insertCell(1);
	this._message.className = 'wm_tip_info';
	this._base = '';
}

CTip.prototype = {
	SetMessageText: function(text)
	{
		this._message.innerHTML = text;
	},
	
	SetCoord: function(element)
	{
		var bounds = GetBounds(element);
		this._container.style.top = (bounds.Top + bounds.Height/2 - 16) + 'px';
		this._container.style.left = (bounds.Left + bounds.Width - 5) + 'px';
	},
	
	Show: function(text, element, base)
	{
		this.SetMessageText(text);
		this.SetCoord(element);
		this._base = base;
		this._container.className = 'wm_tip';
	},
	
	Hide: function(base)
	{
		if (this._base == base || this._base == '')
			this._container.className = 'wm_hide';
	}
}

Ready(INIT_LOGIN);