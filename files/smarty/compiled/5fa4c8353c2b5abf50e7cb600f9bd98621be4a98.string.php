<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 09:14:13
         compiled from "5fa4c8353c2b5abf50e7cb600f9bd98621be4a98" */ ?>
<?php /*%%SmartyHeaderCode:17954521727e52a4d40-29315684%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5fa4c8353c2b5abf50e7cb600f9bd98621be4a98' => 
    array (
      0 => '5fa4c8353c2b5abf50e7cb600f9bd98621be4a98',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '17954521727e52a4d40-29315684',
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
  'unifunc' => 'content_521727e540e94',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521727e540e94')) {function content_521727e540e94($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
?>
	<div><h1><?php echo $_smarty_tpl->tpl_vars['entity']->value;?>
</h1></div>
<?php } ?><?php }} ?>