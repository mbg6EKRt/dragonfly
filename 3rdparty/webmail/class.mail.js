/*
Classes:
	CAccountProperties
	CMessage
	COperationMessages
	CMessageHeaders
	CMessages
	CUpdate
*/

function CAccountProperties()
{
	this.Type = TYPE_ACCOUNT_PROPERTIES;
	this.Email = '';
}

CAccountProperties.prototype = {
	GetStringDataKeys: function(_SEPARATOR)
	{
		var arDataKeys = [ ];
		return arDataKeys.join(_SEPARATOR);
	},//GetStringDataKeys
	
	GetFromXML: function (RootElement)
	{
		var SettingsParts = RootElement.childNodes;
		var count = SettingsParts.length;
		for (var i=count-1; i>=0; i--) {
			var parts = SettingsParts[i].childNodes;
			var partsCount = parts.length;
			if (partsCount > 0) {
				switch (SettingsParts[i].tagName) {
					case 'email':
						this.Email = parts[0].nodeValue;
						break;
				}//switch
			}
		}//for
	}//GetFromXML
}

// for message
function CMessage()
{
	this.Type = TYPE_MESSAGE;
	this.Parts = 0;
	//	0 - Common Headers
	//	1 - HtmlBody
	//	2 - PlainBody
	//	3 - FullHeaders
	//	4 - Attachments
	//	6 - ReplyPlain;
	//	8 - ForwardPlain;

	this.Id = -1;
	this.Uid = '';
	this.HasHtml = true;
	this.HasPlain = false;
	this.IsReplyHtml = false;
	this.IsForwardHtml = false;
	this.Importance = 3;
	this.Charset = AUTOSELECT_CHARSET;
	this.HasCharset = true;
	this.Safety = 1;
	
	// Common Headers
	this.FromAddr = '';
	this.ToAddr = '';
	this.CCAddr = '';
	this.BCCAddr = '';
	this.ReplyToAddr = '';//if it's equal with from, set empty value
	this.Subject = '';
	this.Date = '';

	// Body
	this.HtmlBody = '';
	this.PlainBody = '';
	this.ClearPlainBody = '';

	// Body for reply
	this.ReplyPlain = '';

	// Body for forward
	this.ForwardPlain = '';

	// FullHeaders
	this.FullHeaders = '';
	
	// Attachments - array of objects with fields FileName, Size[, Id, Download, View] (for getting) [, TempName, MimeType] (for sending)
	this.Attachments = [];
	
	this.SaveLink = '#';
	this.PrintLink = '#';
}	

CMessage.prototype = {
	GetStringDataKeys: function(_SEPARATOR)
	{
		var arDataKeys = [ this.Charset, this.Uid ];
		return arDataKeys.join(_SEPARATOR);
	},//GetStringDataKeys
	
	GetFromIdForList: function(_SEPARATOR, id)
	{
		var identifiers = id.split(_SEPARATOR);
		this.Uid = identifiers[0];
	},

	GetIdForList: function(_SEPARATOR, id)
	{
		var identifiers = [this.Uid, this.Charset, id];
		return identifiers.join(_SEPARATOR);
	},

	PrepareForEditing: function (msg)
	{
		this.Uid = HtmlDecode(msg.Uid);
		this.HasHtml = msg.HasHtml;
		this.HasPlain = msg.HasPlain;
		this.Importance = msg.Importance;
		
		this.FromAddr = HtmlDecode(msg.FromAddr);
		this.ToAddr = HtmlDecode(msg.ToAddr);
		this.CCAddr = HtmlDecode(msg.CCAddr);
		this.BCCAddr = HtmlDecode(msg.BCCAddr);
		this.Subject = HtmlDecode(msg.Subject);
		this.Date = HtmlDecode(msg.Date);

		this.HtmlBody = msg.HtmlBody;
		this.PlainBody = msg.ClearPlainBody;

		this.Attachments = msg.Attachments;
	},
	
	ParseEmailStr: function (recipients, fromAddr)
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
	},

	PrepareForReply: function (msg, replyAction, fromAddr)
	{
		this.Safety = msg.Safety;
		switch (replyAction) {
			case REPLY:
				this.HasHtml = msg.IsReplyHtml;
				this.HasPlain = msg.IsReplyHtml ? false : true;
				this.PlainBody = msg.ReplyPlain;
				if (msg.ReplyToAddr.length > 0)
				{
					this.ToAddr = HtmlDecode(msg.ReplyToAddr);
				}
				else
				{
					this.ToAddr = HtmlDecode(msg.FromAddr);
				}
				this.FromAddr = '';
				this.CCAddr = '';
				this.BCCAddr = '';
				this.Subject = Lang.Re + ': ' + HtmlDecode(msg.Subject);
				this.Date = '';
				this.Attachments = [];
				var iCount = msg.Attachments.length;
				var j = 0;
				for (var i=0; i<iCount; i++) {
					if (msg.Attachments[i].Inline) {
						this.Attachments[j] = msg.Attachments[i];
						j++;
					}
				}
				break;
			case REPLY_ALL:
				this.HasHtml = msg.IsReplyHtml;
				this.HasPlain = msg.IsReplyHtml ? false : true;
				this.PlainBody = msg.ReplyPlain;
				if (msg.ReplyToAddr.length > 0)
				{
					this.ToAddr = this.ParseEmailStr(msg.ReplyToAddr + ',' + msg.ToAddr + ',' + msg.CCAddr + ',' + msg.BCCAddr, fromAddr);
				}
				else
				{
					this.ToAddr = this.ParseEmailStr(msg.FromAddr + ',' + msg.ToAddr + ',' + msg.CCAddr + ',' + msg.BCCAddr, fromAddr);
				}
				this.FromAddr = '';
				this.CCAddr = '';
				this.BCCAddr = '';
				this.Subject = Lang.Re + ': ' + HtmlDecode(msg.Subject);
				this.Date = '';
				this.Attachments = [];
				var iCount = msg.Attachments.length;
				var j = 0;
				for (var i=0; i<iCount; i++) {
					if (msg.Attachments[i].Inline) {
						this.Attachments[j] = msg.Attachments[i];
						j++;
					}
				}
				break;
			case FORWARD:
				this.HasHtml = msg.IsForwardHtml;
				this.HasPlain = msg.IsForwardHtml ? false : true;
				this.PlainBody = msg.ForwardPlain;
				this.ToAddr = '';
				this.FromAddr = '';
				this.CCAddr = '';
				this.BCCAddr = '';
				this.Subject = Lang.Fwd + ': ' + HtmlDecode(msg.Subject);
				this.Date = '';
				this.Attachments = msg.Attachments;
				break;
		}
	},//PrepareForReply
	
	GetInXML: function()
	{
		var strResult = '';
		var strHeaders = '';
		strHeaders += '<from>' + GetCData(this.FromAddr) + '</from>';
		strHeaders += '<to>' + GetCData(this.ToAddr) + '</to>';
		strHeaders += '<cc>' + GetCData(this.CCAddr) + '</cc>';
		strHeaders += '<bcc>' + GetCData(this.BCCAddr) + '</bcc>';
		strHeaders += '<subject>' + GetCData(this.Subject) + '</subject>';
		strHeaders = '<headers>' + strHeaders + '</headers>';
		var strBody = '';
		if (this.HasHtml) {
			strBody = '<body is_html="1">' + GetCData(this.HtmlBody, true) + '</body>';
		} else {
			strBody = '<body is_html="0">' + GetCData(this.PlainBody, true) + '</body>';
		}//if else
		var strAttachments = ''
		for (var j=0; j<this.Attachments.length; j++) {
			var Attachment = this.Attachments[j];
			var strAttachment = '';
			strAttachment += '<temp_name>' + GetCData(Attachment.TempName) + '</temp_name>';
			strAttachment += '<name>' + GetCData(Attachment.FileName) + '</name>';
			strAttachment += '<mime_type>' + GetCData(Attachment.MimeType) + '</mime_type>';
			var atAttrs = '';
			atAttrs += ' size="' + Attachment.Size + '"';
			if (Attachment.Inline)
				atAttrs += ' inline="1"';
			else
				atAttrs += ' inline="0"';
			strAttachments += '<attachment' + atAttrs + '>' + strAttachment + '</attachment>';
		}//for
		strAttachments = '<attachments>' + strAttachments + '</attachments>';
		var attrs = '';
		var uid = '';
		if (this.Id != -1) {
			attrs += ' id="' + this.Id + '"';
			uid = '<uid>' + GetCData(this.Uid) + '</uid>';
		} else {
			attrs += ' id="-1"';
			uid = '<uid/>';
		}
		attrs += ' priority="' + this.Importance + '"';
		strResult = '<message' + attrs + '>' + uid + strHeaders + strBody + strAttachments + '</message>';
		return strResult;
	},//GetInXML
	
	GetFromXML: function(RootElement)
	{
		this.HasHtml = false;
		var attr = RootElement.getAttribute('id');      if (attr) this.Id = attr - 0;
		attr = RootElement.getAttribute('html');        if (attr) this.HasHtml= (attr == 1) ? true : false;
		attr = RootElement.getAttribute('plain');       if (attr) this.HasPlain = (attr == 1) ? true : false;
		attr = RootElement.getAttribute('priority');    if (attr) this.Importance = attr - 0;
		attr = RootElement.getAttribute('mode');        if (attr) this.Parts = this.Parts | (attr - 0);
		attr = RootElement.getAttribute('charset');     if (attr) this.Charset = attr - 0;
		attr = RootElement.getAttribute('has_charset'); if (attr) this.HasCharset = (attr == 1) ? true : false;
		attr = RootElement.getAttribute('safety');      if (attr) this.Safety = attr - 0;
		var MessageParts = RootElement.childNodes;
		for (var i=0; i<MessageParts.length; i++) {
			var part = MessageParts[i].childNodes;
			if (part.length > 0) {
				switch (MessageParts[i].tagName) {
					case 'uid':
						this.Uid = Trim(part[0].nodeValue);
						break;
					case 'headers':
						var HeadersParts = MessageParts[i].childNodes;
						for (var j=0; j<HeadersParts.length; j++) {
							var part_ = HeadersParts[j].childNodes;
							if (part_.length > 0) {
								switch (HeadersParts[j].tagName) {
									case 'from':
										this.FromAddr = Trim(part_[0].nodeValue);
										break;
									case 'to':
										this.ToAddr = Trim(part_[0].nodeValue);
										break;
									case 'cc':
										this.CCAddr = Trim(part_[0].nodeValue);
										break;
									case 'bcc':
										this.BCCAddr = Trim(part_[0].nodeValue);
										break;
									case 'reply_to':
										this.ReplyToAddr = Trim(part_[0].nodeValue);
										break;
									case 'subject':
										this.Subject = Trim(part_[0].nodeValue);
										break;
									case 'date':
										this.Date = Trim(part_[0].nodeValue);
										break;
								}//switch
							}
						}//for
						break;
					case 'html_part':
						this.HtmlBody = Trim(part[0].nodeValue);
						if (this.HtmlBody.length > 0) this.HasHtml = true;
						break;
					case 'modified_plain_text':
						this.PlainBody = Trim(part[0].nodeValue);
						this.ClearPlainBody = this.PlainBody;
						if (this.PlainBody.length > 0) this.HasPlain = true;
						break;
					case 'unmodified_plain_text':
						this.ClearPlainBody = Trim(part[0].nodeValue);
						break;
					case 'reply_plain':
						this.ReplyPlain = Trim(part[0].nodeValue);
						break;
					case 'forward_plain':
						this.ForwardPlain = Trim(part[0].nodeValue);
						break;
					case 'full_headers':
						this.FullHeaders = Trim(part[0].nodeValue);
						break;
					case 'attachments':
						var Attachments = MessageParts[i].childNodes;
						this.Attachments = [];
						for (var j=0; j<Attachments.length; j++) {
							var id = -1;
							attr = Attachments[j].getAttribute('id');
							if (attr) id = attr - 0;
							var size = 0;
							attr = Attachments[j].getAttribute('size');
							if (attr) size = attr;
							var inline = false;
							attr = Attachments[j].getAttribute('inline');
							if (attr) inline = (attr == 1) ? true : false;
							var References = Attachments[j].childNodes;
							var fileName = ''; var tempName = '';
							var download = '#'; var view = '#';
							var mimeType = '';
							var refCount = References.length;
							for (var k = refCount-1; k >= 0; k--) {
								var ref = References[k].childNodes;
								if (ref.length > 0 )
									switch (References[k].tagName) {
										case 'filename':
											fileName = Trim(ref[0].nodeValue);
											break;
										case 'tempname':
											tempName = Trim(ref[0].nodeValue);
											break;
										case 'mime_type':
											mimeType = Trim(ref[0].nodeValue);
											break;
										case 'download':
											download = HtmlDecode(Trim(ref[0].nodeValue));
											break;
										case 'view':
											view = HtmlDecode(Trim(ref[0].nodeValue));
											break;
									}//switch
							}//for 
							this.Attachments.push({Id: id, Inline: inline, FileName: fileName, Size: size, Download: download, View: view, TempName: tempName, MimeType: mimeType});
						}//for 
						break;
					case 'save_link':
						var links = MessageParts[i].childNodes;
						if (links.length > 0)
							this.SaveLink = HtmlDecode(Trim(links[0].nodeValue));
					case 'print_link':
						var links = MessageParts[i].childNodes;
						if (links.length > 0)
							this.PrintLink = HtmlDecode(Trim(links[0].nodeValue));
					break;
				}//switch
			}
		}//for
	}//GetFromXML
}

function COperationMessages()
{
	this.Type = TYPE_MESSAGES_OPERATION;
	this.OperationType = '';
	this.OperationField = '';
	this.OperationValue = true;
	this.OperationInt = -1;
	this.Messages = new CDictionary();
}

COperationMessages.prototype = {
	GetInXML: function ()
	{
		var nodes = '<messages>';
		var keys = this.Messages.keys();
		var iCount = keys.length;
		for (var i=0; i<iCount; i++) {
			var msg = this.Messages.getVal(keys[i]);
			var jCount = msg.IdArray.length;
			for (var j=0; j<jCount; j++) {
				nodes += '<message>';
				nodes += '<uid>' + GetCData(msg.IdArray[j].Uid) + '</uid>';
				nodes += '</message>';
			}
		}
		nodes += '</messages>';
		return nodes;
	},
	
	GetFromXML: function (RootElement)
	{
		var attr = RootElement.getAttribute('type');
		if (attr) this.OperationType = attr;
		this.GetOperation();
	},
	
	GetOperation: function ()
	{
		switch (this.OperationType) {
			case OperationTypes[DELETE]:
				this.OperationField = 'Deleted';
				this.OperationValue = true;
				this.OperationInt = DELETE;
				break;
		}
	}
}

// for message in messages list
function CMessageHeaders()
{
	this.Uid = '';
	this.HasAttachments = false;
	this.Importance = 3;

	this.Random = Math.random;

	this.FromAddr = '';
	this.ToAddr = '';
	this.CCAddr = '';
	this.BCCAddr = '';
	this.ReplyToAddr = '';
	this.Size = '';
	this.Subject = '';
	this.Date = '';
}

CMessageHeaders.prototype = {
	GetIdForList: function(_SEPARATOR, id)
	{
		var identifiers = [this.Uid, id];
		return identifiers.join(_SEPARATOR);
	},
	
	GetFromXML: function(RootElement)
	{
		attr = RootElement.getAttribute('has_attachments');
		this.HasAttachments = (attr == 1) ? true : false;
		attr = RootElement.getAttribute('priority');
		if (attr) this.Importance = attr - 0;
		attr = RootElement.getAttribute('size');
		if (attr) this.Size = attr - 0;
		var HeadersParts = RootElement.childNodes;
		for (var i=0; i<HeadersParts.length; i++) {
			var part = HeadersParts[i].childNodes;
			if (part.length > 0) {
				switch (HeadersParts[i].tagName) {
					case 'from':
						this.FromAddr = Trim(part[0].nodeValue);
						break;
					case 'to':
						this.ToAddr = Trim(part[0].nodeValue);
						break;
					case 'cc':
						this.CCAddr = Trim(part[0].nodeValue);
						break;
					case 'bcc':
						this.BCCAddr = Trim(part[0].nodeValue);
						break;
					case 'reply_to':
						this.ReplyToAddr = Trim(part[0].nodeValue);
						break;
					case 'subject':
						this.Subject = Trim(part[0].nodeValue);
						break;
					case 'date':
						this.Date = Trim(part[0].nodeValue);
						break;
					case 'uid':
						this.Uid = Trim(part[0].nodeValue);
						break;
				}//switch
			}
		}//for
	}//GetFromXML
}

function CMessages()
{
	this.Type = TYPE_MESSAGES_LIST;
	this.Page = 1;
	this.MessagesCount = 0;
	this.MailboxSize = 0;
	this.List = [];
	this._SEPARATOR = "!@#!";
}

CMessages.prototype = {
	GetStringDataKeys: function(_SEPARATOR)
	{
		var arDataKeys = [ this.Page ];
		return arDataKeys.join(_SEPARATOR);
	},//GetStringDataKeys
	
	GetFromXML: function(RootElement)
	{
		var attr = RootElement.getAttribute('page');
		if (attr) this.Page = attr - 0;
		attr = RootElement.getAttribute('count');
		if (attr) this.MessagesCount = attr - 0;
		attr = RootElement.getAttribute('mailbox_size');
		if (attr) this.MailboxSize = attr - 0;
		var MessagesXML = RootElement.childNodes;
		var MHeaders = null;
		var msgsCount = 0;
		for (var i=0; i<MessagesXML.length; i++) {
			var part = MessagesXML[i].childNodes;
			if (part.length > 0) {
				switch (MessagesXML[i].tagName) {
					case 'message':
						MHeaders = new CMessageHeaders();
						MHeaders.GetFromXML(MessagesXML[i]);
						this.List[msgsCount++] = MHeaders;
					break;
				}
			}
		}//for
	},//GetFromXML
	
	GetMessageIndex: function (msg)
	{
		var index = -1;
		for (var i=0; i<this.List.length; i++) {
			var lMsg = this.List[i];
			if (lMsg.Uid == msg.Uid) {
				index = i;
			}
		}//for
		return index;
	}	
}

function CUpdate()
{
	this.Type = TYPE_UPDATE;
	this.Value = '';
}

CUpdate.prototype = {
	GetStringDataKeys: function(_SEPARATOR)
	{
		var arDataKeys = [ ];
		return arDataKeys.join(_SEPARATOR);
	},//GetStringDataKeys

	GetFromXML: function(RootElement)
	{
		var attr = RootElement.getAttribute('value');
		if (attr) this.Value = attr;
	}//GetFromXML
}

Ready(INIT_MAIL);