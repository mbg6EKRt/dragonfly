<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 09:15:39
         compiled from "32930e1b7acd51d7fccec92960e184c03b131dc4" */ ?>
<?php /*%%SmartyHeaderCode:115055217283b6be948-80686612%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '32930e1b7acd51d7fccec92960e184c03b131dc4' => 
    array (
      0 => '32930e1b7acd51d7fccec92960e184c03b131dc4',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '115055217283b6be948-80686612',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'entity' => 0,
    'entities' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5217283ba15a4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5217283ba15a4')) {function content_5217283ba15a4($_smarty_tpl) {?><div><h1><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</h1>
<?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['rel']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
?>
	<div><?php echo $_smarty_tpl->tpl_vars['entity']->value;?>
</div>
<?php } ?>
</div><?php }} ?>