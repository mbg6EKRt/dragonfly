<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 09:02:58
         compiled from "9be7c1672904c7a878631074f37cd74f9f218f83" */ ?>
<?php /*%%SmartyHeaderCode:1149352172542175b72-91996262%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9be7c1672904c7a878631074f37cd74f9f218f83' => 
    array (
      0 => '9be7c1672904c7a878631074f37cd74f9f218f83',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '1149352172542175b72-91996262',
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
  'unifunc' => 'content_5217254231b88',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5217254231b88')) {function content_5217254231b88($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['entities']->value;?>

<?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
?>
	<div><h1><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</h1></div>
<?php } ?><?php }} ?>