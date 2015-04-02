<?php /* Smarty version Smarty 3.1.4, created on 2014-05-24 14:39:48
         compiled from "3ca9f6986cb61d628ea752c30825cc264c9a059f" */ ?>
<?php /*%%SmartyHeaderCode:181931252153809314dff363-30434118%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ca9f6986cb61d628ea752c30825cc264c9a059f' => 
    array (
      0 => '3ca9f6986cb61d628ea752c30825cc264c9a059f',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '181931252153809314dff363-30434118',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'formTitle' => 0,
    'formurl' => 0,
    'entity' => 0,
    'entities' => 0,
    'relentity' => 0,
    'relationships' => 0,
    'relationship' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53809314f412b',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53809314f412b')) {function content_53809314f412b($_smarty_tpl) {?><h1><?php echo $_smarty_tpl->tpl_vars['formTitle']->value;?>
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
				<span><input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
" onkeyup="javascript:setURL();" onchange="javascript:setURL();" /></span>

			</label>

			<label>

				<span class="_33">Description</span>
				<span><textarea name="description" id="description"><?php echo $_smarty_tpl->tpl_vars['entity']->value['description'];?>
</textarea></span>

			</label>
		
		</div>

		<div id="relationships" class="hidden tab">
			<h2>Relationships</h2>
			<div>
				Add Relationship:
				<select name="add_relationship_entity" id="add_relationship_entity">
					<?php  $_smarty_tpl->tpl_vars['relentity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['relentity']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['relentity']->key => $_smarty_tpl->tpl_vars['relentity']->value){
$_smarty_tpl->tpl_vars['relentity']->_loop = true;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['relentity']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['relentity']->value['name'];?>
</option>
					<?php } ?>
				</select>
				<input name="add_relationship_name" id="add_relationship_name" />
				<input name="add_relationship_description" id="add_relationship_description" />
			</div>
			<?php  $_smarty_tpl->tpl_vars['relationship'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['relationship']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['relationships']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['relationship']->key => $_smarty_tpl->tpl_vars['relationship']->value){
$_smarty_tpl->tpl_vars['relationship']->_loop = true;
?>
				<div><?php echo $_smarty_tpl->tpl_vars['relationship']->value['name'];?>
<br /><?php echo $_smarty_tpl->tpl_vars['relationship']->value['description'];?>
</div>&nbsp;
			<?php } ?>
		</div>

		<div id="save" class="hidden tab">
			<div id="saving"><!-- <iframe name="submitframe" id="submitframe" class="_100 noborder" style="height: 400px;"></iframe> --></div>
		</div>

	</div>

	<input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['entity']->value['id'];?>
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