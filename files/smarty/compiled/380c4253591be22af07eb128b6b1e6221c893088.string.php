<?php /* Smarty version Smarty 3.1.4, created on 2013-09-08 17:34:25
         compiled from "380c4253591be22af07eb128b6b1e6221c893088" */ ?>
<?php /*%%SmartyHeaderCode:14049522cb52178c754-05076168%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '380c4253591be22af07eb128b6b1e6221c893088' => 
    array (
      0 => '380c4253591be22af07eb128b6b1e6221c893088',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '14049522cb52178c754-05076168',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'entities' => 0,
    'id' => 0,
    'entity' => 0,
    'parentname' => 0,
    'relationship' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_522cb522092e4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_522cb522092e4')) {function content_522cb522092e4($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['entity']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['entity']->key;
?>
	<div class="padding_20 black_15 entity">
		<h2 onclick="javascript:show('<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
');"><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</h2>
		<div class="hidden" id="entity_relationships_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
			<?php echo $_smarty_tpl->tpl_vars['entity']->value['description'];?>

			<h3><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
 has relationships with <?php echo $_smarty_tpl->tpl_vars['parentname']->value;?>
:</h3>
			<?php  $_smarty_tpl->tpl_vars['relationship'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['relationship']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['rel'][$_smarty_tpl->tpl_vars['id']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['relationship']->key => $_smarty_tpl->tpl_vars['relationship']->value){
$_smarty_tpl->tpl_vars['relationship']->_loop = true;
?>
				<?php if ($_smarty_tpl->tpl_vars['relationship']->value['id1']==$_smarty_tpl->tpl_vars['entity']->value['id']){?>
					<p><u><?php echo $_smarty_tpl->tpl_vars['entities']->value['entity'][$_smarty_tpl->tpl_vars['relationship']->value['id2']]['name'];?>
</u><br /><strong><?php echo $_smarty_tpl->tpl_vars['relationship']->value['name'];?>
</strong> <?php echo $_smarty_tpl->tpl_vars['relationship']->value['description'];?>
</p>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['relationship']->value['id2']==$_smarty_tpl->tpl_vars['entity']->value['id']){?>
					<p><u><?php echo $_smarty_tpl->tpl_vars['entities']->value['entity'][$_smarty_tpl->tpl_vars['relationship']->value['id1']]['name'];?>
</u><br /><strong><?php echo $_smarty_tpl->tpl_vars['relationship']->value['name'];?>
</strong> <?php echo $_smarty_tpl->tpl_vars['relationship']->value['description'];?>
</p>
				<?php }?>
			<?php } ?>
		</div>
	</div>
<?php } ?>
<style>
	.entity
	{
		position: absolute;
	}
</style>
<script type="text/javascript">

// Show entity info
function show(id)
{
	$('#entity_relationships_'+id).toggle();
}

// Arrange entities
function arrange()
{
	$('.entity').center();
}

arrange();
</script><?php }} ?>