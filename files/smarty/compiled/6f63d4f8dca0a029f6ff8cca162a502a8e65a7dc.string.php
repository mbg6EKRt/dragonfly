<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 09:15:59
         compiled from "6f63d4f8dca0a029f6ff8cca162a502a8e65a7dc" */ ?>
<?php /*%%SmartyHeaderCode:200805217284f2ace93-20712376%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f63d4f8dca0a029f6ff8cca162a502a8e65a7dc' => 
    array (
      0 => '6f63d4f8dca0a029f6ff8cca162a502a8e65a7dc',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '200805217284f2ace93-20712376',
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
  'unifunc' => 'content_5217284f45a3e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5217284f45a3e')) {function content_5217284f45a3e($_smarty_tpl) {?><div><h1><?php echo $_smarty_tpl->tpl_vars['entities']->value['name'];?>
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