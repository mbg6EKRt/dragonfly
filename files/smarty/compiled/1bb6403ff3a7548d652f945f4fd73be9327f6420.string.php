<?php /* Smarty version Smarty 3.1.4, created on 2015-04-11 14:50:04
         compiled from "1bb6403ff3a7548d652f945f4fd73be9327f6420" */ ?>
<?php /*%%SmartyHeaderCode:15363673765529187c02f2f1-09475528%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1bb6403ff3a7548d652f945f4fd73be9327f6420' => 
    array (
      0 => '1bb6403ff3a7548d652f945f4fd73be9327f6420',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '15363673765529187c02f2f1-09475528',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'formTitle' => 0,
    'formurl' => 0,
    'name' => 0,
    'url' => 0,
    'folder' => 0,
    'file' => 0,
    'namespace' => 0,
    'class' => 0,
    'title' => 0,
    'description' => 0,
    'keywords' => 0,
    'author' => 0,
    'copyright' => 0,
    'indexed' => 0,
    'follow' => 0,
    'cache' => 0,
    'sites' => 0,
    'site' => 0,
    'permissionsform' => 0,
    'meta_id' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5529187c1512a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5529187c1512a')) {function content_5529187c1512a($_smarty_tpl) {?><h1><?php echo $_smarty_tpl->tpl_vars['formTitle']->value;?>
</h1>
<!--
<form id="addeditsite" class="_100" enctype="multipart/form-data" target="submitframe" method="POST" action="<?php echo $_smarty_tpl->tpl_vars['formurl']->value;?>
">
-->
<form id="addeditmodule" class="_100" enctype="multipart/form-data" method="POST">

	<div>

		<span class="_100 block tabmenu">
		
			<a onclick="javascript:show('details');" class="clickable _wb50">Details</a>
			<a onclick="javascript:show('seo');" class="clickable _wb50">SEO</a>
			<a onclick="javascript:show('sites');" class="clickable _wb50">Sites</a>
			<a onclick="javascript:show('security');" class="clickable _wb50">Security</a>
			<!-- a onclick="javascript:show('save');$('#addeditsite').submit();" class="clickable _wb50">Save</a -->
			<a onclick="javascript:show('save');save();" class="clickable _wb50">Save</a>
		
		</span>

		<div id="details" class="tab white_25 shadow">
		<table class="_100">

			<tr>

				<th><h2>Details</h2></th>

			</tr>

			<tr>

				<td>

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

						<span class="_33">Force URL?</span>
						<span><input type="checkbox" name="forceurl" value="1" /></span>

					</label>

				</td>
				
				<td class="_50">
				
					<label>

						<span class="_33">Folder</span>
						<span><input type="text" name="folder" id="folder" value="<?php echo $_smarty_tpl->tpl_vars['folder']->value;?>
" /></span>

					</label>
				
					<label>

						<span class="_33">File</span>
						<span><input type="text" name="file" id="file" value="<?php echo $_smarty_tpl->tpl_vars['file']->value;?>
" /></span>

					</label>
				
					<label>

						<span class="_33">Namespace</span>
						<span><input type="text" name="namespace" id="namespace" value="<?php echo $_smarty_tpl->tpl_vars['namespace']->value;?>
" /></span>

					</label>
				
					<label>

						<span class="_33">Class</span>
						<span><input type="text" name="class" id="class" value="<?php echo $_smarty_tpl->tpl_vars['class']->value;?>
" /></span>

					</label>
				
				</td>

			</tr>

		</table>
		</div>

		<div id="seo" class="hidden tab white_25 shadow">
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

						<span class="_33 top">Index this module?</span>
						<span><input type="checkbox" name="indexed" value="1"<?php if ($_smarty_tpl->tpl_vars['indexed']->value==1){?> checked="checked"<?php }?> /></span>

					</label>

					<label>

						<span class="_33">Follow links?</span>
						<span><input type="checkbox" name="follow" value="1"<?php if ($_smarty_tpl->tpl_vars['follow']->value==1){?> checked="checked"<?php }?> /></span>

					</label>

					<label>

						<span class="_33">Cache this module?</span>
						<span><input type="checkbox" name="cache" value="1"<?php if ($_smarty_tpl->tpl_vars['cache']->value==1){?> checked="checked"<?php }?> /></span>

					</label>

				</td>

			</tr>

		</table>
		</div>

		<div id="sites" class="hidden tab white_25 shadow">
			<h2>Select which sites this module is enabled on:</h2><br />
			<?php  $_smarty_tpl->tpl_vars['site'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['site']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sites']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['site']->key => $_smarty_tpl->tpl_vars['site']->value){
$_smarty_tpl->tpl_vars['site']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['site']->key;
?><label class="_50 inlineblock"><span><input type="checkbox" name="site_id[]" value="<?php echo $_smarty_tpl->tpl_vars['site']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['site']->value['selected']==1){?> checked="checked"<?php }?> />&nbsp;<?php echo $_smarty_tpl->tpl_vars['site']->value['name'];?>
</span></label><?php } ?>
		</div>

		<div id="security" class="hidden tab white_25 shadow">
			<?php echo $_smarty_tpl->tpl_vars['permissionsform']->value;?>

		</div>

		<div id="save" class="hidden tab white_25 shadow">
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
	var savedata = $('#addeditmodule').serializeArray();

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