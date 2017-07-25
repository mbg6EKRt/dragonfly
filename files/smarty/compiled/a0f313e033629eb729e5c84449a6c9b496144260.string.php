<?php /* Smarty version Smarty 3.1.4, created on 2017-07-25 20:55:03
         compiled from "a0f313e033629eb729e5c84449a6c9b496144260" */ ?>
<?php /*%%SmartyHeaderCode:1751306467597794074b65f2-97887189%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0f313e033629eb729e5c84449a6c9b496144260' => 
    array (
      0 => 'a0f313e033629eb729e5c84449a6c9b496144260',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '1751306467597794074b65f2-97887189',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5977940755a2a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5977940755a2a')) {function content_5977940755a2a($_smarty_tpl) {?><table class="menu">

	<tr>

	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
		<td><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['href'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
</a></td>
		<td width="5"></td>
	<?php } ?>

	</tr>

</table><?php }} ?>