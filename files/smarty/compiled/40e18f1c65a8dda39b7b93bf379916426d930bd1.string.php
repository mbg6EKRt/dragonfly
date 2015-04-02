<?php /* Smarty version Smarty 3.1.4, created on 2014-05-18 15:42:30
         compiled from "40e18f1c65a8dda39b7b93bf379916426d930bd1" */ ?>
<?php /*%%SmartyHeaderCode:3470039885378b8c6a40708-62280980%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40e18f1c65a8dda39b7b93bf379916426d930bd1' => 
    array (
      0 => '40e18f1c65a8dda39b7b93bf379916426d930bd1',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '3470039885378b8c6a40708-62280980',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'formTitle' => 0,
    'formurl' => 0,
    'name' => 0,
    'description' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5378b8c6b8b1c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5378b8c6b8b1c')) {function content_5378b8c6b8b1c($_smarty_tpl) {?><h1><?php echo $_smarty_tpl->tpl_vars['formTitle']->value;?>
</h1>
<!--
<form id="addeditsite" class="_100" enctype="multipart/form-data" target="submitframe" method="POST" action="<?php echo $_smarty_tpl->tpl_vars['formurl']->value;?>
">
-->
<form id="addeditentity" class="_100" enctype="multipart/form-data" method="POST">

	<div>

		<span class="_100 block tabmenu">
		
			<a onclick="javascript:show('details');" class="clickable _wb50">Details</a>
			<a onclick="javascript:show('relationships');" class="clickable _wb50">Relationships</a>
			<!-- a onclick="javascript:show('save');$('#addeditsite').submit();" class="clickable _wb50">Save</a -->
			<a onclick="javascript:show('save');save();" class="clickable _wb50">Save</a>
		
		</span>

		<div id="details" class="tab">
		
			<h2>Details</h2>
			<label>

				<span class="_33">Name</span>
				<span><input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" onkeyup="javascript:setURL();" onchange="javascript:setURL();" /></span>

			</label>

			<label>

				<span class="_33">Description</span>
				<span><textarea name="description" id="description"><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</textarea></span>

			</label>
		
		</div>

		<div id="relationships" class="hidden tab">
		<h2>Relationships</h2>
		</div>

		<div id="save" class="hidden tab">
			<div id="saving"><!-- <iframe name="submitframe" id="submitframe" class="_100 noborder" style="height: 400px;"></iframe> --></div>
		</div>

	</div>

	<input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />

</form>

<script type="text/javascript"><!--

var current_tab = 'details';

function show(el)
{
	if (el != current_tab)
	{
		// When using the slide functions, jquery cannot compute the height without a width
		
		$('#'+current_tab).slideToggle("350");
		$('#'+el).slideToggle("350");
		
		current_tab = el;
	}
}

// Set the URL of the site based on the name

function setURL()
{
	var name = $('#name').val();
	var url = name.replace(/[^a-zA-Z 0-9]+/g,'');
	url = url.replace(/[ ]+/g,'-');

	$('#url').val(url);
}

// Save the site

function save()
{
	var x = new Date();
	var h = x.getHours();
	var m = x.getMinutes();
	var s = x.getSeconds();
	
	// add a zero in front of numbers<10
	
	m = checkTime(m);
	s = checkTime(s);
	
	x = h+":"+m+":"+s;

	$("#saving").html($("#saving").html()+'<br />'+x+': '+'Saving ...');
	var saveurl = '<?php echo $_smarty_tpl->tpl_vars['formurl']->value;?>
';
	var savedata = $('#addeditentity').serializeArray();

	$.ajax({
		type: 'POST',
		url: saveurl,
		data: savedata,
		success: function(response, status, xhr){
			if (status == "success") {
				$("#saving").html($("#saving").html()+'<br />'+x+': '+response);
			}
		}
	});
}

function saved(msg)
{
	alert(msg);
}

function checkTime(i)
{
	if (i < 10)
	{
		i = "0" + i;
	}
	return i;
}

//--></script>
<?php }} ?>