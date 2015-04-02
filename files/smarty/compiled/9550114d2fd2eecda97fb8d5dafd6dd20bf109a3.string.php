<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 00:27:27
         compiled from "9550114d2fd2eecda97fb8d5dafd6dd20bf109a3" */ ?>
<?php /*%%SmartyHeaderCode:180685216ac6f6d05c1-84936231%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9550114d2fd2eecda97fb8d5dafd6dd20bf109a3' => 
    array (
      0 => '9550114d2fd2eecda97fb8d5dafd6dd20bf109a3',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '180685216ac6f6d05c1-84936231',
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
  'unifunc' => 'content_5216ac6f874b0',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5216ac6f874b0')) {function content_5216ac6f874b0($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
?>
	<div><h1><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</h1></div>
<?php } ?><?php }} ?>