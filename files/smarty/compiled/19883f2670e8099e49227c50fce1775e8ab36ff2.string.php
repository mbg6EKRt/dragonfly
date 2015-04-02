<?php /* Smarty version Smarty 3.1.4, created on 2013-09-08 15:22:39
         compiled from "19883f2670e8099e49227c50fce1775e8ab36ff2" */ ?>
<?php /*%%SmartyHeaderCode:8854522c963f778e47-46825673%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '19883f2670e8099e49227c50fce1775e8ab36ff2' => 
    array (
      0 => '19883f2670e8099e49227c50fce1775e8ab36ff2',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '8854522c963f778e47-46825673',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'entities' => 0,
    'entity' => 0,
    'parentname' => 0,
    'id' => 0,
    'relationship' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_522c963fd70b3',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_522c963fd70b3')) {function content_522c963fd70b3($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['entity']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['entity']->key;
?>
	<div class="padding_20 black_15">
	<h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['description'];?>

	<h3><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
 has relationships with <?php echo $_smarty_tpl->tpl_vars['parentname']->value;?>
:</h3>
	<?php $_smarty_tpl->tpl_vars['relationships'] = new Smarty_variable($_smarty_tpl->tpl_vars['entities']->value['rel'][$_smarty_tpl->tpl_vars['id']->value], null, 0);?>
	<?php  $_smarty_tpl->tpl_vars['relationship'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['relationship']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['rel'][$_smarty_tpl->tpl_vars['id']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['relationship']->key => $_smarty_tpl->tpl_vars['relationship']->value){
$_smarty_tpl->tpl_vars['relationship']->_loop = true;
?>
		<?php if ($_smarty_tpl->tpl_vars['relationship']->value['id1']==$_smarty_tpl->tpl_vars['entity']->value['id']){?>
			<p><strong><?php echo $_smarty_tpl->tpl_vars['relationship']->value['name'];?>
</strong> <?php echo $_smarty_tpl->tpl_vars['relationship']->value['description'];?>
</p>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['relationship']->value['id2']==$_smarty_tpl->tpl_vars['entity']->value['id']){?>
			<p><strong><?php echo $_smarty_tpl->tpl_vars['relationship']->value['name'];?>
</strong> <?php echo $_smarty_tpl->tpl_vars['relationship']->value['description'];?>
</p>
		<?php }?>
	<?php } ?>
	</div>
<?php } ?><?php }} ?>