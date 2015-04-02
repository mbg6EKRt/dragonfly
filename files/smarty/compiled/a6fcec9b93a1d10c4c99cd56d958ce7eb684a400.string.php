<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 09:19:55
         compiled from "a6fcec9b93a1d10c4c99cd56d958ce7eb684a400" */ ?>
<?php /*%%SmartyHeaderCode:249885217293be24e36-98104995%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6fcec9b93a1d10c4c99cd56d958ce7eb684a400' => 
    array (
      0 => 'a6fcec9b93a1d10c4c99cd56d958ce7eb684a400',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '249885217293be24e36-98104995',
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
  'unifunc' => 'content_5217293c1015e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5217293c1015e')) {function content_5217293c1015e($_smarty_tpl) {?><div><h1><?php echo $_smarty_tpl->tpl_vars['entities']->value['name'];?>
</h1>
<?php echo $_smarty_tpl->tpl_vars['entities']->value['description'];?>

<?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['entities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
?>
	<div style="padding-left:50px;"><h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['description'];?>
</div>
<?php } ?>
</div><?php }} ?>