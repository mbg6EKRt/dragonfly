<?php /* Smarty version Smarty 3.1.4, created on 2014-09-24 22:27:26
         compiled from "1cca91734bf7153f3f1b948fae05e3eef9c63cc6" */ ?>
<?php /*%%SmartyHeaderCode:184685423292e59ec26-96879026%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1cca91734bf7153f3f1b948fae05e3eef9c63cc6' => 
    array (
      0 => '1cca91734bf7153f3f1b948fae05e3eef9c63cc6',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '184685423292e59ec26-96879026',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'show_search' => 0,
    'list' => 0,
    'startnum' => 0,
    'endnum' => 0,
    'count' => 0,
    'pagenum' => 0,
    'totalpagesnum' => 0,
    'adminlist' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5423292e6e4b6',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5423292e6e4b6')) {function content_5423292e6e4b6($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['show_search']->value!='no'){?>
<div class="padding_10 white_15 border_radius_4px">
	Search: <input type="text" name="list_search" id="list_search" onkeyup="javascript:ajax_search();" />
</div>

<div id="list">
<?php }?>
<?php echo $_smarty_tpl->tpl_vars['list']->value;?>

<div class="padding_10 white_15 border_radius_4px">
	Showing <?php echo $_smarty_tpl->tpl_vars['startnum']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['endnum']->value;?>
 of <?php echo $_smarty_tpl->tpl_vars['count']->value;?>
. Page <input type="text" name="list_page" id="list_page" value="<?php echo $_smarty_tpl->tpl_vars['pagenum']->value;?>
" class="center _30px" onkeypress="javascript:return set_page(event);" /> of <?php echo $_smarty_tpl->tpl_vars['totalpagesnum']->value;?>

</div>
<?php if ($_smarty_tpl->tpl_vars['show_search']->value!='no'){?>
</div>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['show_search']->value!='no'){?>
<script type="text/javascript"><!--

// Set the page number
function set_page(e) 
{
	// We can specify the page number
	if (typeof e == 'number')
	{
		var loadURL = '<?php echo $_smarty_tpl->tpl_vars['adminlist']->value;?>
/&search='+$('#list_search').val()+'&page='+e;
	}
	// Or, handle the 'enter' keypress event on the list_page element
	else
	{
		if (e.keyCode == 13) 
		{
			var loadURL = '<?php echo $_smarty_tpl->tpl_vars['adminlist']->value;?>
/&search='+$('#list_search').val()+'&page='+$('#list_page').val();
		}
	}

	$.ajax({
		url: loadURL,
		context: document.body,
		success: function(response, status, xhr)
		{
			if (status == 'success')
			{
				$('#list').html( response );
			}
		}
	});

	return false;
}

function ajax_search()
{
	var loadURL = '<?php echo $_smarty_tpl->tpl_vars['adminlist']->value;?>
/&search='+$('#list_search').val();
	
	$.ajax({
		url: loadURL,
		context: document.body,
		success: function(response, status, xhr)
		{
			if (status == 'success')
			{
				$('#list').html( response );
			}
		}
	});
}

function delete_site(url)
{
	var delete_site = confirm('Are you sure?');

	if (delete_site == true)
	{
		$.ajax({
			url: url,
			context: document.body,
			success: function(response, status, xhr)
			{
				if (response == 'success')
				{
					loadFrame('<?php echo $_smarty_tpl->tpl_vars['adminlist']->value;?>
', true);
				}
			}
		});
	}
}

//--></script>
<?php }?><?php }} ?>