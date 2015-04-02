<?php /* Smarty version Smarty 3.1.4, created on 2013-09-08 20:00:13
         compiled from "95e68b58b901387cc9510525ab070a5c8175985c" */ ?>
<?php /*%%SmartyHeaderCode:6737522cd74de27145-00729304%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95e68b58b901387cc9510525ab070a5c8175985c' => 
    array (
      0 => '95e68b58b901387cc9510525ab070a5c8175985c',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '6737522cd74de27145-00729304',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'entities' => 0,
    'first' => 0,
    'id' => 0,
    'entity' => 0,
    'parentname' => 0,
    'relationship' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_522cd74eaad1b',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_522cd74eaad1b')) {function content_522cd74eaad1b($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['first'] = new Smarty_variable('yes', null, 0);?>
<?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['entity']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['entity']->key;
?>
	<div class="padding_20 black_15 block <?php if ($_smarty_tpl->tpl_vars['first']->value=='no'){?> entity<?php }?><?php if ($_smarty_tpl->tpl_vars['first']->value=='yes'){?><?php $_smarty_tpl->tpl_vars['first'] = new Smarty_variable('no', null, 0);?> firstentity<?php }?>" id="entity_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
		<strong onclick="javascript:show('<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
');"><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</strong>
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
		width:160px;
		height:160px;
		text-align:center;
	}
	.firstentity
	{
		position: absolute;
		width:160px;
		height:160px;
		text-align:center;
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
	
	arrange();
}

function arrange()
{
	var radius = 220; // radius of the circle
	var fields = $('.entity'),
		container = $(document),
		width = container.width(),
		height = container.height(),
		angle = 0,
		step = (2*Math.PI) / fields.length;
		
	fields.each(function() {
		var x = Math.round(width/2 + radius * Math.cos(angle) - $(this).width()/2),
			y = Math.round(height/2 + radius * Math.sin(angle) - $(this).height()/2);
		$(this).css({
			left: x + 'px',
			top: y + 'px'
		});
		angle += step;
	});
}

position();
</script><?php }} ?>