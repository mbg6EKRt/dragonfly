<?php /* Smarty version Smarty 3.1.4, created on 2014-04-19 17:27:25
         compiled from "76c437004581ed10d1cac8515e4ba2110eb1d224" */ ?>
<?php /*%%SmartyHeaderCode:1467961552535295dd51da72-30477347%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '76c437004581ed10d1cac8515e4ba2110eb1d224' => 
    array (
      0 => '76c437004581ed10d1cac8515e4ba2110eb1d224',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '1467961552535295dd51da72-30477347',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'entities' => 0,
    'first' => 0,
    'id' => 0,
    'entity' => 0,
    'relationship' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_535295dd70fff',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_535295dd70fff')) {function content_535295dd70fff($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['first'] = new Smarty_variable('yes', null, 0);?>
<?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['entities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['entity']->key;
?>
<div class="padding_20 black_15 <?php if ($_smarty_tpl->tpl_vars['first']->value=='no'){?> entity<?php }?><?php if ($_smarty_tpl->tpl_vars['first']->value=='yes'){?><?php $_smarty_tpl->tpl_vars['first'] = new Smarty_variable('no', null, 0);?> firstentity<?php }?>" id="entity_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" onclick="javascript:show('<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
');">
	<strong><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</strong>
	<div class="relationship" id="entity_relationships_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
		<?php echo $_smarty_tpl->tpl_vars['entity']->value['description'];?>

		<h3><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
 has relationships with:</h3>
		<?php  $_smarty_tpl->tpl_vars['relationship'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['relationship']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entities']->value['relationships']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['relationship']->key => $_smarty_tpl->tpl_vars['relationship']->value){
$_smarty_tpl->tpl_vars['relationship']->_loop = true;
?>
			<?php if ($_smarty_tpl->tpl_vars['relationship']->value['id1']==$_smarty_tpl->tpl_vars['entity']->value['id']){?>
				<p><u><?php echo $_smarty_tpl->tpl_vars['entities']->value['children']['entities'][$_smarty_tpl->tpl_vars['relationship']->value['id2']]['name'];?>
</u><br /><strong><?php echo $_smarty_tpl->tpl_vars['relationship']->value['name'];?>
</strong> <?php echo $_smarty_tpl->tpl_vars['relationship']->value['description'];?>
</p>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['relationship']->value['id2']==$_smarty_tpl->tpl_vars['entity']->value['id']){?>
				<p><u><?php echo $_smarty_tpl->tpl_vars['entities']->value['children']['entities'][$_smarty_tpl->tpl_vars['relationship']->value['id1']]['name'];?>
</u><br /><strong><?php echo $_smarty_tpl->tpl_vars['relationship']->value['name'];?>
</strong> <?php echo $_smarty_tpl->tpl_vars['relationship']->value['description'];?>
</p>
			<?php }?>
		<?php } ?>
	</div>
</div>
<?php } ?>

<style>
	.entity{ width:150px;height:150px;text-align:center; }
	.firstentity{ width:150px;height:150px;text-align:center; }
	.relationship{ width:100%;text-align:center; }
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
	
	$('.relationship').offset({
		left:((width/2) - ($('.relationship').width()/2)),
		top:((height/2) - ($('.relationship').height()/2))
	});
	
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
	var radius = 200; // radius of the circle
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
</script>
<?php }} ?>