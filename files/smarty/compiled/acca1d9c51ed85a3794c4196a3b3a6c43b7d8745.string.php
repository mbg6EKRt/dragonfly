<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 09:17:33
         compiled from "acca1d9c51ed85a3794c4196a3b3a6c43b7d8745" */ ?>
<?php /*%%SmartyHeaderCode:8814521728add14c03-21769244%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'acca1d9c51ed85a3794c4196a3b3a6c43b7d8745' => 
    array (
      0 => 'acca1d9c51ed85a3794c4196a3b3a6c43b7d8745',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '8814521728add14c03-21769244',
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
  'unifunc' => 'content_521728adedd74',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521728adedd74')) {function content_521728adedd74($_smarty_tpl) {?><div><h1><?php echo $_smarty_tpl->tpl_vars['entities']->value['name'];?>
</h1>
<?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['entities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
?>
	<div><h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</h2></div>
<?php } ?>
</div><?php }} ?>