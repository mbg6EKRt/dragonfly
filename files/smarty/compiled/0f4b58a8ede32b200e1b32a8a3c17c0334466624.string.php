<?php /* Smarty version Smarty 3.1.4, created on 2013-09-08 18:40:32
         compiled from "0f4b58a8ede32b200e1b32a8a3c17c0334466624" */ ?>
<?php /*%%SmartyHeaderCode:13457522cc4a076ca08-00689457%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f4b58a8ede32b200e1b32a8a3c17c0334466624' => 
    array (
      0 => '0f4b58a8ede32b200e1b32a8a3c17c0334466624',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '13457522cc4a076ca08-00689457',
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
  'unifunc' => 'content_522cc4a11518c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_522cc4a11518c')) {function content_522cc4a11518c($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['entity']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['entity']->key;
?>
	<div class="padding_20 black_15 block entity" id="entity_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
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

function position()
{
	width = $(document).width();
	height = $(document).height();
	
	<?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['entity']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['entity']->key;
?>
	$('#entity_'+<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
).offset({
		left:((width/2) - ($('#entity_'+<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
).width()/2)),
		top:((height/2) - ($('#entity_'+<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
).height()/2))
	}); 
	<?php } ?>
}
</script><?php }} ?>