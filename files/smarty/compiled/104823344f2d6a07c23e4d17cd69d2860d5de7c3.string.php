<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 09:05:37
         compiled from "104823344f2d6a07c23e4d17cd69d2860d5de7c3" */ ?>
<?php /*%%SmartyHeaderCode:4552521725e1b77416-02320075%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '104823344f2d6a07c23e4d17cd69d2860d5de7c3' => 
    array (
      0 => '104823344f2d6a07c23e4d17cd69d2860d5de7c3',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '4552521725e1b77416-02320075',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'entities' => 0,
    'entity' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_521725e1ce492',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521725e1ce492')) {function content_521725e1ce492($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
?>
	<div><h1><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</h1></div>
<?php } ?><?php }} ?>