<?php /* Smarty version Smarty 3.1.4, created on 2013-06-30 14:18:11
         compiled from "886422340c730e65d7258749384fb64952d53a5f" */ ?>
<?php /*%%SmartyHeaderCode:1157751d03e23d17ce6-53292935%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '886422340c730e65d7258749384fb64952d53a5f' => 
    array (
      0 => '886422340c730e65d7258749384fb64952d53a5f',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '1157751d03e23d17ce6-53292935',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'accesslevels' => 0,
    'value' => 0,
    'access' => 0,
    'label' => 0,
    'usergroups' => 0,
    'group' => 0,
    'per_site_permissions_enabled' => 0,
    'sites' => 0,
    'site' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_51d03e244de9b',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d03e244de9b')) {function content_51d03e244de9b($_smarty_tpl) {?><h2>Set the access level:</h2>
<label>
	<span>Access Level:</span>
	<span><select name="access" id="access" onchange="_lib_user_select_access();">
		<?php  $_smarty_tpl->tpl_vars['label'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['label']->_loop = false;
 $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['accesslevels']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['label']->key => $_smarty_tpl->tpl_vars['label']->value){
$_smarty_tpl->tpl_vars['label']->_loop = true;
 $_smarty_tpl->tpl_vars['value']->value = $_smarty_tpl->tpl_vars['label']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['value']->value==$_smarty_tpl->tpl_vars['access']->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['label']->value;?>
</option><?php } ?>
		</select></span>
</label>

<div id="_lib_user_rights_permissions" class="hidden">
<br />
<h2>Select which groups have access:</h2><br />
<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['usergroups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
$_smarty_tpl->tpl_vars['group']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['group']->key;
?><label class="inlineblock _50 h_30px"><input type="checkbox" name="group_id[]" value="<?php echo $_smarty_tpl->tpl_vars['group']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['group']->value['selected']==1){?> checked="checked"<?php }?> />&nbsp;<?php echo $_smarty_tpl->tpl_vars['group']->value['name'];?>
</label><?php } ?>
</div>

<?php if ($_smarty_tpl->tpl_vars['per_site_permissions_enabled']->value==true){?>
<div id="_lib_user_site_permissions" class="hidden">
<br />
<h2>Select which groups have access for each site:</h2><br />
<?php  $_smarty_tpl->tpl_vars['site'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['site']->_loop = false;
 $_smarty_tpl->tpl_vars['sitekey'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sites']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['site']->key => $_smarty_tpl->tpl_vars['site']->value){
$_smarty_tpl->tpl_vars['site']->_loop = true;
 $_smarty_tpl->tpl_vars['sitekey']->value = $_smarty_tpl->tpl_vars['site']->key;
?>
	<h3><?php echo $_smarty_tpl->tpl_vars['site']->value['name'];?>
</h3>
	<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['usergroups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
$_smarty_tpl->tpl_vars['group']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['group']->key;
?><label class="inlineblock _50 h_30px"><input type="checkbox" name="site_<?php echo $_smarty_tpl->tpl_vars['site']->value['id'];?>
_group_<?php echo $_smarty_tpl->tpl_vars['group']->value['id'];?>
" value="Y"<?php if ($_smarty_tpl->tpl_vars['group']->value['selected']==1){?> checked="checked"<?php }?> />&nbsp;<?php echo $_smarty_tpl->tpl_vars['group']->value['name'];?>
</label><?php } ?>
<?php } ?>
</div>
<?php }?>

<script type="text/javascript">

// Handle a change in the access select element

function _lib_user_select_access()
{
	var access = $( '#access' ).val();
	
	switch( access )
	{
		case "rights":
			$( "#_lib_user_site_permissions" ).hide( );
			$( "#_lib_user_rights_permissions" ).show( );
		break;
		
		<?php if ($_smarty_tpl->tpl_vars['per_site_permissions_enabled']->value==true){?>
		case "site":
			$( "#_lib_user_rights_permissions" ).hide( );
			$( "#_lib_user_site_permissions" ).show( );
		break;
		<?php }?>
		
		default:
			$( "#_lib_user_rights_permissions" ).hide( );
			$( "#_lib_user_site_permissions" ).hide( );
		break;
	}
}

// Set initial visibility

_lib_user_select_access();

</script><?php }} ?>