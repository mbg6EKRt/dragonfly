<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 09:19:25
         compiled from "8a78ff2ed2ef4cfbe52f0fea94334aa30c799a62" */ ?>
<?php /*%%SmartyHeaderCode:100295217291d609343-00159085%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a78ff2ed2ef4cfbe52f0fea94334aa30c799a62' => 
    array (
      0 => '8a78ff2ed2ef4cfbe52f0fea94334aa30c799a62',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '100295217291d609343-00159085',
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
  'unifunc' => 'content_5217291d81457',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5217291d81457')) {function content_5217291d81457($_smarty_tpl) {?><div><h1><?php echo $_smarty_tpl->tpl_vars['entities']->value['name'];?>
</h1>
<?php echo $_smarty_tpl->tpl_vars['entities']->value['description'];?>

<?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['entities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
?>
	<div><h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['description'];?>
</div>
<?php } ?>
</div><?php }} ?>