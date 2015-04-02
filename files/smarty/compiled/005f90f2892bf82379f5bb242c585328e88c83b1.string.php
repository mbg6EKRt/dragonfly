<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 14:33:25
         compiled from "005f90f2892bf82379f5bb242c585328e88c83b1" */ ?>
<?php /*%%SmartyHeaderCode:3049521772b5458a94-04643402%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '005f90f2892bf82379f5bb242c585328e88c83b1' => 
    array (
      0 => '005f90f2892bf82379f5bb242c585328e88c83b1',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '3049521772b5458a94-04643402',
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
  'unifunc' => 'content_521772b57ce2a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521772b57ce2a')) {function content_521772b57ce2a($_smarty_tpl) {?><div><h1><?php echo $_smarty_tpl->tpl_vars['entities']->value['name'];?>
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
		<div style="padding-left:30px;"><h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['description'];?>

		<?php  $_smarty_tpl->tpl_vars['relationship'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['relationship']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['relationships']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['relationship']->key => $_smarty_tpl->tpl_vars['relationship']->value){
$_smarty_tpl->tpl_vars['relationship']->_loop = true;
?>
			<b><?php echo $_smarty_tpl->tpl_vars['relationship']->value['description'];?>
</b>
		<?php } ?>
		<?php smarty_template_function_showentities($_smarty_tpl,array('subentities'=>$_smarty_tpl->tpl_vars['entity']->value['entities']));?>
</div>
	<?php } ?><?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;}}?>

</div>

<?php smarty_template_function_showentities($_smarty_tpl,array('subentities'=>$_smarty_tpl->tpl_vars['entities']->value['entities'],'relationships'=>$_smarty_tpl->tpl_vars['entities']->value['rel']));?>
<?php }} ?>