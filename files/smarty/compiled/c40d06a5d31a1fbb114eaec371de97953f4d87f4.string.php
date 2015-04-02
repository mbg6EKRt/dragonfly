<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 09:01:47
         compiled from "c40d06a5d31a1fbb114eaec371de97953f4d87f4" */ ?>
<?php /*%%SmartyHeaderCode:22166521724fb138f73-09700792%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c40d06a5d31a1fbb114eaec371de97953f4d87f4' => 
    array (
      0 => 'c40d06a5d31a1fbb114eaec371de97953f4d87f4',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '22166521724fb138f73-09700792',
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
  'unifunc' => 'content_521724fb2b68f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521724fb2b68f')) {function content_521724fb2b68f($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
?>
	<div><h1><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</h1></div>
<?php } ?><?php }} ?>