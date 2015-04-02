<?php /* Smarty version Smarty 3.1.4, created on 2014-05-24 17:08:18
         compiled from "2f3d3a5d60fb8df5fa95c849cf1afb4573e2d453" */ ?>
<?php /*%%SmartyHeaderCode:12496247505380b5e23b85f9-92181181%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2f3d3a5d60fb8df5fa95c849cf1afb4573e2d453' => 
    array (
      0 => '2f3d3a5d60fb8df5fa95c849cf1afb4573e2d453',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '12496247505380b5e23b85f9-92181181',
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
  'unifunc' => 'content_5380b5e24f666',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5380b5e24f666')) {function content_5380b5e24f666($_smarty_tpl) {?><h1><?php echo $_smarty_tpl->tpl_vars['formTitle']->value;?>
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
				<input name="add_relationship_name" id="add_relationship_name" style="width:150px;" />
				<input name="add_relationship_description" id="add_relationship_description" style="width:150px;" />
				<input type="button" name="add_relationship_save" name="add_relationship_save" value="Save" onclick="javascript:save_relationship();" />
			</div>
			<div id="relrows"></div>
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

// Save the entity

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

function save_relationship()
{
	var entity = $( "#add_relationship_entity ").val( );
	var name = $( "#add_relationship_name ").val( );
	var description = $( "#add_relationship_description" ).val( );
	
	$( "#relrows" ).html( $( "#relrows" ).html( ) + "<div>" + name + "<br />" + description + "</div>" );
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