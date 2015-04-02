<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 09:20:14
         compiled from "a6aa65702db42a17b7c1f48c65a940a2699f0ac2" */ ?>
<?php /*%%SmartyHeaderCode:305865217294ec8c532-09279231%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6aa65702db42a17b7c1f48c65a940a2699f0ac2' => 
    array (
      0 => 'a6aa65702db42a17b7c1f48c65a940a2699f0ac2',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '305865217294ec8c532-09279231',
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
  'unifunc' => 'content_5217294eea47c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5217294eea47c')) {function content_5217294eea47c($_smarty_tpl) {?><div><h1><?php echo $_smarty_tpl->tpl_vars['entities']->value['name'];?>
</h1>
<?php echo $_smarty_tpl->tpl_vars['entities']->value['description'];?>

<?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['entities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
?>
	<div style="padding-left:30px;"><h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['description'];?>
</div>
<?php } ?>
</div><?php }} ?>