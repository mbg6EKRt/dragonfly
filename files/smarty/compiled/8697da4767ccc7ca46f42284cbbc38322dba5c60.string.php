<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 16:10:15
         compiled from "8697da4767ccc7ca46f42284cbbc38322dba5c60" */ ?>
<?php /*%%SmartyHeaderCode:30392521789673478f3-18231372%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8697da4767ccc7ca46f42284cbbc38322dba5c60' => 
    array (
      0 => '8697da4767ccc7ca46f42284cbbc38322dba5c60',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '30392521789673478f3-18231372',
  'function' => 
  array (
    'showentities' => 
    array (
      'parameter' => 
      array (
      ),
      'compiled' => '',
    ),
  ),
  'variables' => 
  array (
    'entities' => 0,
    'subentities' => 0,
    'entity' => 0,
    'relationships' => 0,
    'relationship' => 0,
  ),
  'has_nocache_code' => 0,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_521789678144a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521789678144a')) {function content_521789678144a($_smarty_tpl) {?><div><h1><?php echo $_smarty_tpl->tpl_vars['entities']->value['name'];?>
</h1>
<?php echo $_smarty_tpl->tpl_vars['entities']->value['description'];?>

<?php if (!function_exists('smarty_template_function_showentities')) {
    function smarty_template_function_showentities($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['showentities']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
	<?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['subentities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
?>
		<div class="padding_20 shadow"><h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['description'];?>

		<h3>Relationships</h3>
		<?php  $_smarty_tpl->tpl_vars['relationship'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['relationship']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['relationships']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['relationship']->key => $_smarty_tpl->tpl_vars['relationship']->value){
$_smarty_tpl->tpl_vars['relationship']->_loop = true;
?>
			<?php if ($_smarty_tpl->tpl_vars['relationship']->value['id1']==$_smarty_tpl->tpl_vars['entity']->value['id']){?>
				<p><?php echo $_smarty_tpl->tpl_vars['relationship']->value['description'];?>
</p>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['relationship']->value['id2']==$_smarty_tpl->tpl_vars['entity']->value['id']){?>
				<p><?php echo $_smarty_tpl->tpl_vars['relationship']->value['description'];?>
</p>
			<?php }?>
		<?php } ?>
		<?php smarty_template_function_showentities($_smarty_tpl,array('subentities'=>$_smarty_tpl->tpl_vars['entity']->value['entities'],'relationships'=>$_smarty_tpl->tpl_vars['entity']->value['rel']));?>
</div>
	<?php } ?><?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;}}?>

</div>

<?php smarty_template_function_showentities($_smarty_tpl,array('subentities'=>$_smarty_tpl->tpl_vars['entities']->value['entities'],'relationships'=>$_smarty_tpl->tpl_vars['entities']->value['rel']));?>
<?php }} ?>