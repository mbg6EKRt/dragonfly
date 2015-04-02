<?php /* Smarty version Smarty 3.1.4, created on 2014-09-24 15:48:29
         compiled from "d1c49a7558571c336e930f3cc9851cd64df7793f" */ ?>
<?php /*%%SmartyHeaderCode:259525422cbad893902-71494857%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1c49a7558571c336e930f3cc9851cd64df7793f' => 
    array (
      0 => 'd1c49a7558571c336e930f3cc9851cd64df7793f',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '259525422cbad893902-71494857',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'formTitle' => 0,
    'formurl' => 0,
    'name' => 0,
    'url' => 0,
    'domain' => 0,
    'default' => 0,
    'modules' => 0,
    'module' => 0,
    'tasks' => 0,
    'task' => 0,
    'default_task' => 0,
    'themes' => 0,
    'theme' => 0,
    'layouts' => 0,
    'layout' => 0,
    'default_layout' => 0,
    'title' => 0,
    'description' => 0,
    'keywords' => 0,
    'author' => 0,
    'copyright' => 0,
    'indexed' => 0,
    'follow' => 0,
    'cache' => 0,
    'permissionsform' => 0,
    'meta_id' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5422cbadd7254',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5422cbadd7254')) {function content_5422cbadd7254($_smarty_tpl) {?><h1><?php echo $_smarty_tpl->tpl_vars['formTitle']->value;?>
</h1>
<!--
<form id="addeditsite" class="_100" enctype="multipart/form-data" target="submitframe" method="POST" action="<?php echo $_smarty_tpl->tpl_vars['formurl']->value;?>
">
-->

<form id="addeditsite" class="_100" enctype="multipart/form-data" method="POST">

	<div>

		<span class="_100 block tabmenu">
		
			<a onclick="javascript:show('details');" class="clickable _wb50">Details</a>
			<a onclick="javascript:show('seo');" class="clickable _wb50">SEO</a>
			<a onclick="javascript:show('modules');" class="clickable _wb50">Modules</a>
			<a onclick="javascript:show('security');" class="clickable _wb50">Security</a>
			<!-- a onclick="javascript:show('save');$('#addeditsite').submit();" class="clickable _wb50">Save</a -->
			<a onclick="javascript:show('save');save();" class="clickable _wb50">Save</a>
		
		</span>

		<div id="details" class="tab">
		<table class="_100">

			<tr>

				<th class="_50"><h2>Details</h2></th>
				<th class="_50"><h2>Defaults</h2></th>

			</tr>

			<tr>

				<td class="_50 top">

					<label>

						<span class="_33">Logo</span>
						<span><input type="file" name="logo" id="logo" /></span>

					</label>

					<label>

						<span class="_33">Name</span>
						<span><input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" onkeyup="javascript:setURL();" onchange="javascript:setURL();" /></span>

					</label>

					<label>

						<span class="_33">URL</span>
						<span><input type="text" name="url" id="url" value="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" /></span>

					</label>

					<label>

						<span class="_33">Domain</span>
						<span><input type="text" name="domain" value="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
" /></span>

					</label>

					<label>

						<span class="_33">Force URL?</span>
						<span><input type="checkbox" name="forceurl" value="1" /></span>

					</label>

				</td>
				<td class="_50 top">

					<label>

						<span class="_33">Default Site?</span>
						<span><input type="checkbox" name="default" value="1"<?php if ($_smarty_tpl->tpl_vars['default']->value==1){?> checked="checked"<?php }?> /></span>

					</label>

					<label>

						<span class="_33">Default Task</span>
						<span><select name="default_task">
							<?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['modules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
$_smarty_tpl->tpl_vars['module']->_loop = true;
?>
								<option disabled="disabled" value=""><?php echo $_smarty_tpl->tpl_vars['module']->value['name'];?>
</option>
								<?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['task']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tasks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value){
$_smarty_tpl->tpl_vars['task']->_loop = true;
?>
									<?php if ($_smarty_tpl->tpl_vars['task']->value['module_id']==$_smarty_tpl->tpl_vars['module']->value['id']){?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['task']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['default_task']->value==$_smarty_tpl->tpl_vars['task']->value['id']){?> selected="selected"<?php }?>>&nbsp;&nbsp;- <?php echo $_smarty_tpl->tpl_vars['task']->value['name'];?>
</option>
									<?php }?>
								<?php } ?>
							<?php } ?>
						</select></span>

					</label>

					<label>

						<span class="_33">Default Layout</span>
						<span><select name="default_layout">
							<?php  $_smarty_tpl->tpl_vars['theme'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['theme']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['themes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['theme']->key => $_smarty_tpl->tpl_vars['theme']->value){
$_smarty_tpl->tpl_vars['theme']->_loop = true;
?>
								<option disabled="disabled" value=""><?php echo $_smarty_tpl->tpl_vars['theme']->value['name'];?>
</option>
								<?php  $_smarty_tpl->tpl_vars['layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['layout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['layouts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['layout']->key => $_smarty_tpl->tpl_vars['layout']->value){
$_smarty_tpl->tpl_vars['layout']->_loop = true;
?>
									<?php if ($_smarty_tpl->tpl_vars['layout']->value['theme_id']==$_smarty_tpl->tpl_vars['theme']->value['id']){?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['default_layout']->value==$_smarty_tpl->tpl_vars['layout']->value['id']){?> selected="selected"<?php }?>>&nbsp;&nbsp;- <?php echo $_smarty_tpl->tpl_vars['layout']->value['name'];?>
</option>
									<?php }?>
								<?php } ?>
							<?php } ?>
						</select></span>

					</label>

				</td>

			</tr>

		</table>
		</div>

		<div id="seo" class="hidden tab">
		<table class="_100">

			<tr>

				<th class="_50"><h2>Search Engine Optimization</h2></th>
				<th class="_50"></th>

			</tr>

			<tr>

				<td class="_50 top">

					<label>

						<span class="_33">Title</span>
						<span><input type="text" name="title" id="title" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" /></span>

					</label>

					<label>

						<span class="_33 top">Description</span>
						<span><textarea name="description"><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</textarea></span>

					</label>

					<label>

						<span class="_33 top">Keywords</span>
						<span><textarea name="keywords"><?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
</textarea></span>

					</label>

				</td>
				<td class="_50 top">

					<label>

						<span class="_33">Author</span>
						<span><input type="text" name="author" value="<?php echo $_smarty_tpl->tpl_vars['author']->value;?>
" /></span>

					</label>

					<label>

						<span class="_33">Copyright</span>
						<span><input type="text" name="copyright" value="<?php echo $_smarty_tpl->tpl_vars['copyright']->value;?>
" /></span>

					</label>

					<label>

						<span class="_33 top">Index this site?</span>
						<span><input type="checkbox" name="indexed" value="1"<?php if ($_smarty_tpl->tpl_vars['indexed']->value==1){?> checked="checked"<?php }?> /></span>

					</label>

					<label>

						<span class="_33">Follow links?</span>
						<span><input type="checkbox" name="follow" value="1"<?php if ($_smarty_tpl->tpl_vars['follow']->value==1){?> checked="checked"<?php }?> /></span>

					</label>

					<label>

						<span class="_33">Cache this site?</span>
						<span><input type="checkbox" name="cache" value="1"<?php if ($_smarty_tpl->tpl_vars['cache']->value==1){?> checked="checked"<?php }?> /></span>

					</label>

				</td>

			</tr>

		</table>
		</div>

		<div id="modules" class="hidden tab">
			<h2>Select which modules are enabled on this site:</h2><br />
			<?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['modules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
$_smarty_tpl->tpl_vars['module']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['module']->key;
?><label class="_25 inlineblock"><span><input type="checkbox" name="module_id[]" value="<?php echo $_smarty_tpl->tpl_vars['module']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['module']->value['selected']==1){?> checked="checked"<?php }?> />&nbsp;<?php echo $_smarty_tpl->tpl_vars['module']->value['name'];?>
</span></label><?php } ?>
		</div>

		<div id="security" class="hidden tab">
			<?php echo $_smarty_tpl->tpl_vars['permissionsform']->value;?>

		</div>

		<div id="save" class="hidden tab">
			<div id="saving"><!-- <iframe name="submitframe" id="submitframe" class="_100 noborder" style="height: 400px;"></iframe> --></div>
		</div>

	</div>

	<input type="hidden" name="meta_id" id="meta_id" value="<?php echo $_smarty_tpl->tpl_vars['meta_id']->value;?>
" />
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
	var savedata = $('#addeditsite').serializeArray();

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

//--></script><?php }} ?>