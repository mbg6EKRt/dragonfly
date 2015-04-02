<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 09:20:08
         compiled from "197f5c530da3e564372c8f1c986ad096313f094f" */ ?>
<?php /*%%SmartyHeaderCode:148355217294838bf33-45162497%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '197f5c530da3e564372c8f1c986ad096313f094f' => 
    array (
      0 => '197f5c530da3e564372c8f1c986ad096313f094f',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '148355217294838bf33-45162497',
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
  'unifunc' => 'content_5217294859d1f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5217294859d1f')) {function content_5217294859d1f($_smarty_tpl) {?><div><h1><?php echo $_smarty_tpl->tpl_vars['entities']->value['name'];?>
</h1>
<?php echo $_smarty_tpl->tpl_vars['entities']->value['description'];?>

<?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['entities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
?>
	<div style="padding-left:40px;"><h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['description'];?>
</div>
<?php } ?>
</div><?php }} ?>