<?php /* Smarty version Smarty 3.1.4, created on 2013-09-08 18:18:00
         compiled from "df4c57a2ddfeba473ff421d26c8ac11a650dbc68" */ ?>
<?php /*%%SmartyHeaderCode:6954522cbf5819a045-82408616%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df4c57a2ddfeba473ff421d26c8ac11a650dbc68' => 
    array (
      0 => 'df4c57a2ddfeba473ff421d26c8ac11a650dbc68',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '6954522cbf5819a045-82408616',
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
  'unifunc' => 'content_522cbf58b035d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_522cbf58b035d')) {function content_522cbf58b035d($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
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
		top: 0;
		left: 0;
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

position();
</script><?php }} ?>