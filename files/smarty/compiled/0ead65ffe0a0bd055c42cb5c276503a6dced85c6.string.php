<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 09:16:42
         compiled from "0ead65ffe0a0bd055c42cb5c276503a6dced85c6" */ ?>
<?php /*%%SmartyHeaderCode:325995217287ae6ee88-56216329%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ead65ffe0a0bd055c42cb5c276503a6dced85c6' => 
    array (
      0 => '0ead65ffe0a0bd055c42cb5c276503a6dced85c6',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '325995217287ae6ee88-56216329',
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
  'unifunc' => 'content_5217287b0e327',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5217287b0e327')) {function content_5217287b0e327($_smarty_tpl) {?><div><h1><?php echo $_smarty_tpl->tpl_vars['entities']->value['name'];?>
</h1>
<?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['entities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
?>
	<div><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</div>
<?php } ?>
</div><?php }} ?>